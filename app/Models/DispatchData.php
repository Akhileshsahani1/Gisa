<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchData extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatch_id',
        'policy_id',
        'meta_key',
        'meta_value'
    ];

}
