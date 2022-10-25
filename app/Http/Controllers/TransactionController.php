<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Statistics\Statistic;
use App\Transactions\Transaction;

class TransactionController extends Controller
{
    public function index(Statistic $statistic)
    {
        $depenses = $statistic->getDebitTransactionByCategoryMonth();
        return view('dashboard.transaction.index', compact('depenses'));
    }

    public function execute(TransactionRequest $request, Transaction $transaction)
    {
        if($request->has('trans_to_cash'))
            $res = $transaction->executeTransfert($request, 'trans_to_cash');
        elseif ($request->has('trans_to_bank'))
            $res = $transaction->executeTransfert($request, 'trans_to_bank');
        else
            $res = $transaction->execute($request);

        if($res)
            return redirect()->back()->with('success', 'Opération effectuée avec succès');
        else
            return redirect()->back()->withErrors(['Erreur dans la base de donnée']);
    }
}
