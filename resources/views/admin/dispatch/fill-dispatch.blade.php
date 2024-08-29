@extends('layouts.admin')
@section('title', 'Show Dispatch')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <small>Added On</small>
                        <br>
                        <strong>{{ \Carbon\Carbon::parse($dispatch->created_at)->format('H:i A | d, M Y') }}</strong>
                        {{-- <strong>1:57 PM | 29, Apr 2023</strong> --}}
                    </div>
                    <h4 class="page-title">{{ $quotation?->policy?->name }}-
                        <span>{{ $quotation?->policyType?->type }}</span>
                    </h4>
                </div>
            </div>
            <div class="col-sm-12 text-center mb-2">
                @if ($dispatch->status == 'Pending')
                    <button class="btn btn-success" id="fill-dispatch">Fill Dispatch</button>
                @else
                    <button class="btn btn-primary" onclick="{$('#dispatch-view-modal').modal('show')}">
                        <i class="mdi mdi-eye me-1"></i>Dispatch Already Filled</button>
                @endif
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
                                <p>{{ $quotation?->customer?->firstname . ' ' . $quotation?->customer?->lastname }}</p>
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
                    <div class="card-header bg-secondary text-white" style="padding: 12px 15px;">
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
                                <p>{{ $quotation->salesExecutive?->firstname.' '. $quotation->salesExecutive?->lastname}}</p>
                                <label>Service Executive</label>
                                <p>{{ $quotation->serviceExecutive?->firstname.' '. $quotation->serviceExecutive?->lastname}}</p>
                            </div>
                            <div class="col-sm-6">
                                <label>Business Type</label>
                                <p>{{ motor_form($quotation?->id, 'business_type') }}</p>
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
                                <p>{{ policy($policy->id,'registration_no') ? policy($policy->id,'registration_no') : motor_form($quotation->id,'registration_no')  }}</p>
                                <label>Make</label>
                                <p>{{ motor_form($quotation?->id,'make') }}</p>
                                <label>Cubic Capacity (CC)</label>
                                <p>{{ motor_form($quotation?->id,'gvw') }}CC</p>
                                <label>Registration Date</label>
                                <p>{{ ($quotation) ? \Carbon\Carbon::parse(motor_form($quotation->id,'registration_date'))->format('d, M Y') : 'NA' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label>Model</label>
                                <p>{{ motor_form($quotation?->id,'model') }}</p>
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
    @include('admin.dispatch.fill-modal')
    @include('admin.dispatch.view-modal')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@push('scripts')
    <script>
        let members = '<option value="">--select--</option>';
        @if (isset($members))

            @foreach ($members as $member)
                members +=
                    "<option value='{{ $member->id }}'>{{ $member->firstname . ' ' . $member->lastname }}</option>";
            @endforeach
        @endif

        let companies = '<option value="">--select--</option>';
        @if (isset($companies))

            @foreach ($companies as $company)
                companies += "<option value='{{ $company->value }}'>{{ $company->value }}</option>";
            @endforeach
        @endif

        function leadHtm(){
            return `<div class="col-4 mt-2 text-end leaddiv">
                        <label class="form-label">Person Name</label>
                    </div>
                    <div class="col-6 mt-2 float-end leaddiv">
                       <input type="text" class="form-control" placeholder="Lead Person Name" required name="lead_name" id="lead_name" >
                    </div>
                    <div class="col-4 mt-2 text-end leaddiv">
                        <label class="form-label">Person Phone</label>
                    </div>
                    <div class="col-6 mt-2 float-end leaddiv">
                       <input type="text" class="form-control" placeholder="Person Phone no." required name="lead_phone" id="lead_phone" >
                    </div>
                    `;
        }

        jQuery(document).ready(function($) {
            $('#fill-dispatch').click(function(e) {
                e.preventDefault();
                $('#dispatch-fill-modal').modal('show');
            })
            $('body').delegate('input[name="refrence"]','change',function(e){
                $('input[name="refrence"]').prop('checked',false);
                $(this).prop('checked',true);
                let $lhtml = "";
                if( $(this).val() == 'yes' ){
                    $lhtml = leadHtm();
                } else{
                    $('#formFieldsData').find('.leaddiv').remove();
                }
                $('#formFieldsData').find('.row').append($lhtml);
            })

            $('input[name="dispatch_by"]').on('change', function(e) {
                $('input[name="dispatch_by"]').prop('checked', false);
                $(this).prop('checked', true);
                let val = $(this).val();
                let $htm = '';

                if (val == 'whatsapp') {

                    $('#formFieldsData').children().remove();

                    $htm = `<hr><div class="row m-2">
                        <div class="col-4 mt-2 text-end">
                            <label for="whatsapp_no" class="form-label">Whatsapp no.</label>
                        </div>
                        <div class="col-6">
                            <input type="text" required class="form-control" placeholder="Enter whatsaap no." name="whatsapp_no">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label for="send_date" class="form-label">Send Date.</label>
                        </div>
                        <div class="col-6">
                            <input type="date" required class="form-control" name="send_date">
                        </div>
                    </div>`;
                }

                if (val == 'email') {

                    $('#formFieldsData').children().remove();

                    $htm = `<hr><div class="row m-2">
                            <div class="col-4 mt-2 text-end">
                                <label for="email_id" class="form-label">Email ID.</label>
                            </div>
                            <div class="col-6">
                                <input type="email" required class="form-control" placeholder="Enter Email ID." name="email_id">
                            </div>

                            <div class="col-4 mt-2 text-end">
                                <label for="send_date" class="form-label">Send Date.</label>
                            </div>
                            <div class="col-6">
                                <input type="date" required class="form-control" name="send_date">
                            </div>
                        </div>`;
                }

                if (val == 'courier') {

                    $('#formFieldsData').children().remove();

                    $htm = `<hr><div class="row m-2">
                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Dispatch Address</label>
                    </div>
                    <div class="col-6">
                        <input required placeholder="Enter Dispatch Address" class="form-control" name="dispatch_address" type="text">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Courier Company</label>
                    </div>
                    <div class="col-6 mt-2">
                        <select required class="form-select" name="courier_company">
                        ` + companies + `
                        <select>
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">P.O.D Details</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="text" name="pod_details" placeholder="Enter POD Details" class="form-control">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Recieved Date</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="date" name="received_date" class="form-control">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Confirmation date</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="date" name="confirmation_date" class="form-control">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Confirmed By</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="text" name="confirmed_by" placeholder="Enter Confirmed By" class="form-control">
                </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Feedback</label>
                    </div>
                    <div class="col-6 mt-2">
                       <textarea name="feedback" class="form-control" placeholder="Any feedback.."></textarea>
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Refrence</label>
                    </div>
                    <div class="col-6 mt-2 float-end">
                       <input type="checkbox" name="refrence" id="refrence"  value="yes"> Yes
                       <input type="checkbox" name="refrence" id="refrence" value="no"> No
                    </div>

                </div>`;
                }

                if (val == 'employee') {

                    $('#formFieldsData').children().remove();

                    $htm = `<hr><div class="row m-2">
                        <div class="col-4 mt-2 text-end">
                            <label for="email_id" class="form-label">Dispatch Address</label>
                        </div>
                        <div class="col-6">
                            <input required placeholder="Enter Dispatch Address" class="form-control" name="dispatch_address" type="text">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Employee Name</label>
                        </div>
                        <div class="col-6 mt-2">
                            <select required class="form-select" name="employee_name">
                           ` + members + `
                            <select>
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Given To</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="text" name="given_to" placeholder="Enter Given To." class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Given Date</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="date" name="given_date" class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Confirmation date</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="date" name="confirmation_date" class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Confirmed By</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="text" name="confirmed_by" placeholder="Enter Confirmed By" class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Feedback</label>
                        </div>
                        <div class="col-6 mt-2">
                        <textarea name="feedback" class="form-control" placeholder="Any feedback.."></textarea>
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Refrence</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="checkbox" name="refrence" id="refrence"  value="yes"> Yes
                        <input type="checkbox" name="refrence" id="refrence" value="no"> No
                        </div>

                        </div>`;
                }

                if (val == 'self') {

                    $('#formFieldsData').children().remove();

                    $htm = `<hr><div class="row m-2">

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Collector Name</label>
                        </div>
                        <div class="col-6 mt-2">
                            <select required class="form-select" name="collector_name">
                            ` + members + `
                            <select>
                        </div>


                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Collected Date</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="date" name="collected_date" class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Confirmation date</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="date" name="confirmation_date" class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Confirmed By</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="text" name="confirmed_by" placeholder="Enter Confirmed By" class="form-control">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Feedback</label>
                        </div>
                        <div class="col-6 mt-2">
                        <textarea name="feedback" class="form-control" placeholder="Any feedback.."></textarea>
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Refrence</label>
                        </div>
                        <div class="col-6 mt-2 float-end">
                        <input type="checkbox" name="refrence" id="refrence"  value="yes"> Yes
                        <input type="checkbox" name="refrence" id="refrence" value="no"> No
                        </div>

                        </div>`;
                }

                $('#formFieldsData').append($htm);
            });
        })
    </script>
@endpush
