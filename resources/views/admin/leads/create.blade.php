@extends('layouts.admin')
@section('title', 'Create Lead')
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
                        <button type="submit" class="btn btn-sm btn-primary" form="leadForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Create Lead</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <form id="leadForm" method="POST" action="{{ route('admin.leads.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Customer Information</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="customer_type" class="col-form-label">Customer Type <span
                                            class="text-danger">*</span></label>
                                    <select name="customer_type" id="customer_type" class="form-select">
                                        <option value="inword">InWord</option>
                                        <option value="outword">OutWord</option>
                                    </select>
                                    @error('customer_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="salutation" class="col-form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <select id="salutation" class="form-select @error('salutation') is-invalid @enderror"
                                        name="salutation" autofocus>
                                        <option value="">Choose Title</option>
                                        <option value="M/s." {{ old('salutation') == 'M/s.' ? 'selected' : '' }}>M/s.
                                        </option>
                                        <option value="Mr." {{ old('salutation') == 'Mr.' ? 'selected' : '' }}>Mr.
                                        </option>
                                        <option value="Ms." {{ old('salutation') == 'Ms.' ? 'selected' : '' }}>Ms.
                                        </option>
                                        <option value="Mrs." {{ old('salutation') == 'Mrs.' ? 'selected' : '' }}>Mrs.
                                        </option>
                                    </select>
                                    @error('salutation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div
                                    class="form-group col-md-4 company_fields @if (!$errors->has('company_name')) hidden @endif">
                                    <label for="company_name" class="col-form-label">Company Name <span
                                            class="text-danger">*</span></label>
                                    <input id="company_name" type="text"
                                        class="form-control @error('company_name') is-invalid @enderror" name="company_name"
                                        value="{{ old('company_name') }}" placeholder="Enter Company Name">
                                    @error('company_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div
                                    class="form-group col-md-4 company_fields @if (!$errors->has('company_phone')) hidden @endif">
                                    <label for="company_phone" class="col-form-label">Company Phone <span
                                            class="text-danger">*</span></label>
                                    <input id="company_phone" type="text"
                                        class="form-control @error('company_phone') is-invalid @enderror"
                                        name="company_phone" value="{{ old('company_phone') }}"
                                        placeholder="Enter Company Phone">
                                    @error('company_phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="form-group col-md-4">
                                    <label for="firstname" class="col-form-label">Firstname <span
                                            class="text-danger">*</span></label>
                                    <input id="firstname" type="text"
                                        class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                        value="{{ old('firstname') }}" placeholder="Enter Customer Firstname">
                                    @error('firstname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="lastname" class="col-form-label">Lastname <span
                                            class="text-danger">*</span></label>
                                    <input id="lastname" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" placeholder="Enter Customer Lastname">
                                    @error('lastname')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">

                                    <label class="col-form-label" for="phone">Phone Number <span
                                            class="text-danger">*</span>

                                        </span>
                                    </label>
                                    <label class="col-form-label" for="phone">same for whatsaap
                                        <span class="text-dark float-right">
                                            <input type="checkbox" id="samewp">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="Enter Phone Number"
                                        value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="phone-dial-code" name="phonedialcode" type="hidden"
                                        value="{{ isset($lead) ? $lead->dialcode : '' }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="col-form-label" for="whats_app">WhatsApp Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('whats_app') is-invalid @enderror"
                                        id="whats_app" name="whats_app" placeholder="Enter WhatsApp Number"
                                        value="{{ old('whats_app') }}">
                                    @error('whats_app')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input id="whats_app-dial-code" name="whats_app_dialcode" type="hidden"
                                        value="{{ isset($lead) ? $lead->whats_app_dialcode : '' }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="email" class="col-form-label">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Enter Customer Email Address">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="gender" class="col-form-label">Gender <span
                                            class="text-danger">*</span></label>
                                    <select id="gender" class="form-select @error('gender') is-invalid @enderror"
                                        name="gender" autofocus>
                                        <option value="">Choose Customer Gender</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="date_of_birth" class="col-form-label">Date of Birth</label>
                                    <input id="date_of_birth" type="date"
                                        class="form-control @error('date_of_birth') is-invalid @enderror"
                                        name="date_of_birth" value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="gender" class="col-form-label">Address <span
                                            class="text-danger">*</span></label>
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" placeholder="Enter Customer Address">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Lead Information</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="lead_type" class="col-form-label">Lead Type <span
                                            class="text-danger">*</span></label>
                                    <select id="lead_type" class="form-select @error('lead_type') is-invalid @enderror"
                                        name="lead_type">
                                        <option value="">Choose Lead Type</option>
                                        @foreach($dropdown['lead_type'] as $type)
                                        <option value="{{ $type->value }}" {{ old('lead_type') == $type->value ? 'selected' : '' }}>{{ $type->value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('lead_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="lead_source" class="col-form-label">Lead Source <span
                                            class="text-danger">*</span></label>
                                            <select id="lead_source" class="form-select @error('lead_source') is-invalid @enderror"
                                            name="lead_source">
                                            <option value="">Choose Lead Lead Source</option>
                                            @foreach($dropdown['lead_source'] as $source)
                                            <option value="{{ $source->value }}" {{ old('lead_source') == $source->value ? 'selected' : '' }}>{{ $source->value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    @error('lead_source')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="assigned_to" class="col-form-label">Lead Assigned To <span
                                            class="text-danger">*</span></label>
                                    <select id="assigned_to"
                                        class="form-select @error('assigned_to') is-invalid @enderror"
                                        name="assigned_to">
                                        <option value="">Choose User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                                {{ $user->firstname }} {{ $user->lastname }}</option>
                                        @endforeach
                                    </select>
                                    @error('assigned_to')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="lead_status" class="col-form-label">Lead Status <span
                                            class="text-danger">*</span></label>
                                    <select id="lead_status"
                                        class="form-select @error('lead_status') is-invalid @enderror" name="lead_status"
                                        onchange="getContactOptions();">
                                        <option value="">Choose Lead Status</option>
                                        @foreach($dropdown['lead_status'] as $status)
                                        <option value="{{ $status->value }}" {{ old('lead_status') == $status->value ? 'selected' : '' }} {{ $status->value != 'New' ? 'disabled' : '' }}>{{ $status->value }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('lead_status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.leads.contact')
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Policy Information</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="col-form-label" for="policy_id">Type of Product</label>
                                    <select name="policy_id" id="policy_id"
                                        class="form-select @error('policy_id') is-invalid @enderror"
                                        onchange="getProductType()">
                                        <option value="">Choose Product</option>
                                        @foreach ($policies as $policy)
                                            <option value="{{ $policy->id }}"
                                                {{ old('policy_id') == $policy->id ? 'selected' : '' }}>
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

                                <div class="form-group col-md-4">
                                    <label class="col-form-label" for="policy_type_id">Type of Insurance Policy</label>
                                    <select name="policy_type_id" id="policy_type_id"
                                        class="form-select @error('policy_type_id') is-invalid @enderror">
                                        <option value="">Choose Policy Type</option>
                                    </select>
                                    @error('policy_type_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="previous_policy_expiry_date" class="col-form-label">Previous Policy Expiry
                                        Date </label>
                                    <input id="previous_policy_expiry_date" type="date"
                                        class="form-control @error('previous_policy_expiry_date') is-invalid @enderror"
                                        name="previous_policy_expiry_date"
                                        value="{{ old('previous_policy_expiry_date') }}"
                                        placeholder="Previous Policy Expiry Date">
                                    @error('previous_policy_expiry_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="special_remark" class="col-form-label">Specific Remark</label>
                                    <textarea id="special_remark" class="form-control @error('special_remark') is-invalid @enderror"
                                        name="special_remark" value="{{ old('special_remark') }}" rows="2"
                                        placeholder="Write Specific Remark here"></textarea>
                                    @error('special_remark')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="col-form-label" for="is_claimed">Is Claimed</label>
                                    <select name="is_claimed" id="is_claimed"
                                        class="form-select @error('is_claimed') is-invalid @enderror">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                    @error('is_claimed')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Upload Documents</h4>
                        </div>
                        
                        <div class="card-body pt-1" >
                            <div id="add-document-div">
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12 text-end p-10">
                                    <button type="button" class="btn btn-dark" style="margin-right:40px;" onclick="addDocument()">Add Document</button>
                                </div>
                            </div>
                    </div>
                
                        <div class="card-footer text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                    class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                            <button type="submit" class="btn btn-sm btn-primary" form="leadForm"><i
                                    class="mdi mdi-database me-1"></i>Save</button>
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
    <script>
        whats_app_from = document.querySelector("#whats_app_from"),
            whats_app_from_dialCode = document.querySelector("#whats_app_from-dial-code");

        // init plugin
        var iti = window.intlTelInput(whats_app_from, {
            initialCountry: "{{ old('iso2', 'IN') }}",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });
    </script>
    <script>
        whats_app_to = document.querySelector("#whats_app_to"),
            whats_app_to_dialCode = document.querySelector("#whats_app_to-dial-code");

        // init plugin
        var iti = window.intlTelInput(whats_app_to, {
            initialCountry: "{{ old('iso2', 'IN') }}",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });
    </script>
    <script>
        function getContactOptions() {
            var status = $('#lead_status').val();

            switch (status) {
                case 'Contacted':
                    $('#contacted_div').show();
                    break;

                default:
                    $('#contacted_div').hide();
                    break;
            }
        }
    </script>
    <script>
        function getContactSubOptions() {
            var contacted_via = $('#contacted_via').val();

            switch (contacted_via) {
                case 'Via Phone':
                    $('#phone_div').show();
                    $('#email_div').hide();
                    $('#whatsapp_div').hide();
                    $('#meet_div').hide();
                    break;
                case 'Via Email':
                    $('#phone_div').hide();
                    $('#email_div').show();
                    $('#whatsapp_div').hide();
                    $('#meet_div').hide();
                    break;
                case 'Via WhatsApp':
                    $('#phone_div').hide();
                    $('#email_div').hide();
                    $('#whatsapp_div').show();
                    $('#meet_div').hide();
                    break;
                case 'Via Meet':
                    $('#phone_div').hide();
                    $('#email_div').hide();
                    $('#whatsapp_div').hide();
                    $('#meet_div').show();
                    break;
                default:
                    $('#phone_div').hide();
                    $('#email_div').hide();
                    $('#whatsapp_div').hide();
                    $('#meet_div').hide();
                    break;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            getContactOptions();
            getContactSubOptions();
        });
    </script>
    <script>
        function getProductType() {
            var policy_id = $('#policy_id').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('admin.policies.getType') }}",
                data: {
                    policy_id: policy_id
                },
                success: function(data) {

                    var list = $("#policy_type_id");
                    $.each(data.types, function(index, type) {
                        list.append(new Option(type.type, type.id));
                    });

                }

            });
        }
    </script>
    <script>
        $(function() {
            // Multiple images preview in browser
            var documentsPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        $($.parseHTML('<span>')).css('width', '150px')
                            .css('height', '100px').attr('class', 'me-2 mt-2 mb-2 border text-center py-4')
                            .text(input.files[i].name).appendTo(
                                placeToInsertImagePreview);

                    }

                }

            };
            $('#samewp').on('change', function(e) {
                let val = $(this).prop('checked');
                if (val == true) {
                    let phone = $('#phone').val();
                    if (phone == '') {
                        alert('Please enter phone number');
                        $(this).prop('checked', false);
                        return;
                    } else {
                        $('#whats_app').val(phone);
                    }
                }
            })

            $('#documents').on('change', function() {
                $('.document-list').html('')
                documentsPreview(this, 'span.document-list');
            });

            $('#salutation').on('change', function(e) {
                let val = $(this).val();

                if (val == 'M/s.') {
                    $('.company_fields').removeClass('hidden');
                } else {
                    $('.company_fields').addClass('hidden');
                }
            })
        });
    </script>
<script type="text/javascript">
        var document_row = 0;
        function addDocument(){
            let html = '<div class="row mt-2" id="doucment-row-'+document_row+'">';
                html +=     '<div class="col-sm-5">';
                html +=     '<input type="text" name="documents['+document_row+'][title]" id="input" class="form-control" value="" required="required" placeholder="Name of Document">';
                html +=     '</div>';
                html +=     '<div class="col-md-5">';
                html +=     '<input type="file" class="form-control documents" required="required">';
                html +=     '<input type="hidden" class="document" name="documents['+document_row+'][document]" >';
                html +=     '</div>';
                html +=     '<div class="col-sm-2" >';
                html +=     '<button type="button" class="btn btn-danger" onClick=$("#doucment-row-'+document_row+'").remove()>Remove</button>';
                html +=     '</div> </div>';
                 document_row++;
                 $('#add-document-div').append(html);            
        }

    </script>
    <script type="text/javascript">
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    $(document).ready(function(){

         $('body').delegate('.documents','change',function(){
               console.log('gg');
               $('.documents').attr('id','')
               $(this).attr('id','add-doc');

               var files = $(this)[0].files;

               if(files.length > 0){
                     var fd = new FormData();

                     // Append data 
                     fd.append('file',files[0]);
                     fd.append('_token',CSRF_TOKEN);

                     // AJAX request 
                     $.ajax({
                          url: "{{ route('admin.uploadFile') }}",
                          method: 'post',
                          data: fd,
                          contentType: false,
                          processData: false,
                          dataType: 'json',
                          success: function(response){
                                if(response.success == 1){ 
                                $('#add-doc').parent().find('.document').val(response.name);
                                }
                          },
                          error: function(response){
                                console.log("error : " + JSON.stringify(response) );
                          }
                     });
               }else{
                     alert("Please select a file.");
               }

         });
    });
    </script>
@endpush
