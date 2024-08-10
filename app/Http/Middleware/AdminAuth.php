<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //check if authenticate && second is condition when we need to redirect i.e, 
        if (Auth::guard($guard)->check() && $request->route()->named('admin.login')) {
            return redirect()->route('admin.dashbaord');
        }

        return $next($request);
    }
    // User is not authenticated, continue to the requested page
}
