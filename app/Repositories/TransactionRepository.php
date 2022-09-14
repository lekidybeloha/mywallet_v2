<?php

namespace App\Repositories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public function getRecentTransactionByUser($user_id)
    {
        return Transaction::where('user_id', '=', $user_id)
            ->whereBetween(DB::raw('created_at'), [
                Carbon::now()->startOfWeek()->format('Y-m-d'),
                Carbon::now()->endOfWeek()->format('Y-m-d'),
            ]);
    }

    public function getRecentBankTransactionByUser($user_id)
    {
        return Transaction::where('user_id', '=', $user_id)
            ->where('source', '=', 0)->whereBetween(DB::raw('created_at'), [
                Carbon::now()->startOfWeek()->format('Y-m-d'),
                Carbon::now()->endOfWeek()->format('Y-m-d'),
            ]);
    }

    public function getRecentCheckoutTransactionByUser($user_id)
    {
        return Transaction::where('user_id', '=', $user_id)
            ->where('source', '=', 1)->whereBetween(DB::raw('created_at'), [
                Carbon::now()->startOfWeek()->format('Y-m-d'),
                Carbon::now()->endOfWeek()->format('Y-m-d'),
            ]);
    }
}
