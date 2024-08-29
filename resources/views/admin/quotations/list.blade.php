@php
$title = 'Quotations';
if(request()->get('status')=='quoted-request'){
  $title = 'Quoted Request';
}
@endphp
@extends('layouts.admin')
@section('title', $title)
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                                class="mdi mdi-filter me-1"></i> Filter
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all"><i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">{{ $title }}</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="bg-secondary text-white all" width="3%">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="all-rows">
                                                    <label class="form-check-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th class="bg-secondary text-white">{{ __('Id') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Date') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Customer') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Business Type') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Policy') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Payment Status') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Sales Executive') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Service Executive') }}</th>
                                            <th class="bg-secondary text-white" class="text-center">{{ __('More') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quotations as $quotation)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkbox-row"
                                                            name="rows" id="customCheck{{ $quotation->id }}"
                                                            value="{{ $quotation->id }}">
                                                        <label class="form-check-label"
                                                            for="customCheck{{ $quotation->id }}">&nbsp;</label>
                                                    </div>
                                                <td>{{ $quotation->id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('M d Y')  }}
                                                <br><small>{{ \Carbon\Carbon::parse($quotation->created_at)->format('h:i A')  }}</small></td>
                                                <td class="table-user">
                                                    <a href="{{ route('admin.customers.show', $quotation->customer_id) }}"
                                                        class="text-body fw-semibold">{{ $quotation->customer->firstname }}
                                                        {{ $quotation->customer->lastname }}</a>
                                                </td>
                                                <td>{{ motor_form($quotation->id,'business_type') }}</td>
                                                <td>{{ $quotation->policy->name }}<br><small>{{ $quotation->policyType->type }}</small></td>
                                                <td>
                                                    {{ $quotation->payment_status }}
                                                </td>
                                                <td>
                                                    {{ $quotation->status }}
                                                </td>
                                                <td>{{ $quotation?->salesExecutive?->firstname }}</td>
                                                <td>{{ $quotation?->serviceExecutive?->firstname }}</td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        @can('Edit Quotation')
                                                        <a href="{{ route('admin.quotations.edit', $quotation) }}"
                                                            class="btn btn-primary">
                                                            <i class="mdi mdi-pencil"></i></a>
                                                        @endcan
                                                        @can('Show Quotation')
                                                        <a href="{{ route('public.quotation.show', base64_encode($quotation->id)) }}"
                                                            class="btn btn-warning" target="_blank">
                                                            <i class="mdi mdi-eye"></i></a>
                                                        @endcan

                                                        @can('Quotation Transactions')
                                                            <a
                                                            href="{{ route('admin.quotation.transactions.list', $quotation->id) }}"
                                                            class="btn btn-dark">Transactions</a>
                                                        @endcan
                                                        @if( $quotation->status != 'Pending' )
                                                            @can('Create Policy')
                                                                <a
                                                                href="{{ route('admin.quotation.convert-policy', $quotation->id) }}"
                                                                class="btn btn-success text-white">Convert to Policy</a>
                                                            @endcan
                                                        @endif
                                                        @can('Delete Quotation')
                                                            <a href="javascript:void(0);"
                                                            onclick="confirmDelete('{{ $quotation->id }}')"
                                                            class="btn btn-danger">
                                                            <i class="mdi mdi-delete"></i></a>
                                                        @endcan
                                                        <form id='delete-form{{ $quotation->id }}'
                                                            action='{{ route('admin.quotations.destroy', $quotation->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $quotations->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('filter')
    @include('admin.quotations.filter')
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>


    <!-- Datatable Init js -->
    <script>
        $(function() {
            $("#basic-datatable").DataTable({
                paging: !1,
                pageLength: 20,
                lengthChange: !1,
                searching: !1,
                ordering: !0,
                info: !1,
                autoWidth: !1,
                responsive: !0,
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0
                }],
                columns: [{
                    orderable: !1
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
                },{
                    orderable: !0
                },
             ]
            })
        });
    </script>

    <script type="text/javascript">
        $("#all-rows").change(function() {
            var c = [];
            this.checked ? ($(".checkbox-row").prop("checked", !0), $("input:checkbox[name=rows]:checked").each(
                function() {
                    c.push($(this).val())
                }), $("#delete-all").css("display", "block")) : ($(".checkbox-row").prop("checked", !1),
                c = [], $("#delete-all").css("display", "none"))
        });

        $(".checkbox-row").change(function() {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), 0 == rows.length ? $("#delete-all").css("display", "none") : $("#delete-all").css("display",
                "block")
        });

        $("#delete-all").click(function(e) {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), Swal.fire({
                title: "Are you sure?",
                text: "You want to delete selected rows!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete selected!"
            }).then(t => {
                t.isConfirmed && ($("#delete-all").text("Deleting..."), e.preventDefault(), $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.quotations.bulk-delete') }}",
                    data: {
                        quotations: rows,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(e) {
                        location.reload()
                    }
                }))
            })
        });

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
