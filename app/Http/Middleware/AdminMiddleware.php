<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('role') || session('role') !== 'admin') {
            return redirect('/login')->with('error', 'Akses ditolak. Hanya admin yang boleh masuk.');
        }
        return $next($request);
    }
}