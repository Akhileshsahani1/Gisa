@extends('layouts.admin')
@php
$title = match(Request::get('type')){
   'lead-status'          => 'Lead Status',
   'lead-type'            => 'Lead Type',
   'lead-source'          => 'Lead Source',
   'ncb'                  => 'NCB',
   'previous-ncb'         => 'Previous NCB',
   'courier-company'      => 'Courier Company',
   'default'              => 'Data'
}
@endphp
@section('title', $title)
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

                        @can('Create Lead Status')
                        <a href="#modal-create-customer" data-bs-toggle="modal" role="button"
                            class="btn btn-sm btn-primary "><i class="mdi mdi-plus"></i> Add</a>
                        @endcan

                        <a class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                                class="mdi mdi-filter me-1"></i> Filter
                        </a>
                        <a class="btn btn-sm btn-primary me-1" href="{{ route('admin.dropdown') }}"> Back
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
                                            <th class="bg-secondary text-white">{{ __('Name') }}</th>

                                            <th class="bg-secondary text-white">{{ __('Sort Order') }}</th>
                                             <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                             <th class="bg-secondary text-white">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $status)
                                        <tr>
                                            <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkbox-row"
                                                            name="rows" id="customCheck{{ $status->id }}"
                                                            value="{{ $status->id }}">
                                                        <label class="form-check-label"
                                                            for="customCheck{{ $status->id }}">&nbsp;</label>
                                                    </div>
                                            </td>
                                            <td>
                                                {{ $status->value }}
                                            </td>
                                            <td>
                                                {{ $status->sort_order }}
                                            </td>
                                            <td>
                                                @if($status->status)
                                                  Enable
                                                @else
                                                   Disabled
                                                @endif
                                            </td>
                                            <td>
                                                @can('Edit Lead Status')
                                                <button type="button" class="btn btn-sm btn-primary edit-status" data-id="{{$status->id}}" data-value="{{$status->value}}" data-sort-order="{{$status->sort_order}}" data-status="{{$status->status}}">
                                                            <i class="mdi mdi-pencil me-1"></i>Edit</button>
                                                            @endcan

                                                        @can('Delete Lead Status')
                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $status->id }})"
                                                            class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete me-1"></i>Delete</a>
                                                         @endcan

                                                        <form id='delete-form{{ $status->id }}'
                                                            action='{{ route('admin.lead-status.destroy', $status->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                            </td>

                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.dropdown.lead-status.create')
    @include('admin.dropdown.lead-status.edit')
@endsection
@push('filter')
    @include('admin.dropdown.lead-status.filter')
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
                    orderable: !1
                },{
                    orderable: !1
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
                    type: "GET",
                    dataType: "json",
                    url: "{{ route('admin.lead-status.create') }}",
                    data: {
                        leads: rows,
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
        $('.edit-status').on('click',function(){
           let id = $(this).attr('data-id');
           let name = $(this).attr('data-value');
           let sort_order = $(this).attr('data-sort-order');
           let status = $(this).attr('data-status');
           let url = "{{ route('admin.lead-status.update',':id') }}";
           url = url.replace(':id',id);
           $('#edit-dropdown').attr('action',url);
           $('#edit-name').val(name);
           $('#edit-sort-order').val(sort_order);
           $('#edit-status').val(status);
           $('#modal-edit-dropdown').modal('show');
        });
    </script>
@endpush
