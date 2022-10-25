<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(TransactionRepository $transactionsRepository, $filter = null): Factory|View|Application
    {
        if($filter != null)
            $transactions = $transactionsRepository
                ->getAllTransactionByUser(Auth::user()->id)
                ->orderBy('created_at', 'ASC')
                ->paginate(10);
        else
            $transactions = $transactionsRepository
                ->getRecentTransactionByUser(Auth::user()->id)
                ->orderBy('created_at', 'ASC')
                ->paginate(20);

        return view('dashboard.index', compact('transactions'));
    }
}
