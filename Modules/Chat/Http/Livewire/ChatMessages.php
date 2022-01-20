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

    public function showChatStudent($id){

        $this->chats = [];

        $user = Person::where('user_id',$id)->first();

        $this->chats[$id.'_'.Auth::id()] = [
                'background'    => 'bg-ui-chatbox-titlebar',
                'user_id'       => $id,
                'right'         => 0,
                'display'       => 'block',
                'name'          => $user ? $user->full_name : 'User None',
                'message'       => null,
                'messages'      => []
            ];

        $msg = ChatMessage::select(
                        'conversation_ids',
                        'message',
                        'user_id',
                        'receiver',
                        'is_seen',
                        'file',
                        'file_name'
                    )
                    ->where('conversation_ids', $id.'_'.Auth::id())
                    ->get();

        if($msg){
            $this->chats[$id.'_'.Auth::id()]['messages'] = $msg->toArray();
            $this->dispatchBrowserEvent('scroll-button', ['success' => true,'index' => $id.'_'.Auth::id(),'user_id' => $id]);
        }

    }
    public function showChatInstructor($id){

        $this->chats = [];

        $user = Person::where('user_id',$id)->first();

        $this->chats[Auth::id().'_'.$id] = [
            'background'    => 'bg-ui-chatbox-titlebar',
            'user_id'       => $id,
            'right'         => 0,
            'display'       => 'block',
            'name'          => $user ? $user->full_name : 'User None',
            'message'       => null,
            'messages'      => []
        ];

        $msg = ChatMessage::select(
                        'conversation_ids',
                        'message',
                        'user_id',
                        'receiver',
                        'is_seen',
                        'file',
                        'file_name'
                    )
                    ->where('conversation_ids', Auth::id().'_'.$id)
                    ->get();

        if($msg){
            $this->chats[Auth::id().'_'.$id]['messages'] = $msg->toArray();
            $this->dispatchBrowserEvent('scroll-button', ['success' => true,'index' => Auth::id().'_'.$id,'user_id' => $id]);
        }

    }

    public function minimizeChat($index){
        $this->chats[$index]['display'] = 'none';
    }

    public function maximizeChat($index){
        $this->chats[$index]['background'] = 'bg-ui-chatbox-titlebar';
        $this->chats[$index]['display'] = 'block';
    }

    public function closeChat($index){
        unset($this->chats[$index]);
    }

    public function sendMessage($index) {


        $this->chat = $this->chats[$index];

        if($this->chat['message']){

            $file_name  = null;
            $path       = null;
    
            if($this->file) {
                $file = $this->file->store('public/chat/files');
                $path = url(Storage::url($file));
                $file_name = $this->file->getClientOriginalName();
            }
    
            ChatMessage::create([
                'conversation_ids'  => $index,
                'message'           => $this->chat['message'],
                'user_id'           => Auth::id(),
                'receiver'          => $this->chat['user_id'],
                'file'              => $path,
                'file_name'         => $file_name
            ]);

            $new_message = [
                'conversation_ids'  => $index,
                'message'           => $this->chat['message'],
                'user_id'           => Auth::id(),
                'receiver'          => $this->chat['user_id'],
                'is_seen'           => false,
                'file'              => $path,
                'file_name'         => $file_name
            ];

            array_push($this->chat['messages'], $new_message);
           
            $this->chat['message'] = null;
        }

        $user = User::find($this->chat['user_id']);
        event(new PrivateMessage($user,$new_message));

        $this->chats[$index] = $this->chat;

        $this->dispatchBrowserEvent('textarea-null', ['success' => true,'index' => $index]);
    }

    public function addMessages($index,$new_message){
        $this->chats[$index]['background'] = 'new-message-chat-animation';
        array_push($this->chats[$index]['messages'], $new_message);
    }

    public function focusTextArea($index){
        $this->chats[$index]['background'] = 'bg-ui-chatbox-titlebar';
    }
}
