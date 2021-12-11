<?php

namespace Modules\Academic\Http\Livewire\Students;

use Livewire\Component;
use Modules\Academic\Entities\AcaStudent;
use Livewire\WithPagination;

class StudentsList extends Component
{
    public $search;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('academic::livewire.students.students-list',['students' => $this->getData()]);
    }

    public function getData(){
        return AcaStudent::join('people','person_id','people.id')
                ->join('identity_document_types','people.identity_document_type_id','identity_document_types.id')
                ->select(
                    'people.id',
                    'people.full_name',
                    'people.number',
                    'identity_document_types.description as document_type_name',
                    'people.mobile_phone',
                    'people.email'
                )
                ->where('people.full_name','LIKE','%'.$this->search.'%')
                ->paginate(10);
    }

    public function getSearch(){
        $this->resetPage();
    }
}
