@extends('layouts.admin')
@section('title', 'Edit Quotation')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="quotationForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Edit Policy</h4>
                </div>
            </div>
        </div>

        @include('admin.includes.flash-message')
        <form id="quotationPolicyForm" method="POST" action="{{ route('admin.quotation-policy.update') }}" enctype="multipart/form-data">
            @csrf
          
            <input type="hidden" name="id" value="{{ $policy->id }}">
            <input type="hidden" name="quotation_id" value="{{ $policy->quotation?->id }}">
            <div class="row">
                @include('admin.customers.select')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Policy Details</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    
                                    <label class="col-form-label" for="policy_id">Product Type <span
                                            class="text-danger">*</span></label>
                                    <select disabled name="policy_id" id="policy_id"
                                        class="form-select @error('policy_id') is-invalid @enderror"
                                        onchange="getProductType()">
                                        <option value="">Choose Product</option>
                                        @foreach ($policies as $_policy)
                                            <option value="{{ $_policy->id }}"
                                                {{ old('policy_id', $_policy->id) == $policy->quotation?->policy_id ? 'selected' : '' }}>
                                                {{ $_policy->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('policy_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="policy_type_id">Insurance Policy Type <span
                                            class="text-danger">*</span></label>
                                    <select disabled name="policy_type_id" id="policy_type_id"
                                        class="form-select @error('policy_type_id') is-invalid @enderror" onchange="getPolicyEditableForm()">
                                        <option value="">Choose Policy Type</option>
                                    </select>
                                    @error('policy_type_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                              
                                <input type="hidden" name="policy_id" value="{{ $policy->quotation?->policy_id }}">
                                <input type="hidden" name="policy_type_id" value="{{ $policy->quotation?->policy_type_id }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="policy_form_div">

                </div>
            </div>
        </form>
    </div>

@endsection
@push('scripts')
  @include('admin.quotations.quotation-policies.edit.edit-utilities')
@endpush
