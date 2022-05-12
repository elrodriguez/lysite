<?php

namespace Modules\Homepage\Http\Livewire\Home;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Homepage\Entities\HomeHistories;
use Illuminate\Support\Facades\Storage;

class Histories extends Component
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
        return view('homepage::livewire.home.histories', ['histories' => $this->getData()]);
    }

    public function getData()
    {
        return HomeHistories::where('title', 'like', '%' . $this->search . '%')
            ->orwhere('university', 'like', '%' . $this->search . '%')
            ->orwhere('thesis_title', 'like', '%' . $this->search . '%')
            ->orwhere('year', 'like', '%' . $this->search . '%')
            ->orwhere('author', 'like', '%' . $this->search . '%')
            ->paginate(6);
    }
}
