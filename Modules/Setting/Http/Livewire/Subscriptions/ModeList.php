<?php

namespace Modules\Setting\Http\Livewire\Subscriptions;

use App\Models\TypeSubscription;
use Livewire\Component;

class ModeList extends Component
{
    public $modos;
    public $search = null;

    public function mount()
    {
        $this->getModes();
    }

    public function render()
    {
        return view('setting::livewire.subscriptions.mode-list');
    }

    public function getModes()
    {
        $this->modos = TypeSubscription::where('name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function destroy($id)
    {
        try {
            TypeSubscription::find($id)->delete();
            $res = 'success';
            $tit = 'Enhorabuena';
            $msg = 'Se eliminó correctamente';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
            $tit = 'Salió mal';
            $msg = 'No se puede eliminar porque cuenta con registros asociados';
        }

        $this->dispatchBrowserEvent('set-subscription-modes-destroy', ['res' => $res, 'tit' => $tit, 'msg' => $msg]);
    }
}
