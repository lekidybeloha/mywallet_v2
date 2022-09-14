<?php

namespace App\Transactions;

use App\Models\Bank;
use App\Models\Checkout;
use App\Models\Transaction as Trans;

class Transaction
{
    public function execute($request): bool
    {
        $transaction                            = new Trans();
        $transaction->source                    = $request->get('source');
        $transaction->user_id                   = $request->get('user_id');
        $transaction->type                      = $request->get('type');
        $transaction->transaction_category_id   = $request->get('category');
        $transaction->comments                  = $request->get('comments');

        if($request->get('source') == 0)
            $source = Bank::where('user_id', '=', $request->get('user_id'))->first();
        else
            $source = Checkout::where('user_id', '=', $request->get('user_id'))->first();

        switch ($request->get('type'))
        {
            case 0 :
                $source->sold           = $source->sold - $request->get('amount');
                $transaction->amount    = -$request->get('amount');
                break;

            case 1 :
                $source->sold           = $source->sold + $request->get('amount');
                $transaction->amount    = $request->get('amount');
                break;
        }

        $source->save();
        return $transaction->save();
    }

    public function executeTransfert($request, $type)
    {
        if($type == 'trans_to_cash')
        {
            $transaction                            = new Trans();
            $transaction->source                    = 0;
            $transaction->user_id                   = $request->get('user_id');
            $transaction->type                      = 0;
            $transaction->transaction_category_id   = 0;
            $transaction->comments                  = 'Transfert vers caisse';
            $transaction->amount                    = -$request->get('amount');
            $bank                                   = Bank::where('user_id', '=', $request->get('user_id'))->first();
            $bank->sold                             = $bank->sold - $request->get('amount');
            $bank->save();
            $transaction->save();

            $transaction                            = new Trans();
            $transaction->source                    = 1;
            $transaction->user_id                   = $request->get('user_id');
            $transaction->type                      = 1;
            $transaction->transaction_category_id   = 0;
            $transaction->comments                  = 'Reception venant de la banque';
            $transaction->amount                    = $request->get('amount');
            $checkout                               = Checkout::where('user_id', '=', $request->get('user_id'))->first();
            $checkout->sold                         = $checkout->sold + $request->get('amount');
            $checkout->save();


            return $transaction->save();
        }

        if($type == 'trans_to_bank')
        {
            $transaction                            = new Trans();
            $transaction->source                    = 1;
            $transaction->user_id                   = $request->get('user_id');
            $transaction->type                      = 0;
            $transaction->transaction_category_id   = 0;
            $transaction->comments                  = 'Transfert vers banque';
            $transaction->amount                    = -$request->get('amount');
            $checkout                               = Checkout::where('user_id', '=', $request->get('user_id'))->first();
            $checkout->sold                         = $checkout->sold - $request->get('amount');
            $checkout->save();
            $transaction->save();

            $transaction                            = new Trans();
            $transaction->source                    = 0;
            $transaction->user_id                   = $request->get('user_id');
            $transaction->type                      = 1;
            $transaction->transaction_category_id   = 0;
            $transaction->comments                  = 'Reception venant de la caisse';
            $transaction->amount                    = $request->get('amount');
            $bank                                   = Bank::where('user_id', '=', $request->get('user_id'))->first();
            $bank->sold                             = $bank->sold + $request->get('amount');
            $bank->save();

            return $transaction->save();
        }

        return false;
    }
}
