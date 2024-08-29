<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency',
        'description',
        'enabled'
    ];

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'insurance_company_id', 'id');
    }
}
