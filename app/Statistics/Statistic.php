<?php

namespace App\Statistics;

use App\Helpers\Tools;
use App\Repositories\TransactionRepository;
use App\Transactions\Transaction;
use Illuminate\Support\Facades\Auth;

class Statistic
{
    private Tools $tools;
    private TransactionRepository $transactionRepository;

    public function __construct(Tools $tools, TransactionRepository $transactionRepository)
    {
        $this->tools = $tools;
        $this->transactionRepository = $transactionRepository;
    }
    public function getDebitTransactionByCategoryMonth(): array
    {
        $days       = $this->tools->getAllDaysCurrentMonth();
        $categories = Auth::user()->categories;
        $transactions = [];
        $totalByCategories = [];
        foreach($categories as $one)
        {
            foreach($days as $index=>$day)
                $transactions[$one->name][$day] = $this->transactionRepository
                    ->getDebitByCategory(Auth::user()->id, $one->id, $index)
                    ->first()
                ;

            $totalByCategories[$one->name] = $this->transactionRepository
                ->getDebitTransactionCurrentMonth(Auth::user()->id, $one->id)
                ->first();
        }

        return [
            'days'          => $days,
            'transactions'  => $transactions,
            'categories'    => $totalByCategories,
        ];
    }

    public function getCreditTransactionByCategoryMonth()
    {

    }
}
