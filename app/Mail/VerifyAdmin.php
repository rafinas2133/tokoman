<?php

namespace App\Mail;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class VerifyAdmin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user,$token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return (new MailMessage)
            ->subject(Lang::get('Verify User'))
            ->line(Lang::get('There is user ' . $this->user->name . " who wants to join Tokoman App"))
            ->action(Lang::get('Verify Email Address'), route('stokBarang').'/admin-verify/'.$this->token)
            ->line(Lang::get('If you do not want accept it, no further action is required.'));
    }
}
