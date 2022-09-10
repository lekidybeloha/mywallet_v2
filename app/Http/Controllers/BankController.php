<?php

namespace App\Http\Controllers;

class BankController extends Controller
{
    public function index()
    {
        return view('dashboard.bank.index');
    }
}
