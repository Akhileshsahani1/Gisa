<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationPolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'customer_id',
        'expiry_date',
        'status'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'id');
    }
    public function dispatch()
    {
        return $this->belongsTo(DispatchPolicies::class, 'id', 'policy_id');
    }
    public function storeData()
    {
        return $this->hasMany(QuotationPolicyData::class, 'policy_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function insuranceCompany()
    {
        $company_id = policy_data($this->id, 'insurance_company');
        return !is_null($company_id) ? InsuranceCompany::find($company_id)?->company : 'N/A';
    }

    public function policyTypeName()
    {
        $policy_type_id = policy_data($this->id, 'policy_type_id');
        return !is_null($policy_type_id) ? PolicyType::find($policy_type_id)?->type : 'N/A';
    }
    public function policyName()
    {
        $policy_id = policy_data($this->id, 'policy_id');
        return !is_null($policy_id) ? Policy::find($policy_id)?->name : 'N/A';
    }
    public function salesExecutive(){
        $id = policy_data($this->id,'sales_executive_id');
        return !is_null($id) ? Administrator::find($id) : null;
    }
    public function serviceExecutive(){
        $id = policy_data($this->id,'service_executive_id');
        return !is_null($id) ? Administrator::find($id) : null;
    }
    public function agency(){
        $id = policy_data($this->id,'agency');
        return !is_null($id) ? Agency::find($id)?->agency : null;
    }

    public function companyAttaribute()
    {
        return QuotationPolicyData::where(['meta_key' => 'gross_premium', 'quotation_id' => $this->quotation_id, 'policy_id' => $this->id])->value('meta_value');
    }
    public function policyTypeIdAttaribute()
    {
        return QuotationPolicyData::where(['meta_key' => 'policy_type_id', 'policy_id' => $this->id])->value('meta_value');
    }
    public function serviceExecutiveIdAttaribute()
    {
        return QuotationPolicyData::where(['meta_key' => 'service_executive_id', 'policy_id' => $this->id])->value('meta_value');
    }
    public function claim(){
        return $this->hasOne(Claim::class,'policy_id');
    }
  
}
