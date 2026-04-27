<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'admin') {
            // abort(403) lebih aman daripada redirect yang bisa carry POST
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            return response()->redirectTo('/login');
        }
        return $next($request);
    }
}