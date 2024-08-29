@extends('layouts.customer')
@section('title', 'Claims')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">@include('customer.includes.sidebar')</div>
                <div class="col-sm-9">
                    <div class="card-shadow">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <h1 class="h1-heading">Claims</h1>
                                    <div class="page-title-right">
                                        <a href="{{ route('customer.claim.raise') }}" class="btn btn-primary">
                                            <i class="dripicons-to-do"></i>
                                            Raise New Claim
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @include('customer.includes.flash-message')
                        {{-- @include('customer.quotations.filter') --}}
                            <div class="col-md-12 table-responsive">
                                <div class="row">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#ID</th>
                                                <th>Policy No.</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Policy</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                               @foreach ($claims as $claim)
                                            <tr>

                                                <td>#{{ $claim->id }}</td>
                                                <td>{{ policy_data($claim->id,'policy_no') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($claim->created_at)->format('M d, Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($claim->expiry_date)->format('M d, Y') }}</td>
                                                <td>{{ $claim->quotation?->policy->name }}
                                                 <br><small>
                                                    {{ $claim->quotation?->policyType->type }}
                                                 </small>
                                                </td>
                                                <td>{{ $claim->status }}</td>
                                                <td>
                                                    <a class="btn btn-warning" href="{{ route('customer.policy.show',$claim->id) }}">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
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
                order: [
                    [0, "asc"]
                ],
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
                    orderable: !1
                }, {
                    orderable: !1
                }, ]
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
                    url: "{{-- route('quotations.bulk-delete') --}}",
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
        function approveQuotation(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to approve this quotation!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Approve it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{--- route('quotations.approve', ':id') ---}}";
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            })
        }

        function declineQuotation(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to decline this quotation!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Decline it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "{{--- route('quotations.decline', ':id')---}}";
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            })
        }
    </script>
@endpush
