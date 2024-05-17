<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\newUserVerified;
use App\Mail\WelcomeUser;
use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Mail;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        $users=Auth::user();
        $allUser=User::whereNot('email_verified_at', null)->get();
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->email!=$users->email) {
                    Mail::to($user->email)->send(new newUserVerified($users,$user));
                }
            }
        }
        if (Auth::check()) {
            $user = Auth::user();
            Mail::to($user->email)->send(new WelcomeUser($user));
        }
        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }
}
