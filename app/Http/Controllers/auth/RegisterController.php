<?php

namespace App\Http\Controllers\auth;

use App\Http\Requests\NewUserRequest;
use App\Models\Bank;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function index(): Factory|View|Application
    {
        return view('auth.register');
    }

    public function store(NewUserRequest $request): RedirectResponse
    {
        $user               = new User();
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->devise       = $request->devise;
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
