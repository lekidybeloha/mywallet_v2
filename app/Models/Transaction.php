<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'user_id',
        'transaction_type_id',
        'transaction_category_id',
        'comments',
    ];


}
