<?php

namespace Modules\Academic\Http\Livewire\Students;

use Livewire\Component;
use Modules\Academic\Entities\AcaStudent;

class StudentsReportTotal extends Component
{
    public $students = [];

    public function render()
    {
        $this->getData();
        return view('academic::livewire.students.students-report-total');
    }

    public function getData(){
        $this->students = AcaStudent::join('people','person_id','people.id')
                ->join('identity_document_types','people.identity_document_type_id','identity_document_types.id')
                ->select(
                    'people.id',
                    'people.full_name',
                    'people.number',
                    'identity_document_types.description as document_type_name',
                    'people.mobile_phone',
                    'people.email',
                )
                ->groupBy([
                    'people.id',
                    'people.full_name',
                    'people.number',
                    'identity_document_types.description',
                    'people.mobile_phone',
                    'people.email',
                ])
                ->get();
    }
}
