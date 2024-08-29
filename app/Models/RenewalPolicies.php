<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalPolicies extends Model
{
    use HasFactory;

    protected $table = 'renewal_policies';

    protected $fillable = [
        'policy_id',
        'quotation_id',
        'customer_id',
        'user_id',
        'reminder_status',
        'status'
    ];

    public function policy()
    {
        return $this->belongsTo(QuotationPolicy::class,'policy_id','id');
    }
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id','id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }

    public function contactHistories()
    {
        return $this->hasMany(RenewalContactHistory::class, 'renewal_id', 'id');
    }
    public function follows()
    {
        return $this->hasMany(RenewalContactHistory::class, 'renewal_id', 'id')->whereDate('follow_up_date', '>=',date('Y-m-d'))->orderBy('follow_up_date','ASC');
    }

    public function latestContactHistory(){
        return $this->hasOne(RenewalContactHistory::class)->orderBy('id','DESC')->latest();

    }
    public function comments()
    {
        return $this->hasMany(RenewalComment::class,'renewal_id')->orderBy('id','DESC');
    }

}
