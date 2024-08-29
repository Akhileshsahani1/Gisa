@extends('layouts.admin')
@section('title', 'Edit Customer')
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
                        <button type="submit" class="btn btn-sm btn-primary" form="customerForm"><i
                                class="mdi mdi-database me-1"></i>Update</button>
                    </div>
                    <h4 class="page-title">Edit Customer</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <form id="customerForm" method="POST" action="{{ route('admin.customers.update', $customer->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body pt-1">
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="customer_type" class="col-form-label">Customer Type <span
                                            class="text-danger">*</span></label>
                                    <select id="customer_type"
                                        class="form-select @error('customer_type') is-invalid @enderror"
                                        name="customer_type">
                                        <option value="">Choose Customer Type</option>
                                        <option value="Retail"
                                            {{ old('customer_type', isset($customer) ? $customer->customer_type : '') == 'Retail' ? 'selected' : '' }}>
                                            Retail
                                        </option>
                                        <option value="SME"
                                            {{ old('customer_type', isset($customer) ? $customer->customer_type : '') == 'SME' ? 'selected' : '' }}>
                                            SME
                                        </option>
                                        <option value="Corporate"
                                            {{ old('customer_type', isset($customer) ? $customer->customer_type : '') == 'Corporate' ? 'selected' : '' }}>
                                            Corporate
                                        </option>
                                    </select>
                                    @error('customer_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="salutation" class="col-form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <select id="salutation" class="form-select @error('salutation') is-invalid @enderror"
                                        name="salutation" autofocus>
                                        <option value="">Choose Title</option>
                                        <option value="M/s."
                                            {{ old('salutation', isset($customer) ? $customer->salutation : '') == 'M/s.' ? 'selected' : '' }}>
                                            M/s.
                                        </option>
                                        <option value="Mr."
                                            {{ old('salutation', isset($customer) ? $customer->salutation : '') == 'Mr.' ? 'selected' : '' }}>
                                            Mr.
                                        </option>
                                        <option value="Ms."
                                            {{ old('salutation', isset($customer) ? $customer->salutation : '') == 'Ms.' ? 'selected' : '' }}>
                                            Ms.
                                        </option>
                                        <option value="Mrs."
                                            {{ old('salutation', isset($customer) ? $customer->salutation : '') == 'Mrs.' ? 'selected' : '' }}>
                                            Mrs.
                                        </option>
                                    </select>
                                    @error('salutation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="firstname" class="col-form-label">Firstname <span
                                            class="text-danger">*</span></label>
                                    <input id="firstname" type="text"
                                        class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                        value="{{ old('firstname', isset($customer) ? $customer->firstname : '') }}"
                                        placeholder="Enter Customer Firstname">
                                    @error('firstname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="lastname" class="col-form-label">Lastname <span
                                            class="text-danger">*</span></label>
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname', isset($customer) ? $customer->lastname : '') }}"
                                        placeholder="Enter Customer Lastname">
                                    @error('lastname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="phone">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Enter Phone Number"
                                        value="{{ old('phone', isset($customer) ? $customer->phone : '') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="phone-dial-code" name="phonedialcode" type="hidden"
                                        value="{{ isset($customer) ? $customer->dialcode : '' }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="whats_app">WhatsApp Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('whats_app') is-invalid @enderror"
                                        id="whats_app" name="whats_app" placeholder="Enter WhatsApp Number"
                                        value="{{ old('whats_app', isset($customer) ? $customer->whats_app : '') }}">
                                    @error('whats_app')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="whats_app-dial-code" name="whats_app_dialcode" type="hidden"
                                        value="{{ isset($customer) ? $customer->whats_app_dialcode : '' }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email" class="col-form-label">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', isset($customer) ? $customer->email : '') }}"
                                        placeholder="Enter Customer Email Address">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="gender" class="col-form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <select id="gender" class="form-select @error('gender') is-invalid @enderror"
                                        name="gender" autofocus>
                                        <option value="">Choose Customer Gender</option>
                                        <option value="Male"
                                            {{ old('gender', isset($customer) ? $customer->gender : '') == 'Male' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', isset($customer) ? $customer->gender : '') == 'Female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                        <option value="Other"
                                            {{ old('gender', isset($customer) ? $customer->gender : '') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date_of_birth" class="col-form-label">Date of Birth <span
                                            class="text-danger">*</span></label>
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth"
                                        value="{{ old('date_of_birth', isset($customer) ? $customer->date_of_birth : '') }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date_of_anniversary" class="col-form-label">Date of Anniversary </label>
                                    <input id="date_of_anniversary" type="date"
                                        class="form-control @error('date_of_anniversary') is-invalid @enderror"
                                        name="date_of_anniversary"
                                        value="{{ old('date_of_anniversary', isset($customer) ? $customer->date_of_anniversary : '') }}">
                                    @error('date_of_anniversary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="pan_no" class="col-form-label">Pan No. </label>
                                    <input id="pan_no" type="test"
                                        class="form-control @error('pan_no') is-invalid @enderror" name="pan_no"
                                        value="{{ old('pan_no', isset($customer) ? $customer->pan_no : '') }}"
                                        placeholder="Customer Pan No.">
                                    @error('pan_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="gst_no" class="col-form-label">GST No. </label>
                                    <input id="gst_no" type="test"
                                        class="form-control @error('gst_no') is-invalid @enderror" name="gst_no"
                                        value="{{ old('gst_no', isset($customer) ? $customer->gst_no : '') }}"
                                        placeholder="Customer GST No.">
                                    @error('gst_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state" class="col-form-label">State</label>
                                    <input id="state" type="test"
                                        class="form-control @error('state') is-invalid @enderror" name="state"
                                        value="{{ old('state', isset($customer) ? $customer->state : '') }}"
                                        placeholder="Customer State">
                                    @error('state')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city" class="col-form-label">City </label>
                                    <input id="city" type="test"
                                        class="form-control @error('city') is-invalid @enderror" name="city"
                                        value="{{ old('city', isset($customer) ? $customer->city : '') }}"
                                        placeholder="Customer City">
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="zipcode" class="col-form-label">ZipCode </label>
                                    <input id="zipcode" type="test"
                                        class="form-control @error('zipcode') is-invalid @enderror" name="zipcode"
                                        value="{{ old('zipcode', isset($customer) ? $customer->zipcode : '') }}"
                                        placeholder="Customer zipcode">
                                    @error('zipcode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="col-form-label" for="avatar">Profile Picture</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="avatar" name="avatar"
                                            onchange="loadPreview(this);">
                                    </div>
                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif


                                    @php
                                        $avatar_path =
                                            'uploads/customers/' . $customer->id . '/avatar/' . $customer->avatar;
                                    @endphp


                                    <img id="preview_img" src="{{ asset($avatar_path) }}" class="mt-2" width="100"
                                        height="100" />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="source" class="col-form-label">Customer Source <span
                                            class="text-danger">*</span></label>
                                    <input id="source" type="text"
                                        class="form-control @error('source') is-invalid @enderror" name="source"
                                        value="{{ old('source', isset($customer) ? $customer->source : '') }}"
                                        placeholder="Enter customer Source">
                                    @error('source')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="gender" class="col-form-label">Address <span
                                            class="text-danger">*</span></label>
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address"
                                        placeholder="Enter Customer Address">{{ old('address', isset($customer) ? $customer->address : '') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="pancard_file" class="col-form-label">Upload Pan Card </label>
                                    <input id="pancard_file" type="file"
                                        class="form-control @error('pancard_file') is-invalid @enderror"
                                        name="pancard_file">
                                    @error('pancard_file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @isset($customer->pancard_file)
                                        <div class="card my-1 shadow-none border">
                                            <div class="ps-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        Pan Card
                                                    </div>
                                                    <div class="col text-end">
                                                        <!-- Button -->
                                                        <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->pancard_file) }}"
                                                            download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: Pan Card"
                                                            class="btn btn-primary text-white text-muted">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="gst_file" class="col-form-label">Upload GST Certificate </label>
                                    <input id="gst_file" type="file"
                                        class="form-control @error('gst_file') is-invalid @enderror" name="gst_file">
                                    @error('gst_file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @isset($customer->gst_file)
                                        <div class="card my-1 shadow-none border">
                                            <div class="ps-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        GST Certificate
                                                    </div>
                                                    <div class="col text-end">
                                                        <!-- Button -->
                                                        <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->gst_file) }}"
                                                            download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: GST Certificate"
                                                            class="btn btn-primary text-white text-muted">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="aadhar" class="col-form-label">Upload Aadhar Card </label>
                                    <input id="aadhar" type="file"
                                        class="form-control @error('aadhar') is-invalid @enderror" name="aadhar">
                                    @error('aadhar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @isset($customer->aadhar)
                                        <div class="card my-1 shadow-none border">
                                            <div class="ps-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        Aadhar Card
                                                    </div>
                                                    <div class="col text-end">
                                                        <!-- Button -->
                                                        <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->aadhar) }}"
                                                            download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: Aadhar Card"
                                                            class="btn btn-primary text-white text-muted">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="other" class="col-form-label">Upload Other File </label>
                                    <input id="other" type="file"
                                        class="form-control @error('other') is-invalid @enderror" name="other">
                                    @error('other')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @isset($customer->other)
                                        <div class="card my-1 shadow-none border">
                                            <div class="ps-1">
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        Other Document
                                                    </div>
                                                    <div class="col text-end">
                                                        <!-- Button -->
                                                        <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->other) }}"
                                                            download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: Other Documents"
                                                            class="btn btn-primary text-white text-muted">
                                                            <i class="dripicons-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>


                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-primary" form="customerForm"><i
                                    class="mdi mdi-database me-1"></i>Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        phone = document.querySelector("#phone"),
            dialCode = document.querySelector("#phone-dial-code");

        // init plugin
        var iti = window.intlTelInput(phone, {
            initialCountry: "{{ old('iso2', 'IN') }}",
            formatOnDisplay: false,
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });
    </script>
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        whatsapp = document.querySelector("#whats_app"),
            whatsapp_dialCode = document.querySelector("#whats_app-dial-code");

        // init plugin
        var iti = window.intlTelInput(whatsapp, {
            initialCountry: "{{ old('iso2', 'IN') }}",
            formatOnDisplay: false,
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });
    </script>
@endpush
