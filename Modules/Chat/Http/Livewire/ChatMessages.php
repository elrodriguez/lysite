<?php

namespace Modules\Chat\Http\Livewire;

use Livewire\Component;

class ChatMessages extends Component
{
    public function render()
    {
        return view('chat::livewire.chat-messages');
    }
}
