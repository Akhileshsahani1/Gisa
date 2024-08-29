@extends('layouts.admin')
@section('title', 'Policy Types')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('admin.policies.index') }}" class="btn btn-sm btn-dark me-1"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <a href="{{ route('admin.policies.create-type', $policy->id) }}"
                            class="btn btn-sm btn-primary float-end"><i class="mdi mdi-plus"></i> Add
                            Policy Type</a>
                    </div>
                    <h4 class="page-title">{{ $policy->name }} > Policy Types</h4>
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
                                            <th class="bg-secondary text-white">Policy Type</th>
                                            <th class="bg-secondary text-white">Enabled</th>
                                            <th class="bg-secondary text-white"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($policy->types as $type)
                                            <tr>
                                                <td class="table-user">
                                                    <a href="javascript::void(0)"
                                                        class="text-body fw-semibold">{{ $type->type }}</a>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $type->enabled == true ? 'bg-success' : 'bg-danger' }}"
                                                        disabled>{{ $type->enabled == true ? 'Enabled' : 'Disabled' }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.policies.edit-type', $type) }}"
                                                            class="btn btn-sm btn-primary"><i class="mdi mdi-pencil"></i>
                                                        </a>
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $type->id }})"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i></a>
                                                        <form id='delete-form{{ $type->id }}'
                                                            action='{{ route('admin.policies.delete-type', $type->id) }}'
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
                            </div>
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
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0
                }],
                columns: [{
                    orderable: !0
                }, {
                    orderable: !0
                }, {
                    orderable: !0
                }]
            })
        });
    </script>
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
@endpush
