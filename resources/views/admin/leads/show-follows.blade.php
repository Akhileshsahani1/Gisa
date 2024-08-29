@extends('layouts.admin')
@section('title', 'Lead Follow Up')
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
                    	<button type="button" class="btn btn-primary text-end mr-1" id="add-follow-up">Add Follow Up</button>
                    </div>
                    <h4 class="page-title">Lead Follow Up</h4>
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
                               <table id="invoiceTable" class="table table-bordered table-striped dataTable no-footer dtr-inline" aria-describedby="invoiceTable_info">
                        <thead class="bg-dark">
                            <tr>
                                <th class="bg-secondary text-white">Date & Time</th>
                                <th class="bg-secondary text-white">Contacted Via</th>
                                <th class="bg-secondary text-white">Comment</th>
                                <th class="bg-secondary text-white">Follower</th>
                                <th class="bg-secondary text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($follows as $follow)
                            <tr>
                                @php $date_time = $follow->follow_up_date.' '.$follow->follow_up_time @endphp
                                <td> <span class="badge bg-danger"><i class="fas fa-user"></i>{{ date('d M, Y g:i A', strtotime($date_time)) ?? '' }}</span></td>
                                <td>{{ $follow->contacted_via }}</td>
                                <td>{{ $follow->comment }}</td>
                                <td>{{ $follow->user->firstname }} {{ $follow->user->lastname }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm me-1 edit-follow-button" data-id="{{ $follow->id}}"
                                            data-contacted_via="{{ $follow->contacted_via}}"
                                            data-comment="{{ $follow->comment}}"
                                            data-follow_up_date="{{ $follow->follow_up_date}}"
                                            data-follow_up_time="{{ $follow->follow_up_time }}"
                                        ><i class="mdi mdi-pencil"></i></button>
                                        <a href="javascript:void(0);" onclick="confirmFollowDelete({{$follow->id}})" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                        <form id='delete-form-follow{{ $follow->id }}'
                                            action='{{ route('admin.leads.delete-follow', $follow->id) }}'
                                            method='POST'>
                                            <input type='hidden' name='_token'
                                                value='{{ csrf_token() }}'>
                                            <input type='hidden' name='_method' value='DELETE'>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No Follow Up Found.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                                {{ $follows->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admin.leads.follow-up')
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
                }
             ]
            })
        });
    </script>
     <script>
        function confirmFollowDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form-follow" + e).submit()
            })
        }
    </script>
     <script type="text/javascript">
        $('.edit-follow-button').on('click',function(e){
          let follow_id = $(this).attr('data-id');
          let contacted_via = $(this).attr('data-contacted_via');
          let follow_up_date = $(this).attr('data-follow_up_date');
          let follow_up_time = $(this).attr('data-follow_up_time');
          let comment = $(this).attr('data-comment');
          $('#edit_follow_id').val(follow_id);
          $('#edit_follow_contacted_via').val(contacted_via);
          $('#edit_follow_up_date').val(follow_up_date);
          $('#edit_follow_time').val(follow_up_time);
          $('#edit_follow_comment').val(comment);
          $('#follow-up-modal').modal('show');
        });
        $('#add-follow-up').on('click',function(){
          $('#edit_follow_id').val(0);
          $('#edit_follow_contacted_via').val('');
          $('#edit_follow_up_date').val('');
          $('#edit_follow_time').val('');
          $('#edit_follow_comment').val('');
          $('#follow-up-modal').modal('show');
        });
    </script>
@endpush
