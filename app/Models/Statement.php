<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'payment_id',
        'transaction_id',
        'date',
        'amount',
        'paid_amount',
        'balance_amount',
        'details',
        'payment_type',
        'status'
    ];
}
