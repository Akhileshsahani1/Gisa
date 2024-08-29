<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationCompanyMeta extends Model
{
    use HasFactory;
    protected $table = "quotation_companies_meta";
    protected $fillable = [
        'quotation_company_id',
        'quotation_id',
        'meta_key',
        'meta_value'
    ];

}
