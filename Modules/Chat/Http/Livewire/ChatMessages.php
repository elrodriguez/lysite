<?php

namespace Modules\Chat\Http\Livewire;

use App\Events\PrivateMessage;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Chat\Entities\ChatMessage;
use League\Flysystem\Cached\Storage\Predis;

class ChatMessages extends Component
{
    public $chats = [];
    public $chat = [];
    public $msg = [];

    use WithFileUploads;

    public $clicked_user;
    public $file;

    protected $listeners = [
        'showChatStudent'       => 'showChatStudent',
        'showChatInstructor'    => 'showChatInstructor'
    ];

    public function render()
    {
        return view('chat::livewire.chat-messages');
    }

    public function showChatStudent($id)
    {

        $this->chats = [];

        $user = Person::where('user_id', $id)->first();

        $this->chats[$id .  Auth::id()] = [
            'background'    => 'bg-ui-chatbox-titlebar',
            'user_id'       => $id,
            'right'         => 0,
            'display'       => 'block',
            'name'          => $user ? $user->names : 'User None',
            'message'       => null,
            'messages'      => []
        ];

        $msg = ChatMessage::join('users', 'user_id', 'users.id')
            ->select(
                'chat_messages.conversation_ids',
                'chat_messages.message',
                'chat_messages.user_id',
                'chat_messages.receiver',
                'chat_messages.is_seen',
                'chat_messages.file',
                'chat_messages.file_name',
                'users.name'
            )
            ->where('conversation_ids', $id . Auth::id())
            ->get();

        if ($msg) {
            $this->chats[$id . Auth::id()]['messages'] = $msg->toArray();
            $this->dispatchBrowserEvent('scroll-button', ['success' => true, 'index' => $id . Auth::id(), 'user_id' => $id]);
        }
    }
    public function showChatInstructor($id)
    {

        $this->chats = [];

        $user = Person::where('user_id', $id)->first();

        $this->chats[Auth::id() . $id] = [
            'background'    => 'bg-ui-chatbox-titlebar',
            'user_id'       => $id,
            'right'         => 0,
            'display'       => 'block',
            'name'          => $user ? $user->names : 'User None',
            'message'       => null,
            'messages'      => []
        ];

        $msgs = ChatMessage::join('users', 'user_id', 'users.id')
            ->select(
                'chat_messages.conversation_ids',
                'chat_messages.message',
                'chat_messages.user_id',
                'chat_messages.receiver',
                'chat_messages.is_seen',
                'chat_messages.file',
                'chat_messages.file_name',
                'users.name'
            )
            ->where('conversation_ids', Auth::id() . $id)
            ->get();

        if ($msgs) {
            $xmsg = [];
            foreach ($msgs as $k => $msg) {
                $xmsg[$k] = [
                    'conversation_ids' => $msg->conversation_ids,
                    'message' => $this->addLink($msg->message),
                    'user_id' => $msg->user_id,
                    'receiver' => $msg->receiver,
                    'is_seen' => $msg->is_seen,
                    'file' => $msg->file,
                    'file_name' => $msg->file_name,
                    'name' => $msg->name
                ];
            }

            $this->chats[Auth::id() . $id]['messages'] = $msg->toArray();
            $this->dispatchBrowserEvent('scroll-button', ['success' => true, 'index' => Auth::id() . $id, 'user_id' => $id]);
        }
    }

    public function addLink($cadena)
    {
        $reg_exUrl = "/.[http|https|ftp|ftps]*\:\/\/.[^$|\s]*/";
        return preg_replace($reg_exUrl, "<a href='$0' target='_blank'>$0</a>", $cadena);
    }
    public function minimizeChat($index)
    {
        $this->chats[$index]['display'] = 'none';
    }

    public function maximizeChat($index)
    {
        $this->chats[$index]['background'] = 'bg-ui-chatbox-titlebar';
        $this->chats[$index]['display'] = 'block';
    }

    public function closeChat($index)
    {
        unset($this->chats[$index]);
    }

    public function sendMessage($index)
    {

        $this->chat = $this->chats[$index];

        $new_message_text = $this->chat['message'];
        $this->chats[$index]['message'] = null;

        if ($new_message_text) {

            $file_name  = null;
            $path       = null;

            if ($this->file) {
                $file = $this->file->store('public/chat/files');
                $path = url(Storage::url($file));
                $file_name = $this->file->getClientOriginalName();
            }

            ChatMessage::create([
                'conversation_ids'  => $index,
                'message'           => $new_message_text,
                'user_id'           => Auth::id(),
                'receiver'          => $this->chat['user_id'],
                'file'              => $path,
                'file_name'         => $file_name
            ]);

            $new_message = [
                'conversation_ids'  => $index,
                'message'           => $this->addLink($new_message_text),
                'user_id'           => Auth::id(),
                'receiver'          => $this->chat['user_id'],
                'is_seen'           => false,
                'file'              => $path,
                'file_name'         => $file_name,
                'name'              => Auth::user()->name
            ];

            array_push($this->chat['messages'], $new_message);

            $this->chats[$index] = $this->chat;
        }

        $user = User::find($this->chat['user_id']);

        event(new PrivateMessage($user, $new_message));

        $this->dispatchBrowserEvent('textarea-null', ['success' => true, 'index' => $index]);
    }

    public function addMessages($index, $new_message)
    {
        $this->chats[$index]['background'] = 'new-message-chat-animation';
        array_push($this->chats[$index]['messages'], $new_message);
    }

    public function focusTextArea($index)
    {
        $this->chats[$index]['background'] = 'bg-ui-chatbox-titlebar';
    }
}
