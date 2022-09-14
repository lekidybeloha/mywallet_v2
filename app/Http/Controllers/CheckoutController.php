<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Repositories\TransactionRepository;
use App\Transactions\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(TransactionRepository $transactionsRepository)
    {
        $transactions = $transactionsRepository
            ->getRecentCheckoutTransactionByUser(Auth::user()->id)
            ->orderBy('created_at', 'ASC')
            ->get()
        ;
        return view('dashboard.checkout.index', compact('transactions'));
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
