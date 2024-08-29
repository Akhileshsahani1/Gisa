@extends('layouts.admin')
@section('title', 'Dashboard')
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
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-headphones float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index') }}">Total Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $total_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-calendar-today float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ['created_at' => \Carbon\Carbon::now()->format('Y-m-d')]) }}">Today Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $today_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-calendar-week float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["by_time" => "This Week"]) }}">Leads This Week</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $weekly_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-calendar-month-outline float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["by_time" => "This Month"]) }}">Leads This Month</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $monthly_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-new-box float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["lead_status" => "New"]) }}">New Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $new_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-phone-outgoing float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["lead_status" => "Contacted"]) }}">Contacted Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $contacted_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-message-processing-outline float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["lead_status" => "Nurturing"]) }}">Nurturing Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $nurturing_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-shield-check float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["lead_status" => "Qualified"]) }}">Qualified Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $qualified_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card tilebox-one">
                                <div class="card-body p-2">
                                    <i class="mdi mdi-shield-off float-end text-secondary"></i>
                                    <h4 class="mt-0 text-primary"><a href="{{ route('admin.leads.index', ["lead_status" => "Unqualified"]) }}">Unqualified Leads</a></h4>
                                    <h3 class="mt-2" id="active-users-count">{{ $unqualified_leads_count }}</h3>

                                </div> <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-sm-3">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container -->
@endsection
