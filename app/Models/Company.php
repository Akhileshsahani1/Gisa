<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'company',
        'email',
        'dialcode',
        'phone',
        'whats_app_dialcode',
        'whats_app',
        'address_line_1',
        'address_line_2',
        'city',
        'zipcode',
        'state',
        'iso2',
        'logo',
        'gstin'
    ];

}
