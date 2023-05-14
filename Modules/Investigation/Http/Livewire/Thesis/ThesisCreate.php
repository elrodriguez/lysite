<?php

namespace Modules\Investigation\Http\Livewire\Thesis;

use App\Models\Country;
use App\Models\Person;
use App\Models\Universities;
use App\Models\UniversitiesSchools;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Investigation\Entities\InveThesisFormat;
use Illuminate\Support\Str;
use Modules\Academic\Http\Livewire\Students\Students;
use Modules\Investigation\Entities\InveThesisStudent;
use OpenAI\Laravel\Facades\OpenAI;

class ThesisCreate extends Component
{
    protected $listeners = ['helpWithTitleModal' => 'openModalContent'];
    public $countries = [];
    public $country_id = 'PE';
    public $short_name;
    public $university_id;
    public $school_id;
    public $schools = [];
    public $formats = [];
    public $format_id;
    public $state;
    public $thesis_id;
    public $title;
    public $consulta;
    public $resultado="Aquí veras la ayuda luego de Procesar tu consulta";
    public $keywords="Ejemplo: salud pública, seguridad, Arduino, etc...";

    public function mount()
    {
        $person = Person::where('user_id', Auth::id())->first();
        if ($person) {
            $this->country_id = $person->country_id;
            $this->university_id = $person->university_id;

            if ($this->university_id) {
                $this->getSchools();
            }
        }
        $this->countries = Country::all();
        $this->getUniversities();
    }

    public function render()
    {
        return view('investigation::livewire.thesis.thesis-create');
    }
    public function openModalContent(){

        $this->dispatchBrowserEvent('inve-helpwithtitle-open-modal', ['success' => true]);
    }

    public function getUniversities()
    {
        $this->universities = Universities::where('country', $this->country_id)->get();
    }
    public function getSchools()
    {
        $this->schools = UniversitiesSchools::where('university_id', $this->university_id)->get();
    }
    public function getFormat()
    {
        $this->formats = InveThesisFormat::where('school_id', $this->school_id)->get();
    }

    public function save()
    {

        $this->validate([
            'short_name' => 'required',
            'title' => 'required',
            'university_id' => 'required',
            'school_id' => 'required',
            'format_id' => 'required'
        ]);

        $thesis_created = InveThesisStudent::where('person_id', Auth::user()->person->id)->where('deleted_at', NULL)->count();
        $allowed_thesis = Person::where('id', Auth::user()->person->id)->first()->allowed_thesis;

        //Condición que revisa si cuenta con permisos para crear una nueva tesis

        if ($thesis_created < $allowed_thesis) {
            $thesis = InveThesisStudent::create([
                'external_id' => Str::random(10),
                'short_name' => $this->short_name,
                'title' => $this->title,
                'person_id' => Auth::user()->person->id,
                'user_id' => Auth::id(),
                'university_id' => $this->university_id,
                'school_id' => $this->school_id,
                'format_id' => $this->format_id,
                'state' => $this->state ? true : false
            ]);

            $this->short_name = null;
            $this->title = null;
            $this->country_id = 'PE';
            $this->university_id = null;
            $this->school_id = null;
            $this->format_id = null;
            $this->state = null;
            $this->thesis_id = $thesis->id;

            $this->dispatchBrowserEvent('inve-thesis-student-create', ['tit' => 'Enhorabuena', 'msg' => 'Se registró correctamente']);
        } else {
            $this->dispatchBrowserEvent('inve-thesis-student-error', ['tit' => 'No tienes permisos', 'msg' => 'No cuentas con permisos para crear una o más tesis, si deseas crear otra tesis comunícate con tu coordinador, instructor o administrador del sistema']);
        }
    }

    public function parts()
    {
        //$this->emit('updateThesisList');
        redirect()->route('investigation_thesis_parts', $this->thesis_id);
    }

    public function helpwithtitle()
    { 
        dd($this->keywords);
        dd("recomiendame 10 títulos para una tesis ".$this->formats[0].", para la carrera de". $this->schools[0] ."con los siguientes temas: ". $this->keywords);
        if (strlen($this->keywords) > 4) {
            $this->resultado = "espera un momento...";
            $permisos = Person::where('user_id', Auth::user()->id)->first();
            $p_allowed = $permisos->paraphrase_allowed;
            $p_used = $permisos->paraphrase_used;

            if ($p_allowed > $p_used) {
                $max_tokens = 1500;
                $max_tokens = 3400;
                $temperature = 0.6;

                $result_text = "hubo un problema, intenta mas tarde";

                $consulta = "recomiendame 10 títulos para una tesis ".$this->formats[$this->format_id].", para la carrera de". $this->schools[$this->school_id] ."con los siguientes temas: ". $this->keywords;

                try {
                    $result = OpenAI::completions()->create([
                        'model' => 'text-davinci-003',
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
                $this->resultado = $result_text;
            } else {
                $this->resultado = "Lo siento, pero parece que has superado tu límite de consultas. Para continuar utilizando este servicio, por favor comunícate con los administradores para solicitar un aumento en tu límite. Estamos aquí para ayudarte y queremos asegurarnos de que tengas la mejor experiencia posible. ¡Gracias por usar nuestro servicio!";
            }
        } else {
            $this->resultado = Auth::user()->name . " aprovecha este servicio escribiendo palabras claves, esta consulta no será tomada en cuenta";
        }
    }

}
