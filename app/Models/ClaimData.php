<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimData extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'policy_id',
        'meta_key',
        'meta_value'
    ];
}
