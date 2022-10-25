<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function dashboardRouter(): RedirectResponse
    {
        return redirect()->route('dashboard');
    }
    public function login(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login');
    }

    public function attempt(Request $request): RedirectResponse
    {
        $remember = $request->has('remember');
        if(Auth::attempt($request->only(['email', 'password']), $remember))
            return redirect()->route('dashboard') ;
        else
            return redirect()->back()->withErrors(__('auth.failed'))->withInput($request->only('email'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
