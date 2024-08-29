@extends('layouts.admin')
@section('title', 'Show Policy')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <a href="{{ route('admin.quotation-policy.edit', $policy->id) }}" class="btn btn-sm btn-primary"><i
                            class="mdi mdi-pencil me-1"></i>Edit</a>
                    <a href="javascript:void(0)" onclick="confirmDelete('{{ $policy->id }}')"
                        class="btn btn-sm btn-danger"><i class="mdi mdi-delete me-1"></i>Delete</a>
                        <form id='delete-form{{ $policy->id }}'
                            action='{{ route('admin.quotation-policy.delete') }}'
                            method='POST'>
                            <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                            <input type='hidden' name='id'
                                value='{{ $policy->id }}'>
                        </form>
                </div>
                <h4 class="page-title">{{ $policy?->policyName() }}-
                    <span>{{ $policy?->policyTypeName() }}</span>
                </h4>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom_policy">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a href="#cid" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Current Insurance Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#pid" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Previous Insurance Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#updoc" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Uploded Documents</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="cid">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Policy No.</label>
                                    <p>{{ policy_data($policy?->id,'policy_no') }}</p>
                                    <label>Policy Start Date</label>
                                    <p>{{ \Carbon\Carbon::parse(policy_data($policy?->id,'policy_start_date'))->format('d, M Y') }}</p>
                                    <label>Policy Expiry Date</label>
                                    <p>{{ \Carbon\Carbon::parse(policy_data($policy?->id,'policy_expiry_date'))->format('d, M Y') }}</p>
                                    <label>Insurance Company</label>
                                    <p>{{ motor_form($policy->id,'selected_insurance') }}</p>
                                    <label>Financer Name</label>
                                    <p>{{ policy_data($policy->id,'financer_name') }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <label>Agency Name</label>
                                    <p>{{ $policy?->agency() }}</p>
                                    <label>No Claim Bonus (NCB)</label>
                                    <p>{{ policy_data($policy->id,'ncb') }}</p>
                                    <label>IDV</label>
                                    <p>{{ policy_data($policy->id,'idv') }}</p>
                                    <label>Gross OD</label>
                                    <p>{{ policy_data($policy->id,'gross_od') }}</p>
                                    <label>GST on OD</label>
                                    <p>{{ policy_data($policy->id,'gst_od') }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <label>Gross TP</label>
                                    <p>{{ policy_data($policy->id,'gross_tp') }}</p>
                                    <label>GST on TP</label>
                                    <p>{{ policy_data($policy->id,'gst_tp') }}</p>
                                    <label>Net Premium</label>
                                    <p>{{ policy_data($policy->id,'net_premium') }}</p>
                                    <label>Gross Premium</label>
                                    <p>{{ policy_data($policy->id,'gross_premium') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="pid">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Previous Policy No.</label>
                                    <p>{{ policy_data($policy->id,'previous_policy_no') }}</p>
                                    <label>Previous Policy Expiry Date</label>
                                    <p>{{ \Carbon\Carbon::parse(policy_data($policy->id,'previous_policy_expiry_date'))->format('d, M Y') }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <label>Previous Insurance Company</label>
                                    <p>{{ policy_data($policy->id,'previous_insurance_company') }}</p>
                                    <label>Claim Taken</label>
                                    <p>{{ policy_data($policy->id,'claim') }}</p>
                                </div>
                                <div class="col-sm-4">
                                    <label>Previous NCB</label>
                                    <p>{{ policy_data($policy->id,'previous_ncb') ? policy_data($policy->id,'previous_ncb') : motor_form($policy->id,'previous_ncb') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="updoc">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{-- <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            @if (!empty(policy_data($policy->id, 'proposal_form')))
                                                <a href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'proposal_form')) }}"
                                                    download class="btn"><i class="mdi mdi-download me-1"></i>Proposal
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
                                                    download class="btn"><i class="mdi mdi-download me-1"></i>Previous
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
                                    </div> --}}
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <!-- <th class="text-center">Create On</th> -->
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (!empty(policy_data($policy->id, 'proposal_form')))
                                            <tr>
                                                <td>Proposal Form</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'proposal_form')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!empty(policy_data($policy->id, 'invoice_copy')))
                                            <tr>
                                                <td>Invoice Copy</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'invoice_copy')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!empty(policy_data($policy->id, 'previous_policy')))
                                            <tr>
                                                <td>Previous Policy</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'previous_policy')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!empty(policy_data($policy->id, 'pre_inspection_report')))
                                            <tr>
                                                <td>Pre inspection Report</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'pre_inspection_report')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!empty(policy_data($policy->id, 'rc')))
                                            <tr>
                                                <td>Registration Certificate (RC)</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'rc')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!empty(policy_data($policy->id, 'policy_copy')))
                                            <tr>
                                                <td>Policy Copy</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'policy_copy')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if (!empty(policy_data($policy->id, 'other')))
                                            <tr>
                                                <td>Other</td>
                                                <!-- <td class="text-center">17 May, 2024</td> -->
                                                <td class="text-end"><a download href="{{ asset('storage/uploads/quotation_policy/' . $policy->id . '/' . policy_data($policy->id, 'other')) }}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-secondary text-white" style="padding: 12px 15px;">
                    <h3 style="font-size:1rem;font-weight: 400;margin: 0">Customer Details</h3>
                </div>
                <div class="card-body" style="padding: 15px">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Name</label>
                            <p>{{ $policy?->customer?->firstname . ' ' . $policy?->customer?->lastname }}</p>
                            <label>Email</label>
                            <p>{{ $policy?->customer?->email }}</p>
                            <label>Phone</label>
                            <p>{{ $policy?->customer?->phone }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Whatsapp Number</label>
                            <p>{{ $policy?->customer?->whats_app }}</p>
                            <label>Pan Number</label>
                            <p>{{ $policy?->customer?->pan_no }}</p>
                            <label>GST Number</label>
                            <p>{{ $policy?->customer?->gst_no }}</p>
                        </div>
                        <div class="col-sm-12">
                            <label>Address</label>
                            <p>{{ $policy?->customer?->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header bg-secondary text-white" style="padding: 12px 15px;">
                    <h3 style="font-size:1rem;font-weight: 400;margin: 0">Policy Details</h3>
                </div>
                <div class="card-body" style="padding: 15px">
                    <div class="row">
                    <div class="col-sm-6">
                            <label>Product Type</label>
                            <p>{{ $policy?->policyName() }}</p>
                            <label>Insurance Policy Type</label>
                            <p>{{ $policy?->insuranceCompany() }}</p>
                            <label>Sales Executive</label>
                            <p>{{ $policy?->salesExecutive()?->firstname.' '. $policy?->salesExecutive()?->lastname}}</p>
                            <label>Service Executive</label>
                            <p>{{ $policy?->serviceExecutive()?->firstname.' '. $policy?->serviceExecutive()?->lastname }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Business Type</label>
                            <p>{{ policy_data($policy?->id, 'business_type') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-secondary text-white" style="padding: 12px 15px;">
                    <h3 style="font-size:1rem;font-weight: 400;margin: 0">Vehicle Details</h3>
                </div>
                <div class="card-body" style="padding: 15px">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Registration Number</label>
                            <p>{{ policy($policy->id,'registration_no') ? policy($policy->id,'registration_no') : motor_form($policy->id,'registration_no')  }}</p>
                            <label>Make</label>
                            <p>{{ motor_form($policy?->id,'make') }}</p>
                            <label>Cubic Capacity (CC)</label>
                            <p>{{ motor_form($policy?->id,'gvw') }}CC</p>
                            <label>Registration Date</label>
                            <p>{{ ($policy) ? \Carbon\Carbon::parse(motor_form($policy->id,'registration_date'))->format('d, M Y') : 'NA' }}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Model</label>
                            <p>{{ motor_form($policy?->id,'model') }}</p>
                            <label>Chassis No.</label>
                            <p>{{ policy_data($policy?->id,'chassis_no') }}</p>
                            <label>Engine No.</label>
                            <p>{{ policy_data($policy?->id,'engine_no') }}</p>
                            <label>Year of Manufacture</label>
                            <p>{{ policy_data($policy?->id,'year_of_manufacture') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
