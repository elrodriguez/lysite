<?php

namespace Modules\Academic\Http\Livewire\Contents;

use Livewire\Component;
use Modules\Academic\Entities\AcaContent;
use Modules\Academic\Entities\AcaSection;

class ContentsInstructorForm extends Component
{
    public $section_id;
    public $section_name;
    public $content_type_id;
    public $name;
    public $content_url;
    public $original_name;
    public $status;
    public $count;
    public $contents = [];

    protected $listeners = ['instructorOpenModal' => 'openModalContent'];

    public function mount(){

    }

    public function render()
    {
        return view('academic::livewire.contents.contents-instructor-form');
    }

    public function openModalContent($section_id){

        $this->section_id = $section_id;
        $this->section_name = AcaSection::find(1)->title;

        $this->contents = AcaContent::join('aca_content_types','content_type_id','aca_content_types.id')
                            ->select(
                                'aca_content_types.name AS content_type_name',
                                'aca_contents.name AS content_name',
                                'aca_contents.content_url',
                                'aca_contents.original_name',
                                'aca_contents.status',
                                'aca_contents.count'
                            )
                            ->where('aca_contents.section_id', $section_id)
                            ->get();

        $this->dispatchBrowserEvent('aca-content-open-modal', ['success' => true]);
    }   
}
