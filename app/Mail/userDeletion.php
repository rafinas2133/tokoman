<?php

namespace App\Mail;

use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class userDeletion extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $admin;
    public function __construct($user, $admin = null)
    {
        $this->user = $user;
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->view('email.deleteUser')
            ->with([
                'user' => $this->user,
                'admin'=> $this->admin? "admin":"yourself",
            ]);
    }
}
