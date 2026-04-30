<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek session role
        if (session('role') !== 'admin') {
            
            // Jika request JSON (API)
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 403);
            }
            
            // Redirect ke route login admin
            return redirect()->route('admin.login'); 
        }
        
        return $next($request);
    }
}