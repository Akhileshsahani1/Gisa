<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropdownValue extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'type',
        'value',
        'sort_order',
        'status',
    ];
}
