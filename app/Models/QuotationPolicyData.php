<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationPolicyData extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'quotation_id',
        'meta_key',
        'meta_value'
    ];

    public function quotation()
    {
        return $this->hasOne(Quotation::class, 'id');
    }
}
