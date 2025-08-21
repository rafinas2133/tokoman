<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;




class userDeletion extends Mailable implements ShouldQueue
{
    use Queueable;

    public $user;
    public $admin;
    public function __construct(User $user, $admin = false)
    {
        $this->user = $user;
        $this->admin = $admin ? "admin" : "yourself";
    }

    public function build()
    {
        return $this->view('email.deleteUser')
            ->with([
                'user' => $this->user,
                'admin'=> $this->admin,
            ]);
    }
}
