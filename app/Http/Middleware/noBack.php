<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class noBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response=$next($request);
        $response->headers->set('Cache-control','nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Expires','Sat, 01 Jan 2000 00:00:00 GMT');
        return $response;
    }
}
