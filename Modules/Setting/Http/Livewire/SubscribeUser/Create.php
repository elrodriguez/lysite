<?php

namespace Modules\Setting\Http\Livewire\SubscribeUser;

use App\Models\TypeSubscription;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSubscription;
use App\Models\Person;
use Livewire\WithPagination;

use Livewire\Component;

class Create extends Component
{
    public $type_subscriptions;
    protected $users;
    public $search=null;
    public $selectedOptions = [];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->getTypeSubscriptions();
        $this->getSearch('');
    }

    public function render()
    {
        return view('setting::livewire.subscribe-user.create',['users' => $this->users]);
    }

    public function getTypeSubscriptions()
    {
        $this->type_subscriptions = TypeSubscription::where('price', '>', 0)->get();
    }

    public function getSearch()
    {
        $this->users = Person::where('names', 'like', '%' . $this->search . '%')
        ->orWhere('last_name_father', 'like', '%' . $this->search . '%')
        ->orWhere('last_name_mother', 'like', '%' . $this->search . '%')
        ->orWhere('full_name', 'like', '%' . $this->search . '%')
        ->where('users.deleted_at', null)->where('people.deleted_at', null)
        ->join('users', 'users.id', 'people.user_id')
        ->select('users.id as user_id', 'people.full_name', 'people.names')
        ->paginate(5);
    }
    public function subscribing($user_id, $key){
        dd($user_id, $this->selectedOptions[$key]);
    }
}
