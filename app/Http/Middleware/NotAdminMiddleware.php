<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NotAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Deny access if user is an admin -> send to admin dashboard
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak diizinkan mengakses halaman pengguna.');
        }

        return $next($request);
    }
}
