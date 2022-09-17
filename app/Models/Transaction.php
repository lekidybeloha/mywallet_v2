<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'user_id',
        'type',
        'transaction_category_id',
        'comments',
        'amount',
    ];

    protected $casts = [
        'created_at'    =>  'datetime'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(TransactionCategory::class, 'id', 'transaction_category_id');
    }

    public function getTransactionTypeAttribute(): string
    {
        if($this->type == 0)
            return "Débit";

        return "Crédit";
    }

    public function getTransactionSourceAttribute(): string
    {
        if($this->source == 0)
            return "Banque";

        return "Caisse";
    }
}
