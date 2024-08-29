<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyTypeCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_type_id',
        'policy_id',
        'company_name',
        'commissions_value'
    ];
}
