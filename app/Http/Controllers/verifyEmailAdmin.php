<?php

namespace App\Http\Controllers;

use App\Mail\newUserVerified;
use App\Models\unverifiedUser;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Pusher\Pusher;

class verifyEmailAdmin extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $forchange = false;
        $emailuser = '';
        $unverif = unverifiedUser::all();
        if ($unverif[0]??false) {
            foreach ($unverif as $unverifiedUser) {
                if (\Hash::check($id, $unverifiedUser->token)) {
                    $forchange = true;
                    $emailuser = $unverifiedUser->email;
                }
            }
            if ($forchange == true) {
                $unverifnew = unverifiedUser::where("email", $emailuser)->first();
                $unverifnew->delete();
                $name = User::where("email", $emailuser)->first();
                $name->adminVerified = now();
                $name->save();
                $name->sendEmailVerificationNotification();

                return response()->json('Action Successfull');
            }
            return abort(403);
        }
        return abort(401);
    }
}
