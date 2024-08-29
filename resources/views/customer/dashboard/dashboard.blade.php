@extends('layouts.customer')
@section('title', 'Dashboard')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="javascript:void(0)" class="btn btn-sm btn-grey">
                            <i class="uil-clock me-1"></i> <span class="hms"></span><span class="ampm"></span>
                        </a>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('customer.includes.flash-message')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 input-group input-group-merge">
                                <div class="btn-group">
                                    <a href="{{ route('home') }}" class="btn btn-dark">All Dates</a>
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu dashboard-filter-dropdown"
                                        style="transform: translate(0px, 40px) !important;">
                                        <a class="dropdown-item" href="javascript:void(0)"
                                            onclick="showDateInput();">Custom</a>
                                        <a class="dropdown-item" href="{{ route('home', ['filter' => 'today']) }}">Today</a>
                                        <a class="dropdown-item"
                                            href="{{ route('home', ['filter' => 'yesterday']) }}">Yesterday</a>
                                        <a class="dropdown-item" href="{{ route('home', ['filter' => 'week']) }}">This
                                            Week</a>
                                        <a class="dropdown-item" href="{{ route('home', ['filter' => 'month']) }}">This
                                            Month</a>
                                        <a class="dropdown-item" href="{{ route('home', ['filter' => 'year']) }}">This
                                            Year</a>
                                    </div>
                                </div>
                                <div class="date-width">
                                    <input type="date" class="form-control date-width" name="date" id="filter_date"
                                        onchange="handler(event);"
                                        @isset($filter['date']) value="{{ $filter['date'] }}" @else style="display: none;" @endif>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-briefcase-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Total Quotations</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_quotations }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a href="{{ route('quotations.index') }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-briefcase-check-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Approved Quotations</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_approved_quotations }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a
                                                    href="{{ route('quotations.index', ['status' => 'approved']) }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-briefcase-clock-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Pending Quotations</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_pending_quotations }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a
                                                    href="{{ route('quotations.index', ['status' => 'pending']) }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-briefcase-remove-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Rejected Quotations</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_declined_quotations }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a
                                                    href="{{ route('quotations.index', ['status' => 'declined']) }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="dripicons-suitcase float-end text-primary"></i>
                                        <h5 class="mt-0">Total Jobs</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_jobs }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a href="{{ route('jobs.index') }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-checkbox-marked-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Completed Jobs</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_completed_jobs }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a
                                                    href="{{ route('jobs.index', ['status' => 'completed']) }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-cash-usd-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Invoice Total</h5>
                                        <h3 class="my-1" id="active-users-count">{{ round($total_invoices) }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a
                                                href="{{ route('invoices.index') }}"><span
                                                    class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card border tilebox-one">
                                    <div class="card-body">
                                        <i class="mdi mdi-account-multiple-outline float-end text-primary"></i>
                                        <h5 class="mt-0">Sub Customers</h5>
                                        <h3 class="my-1" id="active-users-count">{{ $total_subusers }}</h3>
                                        <p class="mb-0 text-muted text-end">
                                            <span class="text-nowrap"><a href="{{ route('sub-customers.index') }}"><span
                                                        class="text-muted">See Details</a></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->
@endsection
@push('scripts')
    <script>
        function showDateInput() {
            $('#filter_date').toggle();
        }

        function handler(e) {
            var base = "{!! route('home') !!}";
            var url = base + '?date=' + e.target.value;
            location.href = url;
        }
    </script>
@endpush
