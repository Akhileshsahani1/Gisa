@extends('layouts.admin')
@section('title', 'Dashboard')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="mdi mdi-account-group me-1"></i>Leads</h4>
                    <div id="reportrange"  class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                        <span></span> <b class="caret"></b>
                    </div>
                    {{-- <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="all_date">All Date</span> <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 7 Days</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 15 Days</a>
                            <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Custom Range</a>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body">
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card tilebox-one border-l-blue">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="{{ route('admin.leads.index') }}">Total Leads</a></h4>
                                    <h3 class="mb-0" id="active-users-count">{{ $total_leads_count }}</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card tilebox-one border-l-yellow">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="{{ route('admin.leads.index', ["lead_status" => "New"]) }}">New Leads</a></h4>
                                    <h3 class="mb-0" id="active-users-count">{{ $new_leads_count }}</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card tilebox-one border-l-light-blue">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="{{ route('admin.leads.index', ["lead_status" => "Contacted"]) }}">Contacted Leads</a></h4>
                                    <h3 class="mb-0" id="active-users-count">{{ $contacted_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card tilebox-one border-l-megenta">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="{{ route('admin.leads.index', ["lead_status" => "Nurturing"]) }}">Nurturing Leads</a></h4>
                                    <h3 class="mb-0" id="active-users-count">{{ $nurturing_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card tilebox-one border-l-green">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="{{ route('admin.leads.index', ["lead_status" => "Qualified"]) }}">Qualified Leads</a></h4>
                                    <h3 class="mb-0" id="active-users-count">{{ $qualified_leads_count }}</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card tilebox-one border-l-red">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="{{ route('admin.leads.index', ["lead_status" => "Unqualified"]) }}">Unqualified Leads</a></h4>
                                    <h3 class="mb-0" id="active-users-count">{{ $unqualified_leads_count }}</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="mdi mdi-note-text me-1"></i>Quotations</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="all_date">All Date</span> <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 7 Days</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 15 Days</a>
                            <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-blue">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Total Quotations</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-yellow">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Pending Quotations</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-light-blue">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Customer Accepted</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-green">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Policy Generated</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="mdi mdi-newspaper-variant me-1"></i>Policies</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="all_date">All Date</span> <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 7 Days</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 15 Days</a>
                            <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-megenta">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Total Policies</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-blue">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Renewal Policies</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-red">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Dispatched Policies</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one border-l-yellow">
                                <div class="card-body p-2 text-center">
                                    <h4><a href="#">Total Customers</a></h4>
                                    <h3 class="mb-0">100</h3>
                                </div> <!-- end card-body-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="mdi mdi-newspaper-variant me-1"></i>Renewal Policies</h4>
                    <a href="{{ route('admin.renewal.list') }}" class="text-dark">View All</a>
                </div>
                <div class="card-body" style="padding: 10px;">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="bg-secondary text-white">Id</th>
                                    <th class="bg-secondary text-white">Policy No.</th>
                                    <th class="bg-secondary text-white">Policy Expire Date</th>
                                    <th class="bg-secondary text-white">Policy</th>
                                    <th class="bg-secondary text-white">Customer</th>
                                    <th class="bg-secondary text-white">Status</th>
                                    <th class="bg-secondary text-white" class="text-center">More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>8</td>
                                    <td>9871201</td>
                                    <td>31 May, 2024
                                        <br><small class="badge bg-danger">2 Days left</small>
                                        <br><small class="badge bg-secondary">Reminder Sent :22 May 2024, 12:00am</small>
                                    </td>
                                    <td>Motor<br><small>Two Wheeler Package Policy</small></td>
                                    <td class="table-user"><a href="#" class="text-body fw-semibold">Khalid M</a></td>
                                    <td><span class="badge bg-info">Pending</span><br>
                                        <small class="badge bg-primary">Next follow up:</small>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-primary btn-sm" target="_blank">Show Renewal</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="mdi mdi-newspaper-variant me-1"></i>Recent Claims</h4>
                </div>
                <div class="card-body" style="padding: 10px;">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="bg-secondary text-white">Id</th>
                                    <th class="bg-secondary text-white">Customer</th>
                                    <th class="bg-secondary text-white">Claim Type</th>
                                    <th class="bg-secondary text-white">Raised on.</th>
                                    <th class="bg-secondary text-white">Status</th>
                                    <th class="bg-secondary text-white" class="text-center">More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>8</td>
                                    <td>Virat Sharma</td>
                                    <td>Motor<br><small>Two Wheeler Package Policy</small></td>
                                    <td class="table-user"><a href="#" class="text-body fw-semibold">Khalid M</a></td>
                                    <td>May 21 2024</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="#" class="btn btn-primary btn-sm" target="_blank">Show Claim</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="uil-moneybag-alt me-1"></i>Revenue</h4>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="all_date">All Date</span> <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Yesterday</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 7 Days</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Last 15 Days</a>
                            <a href="javascript:void(0);" class="dropdown-item">This Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Last Month</a>
                            <a href="javascript:void(0);" class="dropdown-item">Custom Range</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-content-bg">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <p class="mb-0 mt-3">Total Income</p>
                                <h3 class="font-weight-normal mb-3">
                                    <small class="mdi mdi-checkbox-blank-circle text-primary align-middle mr-1"></small>
                                    <span>₹58,254</span>
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 mt-3">Total Expenses</p>
                                <h3 class="font-weight-normal mb-3">
                                    <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                    <span>₹69,524</span>
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <h5>Today's Earning: ₹2,562.30</h5>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="uil-calling me-1"></i>Upcoming Follow Up</h4>
                    <a href="{{ route('admin.leads.index') }}" class="text-dark">View All</a>
                </div>
                <div class="card-body" style="padding: 10px;">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="bg-secondary text-white">Follower</th>
                                    <th class="bg-secondary text-white">Contact Via</th>
                                    <th class="bg-secondary text-white">Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Himanshu Sharma</td>
                                    <td>Via WhatsApp</td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>21 May, 2024 12:43 PM</span></td>
                                </tr>
                                <tr>
                                    <td>Nurul Hasan</td>
                                    <td>Via Email</td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>30 May, 2024 12:43 PM</span></td>
                                </tr>
                                <tr>
                                    <td>Nurul Hasan</td>
                                    <td>Via Meeting</td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>5 June, 2024 12:43 PM</span></td>
                                </tr>
                                <tr>
                                    <td>Nurul Hasan</td>
                                    <td>Via Meeting</td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>5 June, 2024 12:43 PM</span></td>
                                </tr>
                                <tr>
                                    <td>Nurul Hasan</td>
                                    <td>Via Meeting</td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>5 June, 2024 12:43 PM</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title"><i class="uil-ticket me-1"></i>Recent Grievance</h4>
                    <a href="{{ route('admin.grievance.index') }}" class="text-dark">View All</a>
                </div>
                <div class="card-body" style="padding: 10px;">
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="bg-secondary text-white">Id</th>
                                    <th class="bg-secondary text-white">Customer</th>
                                    <th class="bg-secondary text-white">Status</th>
                                    <th class="bg-secondary text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Emilia Pfeffer <br><span style="font-size: 12px;">whermann@example.net</span></td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>Open</span></td>
                                    <td class="text-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a href="#"><li class="dropdown-item">Chat</li></a>
                                            <a href="#"><li class="dropdown-item">Show</li></a>
                                            <a href="javascript:void(0)" onclick="confirmDelete(1)"><li class="dropdown-item"> Delete</li>
                                                <form id="delete-form1" action="#" method="POST">
                                                    <input type="hidden" name="_token" value="2nqJLlW0kqeeCd12YTRfGIJjCekEI1Mn6kefPhv6">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Emilia Pfeffer <br><span style="font-size: 12px;">whermann@example.net</span></td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>Open</span></td>
                                    <td class="text-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a href="#"><li class="dropdown-item">Chat</li></a>
                                            <a href="#"><li class="dropdown-item">Show</li></a>
                                            <a href="javascript:void(0)" onclick="confirmDelete(1)"><li class="dropdown-item"> Delete</li>
                                                <form id="delete-form1" action="#" method="POST">
                                                    <input type="hidden" name="_token" value="2nqJLlW0kqeeCd12YTRfGIJjCekEI1Mn6kefPhv6">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Emilia Pfeffer <br><span style="font-size: 12px;">whermann@example.net</span></td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>Open</span></td>
                                    <td class="text-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a href="#"><li class="dropdown-item">Chat</li></a>
                                            <a href="#"><li class="dropdown-item">Show</li></a>
                                            <a href="javascript:void(0)" onclick="confirmDelete(1)"><li class="dropdown-item"> Delete</li>
                                                <form id="delete-form1" action="#" method="POST">
                                                    <input type="hidden" name="_token" value="2nqJLlW0kqeeCd12YTRfGIJjCekEI1Mn6kefPhv6">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Emilia Pfeffer <br><span style="font-size: 12px;">whermann@example.net</span></td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>Open</span></td>
                                    <td class="text-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a href="#"><li class="dropdown-item">Chat</li></a>
                                            <a href="#"><li class="dropdown-item">Show</li></a>
                                            <a href="javascript:void(0)" onclick="confirmDelete(1)"><li class="dropdown-item"> Delete</li>
                                                <form id="delete-form1" action="#" method="POST">
                                                    <input type="hidden" name="_token" value="2nqJLlW0kqeeCd12YTRfGIJjCekEI1Mn6kefPhv6">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Emilia Pfeffer <br><span style="font-size: 12px;">whermann@example.net</span></td>
                                    <td><span class="badge bg-danger"><i class="fas fa-user"></i>Open</span></td>
                                    <td class="text-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a href="#"><li class="dropdown-item">Chat</li></a>
                                            <a href="#"><li class="dropdown-item">Show</li></a>
                                            <a href="javascript:void(0)" onclick="confirmDelete(1)"><li class="dropdown-item"> Delete</li>
                                                <form id="delete-form1" action="#" method="POST">
                                                    <input type="hidden" name="_token" value="2nqJLlW0kqeeCd12YTRfGIJjCekEI1Mn6kefPhv6">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div>
        </div>
    </div>
</div> <!-- container -->
@endsection
@push('scripts')
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script>
    $(function() {

var start = moment().subtract(29, 'days');
var end = moment();

function cb(start, end) {
    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, cb);

cb(start, end);

});
</script>
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
                },
                {
                    orderable: !0
                }
            ]
        })
    });
</script>
@endpush

{{-- <div class="col-sm-3">
    <div class="card tilebox-one">
        <div class="card-body p-2">
            <i class="mdi mdi-account float-end text-secondary"></i>
            <h4 class="mt-0 text-primary"><a href="{{ route('admin.customers.index') }}">Total Customers</a></h4>
            <h3 class="mt-2" id="active-users-count">{{ $total_customers }}</h3>

        </div> <!-- end card-body-->
    </div>
</div>
<div class="col-sm-3">
    <div class="card tilebox-one">
        <div class="card-body p-2">
            <i class="mdi mdi-form-select float-end text-secondary"></i>
            <h4 class="mt-0 text-primary"><a href="{{ route('admin.quotations.index') }}">Total Quotations</a></h4>
            <h3 class="mt-2" id="active-users-count">{{ $total_quotations }}</h3>

        </div> <!-- end card-body-->
    </div>
</div>
<div class="col-sm-3">
    <div class="card tilebox-one">
        <div class="card-body p-2">
            <i class="mdi mdi-star float-end text-secondary"></i>
            <h4 class="mt-0 text-primary"><a href="{{ route('admin.policies.index') }}">Policies</a></h4>
            <h3 class="mt-2" id="active-users-count">{{ $total_policies }}</h3>

        </div> <!-- end card-body-->
    </div>
</div> --}}
{{-- <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-calendar-today float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ['created_at' => \Carbon\Carbon::now()->format('Y-m-d')]) }}">Today Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $today_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div> --}}
                        {{-- <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-calendar-week float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["by_time" => "This Week"]) }}">Leads This Week</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $weekly_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div> --}}
                        {{-- <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-calendar-month-outline float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["by_time" => "This Month"]) }}">Leads This Month</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $monthly_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div> --}}
