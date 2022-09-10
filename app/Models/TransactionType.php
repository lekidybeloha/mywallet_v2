<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    /**
     * Transaction type :
     * O = DEBIT
     * 1 = CREDIT
     */
    use HasFactory;

    protected $table = 'transaction_types';
    protected $fillable = [
        'type'
    ];
}
