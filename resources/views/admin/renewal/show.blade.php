@extends('layouts.admin')
@section('title', 'Renewal Details')
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
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <a href="javascript:void(0)" onclick="confirmDelete({{ $renewal->id }})"
                            class="btn btn-sm btn-danger"><i class="mdi mdi-delete me-1"></i>Delete</a>
                        <form id='delete-form{{ $renewal->id }}' action='{{ route('admin.renewal.destroy', $renewal->id) }}'
                            method='POST'>
                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                            <input type='hidden' name='id' value='{{$renewal->id}}'>
                        </form>
                    </div>
                    <h4 class="page-title">Renewal Details</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="col-md-12 assign-message-div" style="display: none">
            <div class="alert alert-success assign-message alert-dismissible fade show" role="alert"
                style="display: none">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @php

        $exp_date = policy_data($renewal->policy?->id, 'policy_expiry_date');
        if( !empty($exp_date) ){
        $exp = \Carbon\Carbon::parse($exp_date);
        $now = \Carbon\Carbon::now()->toDateString();
        $diff = $exp->diffInDays($now);
        } else {
            $diff = "N/A";
        }
        @endphp
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Days left to expire : </span>
                                         <span class="badge bg-danger">{{ $diff }}</span>
                                    </td>
                                    @if( !is_null($renewal->reminder_status) )
                                    <td style="width: 50%"><span class="badge bg-success">
                                        {{ $renewal->reminder_status }}
                                    </span>
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Customer Name </span><br>
                                        {{ $renewal->customer?->salutation }} {{ $renewal->customer?->firstname }}
                                        {{ $renewal->customer?->lastname }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Gender </span><br>
                                        {{ $renewal->customer?->gender }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Phone Number </span><br>
                                        {{ $renewal->customer?->phone }}</td>
                                    <td style="width: 50%"><span class="fw-bold">WhatsApp Number </span><br>
                                        {{ $renewal->customer?->whats_app }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email </span><br>
                                        {{ $renewal->customer?->email }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Address </span><br>
                                        {{ $renewal->customer?->address }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-secondary text-white" style="padding: 12px 15px;">
                        <h3 style="font-size:1rem;font-weight: 400;margin: 0">Policy Details</h3>
                    </div>
                    <div class="card-body" style="padding: 15px">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Policy No.</label>
                                <p>{{ policy_data($renewal->policy?->id, 'policy_no') }}</p>
                                <label>Policy Start Date</label>
                                <p>{{ policy_data($renewal->policy?->id, 'policy_start_date')
                                    ? \Carbon\Carbon::parse(policy_data($renewal->policy?->id, 'policy_start_date'))->format('d M, Y')
                                    : 'N/A' }}
                                </p>
                                <label>Policy Expiry Date</label>
                                <p>{{ policy_data($renewal->policy?->id, 'policy_expiry_date')
                                    ? \Carbon\Carbon::parse(policy_data($renewal->policy?->id, 'policy_expiry_date'))->format('d M, Y')
                                    : 'N/A' }}
                                </p>
                                <label>Insurance Company</label>
                                <p>{{ motor_form($renewal->quotation?->id, 'selected_insurance') }}</p>
                                <label>Financer Name</label>
                                <p>{{ policy_data($renewal->policy?->id, 'financer_name') }}</p>
                            </div>
                            <div class="col-sm-4">
                                <label>Agency Name</label>
                                <p>{{ policy_data($renewal->policy?->id, 'agency')
                                    ? \App\Models\Agency::find(policy_data($renewal->policy?->id, 'agency'))->agency
                                    : 'N/A' }}
                                </p>
                                <label>No Claim Bonus (NCB)</label>
                                <p>{{ policy_data($renewal->policy?->id, 'ncb') }}</p>
                                <label>IDV</label>
                                <p>{{ policy_data($renewal->policy?->id, 'idv') }}</p>
                                <label>Gross OD</label>
                                <p>{{ policy_data($renewal->policy?->id, 'gross_od') }}</p>
                                <label>GST on OD</label>
                                <p>{{ policy_data($renewal->policy?->id, 'gst_od') }}</p>
                            </div>
                            <div class="col-sm-4">
                                <label>Gross TP</label>
                                <p>{{ policy_data($renewal->policy?->id, 'gross_tp') }}</p>
                                <label>GST on TP</label>
                                <p>{{ policy_data($renewal->policy?->id, 'gst_tp') }}</p>
                                <label>Net Premium</label>
                                <p>{{ policy_data($renewal->policy?->id, 'net_premium') }}</p>
                                <label>Gross Premium</label>
                                <p>{{ policy_data($renewal->policy?->id, 'gross_premium') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">

                <div class="d-grid mb-2">
                    <form action="{{ route('admin.renewal.quote-request',$renewal->id) }}" method="POST" >
                        @csrf
                    <input type="hidden" name="policy_id" value="{{ $renewal->policy?->id }}">
                    <input type="hidden" name="policy_type_id" value="{{ $renewal->policy->policyTypeIdAttaribute() }}">
                    <input type="hidden" name="service_executive_id" value="{{ $renewal->policy->serviceExecutiveIdAttaribute() }}">
                    <input type="hidden" name="renewal" value="1">
                    <input type="hidden" name="description" value="">


                    <button type="submit" class="btn btn-success"><i
                            class="mdi mdi-refresh me-1"></i> Convert to Quotation</button>
                    </form>
                </div>
                <div class="card">
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="user_id" class="col-form-label">Transfer Renewal</label>
                                <select id="user_id" class="form-select @error('user_id') is-invalid @enderror"
                                    name="user_id">
                                    <option value="">Choose User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id', $renewal->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->firstname }} {{ $user->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.renewal.update-status', $renewal->id) }}" method="POST" id="statusForm">
                    @csrf
                    @method('PUT')
                    <div class="card mb-0">
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="status" class="col-form-label">Renewal Status</label>
                                    <select id="status1" class="form-select" name="status"
                                        onchange="getContactOptions();">
                                        <option value="New"
                                            {{ old('status', $renewal->status) == 'New' ? 'selected' : '' }}>New
                                        </option>
                                        <option value="Contacted"
                                            {{ old('status', $renewal->status) == 'Contacted' ? 'selected' : '' }}>
                                            Contacted
                                        </option>
                                        <option value="Nurturing"
                                            {{ old('status', $renewal->status) == 'Nurturing' ? 'selected' : '' }}>
                                            Nurturing
                                        </option>
                                        <option value="Qualified"
                                            {{ old('status', $renewal->status) == 'Qualified' ? 'selected' : '' }}>
                                            Qualified
                                        </option>
                                        <option value="Unqualified"
                                            {{ old('status', $renewal->status) == 'Unqualified' ? 'selected' : '' }}>
                                            Unqualified
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    @include('admin.renewal.contact')
                    <div class="card mt-0 d-grid">
                        <button type="submit" class="btn btn-primary" form="statusForm"><i
                                class="mdi mdi-update me-1"></i>Update</button>
                    </div>
                </form>

                <form action="{{ route('admin.renewal.comment', $renewal->id) }}" method="POST" id="commentForm">
                    @csrf
                    <div class="card mb-0">
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="comment" class="col-form-label">Comment</label>
                                    <textarea class="form-control" row="5" name="comment"></textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card mt-0 p-1" style="flex-direction: row !important;">
                        <button type="submit" class="btn btn-primary" form="commentForm"
                            style="width:49%; margin-right:4px;"><i class="mdi mdi-update me-1"></i>Save Comment</button>

                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#full-width-modal" style="width:49%">View Comment</button>

                    </div>
                </form>
                <div class="card mt-0 p-1" style="flex-direction: row !important;">
                    <a href="{{ route('admin.renewal.contact-history', $renewal->id) }}" class="btn btn-warning"
                        style="width:49%; margin-right:4px;"><i class="mdi mdi-eye me-1"></i>Contact History</a>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#follow-up-modal" style="width:49%">Follow Up</button>
                </div>
            </div>
        </div>
        @include('admin.renewal.comment')
        @include('admin.renewal.follow-up')
    </div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        function confirmDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + e).submit()
            })
        }
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
        $('#user_id').change(function() {
            var user_id = this.value;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.renewal.transfer') }}",
                data: {
                    'user_id': user_id,
                    'lead_id': "{{ $renewal->id }}",
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('.assign-message-div').css('display', 'block');
                    $('.assign-message').css('display', 'block');
                    $(".assign-message").html('<center>' + data.success + '</center>');
                    $(function() {
                        setTimeout(function() {
                            $('.assign-message').slideUp();
                        }, 6000);
                    });
                }
            });

        })
    </script>
    <script>
        function getContactOptions() {
            var status = $('#status1').val();

            switch (status) {
                case 'Contacted':
                    $('#contacted_div').show();
                    break;
                case 'Nurturing':
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
            getContactSubOptions();
        });
    </script>
    <script>
        function convertQuotation() {

            let error = false;
            let policy_id = "{{ $renewal->policy?->id }}";
            let policy_type_id = "{{ $renewal->policy?->quotation?->policy_type_id }}";
            $('.error-custom').remove();
            if (policy_id == '') {
                $('#policy_id').after('<span class="text-danger error-custom">Product Type is Required.</span>');
                error = true;
            }
            if (policy_type_id == '') {
                $('#policy_type_id').after(
                    '<span class="text-danger error-custom">Insurance Policy Type is Required.</span>');
                error = true;
            }
            if (error) {
                return false;
            }
            // Swal.fire({
            //     title: "Are you sure?",
            //     text: "You want to convert this Lead!",
            //     icon: "warning",
            //     showCancelButton: !0,
            //     confirmButtonColor: "#3085d6",
            //     cancelButtonColor: "#d33",
            //     confirmButtonText: "Yes, Convert it!"
            // }).then(t => {
            //     if (t.isConfirmed) {
            //var url = '{{-- route('admin.renewal.convert', ':lead') --}}';
           // url = url.replace(':lead', "{{ $renewal->id }}");
         //   url = url + '?policy_id=' + policy_id + '&policy_type_id=' + policy_type_id + '&renewal=1';
          //  window.location.href = url;
            //     }
            // })
        }
    </script>

@endpush
