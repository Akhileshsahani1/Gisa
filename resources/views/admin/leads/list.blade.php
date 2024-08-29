@extends('layouts.admin')
@section('title', 'Lead Management')
@section('head')

    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <select id="assign-user" class="form-control float-start me-1" style="width:auto;display: none">
                            <option value="">Choose User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                            @endforeach
                        </select>
                        <a class="btn btn-sm btn-primary me-1" href="javascript:void(0);" style="display: none"
                            id="assign-user-btn"><i class="mdi mdi-plus me-1"></i> Assign Leads
                        </a>
                        @can('Create Lead')
                            <a href="{{ route('admin.leads.create') }}" class="btn btn-sm btn-primary float-end"><i
                                    class="mdi mdi-plus"></i> Add New Lead</a>
                        @endcan
                        <a class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                                class="mdi mdi-filter me-1"></i> Filter
                        </a>
                        @can('Import Lead')
                            <a class="btn btn-sm btn-dark me-1" href="{{ route('admin.leads.import-view') }}"><i
                                    class="mdi mdi-database-import-outline me-1"></i> Import
                            </a>
                        @endcan
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all"><i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Lead Management</h4>
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
                                <table id="basic-datatable" class="table table-stripedx dt-responsive nowrap w-100">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="bg-secondary text-white all" width="3%">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="all-rows">
                                                    <label class="form-check-label">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th class="bg-secondary text-white">{{ __('Job Id') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Name') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Assigned to') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Phone Number') }}</th>
                                            {{-- <th class="bg-secondary text-white">{{ __('Customer Type') }}</th> --}}
                                            <th class="bg-secondary text-white">{{ __('Status') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Email') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Time (ago)') }}</th>
                                            <th class="bg-secondary text-white" class="text-center">{{ __('More') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leads as $lead)
                                            <tr>


                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input checkbox-row"
                                                            name="rows" id="customCheck{{ $lead->id }}"
                                                            value="{{ $lead->id }}">
                                                        <label class="form-check-label"
                                                            for="customCheck{{ $lead->id }}">&nbsp;</label>
                                                    </div>
                                                </td>

                                                <td>{{ $lead->id }}</td>
                                                <td class="table-user {{ empty($lead->seen_by) ? 'seenclr' : '' }}">
                                                    <a href="{{ route('admin.leads.show', $lead) }}"
                                                        class="text-body fw-semibold">{{ $lead->firstname }}
                                                        {{ $lead->lastname }}</a>
                                                </td>
                                                <td class="">
                                                    {{ \App\Models\Administrator::find($lead->assigned_to)?->firstname }}
                                                    {{ \App\Models\Administrator::find($lead->assigned_to)?->lastname }}
                                                </td>
                                                <td class="">{{ $lead->phone }}</td>

                                                {{-- @if ($lead->customer_type == 'inword')
                                                <td class=""><!-- Primary Switch-->
                                                    <input type="checkbox" id="switch{{$lead->id}}" data-switch="primary" data-switch-off="info" checked="" class="ctype" c="in" lid="{{$lead->id}}">
                                                    <label for="switch{{$lead->id}}" data-on-label="InWord" data-off-label="OutWord"></label>
                                                </td>
                                                @else
                                                <td class=""><!-- Primary Switch-->
                                                    <input type="checkbox" id="switch{{$lead->id}}" data-switch="info" data-switch-off="primary" checked="" class="ctype" c="out" lid="{{$lead->id}}">
                                                    <label for="switch{{$lead->id}}" data-on-label="OutWord" data-off-label="Inword"></label>
                                                </td>
                                                @endif --}}
                                                <td><span class="badge bg-info">{{ $lead->lead_status }}</span>

                                                    @if( isset($lead->follows) )

                                                    @foreach( $lead->follows as $follow)
                                                     <br><small class="badge bg-primary">Next follow up: {{ \Carbon\Carbon::parse($follow->follow_up_date)->format('d M, Y') }}</small>
                                                    @endforeach

                                                    @endif
                                                </td>
                                                <td class="">{{ $lead->email }}</td>

                                                <td class="">{{ $lead->created_at->diffForHumans() }}</td>
                                                <td class="text-end ">
                                                    <div class="btn-group">
                                                        @can('Edit Lead')
                                                            <a href="{{ route('admin.leads.edit', $lead) }}"
                                                                class="btn btn-primary tooltip">
                                                                <i class="mdi mdi-pencil"></i>
                                                                <span class="tooltiptext">Edit</span>
                                                            </a>
                                                        @endcan
                                                        @can('Show Lead')
                                                            <a href="{{ route('admin.leads.show', $lead) }}"
                                                                class="btn btn-warning tooltip">
                                                                <i class="mdi mdi-eye"></i>
                                                                <span class="tooltiptext">View</span>
                                                            </a>
                                                        @endcan

                                                        @can('Delete Lead')
                                                            <a href="javascript:void(0);"
                                                                onclick="confirmDelete('{{ $lead->id }}')"
                                                                class="btn btn-danger tooltip">
                                                                <i class="mdi mdi-delete"></i>
                                                                <span class="tooltiptext">Delete</span>
                                                            </a>
                                                        @endcan
                                                        <form id='delete-form{{ $lead->id }}'
                                                            action='{{ route('admin.leads.destroy', $lead->id) }}'
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
                                {{ $leads->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        input[data-switch]+label {
            width: 79px;
        }

        input[data-switch]:checked+label:after {
            left: 55px;
        }

        .seenclr {
            background: #c7dd1599 !important;
        }
    </style>

@endsection
@push('filter')
    @include('admin.leads.filter')
@endpush
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendor/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.html5.min.js') }}"></script>
     <script src="{{ asset('assets/js/vendor/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/vfs_fonts.js') }}"></script>

    <!-- Datatable Init js -->
    <script>
        $(function() {
            var a = $("#basic-datatable").dataTable({
                dom: 'Bfrtip',
                paging: !1,
                pageLength: 20,
                lengthChange: !1,
                buttons: [
                    'copy', 'print', 'csv', 'pdf','excel'
                    ],
                searching: !1,
                ordering: !0,
                info: !1,
                autoWidth: !1,
                responsive: !0,
                columnDefs: [{
                    targets: [0],
                    visible: !0,
                    searchable: !0,
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
                    orderable: !1
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

        })

        $('.ctype').on('change', function(e) {
            var lead_id = $(this).attr('lid');
            var type = $(this).attr('c');
            //var type = $(this).prop('checked');
            $.ajax({
                url: "{{ route('admin.lead.type') }}",
                dataType: 'JSON',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    lead_id,
                    type
                },
                success: function(res) {
                    console.log(res.data);
                }
            });
        });
    </script>

    <script type="text/javascript">
        $("#all-rows").change(function() {
            var c = [];
            this.checked ? ($(".checkbox-row").prop("checked", !0), $("input:checkbox[name=rows]:checked").each(
                function() {
                    c.push($(this).val())
                }), showDiv()) : ($(".checkbox-row").prop("checked", !1),
                c = [], hideDiv())
        });

        $(".checkbox-row").change(function() {
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), 0 == rows.length ? hideDiv() : showDiv()
        });

        function showDiv() {
            $("#delete-all").css("display", "block")
            $("#assign-user").css("display", "inline")
            $("#assign-user-btn").css("display", "inline")
        }

        function hideDiv() {
            $("#delete-all").css("display", "none")
            $("#assign-user").css("display", "none")
            $("#assign-user-btn").css("display", "none")
        }

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
                    url: "{{ route('admin.leads.bulk-delete') }}",
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

        $("#assign-user-btn").click(function(e) {
            if ($('#assign-user').val() == '') {
                swal.fire({
                    title: "Error!",
                    text: "You Must Select User to Assign Leads!",
                    type: "error",
                    confirmButtonText: "OK"
                });
                return false;
            }
            rows = [], $("input:checkbox[name=rows]:checked").each(function() {
                rows.push($(this).val())
            }), Swal.fire({
                title: "Are you sure?",
                text: "You want to assign selected rows!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Assign selected!"
            }).then(t => {
                t.isConfirmed && ($("#assign-user-btn").text("Assigning..."), e.preventDefault(), $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.bulk.leads.assign.user') }}",
                    data: {
                        leads: rows,
                        user_id: $('#assign-user').val(),
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
                    var options = '<option value="">Choose Policy Type</option>';
                    $.each(data.types, function(index, type) {
                        options += '<option value="' + $filter['policy_type_id'] + '"';
                        if (type.id == "{{ old('type_id') }}") {
                            options += ' selected';
                        }
                        options += '>' + type.type + '</option>';
                    });
                    $('#policy_type_id').html(options);
                }

            });
        }
    </script>
    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
