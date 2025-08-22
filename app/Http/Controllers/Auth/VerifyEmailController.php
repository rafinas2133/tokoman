<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\pegawaiController;
use App\Mail\newUserVerified;
use App\Mail\WelcomeUser;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Mail;
use Pusher\Pusher;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        if (Auth::check()) {
            Mail::to(Auth::user()->email)->queue(new newUserVerified(Auth::user()));
            
            $pegawaicontroll=new pegawaiController();
            $string=$pegawaicontroll->generateDataPusher(Auth::user());
            
        }
        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
