<?php

namespace App\Mail;

use App\Models\User;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class userUpdation extends Mailable implements ShouldQueue
{
    use Queueable;

    public $user;
    public $admin;
    public $change;
    public function __construct(User $user, $a)
    {
        $this->user = $user;
        $this->admin = "yourself";
        if ((Auth::user()->role_id == 0 && Auth::user()->id != $this->user->id))
            $this->admin = "admin";
        $this->change = $a;
    }

    public function build()
    {
        return $this->view('email.updateUser')
            ->with([
                'user' => $this->user,
                'admin' => $this->admin,
                'change' => $this->change
            ]);
    }
}
