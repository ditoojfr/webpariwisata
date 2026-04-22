<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('id_customer')) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}