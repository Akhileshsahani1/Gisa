@extends('layouts.admin')
@section('title', 'Show Claim')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="#modal-create-surveyor" data-bs-toggle="modal" role="button"
                            class="btn btn-sm btn-primary float-end"><i class="mdi mdi-plus"></i> Add Surveyor Detail</a>
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-2"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                </div>
                <h4 class="page-title">Claim
                    <span class="btn bage bg-success text-white">{{ $claim->status }}</span>
                </h4>
                <h5 class="page-titlex">{{ $policy?->policyName() }}-
                    <span>{{ $policy?->policyTypeName() }}</span>
                </h5>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body custom_policy">
                    <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                            <a href="#claimDetails" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Claim Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#claimDoc" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Claim Documents</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#vehDoc" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Vehicle Documents</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#cid" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Current Insurance Details</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#pid" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Previous Insurance Details</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#updoc" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Policy Documents</span>
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content">

                    <!-----Claim details------->
                    <div class="tab-pane show active" id="claimDetails">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date of Accident</label>
                                    <p>{{ \Carbon\Carbon::parse($claim->date_of_accident)->format('d, M Y') }}</p>
                                    <label>Place of Accident</label>
                                    <p>{{ $claim->place_of_accident }}</p>
                                    <label>Time of Accident</label>
                                    <p>{{ $claim->time_of_accident }}</p>
                                    <label>Description</label>
                                    <p>{{ $claim->description }}</p>
                                    <label>Voice Description</label>

                                    @if( !is_null($claim->voice_description) )
                                    <p>
                                        <audio controls>
                                            <source src="{{ $claim->voice_description }}" type="audio/ogg">
                                            <saource src="{{ $claim->voice_description }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                          </audio>
                                    </p>
                                    @else
                                      N/A
                                    @endif

                                </div>
                                <div class="col-sm-4">
                                    <label>Name</label>
                                    <p>{{ $claim->name }}</p>
                                    <label>Contact no.</label>
                                    <p>{{$claim->phone }}</p>
                                    <label>Settlement Type</label>
                                    <p>{{ $claim->settlement_type }}</p>
                                </div>

                            </div>
                        </div>
                        <!------Claim details end-------->

                        <!-----Claim Doc------>
                        <div class="tab-pane" id="claimDoc">
                            <div class="row">
                                <div class="col-sm-12">

                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @if (!is_null($claim->dl))
                                            <tr>
                                                <td>Driving Licence (DL)</td>
                                                <td class="text-end"><a download href="{{$claim->dl}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->rc))
                                            <tr>
                                                <td>Registration Certificate (RC)</td>
                                                <td class="text-end"><a download href="{{$claim->rc}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->repair_estimate))
                                            <tr>
                                                <td>Repair Estimate</td>
                                                <td class="text-end"><a download href="{{$claim->repair_estimate}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->pan_card))
                                            <tr>
                                                <td>Pan Card of Owner</td>
                                                <td class="text-end"><a download href="{{$claim->pan_card}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->pan_card_repairer))
                                            <tr>
                                                <td>Pan Card of Repairer</td>
                                                <td class="text-end"><a download href="{{$claim->pan_card_repairer}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->aadhar_card_owner))
                                            <tr>
                                                <td>Aadhar Card of Owner</td>
                                                <td class="text-end"><a download href="{{$claim->aadhar_card_owner}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-----Claim Doc End-------->

                        <!-----Vehicle Doc------->

                        <div class="tab-pane" id="vehDoc">
                            <div class="row">
                                <div class="col-sm-12">

                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (!is_null($claim->front_side))
                                            <tr>
                                                <td>Front Side</td>
                                                <td class="text-end"><a download href="{{$claim->front_side}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->back_side))
                                            <tr>
                                                <td>Back Side</td>
                                                <td class="text-end"><a download href="{{$claim->back_side}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->right_side))
                                            <tr>
                                                <td>Right Side</td>
                                                <td class="text-end"><a download href="{{$claim->right_side}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->left_side))
                                            <tr>
                                                <td>Left Side</td>
                                                <td class="text-end"><a download href="{{$claim->left_side}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->damage_portion_one))
                                            <tr>
                                                <td>Damage Portion 1</td>
                                                <td class="text-end"><a download href="{{$claim->damage_portion_one}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->damage_portion_two))
                                            <tr>
                                                <td>Damage Portion 2</td>
                                                <td class="text-end"><a download href="{{$claim->damage_portion_two}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->damage_portion_three))
                                            <tr>
                                                <td>Damage Portion 3</td>
                                                <td class="text-end"><a download href="{{$claim->damage_portion_three}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif

                                        @if (!is_null($claim->damage_portion_four))
                                            <tr>
                                                <td>Damage Portion 4</td>
                                                <td class="text-end"><a download href="{{$claim->damage_portion_four}}" class="btn btn-sm btn-primary"><i
                                                    class="mdi mdi mdi-download me-1"></i>Download</a>
                                                </td>
                                            </tr>
                                        @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!----Vehicle Doc End--->

                        <div class="tab-pane show" id="cid">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Policy No.</label>
                                    <p>{{ policy_data($policy?->id,'policy_no') }}</p>
                                    <label>Policy Start Date</label>
                                    <p>{{ policy_data($policy?->id,'policy_start_date') != 'N/A' ? \Carbon\Carbon::parse(policy_data($policy?->id,'policy_start_date'))->format('d, M Y') : 'N/A'}}</p>
                                    <label>Policy Expiry Date</label>
                                    <p>{{ policy_data($policy?->id,'policy_expiry_date') != 'N/A' ? \Carbon\Carbon::parse(policy_data($policy?->id,'policy_expiry_date'))->format('d, M Y') : 'N/A'}}</p>
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
                            <p>{{ ($policy) && motor_form($policy->id,'registration_date') != 'N/A' ? \Carbon\Carbon::parse(motor_form($policy->id,'registration_date'))->format('d, M Y') : 'NA' }}</p>
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

@include('admin.claims.surveyor-create')


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
