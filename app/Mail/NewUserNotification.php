<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Nuevo usuario se ha registrado";
    public $new_user_email;
    public $new_user_name;
    public $telephone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $telephone=0)
    {
       $this->new_user_email=$email;
       $this->new_user_name=$name;
       $this->telephone=$telephone;
       if($this->telephone=="")$this->telephone=null;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-user-notification',[$this->new_user_email, $this->new_user_name, $this->telephone]);
    }
}
