<?php

use App\Models\DispatchData;
use App\Models\DispatchPolicies;
use App\Models\DropdownValue;
use App\Models\QuotationCompanyMeta;
use App\Models\QuotationMotorData;
use App\Models\QuotationPolicyData;
use App\Models\InsuranceCompany;
use App\Models\Quotation;

function motor_form($quotation_id, $meta_key)
{
    $response = QuotationMotorData::where([
        'quotation_id' => $quotation_id,
        'meta_key'     => $meta_key,
    ])->first();

    return !is_null($response) ? $response->meta_value : 'N/A';
}

function getPolicyNoByQuotationId($id)
{
    $quotation =  Quotation::find($id);

    if($quotation){
        return Quotation::find($id)->value('policy_id');
    }else{
        return 'N/A';
    }
}

function company_data($id)
{
    $insurancecompany =  InsuranceCompany::where('id', $id);

    if($insurancecompany){
        return InsuranceCompany::where('id', $id)->value('company');
    }else{
        return "-----";
    }

    
}

function motor_meta($quotation_id, $quotation_company_id, $meta_key)
{
    $response = QuotationCompanyMeta::where([
        'quotation_id' => $quotation_id,
        'quotation_company_id' => $quotation_company_id,
        'meta_key'     => $meta_key,
    ])->first();

    return !is_null($response) ? $response->meta_value : '';
}

function policy_data($policy_id, $meta_key)
{
    $response = QuotationPolicyData::where('policy_id', $policy_id)->where('meta_key', $meta_key)->first();
    return !is_null($response) ? $response->meta_value : '';
}

function dropdowns()
{
    $dropdown = [];
    $dropdown['lead_status']                = DropdownValue::where('type', 'lead-status')->where('status', true)->orderBy('sort_order')->get();
    $dropdown['lead_type']                  = DropdownValue::where('type', 'lead-type')->where('status', true)->orderBy('sort_order')->get();
    $dropdown['lead_source']                = DropdownValue::where('type', 'lead-source')->where('status', true)->orderBy('sort_order')->get();
    $dropdown['ncb']                = DropdownValue::where('type', 'ncb')->where('status', true)->orderBy('sort_order')->get();
    $dropdown['previous-ncb']                = DropdownValue::where('type', 'previous-ncb')->where('status', true)->orderBy('sort_order')->get();
    return $dropdown;
}

function dispatch_data($dispatch_id)
{
    $response = DispatchData::where('dispatch_id', $dispatch_id)->pluck('meta_value', 'meta_key')->except('_token', 'id');
    return isset($response) ? $response->toArray() : [];
}
