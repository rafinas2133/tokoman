<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
        public function handle(Request $request, Closure $next)
        {
            if (!session()->has('token_validated') || session()->get('token_validated') !== true) {
                return redirect('/dashboard')->withErrors(['message' => 'Access denied. Please validate your token.']);
            }
            return $next($request);
        }
    
}
