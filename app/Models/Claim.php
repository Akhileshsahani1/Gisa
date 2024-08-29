<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'claim_type',
        'policy_id',
        'status'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
