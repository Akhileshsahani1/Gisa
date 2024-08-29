@extends('layouts.admin')
@section('title', 'Tickets')
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
                    <a class="btn btn-sm btn-primary float-end" href="{{ route('admin.grievance.create') }}"><i class="mdi mdi-plus"></i> Add New Ticket</a>
                    <a class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                            class="mdi mdi-filter me-1"></i> Filter
                    </a>
                </div>
                <h4 class="page-title">Tickets</h4>
            </div>
        </div>
    </div>
    @include('admin.supports.filter')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body p-3">
                            <i class="mdi mdi-ticket float-end text-secondary" style="right: 1.5rem;"></i>
                            <h4 class="mt-0 text-primary"><a href="">Total Tickets</a></h4>
                            <h3 class="mt-2" id="active-users-count">{{ $open_ticket_count + $closed_ticket_count }}</h3>
                        </div> <!-- end card-body-->
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body p-3">
                            <i class="mdi mdi-ticket float-end text-secondary" style="right: 1.5rem;"></i>
                            <h4 class="mt-0 text-primary"><a href="">Open Tickets</a></h4>
                            <h3 class="mt-2" id="active-users-count">{{ $open_ticket_count }}</h3>
                        </div> <!-- end card-body-->
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card tilebox-one">
                        <div class="card-body p-3">
                            <i class="mdi mdi-ticket float-end text-secondary" style="right: 1.5rem;"></i>
                            <h4 class="mt-0 text-primary"><a href="">Closed Tickets</a></h4>
                            <h3 class="mt-2" id="active-users-count">{{ $closed_ticket_count }}</h3>
                        </div> <!-- end card-body-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            @if (count($tickets) > 0)
                            <table id="basic-datatable" class="table table-stripedx dt-responsive nowrap w-100">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="bg-secondary text-white">Id</th>
                                        <th class="bg-secondary text-white">Customer</th>
                                        <th class="bg-secondary text-white">Department</th>
                                        <th class="bg-secondary text-white">Subject</th>
                                        <th class="bg-secondary text-white">Status</th>
                                        <th class="bg-secondary text-white">Created At</th>
                                        <th class="bg-secondary text-white">Created By</th>
                                        <th class="bg-secondary text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>
                                                <h5 class="font-14 m-0">{{ isset($ticket->customer->firstname) ? $ticket->customer->firstname.' '.$ticket->customer->lastname : '' }}</h5>
                                                <span class="text-muted font-13">{{ isset($ticket->customer->email) ? $ticket->customer->email : '' }}</span>
                                            </td>
                                            <td>
                                                @if ($ticket->role_id)
                                                <a href="{{ route('admin.roles.edit', $ticket->department->id) }}" target="_blank" class="badge bg-info"> {{ $ticket->department->name }} </a>
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td>
                                                {!! $ticket->subject !!}
                                            </td>

                                            @if ($ticket->status == 0)
                                                <td><span class="badge bg-danger">Open</span>
                                                    <br>
                                                    @if(count($ticket->unseenadmin) > 0)
                                                    <span title="{{ count($ticket->unseenadmin) }} New Message" class="badge bg-primary">{{ count($ticket->unseenadmin) }} New Message</span>
                                                    @endif
                                                </td>
                                            @else
                                                <td><span class="badge bg-success">Closed</span>
                                                    <br>
                                                    @if(count($ticket->unseenadmin) > 0)
                                                    <span title="{{ count($ticket->unseenadmin) }} New Message" class="badge bg-primary">{{ count($ticket->unseenadmin) }}  New Message</span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d-m-Y') }}<br>
                                                {{ \Carbon\Carbon::parse($ticket->created_at)->format('H:i A') }}</td>

                                            @if ($ticket->user_id)
                                                <td>
                                                    {{ ($ticket->user->name)? $ticket->user->name : 'N/A' }}
                                                </td>
                                            @else
                                                <td> Customer </td>
                                            @endif


                                            <td class="text-end">
                                                <a href="#" class="dropdown-toggle arrow-none card-drop"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">

                                                    <a href="{{ route('admin.grievance.show', $ticket->id) }}">
                                                        <li class="dropdown-item">Chat</li>
                                                    </a>

                                                <a href="{{ route('admin.grievance.edit', $ticket->id) }}">
                                                        <li class="dropdown-item">Edit</li>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="confirmDelete({{ $ticket->id }})">
                                                        <li class="dropdown-item">
                                                            Delete
                                                        </li>
                                                        <form id='delete-form{{ $ticket->id }}'
                                                            action='{{ route('admin.grievance.destroy', $ticket->id) }}' method='POST'>
                                                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @else
                                <p class="text-center">No Ticket added.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-2">
        {{ $tickets->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

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

<script>
    function confirmDelete(no){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form'+no).submit();
            }
            })
    };
</script>


<script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endpush
