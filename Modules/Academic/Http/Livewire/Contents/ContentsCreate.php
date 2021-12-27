<?php

namespace Modules\Academic\Http\Livewire\Contents;

use Livewire\Component;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaContent;
use Modules\Academic\Entities\AcaContentType;
use Modules\Academic\Entities\AcaSection;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Modules\Academic\Http\Livewire\Contents\DB;

class ContentsCreate extends Component
{
    use WithFileUploads;
    public $section_id;
    public $course;
    public $section;
    public $name; //nombre o título del contenido
    public $content_types;

    public $content_type_id;
    public $content_url;
    public $status;
    public $created_by;
    public $original_name;

    public function render()
    {
        return view('academic::livewire.contents.contents-create');
    }

    public function mount($section_id)
    {
        $this->content_type_id=1;
        $this->section_id = $section_id;
        $this->section = AcaSection::find($section_id);
        $this->course = AcaCourse::find($this->section->course_id);
        $this->content_types = AcaContentType::all();
    }

    /*
    protected $rules = [
        'content_url' =>'required',
    ];
    public $validators; */

    public function updated($propertyName)

    {
        switch ($this->content_type_id) {
            case 3:
                $this->validateOnly($propertyName, [

                    'content_url' => 'required|max:50240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt',

                ]);
                break;
            case 4:
                $this->validateOnly($propertyName, [

                    'content_url' => 'required|max:20240|image',

                ]);
                break;

            default:
                $this->validateOnly($propertyName, [

                    'content_url' => 'required',

                ]);
                break;
        }
    }

    public function save()
    {

        $this->validate();
        if ($this->content_type_id == 3 || $this->content_type_id == 4) {
            $this->original_name = $this->content_url->getClientOriginalName();
            $this->content_url = 'storage/'.substr($this->content_url->store('public/uploads/academic/contents'), 7);    // <----------------------Solo para archivos e imagenes-------------------------------------------

            //$this->content_url = $this->content_url->store('contents');
        }

        $count=AcaContent::where('Section_id',$this->section_id)->count();
        AcaContent::create([
            'section_id' => $this->section_id,
            'content_type_id' => $this->content_type_id,
            'name' => $this->name,
            'content_url' => $this->content_url, //tuve que hacer substring para quitar el public del path, ya que no me dejaba cargar la imagen en la carpeta public
            'original_name' => $this->original_name,
            'status' => true,
            'count' => $count+1,
            'created_by' => Auth::id()
        ]);

        $this->content_type_id = null;
        $this->content_url = null;
        $this->created_by = null;
        $this->name=null;

        $this->dispatchBrowserEvent('aca-content-create', ['tit' => 'Enhorabuena', 'msg' => 'Se registró correctamente']);
        redirect()->route('academico_contenido', [$this->section->course_id, $this->section->id])->with('message', 'Volverás a la Lista de Contenidos');


    }

    public function updatedPhoto()

    {

        $this->validate([

            'content_url' => 'image|max:10240',

        ]);
    }

    protected $rules = [
        'content_url' => 'required'
    ];
}
