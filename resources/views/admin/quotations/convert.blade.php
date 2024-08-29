@extends('layouts.admin')
@section('title', 'Convert Lead')
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
                    <h4 class="page-title">{{ isset($renewal) ? 'Convert Renewal' : 'Convert Lead' }}</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <form id="quotationForm" method="POST" action="{{ route('admin.quotations.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="lead_id" value="{{ $lead->id }}">
            <input type="hidden" name="is_renewal" value="{{ $renewal }}">
            <input type="hidden" name="policy_id" value="{{ $policy_id }}">
            <input type="hidden" name="policy_type_id" value="{{ $policy_type_id }}">
            <input type="hidden" name="quotation_description" value="{{ $description }}">

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
                                    <select name="policy_idd" id="policy_id" disabled
                                        class="form-select @error('policy_id') is-invalid @enderror"
                                        onchange="getProductType()">
                                        <option value="">Choose Product</option>
                                        @foreach ($policies as $policy)
                                            <option value="{{ $policy->id }}"
                                                {{ $policy_id == $policy->id ? 'selected' : '' }}>
                                                {{ $policy->name }}
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
                                    <select name="policy_type_idd" id="policy_type_id" disabled
                                        class="form-select @error('policy_type_id') is-invalid @enderror" onchange="getPolicyForm()">
                                        <option value="">Choose Policy Type</option>
                                    </select>
                                    @error('policy_type_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="policy_form_div">

                </div>
            </div>
            <div class="card">
    <div class="card-footer text-end">
        <a href="{{ route('admin.leads.show',$lead->id) }}" class="btn btn-sm btn-dark me-1"><i
                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
        <button type="submit" class="btn btn-sm btn-primary" form="quotationForm"><i
                class="mdi mdi-database me-1"></i>Save</button>
    </div>
</div>
        </form>
    </div>
    @include('admin.customers.create')
@endsection
@push('scripts')
  @include('admin.quotations.convert-utilities')
@endpush
