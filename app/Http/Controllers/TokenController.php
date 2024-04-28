<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function validateToken(Request $request)
    {
        $inputToken = $request->input('token');
        $tokenDatabase = DB::table('admintoken')->first();
        // Asumsi bahwa token di database sudah dienkripsi
        if ($tokenDatabase && Hash::check($inputToken, $tokenDatabase->token)) {
            // Menyimpan status validasi di session
            Session::put('token_validated', true);
            return redirect('/admin');
        } else {
            // Menghapus status validasi jika ada
            Session::forget('token_validated');
            return redirect('/dashboard');
            
        }
    }
    public function forgotAdmin(Request $request){
        Session::forget('token_validated');
         return redirect('/dashboard');
    }
    public function insertToken(Request $request)
    {
        $inputToken = $request->input('token');
        $encryptedToken = bcrypt($inputToken);

        DB::table('admintoken')->insert([
            'token' => $encryptedToken,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/admin')->with('success', 'Token berhasil ditambahkan');
    }
    public function changeToken(Request $request)
    {
        $tokenDatabase = DB::table('admintoken')->first();
        $inputtokenprev = $request->input('token');
        $inputTokennew = $request->input('token2');
        if ($tokenDatabase && Hash::check($inputtokenprev, $tokenDatabase->token)) {
            $encryptedToken = bcrypt($inputTokennew);
            DB::table('admintoken')->delete();
            DB::table('admintoken')->insert([
                'token' => $encryptedToken,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect('/forgot-token')->with('success', 'Token berhasil ditambahkan');
        }
        else{
            return redirect('/admin')->with('error', 'Token gagal ditambahkan');
        }
    }
}
