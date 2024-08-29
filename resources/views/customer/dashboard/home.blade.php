@extends('layouts.customer')
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
                                    <!--<li class="breadcrumb-item"><a href="javascript: void(0);">Base UI</a></li>-->
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                            <h1 class="h1-heading">Dashboard</h1>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-3 mt-4">
                        <a href="{{ route('customer.policies') }}">
                            <div class="dashboard-section text-center">
                                <i class="dripicons-suitcase"></i>
                                <h3>Policies</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mt-4">
                        <a href="{{ route('customer.claims') }}">
                            <div class="dashboard-section text-center">
                                <i class="dripicons-to-do"></i>
                                <h3>Claims</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mt-4">
                        <a href="{{ route('customer.transactions') }}">
                            <div class="dashboard-section text-center">
                                <i class="dripicons-card"></i>
                                <h3>Transactions</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mt-4">
                        <a href="{{ route('customer.profile') }}">
                            <div class="dashboard-section text-center">
                                <i class="dripicons-user"></i>
                                <h3>Profile</h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 mt-4">
                        <a href="{{ route('customer.change-password') }}">
                            <div class="dashboard-section text-center">
                                <i class="dripicons-preview"></i>
                                <h3>Change Password</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
