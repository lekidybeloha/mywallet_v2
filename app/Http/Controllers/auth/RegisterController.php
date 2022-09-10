<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\NewUserRequest;
use App\Models\Bank;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.register');
    }

    public function store(NewUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->save();

        $bank               = new Bank();
        $bank->user_id      = $user->id;
        $bank->save();

        $checkout           = new Checkout();
        $checkout->user_id  = $user->id;
        $checkout->save();

        Auth::login($user);
        return redirect()->route('dashboard');
    }
}
