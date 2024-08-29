<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'description',
        'logo',
        'enabled'
    ];

    public function previousQuotations()
    {
        return $this->hasMany(Quotation::class, 'previous_insurance_company_id', 'id');
    }

    public function previousOdQuotations()
    {
        return $this->hasMany(Quotation::class, 'previous_od_insurance_company_id', 'id');
    }

    public function previousTpQuotations()
    {
        return $this->hasMany(Quotation::class, 'previous_tp_insurance_company_id', 'id');
    }
    
    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'insurance_company_id', 'id');
    }
}
