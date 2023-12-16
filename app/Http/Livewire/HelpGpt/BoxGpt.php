<?php

namespace App\Http\Livewire\HelpGpt;

use App\Models\HistoryGpt;
use App\Models\HistoryGptItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BoxGpt extends Component
{
    public $typeAction = 1;
    public $history = [];
    public $historyItems = [];
    public $message = null;
    public $file = null;

    public function render()
    {
        $this->getHistory($this->typeAction);
        return view('livewire.help-gpt.box-gpt');
    }

    public function setBtnActive($num)
    {
        $this->typeAction = $num;
        $this->getHistory($num);
    }

    public function getHistory($num)
    {
        $this->history = HistoryGpt::where('user_id', Auth::id())
            ->where('type_action', $num)
            ->first();
        if ($this->history) {
            $this->historyItems = HistoryGptItem::where('history_id', $this->history->id)->get();
        }
    }

    public function formatDateBox($date)
    {

        $fechaCreacion = $date;

        // Obtén la fecha actual
        $fechaActual = Carbon::now();

        // Verifica si el año de la fecha de creación es diferente al año actual
        if ($fechaCreacion->year != $fechaActual->year) {
            // Si el año es diferente, muestra el año también en el formato
            $formattedDate = $fechaCreacion->format('h:i A | F j, Y');
        } else {
            // Si el año es igual, omite el año en el formato
            $formattedDate = $fechaCreacion->format('h:i A | F j');
        }

        // Imprime la fecha formateada
        return $formattedDate;
    }

    public function saveMessageUser()
    {
        $history = HistoryGpt::firstOrCreate(
            [
                'type_action' => $this->typeAction,
                'user_id'   => Auth::id()
            ]
        );

        HistoryGptItem::create([
            'history_id' => $history->id,
            'my_user' => true,
            'file_original_name' => null,
            'content' => $this->message
        ]);

        $this->message = null;
    }
}
