<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(TransactionRepository $transactionsRepository): Factory|View|Application
    {
        $transactions = $transactionsRepository
            ->getRecentTransactionByUser(Auth::user()->id)
            ->orderBy('created_at', 'ASC')
            ->get();
        return view('dashboard.index', compact('transactions'));
    }
}
