@extends('layouts.front')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-sm-3">@include('customer.includes.sidebar')</div>
                <div class="col-sm-9">
                    <div class="card-shadow">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="float-start mb-3">
                                    <img src="{{ Helper::getlogo() }}" alt="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-end">
                                    <h4 class="m-0">Quotation # {{ $order->id }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Service</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->services as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <b>{{ $item->description }}</b>
                                                
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> <!-- end table-responsive-->
                            </div> <!-- end col -->
                        </div>
                </div>
        </div>
    </div>
        <!-- Invoice Logo-->
            

        <!-- Invoice Detail-->
        
        <!-- end row -->

        

        
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function prinDoc() {
            document.title = "Quotation #{{ $order->id }}";
            window.print();
        }       
    </script>
@endpush
