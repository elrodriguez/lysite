<?php

namespace App\Http\Livewire\HelpGpt;

use App\Models\HistoryGpt;
use App\Models\HistoryGptItem;
use App\Models\Person;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Psr7\Request as GRequest;
use Livewire\WithFileUploads;

class BoxGpt extends Component
{

    use WithFileUploads;
    public $typeAction = 1;
    public $history = [];
    public $historyItems = [];
    public $consulta = null;
    public $file = null;
    public $fileName;
    public $resultado = null;
    public $paraphrase_left;
    public $normativa;
    public $prompt = 0;
    /*  Asistente de Chat GPT  */
    public $thread_id = null;
    public $run_id = null;
    public $assistant_id = null;
    public $message = null;

    public function mount()
    {
        $permisos = Person::where('user_id', Auth::user()->id)->first();
        $this->paraphrase_left = $permisos->paraphrase_allowed - $permisos->paraphrase_used;
    }
    public function render()
    {
        $this->getHistory($this->typeAction);
        return view('livewire.help-gpt.box-gpt');
    }

    public function setBtnActive($num)
    {
        $this->typeAction = $num;
        $this->resultado = null;
        $this->getHistory($num);
    }

    public function getHistory($num)
    {
        $this->history = HistoryGpt::where('user_id', Auth::id())
            ->where('type_action', $num)
            ->first();
        if ($this->history) {
            $this->historyItems = HistoryGptItem::where('history_id', $this->history->id)->get();
        }
    }

    public function formatDateBox($date)
    {

        $fechaCreacion = $date;

        // Obtén la fecha actual
        $fechaActual = Carbon::now();

        // Verifica si el año de la fecha de creación es diferente al año actual
        if ($fechaCreacion->year != $fechaActual->year) {
            // Si el año es diferente, muestra el año también en el formato
            $formattedDate = $fechaCreacion->format('h:i A | F j, Y');
        } else {
            // Si el año es igual, omite el año en el formato
            $formattedDate = $fechaCreacion->format('h:i A | F j');
        }

        // Imprime la fecha formateada
        return $formattedDate;
    }

    public function saveMessageUser(Request $request)
    {   
        $this->fileName = null;
        if($this->file){
            $basePath = base_path();
            $asistentePath = $basePath . '/asistente_lyon';
        
            if (!is_dir($asistentePath)) {
                mkdir($asistentePath);
            }
        
            $extension = $this->file->getClientOriginalExtension();
            $this->fileName = $this->randomName() . '.' . $extension;

            $path = $this->file->storeAs('asistente_lyon', $this->fileName);
        }

        $history = HistoryGpt::firstOrCreate(
            [
                'type_action' => $this->typeAction,
                'user_id'   => Auth::id()
            ]
        );

        HistoryGptItem::create([
            'history_id' => $history->id,
            'my_user' => true,
            'file_original_name' => null,
            'content' => $this->message
        ]);

        $resultado = null;
        $messages = null;
        if ($this->typeAction == 1) {
            $resultado = $this->paraphrasing();
        } elseif ($this->typeAction == 2) {
            $resultado = $this->recommendations();
        } elseif ($this->typeAction == 3) {
            $resultado = $this->grammarCorrection();
        }    elseif($this->typeAction == 4){
                $messages = $this->getThreadId($this->message);  //crear u obtener el thread_id devuelve lista de mensajes

                    try {
                        if(!isset($messages[0])){
                        while($messages['status'] == "Pending"){
                            $messages = $this->getPendingRun($messages);
                        }
                    }
                    } catch (\Throwable $th) {

                    }
        $resultado = $messages[0][0]['text']['value'];   //la respuesta final
        } elseif ($this->typeAction == 5) {
            $resultado = $this->references();
        }

        HistoryGptItem::create([
            'history_id' => $history->id,
            'my_user' => false,
            'file_original_name' => null,
            'content' => $resultado
        ]);

        $this->consulta = null;
        $this->file = null;
        $this->fileName = null;
    }


    public function paraphrasing()
    {
        $resultado = null;

        if (strlen($this->consulta) > 10) {
            $this->resultado = "espera un momento...";
            $permisos = Person::where('user_id', Auth::user()->id)->first();
            $p_allowed = $permisos->paraphrase_allowed;
            $p_used = $permisos->paraphrase_used;

            if ($p_allowed > $p_used) {
                $max_tokens = 3400;
                $temperature = 0.7;
                $consulta = null;
                $result_text = "hubo un problema, intenta mas tarde";

                switch ($this->prompt) {
                    case  0:
                        $consulta = "Parafraséame este texto en español como si fueras un docente universitario: ";
                        break;
                    case  1:
                        $consulta = "Parafraséame este texto en español como si fueras un experto en investigación: ";
                        break;
                    case  2:
                        $consulta = "Parafraséame este texto en español con el objetivo de reducir el mayor grado de similitud: ";
                }

                $consulta = $consulta . "{" . $this->consulta . "}";

                try {
                    $result = OpenAI::completions()->create([
                        'model' => 'gpt-3.5-turbo-instruct',
                        'prompt' => $consulta,
                        'max_tokens' => $max_tokens,
                        'temperature' => $temperature,
                    ]);
                    $result_text = $result['choices'][0]['text'];
                    $query_tokens = $result['usage']['prompt_tokens'];
                    $result_tokens = $result['usage']['completion_tokens'];
                    $consumed_tokens = $result['usage']['total_tokens'];
                    $permisos->paraphrase_used = $p_used + 1;
                    $permisos->save();
                    $this->paraphrase_left--;
                } catch (Exception $e) {
                    $result_text = $e->getMessage();
                }
                $resultado = $result_text;
            } else {
                $resultado = "Lo siento, pero parece que has superado tu límite de parafraseo. Para continuar utilizando este servicio, por favor comunícate con los administradores para solicitar un aumento en tu límite. Estamos aquí para ayudarte y queremos asegurarnos de que tengas la mejor experiencia posible. ¡Gracias por usar nuestro servicio!";
            }
        } else {
            $resultado = Auth::user()->name . " aprovecha este servicio escribiendo párrafos mas extensos que el que acabas de escribir, esta consulta no será tomada en cuenta";
        }
        $this->resultado = $resultado;
        return $resultado;
    }

    public function recommendations()
    {
        $consulta = $this->consulta;
        $resultado = "espera un momento...";

        if (strlen($consulta) > 6) {
            $permisos = Person::where('user_id', Auth::user()->id)->first();
            $p_allowed = $permisos->paraphrase_allowed;
            $p_used = $permisos->paraphrase_used;

            if ($p_allowed > $p_used) {

                $max_tokens = 3400;
                $temperature = 0.7;

                $result_text = "hubo un problema, intenta mas tarde";

                $consulta = "Dame un listado de títulos de artículos científicos reales sobre: {" . $consulta . "} presenta esta lista en idioma inglés, luego presenta la misma lista traducida al español y finalmente presenta la misma lista traducida al portugués. por favor recuerda presentar las listas dentro de etiquetas HTML";

                try {
                    $result = OpenAI::completions()->create([
                        'model' => 'gpt-3.5-turbo-instruct',
                        'prompt' => $consulta,
                        'max_tokens' => $max_tokens,
                        'temperature' => $temperature,
                    ]);
                    $result_text = $result['choices'][0]['text'];
                    $query_tokens = $result['usage']['prompt_tokens'];
                    $result_tokens = $result['usage']['completion_tokens'];
                    $consumed_tokens = $result['usage']['total_tokens'];
                    $permisos->paraphrase_used = $p_used + 1;
                    $permisos->save();
                } catch (Exception $e) {
                    $result_text = $e->getMessage();
                }
                $resultado = $result_text;
            } else {
                $resultado = "Lo siento, pero parece que has superado tu límite de consultas. Para continuar utilizando este servicio, por favor comunícate con los administradores para solicitar un aumento en tu límite. Estamos aquí para ayudarte y queremos asegurarnos de que tengas la mejor experiencia posible. ¡Gracias por usar nuestro servicio!";
            }
        } else {
            $resultado = Auth::user()->name . " aprovecha este servicio escribiendo párrafos mas extensos que el que acabas de escribir, esta consulta no será tomada en cuenta";
        }

        $this->resultado = $resultado;
        return $resultado;
    }

    public function grammarCorrection()
    {
        $consulta = $this->consulta;
        $resultado = "espera un momento...";
        if (strlen($consulta) > 6) {

            $permisos = Person::where('user_id', Auth::user()->id)->first();
            $p_allowed = $permisos->paraphrase_allowed;
            $p_used = $permisos->paraphrase_used;

            if ($p_allowed > $p_used) {

                $max_tokens = 3400;
                $temperature = 0.7;

                $result_text = "hubo un problema, intenta mas tarde";

                $consulta = "Corrígeme este texto en español para una mejor comprensión como si fueras un experto en literatura: {" . $consulta . "}";

                try {
                    $result = OpenAI::completions()->create([
                        'model' => 'gpt-3.5-turbo-instruct',
                        'prompt' => $consulta,
                        'max_tokens' => $max_tokens,
                        'temperature' => $temperature,
                    ]);
                    $result_text = $result['choices'][0]['text'];
                    $query_tokens = $result['usage']['prompt_tokens'];
                    $result_tokens = $result['usage']['completion_tokens'];
                    $consumed_tokens = $result['usage']['total_tokens'];
                    $permisos->paraphrase_used = $p_used + 1;
                    $permisos->save();
                } catch (Exception $e) {
                    $result_text = $e->getMessage();
                }
                $resultado = $result_text;
            } else {
                $resultado = "Lo siento, pero parece que has superado tu límite de consultas. Para continuar utilizando este servicio, por favor comunícate con los administradores para solicitar un aumento en tu límite. Estamos aquí para ayudarte y queremos asegurarnos de que tengas la mejor experiencia posible. ¡Gracias por usar nuestro servicio!";
            }
        } else {
            $resultado = Auth::user()->name . " aprovecha este servicio escribiendo párrafos mas extensos que el que acabas de escribir, esta consulta no será tomada en cuenta";
        }
        $this->resultado = $resultado;
        return $resultado;
    }

    public function references()
    {
        $references = new MendeleyReferences();


        $resultado = $references->citar($this->consulta, $this->normativa);

        $this->resultado = $resultado;
        return $resultado;
    }
    /*  Asistente de chat GPT  */

    public function getThreadId($msg){  //crea el thread y obtiene el ID, si ya existe no la crea y luego consulta respuesta
        if($this->thread_id == null){
            $client = new Client();
            $promise = $client->getAsync('http://localhost:3000/create_thread');
            $response = $promise->wait();
            $data = json_decode($response->getBody(), true);
            $this->thread_id = $data['thread_id'];
            $this->assistant_id = $data['assistant_id'];
        }else{

        }

        return $this->sendGetConsulta($msg); //aqui ejecuta run y consulta respuesta el thread_id es variable global 
    }

    public function sendGetConsulta($msg)   //consulta respuesta y verificar si existe archivo q pasar file
    {
        // Creando run y haciendo consulta para obtener respuesta de la IA
        $response = Http::post('http://localhost:3000/create_run', [
            'user_message' => $msg,
            'user_name' => Auth::user()->name,
            'thread_id' => $this->thread_id,
            'assistant_id' => $this->assistant_id,
            'file' => $this->fileName,
        ]);

        $data = $response->json();
        return $data;
        // dd($this->thread_id, $response);
    }

    public function getPendingRun($messages){   //consulta de respuesta cuando la espera es larga
        // consultamos si el run ya tiene respuesta y si es así entregue el mensaje o avise que no
        $response = Http::post('http://localhost:3000/get_run_pending', [
            'thread_id' => $messages['thread_id'],
            'run_id' => $messages['run_id'],
        ]);

        $data = $response->json();
        return $data;
        // dd($this->thread_id, $response);
    }

    public function getThreadId_w_file($msg){  //crea el thread y obtiene el ID, si ya existe no la crea y luego consulta respuesta
        if($this->thread_id == null){
            $client = new Client();
            $promise = $client->getAsync('http://localhost:3000/create_thread');
            $response = $promise->wait();
            $data = json_decode($response->getBody(), true);
            $this->thread_id = $data['thread_id'];
            $this->assistant_id = $data['assistant_id'];
        }else{

        }

        // cambiar por el metodo para archivo return $this->sendGetConsulta($msg);
    }
    public function randomName() {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud = 6;
        $codigo = '';
    
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
    
        return $codigo;
    }
}
