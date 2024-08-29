@extends('layouts.customer')
@section('title', 'Show Policy')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">@include('customer.includes.sidebar')</div>
            <div class="col-sm-9 mt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h1 class="h1-heading">View Policy</h1>
                            <div class="text-center">
                                <strong>
                                    <a onclick="{$('#raiseClaimForm').submit()}" class="btn btn-info">
                                        <i class="dripicons-to-do"></i> Raise Claim
                                    </a>
                                </strong>
                                <form method="POST" id="raiseClaimForm" action="{{ route('customer.claim.details') }}">
                                    @csrf
                                    <input type="hidden" name="policy_id" value="{{ $policy->id }}">
                                </form>
                            </div>
                            <div class="page-title-right">
                                <small>Added On</small>
                                <br>
                                <strong>{{ \Carbon\Carbon::parse($policy->created_at)->format('H:i A | d, M Y') }}</strong>
                            </div>
                            <h4 class="page-title">{{ $quotation?->policy?->name }}-
                                <span>{{ $quotation?->policyType?->type }}</span>
                            </h4>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white" style="padding: 12px 15px;">
                                <h3 style="font-size:1rem;font-weight: 400;margin: 0">Customer Details</h3>
                            </div>
                            <div class="card-body" style="padding: 15px">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Name</label>
                                        <p>{{ $quotation?->customer?->firstname . ' ' . $quotation?->customer?->lastname }}
                                        </p>
                                        <label>Email</label>
                                        <p>{{ $quotation?->customer?->email }}</p>
                                        <label>Phone</label>
                                        <p>{{ $quotation?->customer?->phone }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Whatsapp Number</label>
                                        <p>{{ $quotation?->customer?->whats_app }}</p>
                                        <label>Pan Number</label>
                                        <p>{{ $quotation?->customer?->pan_no }}</p>
                                        <label>GST Number</label>
                                        <p>{{ $quotation?->customer?->gst_no }}</p>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Address</label>
                                        <p>{{ $quotation?->customer?->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white" style="padding: 12px 15px;">
                                <h3 style="font-size:1rem;font-weight: 400;margin: 0">Actions</h3>
                            </div>
                            <div class="card-body action_btn" style="padding: 15px">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6 mb-3">

                                                @if (!empty(policy_data($policy->id, 'proposal_form')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'proposal_form')) }}"
                                                        download class="btn"><i
                                                            class="mdi mdi-download me-1"></i>Proposal
                                                        Form</a>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                @if (!empty(policy_data($policy->id, 'invoice_copy')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'invoice_copy')) }}"
                                                        download class="btn"><i class="mdi mdi-download me-1"></i>Invoice
                                                        Copy</a>
                                                @endif
                                            </div>

                                            <div class="col-sm-6 mb-3">
                                                @if (!empty(policy_data($policy->id, 'previous_policy')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'previous_policy')) }}"
                                                        download class="btn"><i
                                                            class="mdi mdi-download me-1"></i>Previous
                                                        Policy</a>
                                                @endif
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                @if (!empty(policy_data($policy->id, 'pre_inspection_report')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'pre_inspection_report')) }}"
                                                        download class="btn">
                                                        <i class="mdi mdi-download me-1"></i>Pre Inspection Report
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                @if (!empty(policy_data($policy->id, 'rc')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'rc')) }}"
                                                        download class="btn">
                                                        <i class="mdi mdi-download me-1"></i>RC
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                @if (!empty(policy_data($policy->id, 'policy_copy')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'policy_copy')) }}"
                                                        download class="btn">
                                                        <i class="mdi mdi-download me-1"></i>Policy Copy
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                @if (!empty(policy_data($policy->id, 'other')))
                                                    <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'other')) }}"
                                                        download class="btn">
                                                        <i class="mdi mdi-download me-1"></i>Others
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white" style="padding: 12px 15px;">
                                <h3 style="font-size:1rem;font-weight: 400;margin: 0">Policy Details</h3>
                            </div>
                            <div class="card-body" style="padding: 15px">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Product Type</label>
                                        <p>{{ $quotation->policy?->name }}</p>
                                        <label>Insurance Policy Type</label>
                                        <p>{{ $quotation->policyType?->type }}</p>
                                        <label>Sales Executive</label>
                                        <p>{{ $quotation->salesExecutive?->firstname . ' ' . $quotation->salesExecutive?->lastname }}
                                        </p>
                                        <label>Service Executive</label>
                                        <p>{{ $quotation->serviceExecutive?->firstname . ' ' . $quotation->serviceExecutive?->lastname }}
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Business Type</label>
                                        <p>{{ motor_form($quotation?->id, 'business_type') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header bg-primary text-white" style="padding: 12px 15px;">
                                <h3 style="font-size:1rem;font-weight: 400;margin: 0">Vehicle Details</h3>
                            </div>
                            <div class="card-body" style="padding: 15px">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Registration Number</label>
                                        <p>{{ policy($policy->id, 'registration_no') ? policy($policy->id, 'registration_no') : motor_form($quotation->id, 'registration_no') }}
                                        </p>
                                        <label>Make</label>
                                        <p>{{ motor_form($quotation?->id, 'make') }}</p>
                                        <label>Cubic Capacity (CC)</label>
                                        <p>{{ motor_form($quotation?->id, 'gvw') }}CC</p>
                                        <label>Registration Date</label>
                                        <p>{{ $quotation ? \Carbon\Carbon::parse(motor_form($quotation->id, 'registration_date'))->format('d, M Y') : 'NA' }}
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Model</label>
                                        <p>{{ motor_form($quotation?->id, 'model') }}</p>
                                        <label>Chassis No.</label>
                                        <p>{{ policy_data($policy?->id, 'chassis_no') }}</p>
                                        <label>Engine No.</label>
                                        <p>{{ policy_data($policy?->id, 'engine_no') }}</p>
                                        <label>Year of Manufacture</label>
                                        <p>{{ policy_data($policy?->id, 'year_of_manufacture') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-header bg-primary text-white" style="padding: 12px 15px;">
                                <h3 style="font-size:1rem;font-weight: 400;margin: 0">Current Insurance Details</h3>
                            </div>
                            <div class="card-body" style="padding: 15px">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Policy No.</label>
                                        <p>{{ policy_data($policy?->id, 'policy_no') }}</p>
                                        <label>Policy Start Date</label>
                                        <p>{{ \Carbon\Carbon::parse(policy_data($policy?->id, 'policy_start_date'))->format('d, M Y') }}
                                        </p>
                                        <label>Policy Expiry Date</label>
                                        <p>{{ \Carbon\Carbon::parse(policy_data($policy?->id, 'policy_expiry_date'))->format('d, M Y') }}
                                        </p>
                                        <label>Insurance Company</label>
                                        <p>{{ motor_form($quotation->id, 'selected_insurance') }}</p>
                                        <label>Financer Name</label>
                                        <p>{{ policy_data($policy->id, 'financer_name') }}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Agency Name</label>
                                        <p>{{ policy_data($policy->id, 'agency') }}</p>
                                        <label>No Claim Bonus (NCB)</label>
                                        <p>{{ policy_data($policy->id, 'ncb') }}</p>
                                        <label>IDV</label>
                                        <p>{{ policy_data($policy->id, 'idv') }}</p>
                                        <label>Gross OD</label>
                                        <p>{{ policy_data($policy->id, 'gross_od') }}</p>
                                        <label>GST on OD</label>
                                        <p>{{ policy_data($policy->id, 'gst_od') }}</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Gross TP</label>
                                        <p>{{ policy_data($policy->id, 'gross_tp') }}</p>
                                        <label>GST on TP</label>
                                        <p>{{ policy_data($policy->id, 'gst_tp') }}</p>
                                        <label>Net Premium</label>
                                        <p>{{ policy_data($policy->id, 'net_premium') }}</p>
                                        <label>Gross Premium</label>
                                        <p>{{ policy_data($policy->id, 'gross_premium') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-header bg-primary text-white" style="padding: 12px 15px;">
                                <h3 style="font-size:1rem;font-weight: 400;margin: 0">Previous Insurance Details</h3>
                            </div>
                            <div class="card-body" style="padding: 15px">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Previous Policy No.</label>
                                        <p>{{ policy_data($policy->id, 'previous_policy_no') }}</p>
                                        <label>Previous Policy Expiry Date</label>
                                        <p>{{ \Carbon\Carbon::parse(policy_data($policy->id, 'previous_policy_expiry_date'))->format('d, M Y') }}
                                        </p>
                                        <label>Previous Insurance Company</label>
                                        <p>{{ policy_data($policy->id, 'previous_insurance_company') }}</p>
                                        <label>Claim Taken</label>
                                        <p>{{ policy_data($policy->id, 'claim') }}</p>
                                        <label>Previous NCB</label>
                                        <p>{{ policy_data($policy->id, 'previous_ncb') ? policy_data($policy->id, 'previous_ncb') : motor_form($quotation->id, 'previous_ncb') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
