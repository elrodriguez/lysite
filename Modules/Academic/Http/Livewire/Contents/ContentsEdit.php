<?php

namespace Modules\Academic\Http\Livewire\Contents;

use Modules\Academic\Entities\AcaContent;
use Modules\Academic\Entities\AcaContentType;
use Modules\Academic\Entities\AcaCourse;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Modules\Academic\Entities\AcaSection;
use Livewire\WithFileUploads;

class ContentsEdit extends Component
{
    use WithFileUploads;
    public $content_types;
    public $section_id;
    public $content_id;
    public $content_type_id;
    public $content_url;
    public $content_url_last; // for checking if url is changed y luego debe borrarse el archivo
    public $status;
    public $content_type_id_last;
    public $its_image=false;
    public $original_name;

    //entidades
    public $section;
    public $content;
    public $course;

    public function mount($section_id, $content_id){
        $this->section = AcaSection::find($section_id);
        $this->content = AcaContent::find($content_id);
        $this->content_types = AcaContentType::all();
        $this->original_name =$this->content->original_name;
        $this->content_type_id = $this->content->content_type_id;
        $this->course = AcaCourse::find($this->section->course_id);
        $this->content_url = $this->content->content_url;
        $this->content_type_id_last = $this->content_type_id;
        $this->status = $this->content->status;
        $this->content_url_last = $this->content_url;
    }

    public function render()
    {
        return view('academic::livewire.contents.contents-edit');
    }

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
        if($this->content_type_id_last < 4){
            $this->its_image = false;
        }else{
            $this->its_image = true;
        }
        $this->content_type_id_last=$this->content_type_id;
    }



    public function save(){
        $this->its_image=false;
        $this->validate();

        if ($this->content_type_id == 3 || $this->content_type_id == 4) {
            if($this->content_url_last != $this->content_url){
                $this->original_name = $this->content_url->getClientOriginalName();
                $this->content_url = 'storage/'.substr($this->content_url->store('public/uploads/academic/contents'),7);    // <----------------------Solo para archivos e imagenes-------------------------------------------
                //tuve que hacer substring para quitar el public del path, ya que no me dejaba cargar la imagen en la carpeta public
                //$this->content_url = $this->content_url->store('contents');
            }
        }

        $this->content->update([
            'content_type_id' => $this->content_type_id,
            'content_url' => $this->content_url,
            'original_name' => $this->original_name,
            'status' => $this->status,
            'updated_by' => Auth::id(),
        ]);



        $this->dispatchBrowserEvent('aca-content-update', ['tit' => 'Enhorabuena','msg' => 'Se Actualizo correctamente']);
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
