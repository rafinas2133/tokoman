<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class LoginNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $sessionData;
    public $realIp;

    public function __construct($user, $sessionData, $realIp)
    {
        $this->user = $user;
        $this->sessionData = $sessionData;
        $this->realIp = $realIp;
    }

    public function build()
    {
        return $this->view('email.index')
            ->with([
                'username' => $this->user->name,
                'email' => $this->user->email,
                'sessionData' => $this->sessionData,
                'token' => $this->user->remember_token,
                'real_ip' => $this->realIp
            ]);
    }
}
