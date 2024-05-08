<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;

class pegawai
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $roleId = $request->session()->get('role_id');
        switch ($roleId) {
            case '0': return redirect ('/dashboard');
            case '1': return $next($request);
            default : return redirect('/');
        }
    }
}