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

class BoxGpt extends Component
{
    public $typeAction = 1;
    public $history = [];
    public $historyItems = [];
    public $consulta = null;
    public $file = null;
    public $resultado = null;
    public $paraphrase_left;
    public $normativa;
    public $prompt = 0;

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

    public function saveMessageUser()
    {
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
            'content' => $this->consulta
        ]);

        $resultado = null;

        if ($this->typeAction == 1) {
            $resultado = $this->paraphrasing();
        } elseif ($this->typeAction == 2) {
            $resultado = $this->recommendations();
        } elseif ($this->typeAction == 3) {
            $resultado = $this->grammarCorrection();
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
}
