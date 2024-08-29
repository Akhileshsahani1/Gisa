@extends('layouts.admin')
@section('title', 'Company Settings')
@section('head')
<link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="companyDetailForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Company Settings</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('admin.includes.flash-message')
                        <form id="companyDetailForm" method="POST" action="{{ route('admin.company-details') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mb-2 {{ $errors->has('company') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="company">Company</label>
                                    <input type="text" class="form-control" id="company" name="company"
                                        placeholder="Enter Company Name" value="{{ old('company', $company->company) }}">
                                    @error('company')
                                        <span id="company-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Email Address" value="{{ old('email', $company->email) }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('phone') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter Phone Number" value="{{ old('phone', $company->phone) }}">
                                    @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input id="dial-code" name="dialcode" type="hidden"
                                        value="{{ isset($company) ? $company->dialcode : '' }}">
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('whats_app') ? 'has-error' : '' }}">
                                    <label class="col-form-label" for="whats_app">WhatsApp Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('whats_app') is-invalid @enderror"
                                        id="whats_app" name="whats_app" placeholder="Enter WhatsApp Number"
                                        value="{{ old('whats_app', $company->whats_app) }}">
                                    @error('whats_app')
                                    <span id="whats_app-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <input id="whats_app-dial-code" name="whats_app_dialcode" type="hidden"
                                        value="{{ isset($company) ? $company->whats_app_dialcode : '' }}">
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('gstin') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="gstin">GSTIN</label>
                                    <input type="text" class="form-control" id="gstin" name="gstin"
                                        placeholder="Enter gstin" value="{{ old('gstin', $company->gstin) }}">
                                    @error('gstin')
                                        <span id="gstin-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('address_line_1') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="address_line_1">Address Line 1</label>
                                    <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                                        placeholder="Enter Address Line 1"
                                        value="{{ old('address_line_1', $company->address_line_1) }}">
                                    @error('address_line_1')
                                        <span id="address_line_1-error"
                                            class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="address_line_2">Address Line 2</label>
                                    <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                                        placeholder="Enter Address Line 2"
                                        value="{{ old('address_line_2', $company->address_line_2) }}">
                                    @error('address_line_2')
                                        <span id="address_line_2-error"
                                            class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('city') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter City" value="{{ old('city', $company->city) }}">
                                    @error('city')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-2 {{ $errors->has('state') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="Enter State" value="{{ old('state', $company->state) }}">
                                    @error('state')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6 mb-2 {{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                    <label class="col-form-label"  for="zipcode">Zipcode</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                                        placeholder="Enter Zipcode" value="{{ old('zipcode', $company->zipcode) }}">
                                    @error('zipcode')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="col-form-label"  for="logo">Logo</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="logo" name="logo"
                                            onchange="loadPreview(this);">
                                    </div>
                                    @if ($errors->has('logo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                    @endif
                                    <img id="preview_img" src="{{ $company->logo }}" class="mt-2" width="191"
                                        height="106" />
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-sm btn-primary" form="companyDetailForm"><i
                            class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(191)
                        .height(106);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

<script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
<script>
    phone = document.querySelector("#phone"),
        dialCode = document.querySelector("#phone-dial-code");

    // init plugin
    var iti = window.intlTelInput(phone, {
        initialCountry: "{{ old('iso2', 'IN') }}",
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });
</script>
<script>
    whatsapp = document.querySelector("#whats_app"),
        whatsapp_dialCode = document.querySelector("#whats_app-dial-code");

    // init plugin
    var iti = window.intlTelInput(whatsapp, {
        initialCountry: "{{ old('iso2', 'IN') }}",
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });
</script>
@endpush
