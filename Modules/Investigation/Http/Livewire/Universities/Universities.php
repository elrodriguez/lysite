<?php

namespace Modules\Investigation\Http\Livewire\Universities;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Universities as UniversitiesModel;

class Universities extends Component
{
    public $search;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function getSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('investigation::livewire.universities.universities',['universities' => $this->getData()]);
    }

    public function getData(){
        return UniversitiesModel::where('name','like','%'.$this->search.'%')
            ->paginate(10);
    }
}
