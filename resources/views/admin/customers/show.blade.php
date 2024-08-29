@extends('layouts.admin')
@section('title', 'Show Customer')
@section('head')
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
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
                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-primary  me-1"><i
                                class="mdi mdi-pencil me-1"></i>Edit</a>
                        <a href="javascript:void(0)" onclick="confirmDelete({{ $customer->id }})"
                            class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i>Delete</a>
                        <form id='delete-form{{ $customer->id }}'
                            action='{{ route('admin.customers.destroy', $customer->id) }}' method='POST'>
                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                            <input type='hidden' name='_method' value='DELETE'>
                        </form>
                    </div>
                    <h4 class="page-title">Customer Details</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Customer Type </span><br>
                                        {{ $customer->customer_type }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Customer Source </span><br>
                                        {{ $customer->source }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Customer Name </span><br>
                                        {{ $customer->salutation }} {{ $customer->firstname }} {{ $customer->lastname }}
                                    </td>
                                    <td style="width: 50%"><span class="fw-bold">Gender </span><br> {{ $customer->gender }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Phone Number </span><br>
                                        {{ $customer->phone }}</td>
                                    <td style="width: 50%"><span class="fw-bold">WhatsApp Number </span><br>
                                        {{ $customer->whats_app }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Email </span><br> {{ $customer->email }}
                                    </td>
                                    <td style="width: 50%"><span class="fw-bold">Address </span><br>
                                        {{ $customer->address }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Date of Birth </span><br>
                                        {{ $customer->date_of_birth ?? 'Not Found' }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Date of Anniversary </span><br>
                                        {{ $customer->date_of_anniversary ?? 'Not Found' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Pan No. </span><br>
                                        {{ $customer->pan_no ?? 'Not Found' }}</td>
                                    <td style="width: 50%"><span class="fw-bold">GST No. </span><br>
                                        {{ $customer->gst_no ?? 'Not Found' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Created On </span><br>
                                        {{ $customer->created_at->format('M d, Y h:i:A') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Uploaded Documents</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (isset($customer->pancard_file) || isset($customer->gst_file) || isset($customer->aadhar) || isset($customer->other))
                                @isset($customer->pancard_file)
                                    <div class="card my-1 shadow-none border">
                                        <div class="ps-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    Pan Card
                                                </div>
                                                <div class="col text-end px-0">
                                                    <!-- Button -->
                                                    <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->pancard_file) }}"
                                                        download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: Pan Card"
                                                        class="btn btn-primary text-white">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                @isset($customer->gst_file)
                                    <div class="card my-1 shadow-none border">
                                        <div class="ps-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    GST Certificate
                                                </div>
                                                <div class="col text-end px-0">
                                                    <!-- Button -->
                                                    <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->gst_file) }}"
                                                        download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: GST Certificate"
                                                        class="btn btn-primary text-white">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                @isset($customer->aadhar)
                                    <div class="card my-1 shadow-none border">
                                        <div class="ps-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    Aadhar Card
                                                </div>
                                                <div class="col text-end px-0">
                                                    <!-- Button -->
                                                    <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->aadhar) }}"
                                                        download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: Aadhar Card"
                                                        class="btn btn-primary text-white">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                @isset($customer->other)
                                    <div class="card my-1 shadow-none border">
                                        <div class="ps-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    Other Document
                                                </div>
                                                <div class="col text-end px-0">
                                                    <!-- Button -->
                                                    <a href="{{ asset('storage/uploads/customers/' . $customer->id . '/documents' . '/' . $customer->other) }}"
                                                        download="{{ $customer->salutation . ' ' . $customer->firstname . ' ' . $customer->lastname }}: Other Documents"
                                                        class="btn btn-primary text-white">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                            @else
                                <p class="text-center py-4">No Documents Uploaded</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 customer_tab">
                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#tab_lead" id="lead_table" data-toggle="tab" aria-expanded="true"
                                            class="nav-link rounded-0 active">
                                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Leads</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_quotation" data-toggle="tab" onclick="getquotationTable()"
                                            aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Quotations</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_policy" data-toggle="tab" onclick="getPoliciesTable()"
                                            aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Policies</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_dispatch" data-toggle="tab" onclick="getdispatchpoliciesTable()"
                                            aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Dispatch</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_renewal" data-toggle="tab" onclick="getrenewalsTable()"
                                            aria-expanded="false" class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Renewals</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab_claims" data-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                            <span class="d-none d-md-block">Claims</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="tab_lead">



                                    </div>
                                    <div class="tab-pane" id="tab_quotation">

                                    </div>
                                    <div class="tab-pane" id="tab_policy">
                                        <p>Policies</p>
                                    </div>
                                    <div class="tab-pane" id="tab_dispatch">
                                        <p>Dispatch</p>
                                    </div>
                                    <div class="tab-pane" id="tab_renewal">
                                        <p>Renewals</p>
                                    </div>
                                    <div class="tab-pane" id="tab_claims">
                                        <p>Claims</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

    <script>
        function dbs(id) {

            $(id).DataTable({
                paging: !1,
                pageLength: 20,
                lengthChange: !1,
                searching: !1,
                ordering: !0,
                info: !1,
                autoWidth: !1,
                responsive: !0,
                responsivePriority: 1,
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0
                }],
                columnsx: [{
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }]
            });
    }
    </script>

    <script>
        function getLeadTable(url = '') {

            if (url == '') {
                url = '{{ route('admin.customer.Table') }}';
            }
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    phone: '{{ $customer->phone }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    //
                },
                success: function(res, status) {

                    $('#tab_lead').html(res);
                    dbs("#basic-datatable-lead");

                },
                error: function(res, status) {
                    console.log(res);
                }
            });

        }
        getLeadTable();
        $('body').on('click', '#lead_table a', function(e) {
            e.preventDefault();
            getLeadTable(this.href);
        });
    </script>

    <script>
        function getquotationTable(url = '') {

            if (url == '') {
                url = '{{ route('admin.customer.quotationTable') }}';
            }
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: '{{ $customer->id }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    //
                },
                success: function(res, status) {

                    $('#tab_quotation').html(res);
                    dbs("#basic-datatable-quote");

                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
        $('body').on('click', '#quotation_Table a', function(e) {
            e.preventDefault();
            getquotationTable(this.href);
        });
    </script>

    <script>
        function getPoliciesTable(url = '') {

            if (url == '') {
                url = '{{ route('admin.customer.quotationPolicyTable') }}';
            }
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: '{{ $customer->id }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    //
                },
                success: function(res, status) {
                    $('#tab_policy').html(res);
                    dbs("#basic-datatable-qp");
                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
        $('body').on('click', '#policy_table a', function(e) {
            e.preventDefault();
            getPoliciesTable(this.href);
        });
    </script>

    <script>
        function getdispatchpoliciesTable(url = '') {

            if (url == '') {
                url = '{{ route('admin.customer.dispatchpoliciesTable') }}';
            }
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: '{{ $customer->id }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    //
                },
                success: function(res, status) {
                    $('#tab_dispatch').html(res);
                    dbs("#basic-datatable-dis");
                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
        $('body').on('click', '#dispatchpolicy_table a', function(e) {
            e.preventDefault();
            getPoliciesTable(this.href);
        });
    </script>

    <script>
        function getrenewalsTable(url = '') {

            if (url == '') {
                url = '{{ route('admin.customer.renewalTable') }}';
            }
            $.ajax({
                type: 'get',
                url: url,
                data: {
                    id: '{{ $customer->id }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    //
                },
                success: function(res, status) {
                    $('#tab_renewal').html(res);
                    dbs("#basic-datatable-rn");
                },
                error: function(res, status) {
                    console.log(res);
                }
            });
        }
        $('body').on('click', '#renewal_table a', function(e) {
            e.preventDefault();
            getPoliciesTable(this.href);
        });
    </script>
@endpush
