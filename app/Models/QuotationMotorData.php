<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationMotorData extends Model
{
    use HasFactory;
    protected $table = "quotation_motor_data";
    protected $fillable = [
        'quotation_id',
        'policy_type_id',
        'meta_key',
        'meta_value'
    ];

}
