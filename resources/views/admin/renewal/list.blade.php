@extends('layouts.admin')
@section('title', 'Renewal Policies')
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
                    <h4 class="page-title">Renewal Policies</h4>
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
                                            <th class="bg-secondary text-white">{{ __('Policy No.') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Policy Expire Date') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Policy') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Customer') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                            <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($renewals))
                                            @foreach ($renewals as $renewal)
                                                @php

                                                    $exp_date = policy_data(
                                                        $renewal->policy?->id,
                                                        'policy_expiry_date',
                                                    );
                                                    if (!empty($exp_date)) {
                                                        $exp = \Carbon\Carbon::parse($exp_date);
                                                        $now = \Carbon\Carbon::now()->toDateString();
                                                        $diff = $exp->diffInDays($now);
                                                    } else {
                                                        $diff = 'N/A';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input checkbox-row"
                                                                name="rows" id="customCheck{{ $renewal->id }}"
                                                                value="{{ $renewal->id }}">
                                                            <label class="form-check-label"
                                                                for="customCheck{{ $renewal->id }}">&nbsp;</label>
                                                        </div>
                                                    <td>{{ $renewal->id }}</td>
                                                    <td>{{ policy_data($renewal->policy?->id, 'policy_no') }}</td>
                                                    <td>{{ $exp_date ? \Carbon\Carbon::parse($exp_date)->format('d M, Y') : '' }}
                                                        <br><small class="badge bg-danger">{{ $diff }} Days
                                                            left</small>
                                                        @if (!is_null($renewal->reminder_status))
                                                            <br><small
                                                                class="badge bg-secondary">{{ $renewal->reminder_status }}</small>
                                                        @endif
                                                    </td>

                                                    <td>{{ $renewal->quotation?->policy?->name }}<br><small>{{ $renewal->quotation?->policyType?->type }}</small>
                                                    </td>
                                                    <td class="table-user">
                                                        <a href="{{ route('admin.customers.show', $renewal->customer?->id) }}"
                                                            class="text-body fw-semibold">{{ $renewal->customer?->firstname }}
                                                            {{ $renewal->customer?->lastname }}</a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info"> {{ $renewal->status }}</span>
                                                        @if (isset($renewal->follows))
                                                            @foreach ($renewal->follows as $follow)
                                                                <br><small class="badge bg-primary">Next follow up:
                                                                    {{ \Carbon\Carbon::parse($follow?->follow_up_date)->format('d M, Y') }}</small>
                                                            @endforeach
                                                        @endif
                                                    </td>

                                                    <td class="text-end">
                                                        <div class="btn-group">


                                                            @can('Show Quotation')
                                                                <a href="{{ route('admin.renewal.show', $renewal->id) }}"
                                                                    class="btn btn-primary" target="_blank">Show Renewal</a>
                                                            @endcan

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                {{ $renewals->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.dispatch.edit.edit')
@endsection
@push('filter')
    @include('admin.renewal.filter')
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
                    },
                    {
                        orderable: !0
                    }
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