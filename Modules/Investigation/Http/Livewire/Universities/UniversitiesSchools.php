<?php

namespace Modules\Investigation\Http\Livewire\Universities;

use Livewire\Component;
use App\Models\universities_schools as UniversitiesSchoolsModel;
use App\Models\Universities as UniversitiesModel;
use Livewire\WithPagination;

class UniversitiesSchools extends Component
{
    public $search;
    public $university_id;
    public $university;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public function mount($university_id){
        $this->university = UniversitiesModel::find($university_id);
        $this->university_id = $university_id;
    }

    public function getSearch()
    {
        $this->resetPage();
    }

    public function getSchools(){
        return UniversitiesSchoolsModel::where('name','like','%'.$this->search.'%')
        ->where('university_id',$this->university_id)
            ->paginate(10);
    }

    public function render()
    {
        return view('investigation::livewire.universities.universities-schools',['schools' => $this->getSchools()]);
    }
}
