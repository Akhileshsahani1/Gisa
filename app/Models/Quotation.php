<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'customer_id',
        'policy_id',
        'policy_type_id',
        'business_type',
        'sales_executive_id',
        'service_executive_id',
        'registration_no',
        'new',
        'make',
        'model',
        'gvw',
        'seating_capacity',
        'cubic_capacity',
        'year_of_manufacture',
        'registration_date',
        'engine_no',
        'chassis_no',
        'previous_policy_no',
        'previous_od_policy_no',
        'previous_tp_policy_no',
        'previous_policy_start_date',
        'previous_policy_expiry_date',
        'previous_od_policy_expiry_date',
        'previous_tp_policy_expiry_date',
        'previous_insurance_company_id',
        'previous_od_insurance_company_id',
        'previous_tp_insurance_company_id',
        'previous_od_ncb',
        'previous_ncb',
        'claim',
        'claim_amount',
        'previous_cumultaive_bonus',
        'previous_coverage_table',
        'previous_financer_name',
        'previous_sum_insured',
        'previous_net_premium',
        'previous_gst',
        'previous_gross_premium',
        'nature_of_work',
        'policy_type',
        'doctor_specialty',
        'risk_occupancy',
        'machine_description',
        'machine_sno',
        'premises_type',
        'motor_policy_no',
        'motor_policy_expiry_date',
        'vehicle_no',
        'cargo_in_carrier',
        'project_description',
        'project_period',
        'extended_maintenance_period',
        'family_size',
        'total_members',
        'relationship',
        'risk_location',
        'total_no_of_work',
        'policy_no',
        'policy_start_date',
        'policy_expiry_date',
        'od_policy_start_date',
        'od_policy_expiry_date',
        'tp_policy_start_date',
        'tp_policy_expiry_date',
        'financer_name',
        'insurance_company_id',
        'agency_id',
        'idv',
        'erf_fund',
        'ncb',
        'gross_od',
        'gross_tp',
        'gst',
        'gst_od',
        'gst_tp',
        'sum_insured',
        'declaration_frequency',
        'cumultaive_bonus',
        'coverage_table',
        'net_premium',
        'gross_premium',
        'proposal_form',
        'rc',
        'quotation',
        'new_machinery_quotation',
        'machinery_list',
        'members_list',
        'list_of_items',
        'work_order',
        'lr',
        'letter_of_award',
        'e_way_bill',
        'pre_dispatch_survey_report',
        'destination_survey_report',
        'ca_certificate',
        'previous_policy',
        'motor_policy',
        'previous_od_policy',
        'tp_policy',
        'pre_inspection_report',
        'aadhar_card',
        'invoice_copy',
        'policy_copy',
        'other_file',
        'status'
    ];

    /**
     * Get the customer that owns the Quotation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }

    public function policyType()
    {
        return $this->belongsTo(PolicyType::class, 'policy_type_id', 'id');
    }

    public function previousInsuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'previous_insurance_company_id', 'id');
    }

    public function previousOdInsuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'previous_od_insurance_company_id', 'id');
    }

    public function previousTpInsuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'previous_tp_insurance_company_id', 'id');
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(InsuranceCompany::class, 'insurance_company_id', 'id');
    }

    public function salesExecutive()
    {
        return $this->belongsTo(Administrator::class, 'sales_executive_id', 'id');
    }

    public function serviceExecutive()
    {
        return $this->belongsTo(Administrator::class, 'service_executive_id', 'id');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id', 'id');
    }

    public function quotationOptions(){
        return $this->hasMany(QuotationCompany::class,'quotation_id','id');
    }
    public function transactions(){
        return $this->hasMany(Transactions::class,'quotation_id','id');
    }

}
