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

    public function getAllTransactionByUser($user_id)
    {
        return Transaction::where('user_id', '=', $user_id);
    }

    public function getRecentTransactionByType($user_id, $type)
    {
        return Transaction::where('user_id', '=', $user_id)
            ->where('source', '=', $type)->whereBetween(DB::raw('created_at'), [
                Carbon::now()->startOfWeek()->format('Y-m-d'),
                Carbon::now()->endOfWeek()->format('Y-m-d'),
            ]);
    }

    public function getAllTransactionByType($user_id, $type)
    {
        return Transaction::where('user_id', '=', $user_id)
            ->where('source', '=', $type);
    }
}
