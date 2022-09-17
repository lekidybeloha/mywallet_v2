<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Transactions\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('dashboard.transaction.index');
    }

    public function execute(TransactionRequest $request, Transaction $transaction)
    {
        $res = false;
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
