<?php

namespace Modules\Homepage\Http\Livewire\Home;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Homepage\Entities\HomeInstructors;
use Illuminate\Support\Facades\Storage;

class Instructors extends Component
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
        return view('homepage::livewire.home.instructors', ['instructors' => $this->getData()]);
    }

    public function getData()
    {
        return HomeInstructors::where('name_instructor', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }
}
