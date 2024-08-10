<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectToLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/admin/login'); // Adjust as needed for non-admin users
            }
        }

        return $next($request);
    }
}
