<?php

namespace Modules\Setting\Http\Livewire\SubscribeUser;

use Livewire\Component;
use App\Models\Person;
use App\Models\TypeSubscription;
use Livewire\WithPagination;

class CreateForm extends Component
{
    public $type_subscriptions;
    public $search = null;
    public $selectedOption;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->getTypeSubscriptions();
        $this->getSearch('');
        return view('setting::livewire.subscribe-user.create-form', [
            'users' => $this->getSearch()
        ]);
    }

    public function getTypeSubscriptions()
    {
        $this->type_subscriptions = TypeSubscription::where('price', '>', 0)->get();
    }

    public function getSearch()
    {
        return Person::where('names', 'like', '%' . $this->search . '%')
            ->orWhere('last_name_father', 'like', '%' . $this->search . '%')
            ->orWhere('last_name_mother', 'like', '%' . $this->search . '%')
            ->orWhere('full_name', 'like', '%' . $this->search . '%')
            ->where('users.deleted_at', null)->where('people.deleted_at', null)
            ->join('users', 'users.id', 'people.user_id')
            ->select('users.id as user_id', 'people.full_name', 'people.names')
            ->paginate(5);
    }

    public function changeSubcription($id)
    {
        $this->selectedOption = $id;
    }
    public function subscribingUser($id)
    {
        dd($id);
    }
}
