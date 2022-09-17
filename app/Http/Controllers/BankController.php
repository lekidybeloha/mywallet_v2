<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Repositories\TransactionRepository;
use App\Transactions\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function index(TransactionRepository $transactionsRepository, $filter = null): Factory|View|Application
    {
        if($filter != null)
            $transactions = $transactionsRepository
                ->getAllTransactionByType(Auth::user()->id, 0)
                ->orderBy('created_at', 'ASC')
                ->paginate(20);
        else
            $transactions = $transactionsRepository
                ->getRecentTransactionByType(Auth::user()->id, 0)
                ->orderBy('created_at', 'ASC')
                ->paginate(20);
        ;
        return view('dashboard.bank.index', compact('transactions'));
    }

    public function update(TransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $res = $transaction->execute($request);

        if($res)
            return redirect()->back()->with('success', 'Solde initial insérer');
        else
            return redirect()->back()->withErrors(['query_error', 'Erreur dans la base de donnée']);
    }
}
