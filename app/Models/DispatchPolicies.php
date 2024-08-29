<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchPolicies extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'user_id',
        'customer_id',
        'dispatch_date',
        'dispatch_by',
        'status'
    ];
    public function policy(){
        return $this->belongsTo(QuotationPolicy::class,'policy_id','id');
    }
}
