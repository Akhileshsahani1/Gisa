<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'quotation_id',
        'amount',
        'mode',
        'date',
        'transaction_id',
        'policy_generated'
    ];
}
