@extends('layouts.customer')
@section('title', 'Transactions')
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
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <!--<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>-->
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashbaord</a></li>
                                            <li class="breadcrumb-item active">Transactions</li>
                                        </ol>
                                    </div>
                                    <h1 class="h1-heading">Transactions</h1>
                                </div>
                            </div>
                        </div>
                        @include('customer.includes.flash-message')
                        {{-- @include('customer.transactions.filter') --}}
                            <div class="col-md-12 table-responsive">
                                <div class="row">
                                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead class="bg-dark">
                                            <tr>
                                              <th >ID</th>
                                              <th >Amount</th>  
                                              <th >Mode</th>
                                              <th >Transaction Id</th>
                                              <th >Created AT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              @forelse($transactions as $transaction)

                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                       {{ $transaction->amount }}
                                                    </td>
                                                    <td>
                                                       {{ $transaction->mode }}
                                                    </td>
                                                    <td>
                                                       {{ $transaction->transaction_id }}
                                                    </td>
                                                    <td>
                                                       {{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y h:i A') }}
                                                    </td>
                                                    
                                                </tr>
                                                @empty
                                                  <tr>
                                                    <td colspan="4">No Records Found.</td>
                                                  </tr>
                                                @endforelse
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
@endpush
