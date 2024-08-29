@extends('layouts.admin')
@section('title', 'Receipts')
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
                    <a class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                                class="mdi mdi-filter me-1"></i> Filter
                        </a>
                    </div>

                    <h4 class="page-title">Receipts</h4>

                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-stripedx dt-responsive nowrap w-100">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th class="bg-secondary text-white">{{ __('Id') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Payment Date') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Payment Mode') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Transaction ID') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Customer') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Payment Status') }}</th>
                                            <th class="bg-secondary text-white">{{ __('Amount') }}</th>
                                            <th class="bg-secondary text-white" class="text-center">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody style="vertical-align: middle;">
                                        @foreach ($recipts as $recipt)
                                            <tr>
                                                <td >{{ $recipt->id }}</td>
                                                <td >{{ $recipt->date }}</td>
                                                <td >{{ $recipt->mode }}</td>
                                                <td >{{ $recipt->transactionId }}</td>
                                                <td ><a href="{{ route('admin.customers.show', $recipt->customer->id) }}"> {{ $recipt->customer->firstname }} {{ $recipt->customer->lastname }} </a> </td>
                                                <td><span class="badge @if($recipt->status == 'Approve') bg-success @else bg-danger @endif"
                                                >{{ $recipt->status }}</span></td>
                                                <td >{{ $recipt->amount }}</td>
                                                <td class="" style="text-align: center">
                                                    <a href="{{ route('admin.receipts.show', $recipt->id) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $recipts->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
    input[data-switch] + label {
        width:79px;
    }
    input[data-switch]:checked + label:after {
        left:55px;
    }
    .seenclr{
        background: #c7dd1599!important;
    }
</style>
@endsection

@push('filter')
    @include('admin.sales.recipts.filter')
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
                    orderable: !1
                },{
                    orderable: !0
                },{
                    orderable: !0
                },{
                    orderable: !0
                },{
                    orderable: !0
                }
             ]
            })
        });

        $('.ctype').on('change',function(e){
           var lead_id = $(this).attr('lid');
           var type = $(this).attr('c');
           //var type = $(this).prop('checked');
           $.ajax({
             url:"{{ route('admin.lead.type') }}",
             dataType:'JSON',
             type:'POST',
             data:{
                _token:"{{ csrf_token() }}",
                lead_id,
                type
             },
             success:function(res){
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
        function showDiv(){
             $("#delete-all").css("display", "block")
             $("#assign-user").css("display", "inline")
             $("#assign-user-btn").css("display", "inline")
        }
        function hideDiv(){
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
            if($('#assign-user').val() == ''){
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
                        user_id:$('#assign-user').val(),
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

@endpush
