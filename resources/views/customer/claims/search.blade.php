@extends('layouts.customer')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">@include('customer.includes.sidebar')</div>
            <div class="col-sm-9 mt-2">
                <div class="row">
                    <div class="page-title-box">
                        <h1 class="h1-heading">Search Claim</h1>
                    </div>
                    @if( is_null(request()->session()->get('policy')) )
                    <div class="card mt-2">
                        <form id="searchForm" method="POST" action="{{ route('customer.claim.search') }}">
                            @csrf
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="col-6 text-end">
                                        <span class="btn btn-outline-success mbtn" onclick="{$('#ptype').val('motor');$('.mbtn').addClass('btn-outline-success').removeClass('btn-success');$(this).removeClass('btn-outline-success').addClass('btn-success')}">Motor</span>
                                    </div>
                                    <div class="col-6">
                                        <span class="btn btn-outline-success mbtn" onclick="{$('#ptype').val('non-motor');$('.mbtn').addClass('btn-outline-success').removeClass('btn-success');$(this).removeClass('btn-outline-success').addClass('btn-success')}">Non
                                            Motor</span>
                                    </div>
                                    <input type="hidden" name="product_type" value="" id="ptype">
                                </div>

                                <div class="row text-center mt-3">
                                    <div class="col-12">
                                        <label class="form-label">Enter your vehicle number</label>
                                        <input class="form-control w-50 mx-auto" name="vehicle_no" type="text"
                                            placeholder="Enter your vehicle number" value="{{ old('vehicle_no') }}"/>
                                    </div>
                                    <div class="row text-enter"><strong>OR</strong></div>
                                    <div class="col-12">
                                        <label class="form-label">Enter your Last 5 digits chassis number</label>
                                        <input class="form-control w-50 mx-auto" name="chassis_no" type="text"
                                            placeholder="Last 5 digits chassis number" value="{{ old('chassis_no') }}"/>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-6 text-end">
                                        <a href="{{ route('customer.claims') }}" class="btn btn-dark">Back</a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success">Search</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    @endif

                    <!----Result Form ---->
                    @if( !is_null(request()->session()->get('policy')) )
                    @php
                        $policy = request()->session()->get('policy');
                    @endphp

                    <div class="card mt-2">
                        <form>

                            <div class="card-body pt-1">

                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <label class="form-label">Customer Name :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="customer_name" type="text" readonly value="{{ $policy->customer?->firstname.' '.$policy->customer?->lastname }}" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Vehicle Number :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="vehicle_number" type="text" readonly value="{{ policy_data($policy->id,'registration_number') }}"/>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Engine Number :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="engine_number" type="text" readonly value="{{ policy_data($policy->id,'engine_no') }}"/>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Chasis Number :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="chasis_number" type="text" readonly value="{{ policy_data($policy->id,'chassis_no') }}"/>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Make :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="make" type="text" readonly value="{{ motor_form($policy->quotation_id,'make') }}"/>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Model :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="model" type="text" readonly value="{{ motor_form($policy->quotation_id,'model') }}"/>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Year of manufacture :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="year_of_manufacture" readonly type="text" value="{{ policy_data($policy->id,'year_of_manufacture') }}"/>
                                    </div>
                                </div>


                                <div class="row mt-2 justify-center">
                                    <div class="col-12 text-center">
                                        <a href="{{ route('customer.claim.raise') }}" class="btn btn-dark">Back</a>
                                        <button class="btn btn-success">Register Claim</button>
                                        <button class="btn btn-info">Claim Status</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!----End Result Form --->
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
