<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (Auth::check()) {
            return $next($request);
        }

        // Redirect non-admins to login page or another route
        return redirect()->route('admin.login');
    }
}
