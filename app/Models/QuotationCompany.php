<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationCompany extends Model
{
    use HasFactory;
    protected $table = "quotation_companies";
    protected $fillable = [
        'quotation_id',
        'policy_type_id',
        'company_id',
        'type'
    ];
    public function meta(){
        return $this->hasMany(QuotationCompanyMeta::class,'quotation_company_id','id');
    }


}
