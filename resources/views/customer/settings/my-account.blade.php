@extends('layouts.customer')
@section('title', 'My Account')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        
                    </div>
                    <h4 class="page-title">My Account</h4>
                </div>
            </div>
        </div>
        @include('customer.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-sm-3">@include('customer.includes.sidebar')</div>
        <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="name">Full Name</label>
                                <p>{{ $customer->salutation }} {{ $customer->firstname }}
                                     {{ $customer->lastname }}
                                </p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="gender">{{ __('Gender') }}</label>
                               <p>{{ $customer->gender }}</p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="phone">Phone Number</label>
                                <p> {{ $customer->phone }}</p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="phone">WhatsApp Number</label>
                                <p> {{ $customer->whats_app }}</p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="email">Email Address</label>
                                <p> {{ $customer->email }}</p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="address">Address</label>
                                <p>{{ $customer->address }} </p>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="state">Date of Birth</label>
                                <p> {{ \Carbon\Carbon::parse($customer->date_of_birth)->format('d-m-Y') }} </p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="state">Date of Anniversary</label>
                                <p> {{ \Carbon\Carbon::parse($customer->date_of_anniversary)->format('d-m-Y') }} </p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="zipcode">PAN No.</label>
                                <p>{{ $customer->pan_no }}</p>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="col-form-label" for="zipcode">GST No.</label>
                                <p>{{ $customer->gst_no }}</p>
                            </div>

                           {{--  <div class="col-sm-6">
                                <label class="col-form-label" for="avatar">Image</label>
                                <div>
                                <img id="preview_img" src="{{ $customer->avatar }}" class="mt-2"
                                    width="100" height="100" />
                                </div>
                            </div> --}}
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
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        // get the country data from the plugin
        // var countryData = window.intlTelInputGlobals.getCountryData(),

            input = document.querySelector("#phone"),
            dialCode = document.querySelector("#dial-code");
        // countryDropdown = document.querySelector("#country");

        // for (var i = 0; i < countryData.length; i++) {
        //     var country = countryData[i];
        //     var optionNode = document.createElement("option");
        //     optionNode.value = country.iso2;
        //     var textNode = document.createTextNode(country.name);
        //     optionNode.appendChild(textNode);
        //     countryDropdown.appendChild(optionNode);
        // }

        // init plugin
        var iti = window.intlTelInput(input, {
            onlyCountries: ["SG"],
            initialCountry: 'SG',
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });

        // set it's initial value
        // dialCode.value = '+' + iti.getSelectedCountryData().dialCode;
        // countryDropdown.value = iti.getSelectedCountryData().iso2;

        // // listen to the telephone input for changes
        // input.addEventListener('countrychange', function(e) {
        //     dialCode.value = '+' + iti.getSelectedCountryData().dialCode;
        //     countryDropdown.value = iti.getSelectedCountryData().iso2;
        // });

        // // listen to the address dropdown for changes
        // countryDropdown.addEventListener('change', function() {
        //     iti.setCountry(this.value);
        // });
    </script>
@endpush
