<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class newUserVerified extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $users;
    public function __construct($user,$users)
    {
        $this->user = $user;
        $this->users = $users;
    }

    public function build()
    {
        return $this->view('email.newUserVerified')
            ->with([
                'user' => $this->user,
                'users'=> $this->users
            ]);
    }
}
