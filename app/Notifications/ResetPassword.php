<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Mail_templates;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $data = Mail_templates::where('title','Forgot Password')->first();
        $link = url('password/reset', $this->token);
        return (new MailMessage)
            ->subject($data->subject)
            ->view('mail.forgot',['data'=>$data,'link'=>$link]);
            
    }
}