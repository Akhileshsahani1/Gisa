@extends('layouts.admin')
@section('title', 'Claims')
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
                    <h4 class="page-title">Claims @if (request()->get('type'))
                            {{ ucwords(Str::replace('-', ' ', request()->get('type'))) }}
                        @endif
                    </h4>
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
                                            <th class="bg-secondary text-white">{{ __('Customer') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Claim Type') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Vehicle No. / Chasis') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Raised on.') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                            <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($claims))
                                            @foreach ($claims as $claim)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input checkbox-row"
                                                                name="rows" id="customCheck{{ $claim->id }}"
                                                                value="{{ $claim->id }}">
                                                            <label class="form-check-label"
                                                                for="customCheck{{ $claim->id }}">&nbsp;</label>
                                                        </div>
                                                    </td>

                                                    <td>{{ $claim->id }}</td>
                                                    <td>{{ $claim->customer?->firstname." ".$claim->customer?->lastname }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary"> {{ ucwords(Str::replace('-',' ',$claim->claim_type)) }}</span>
                                                    </td>
                                                    <td>{{ policy_data($claim->policy_id,'engine_no').' / '.policy_data($claim->policy_id,'chassis_no') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($claim->created_at)->format('d M, Y') }}
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-info"> {{ $claim->status }}</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">

                                                            @can('Show Claims')
                                                                <a href="{{ route('admin.claims.show', $claim->id) }}"
                                                                    class="dropdown-item" target="_blank">
                                                                    <i class="mdi mdi-eye me-1"></i>Show Claim</a>
                                                            @endcan

                                                            @can('Delete Claims')
                                                                <a href="#" onclick="confirmDelete()"
                                                                    class="dropdown-item" target="_blank">
                                                                    <i class="mdi mdi-trash me-1"></i>Delete Claim</a>
                                                            @endcan

                                                            <form id="delete-form{{ $claim->id }}" method="POST"
                                                                action="{{ route('admin.claims.delete', $claim->id) }}">
                                                                @csrf
                                                            </form>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                {{ $claims->appends(request()->query())->links('pagination::bootstrap-5') }}
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
    {{-- @include('admin.quotations.filter') --}}
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
                }]
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
