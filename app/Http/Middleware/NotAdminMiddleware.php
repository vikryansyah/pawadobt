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
            abort(403, 'Silakan login terlebih dahulu.');
        }

        // Deny access if user is an admin
        if (Auth::user()->is_admin) {
            abort(403, 'Admin tidak diizinkan mengakses halaman ini.');
        }

        return $next($request);
    }
}
