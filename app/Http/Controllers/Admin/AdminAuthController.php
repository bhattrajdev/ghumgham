<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AdminAuthController extends Controller
{
    public function login()
    {
        $Setting = SiteSetting::first()->get();
        return view("admin.auth.login")->with('setting');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()
                ->with('error', 'Either Email/Password is incorrect')
                ->withInput($request->only('email'));
        }
    }
}
