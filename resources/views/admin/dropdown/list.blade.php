@extends('layouts.admin')
@section('title', 'Dropdown')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Dropdown</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                               <a href="{{ route('admin.lead-status.index',['type'=>'lead-status']) }}" class="btn btn-primary form-control text-white mt-2">{{ __('Lead Status') }}</a>
                               <a href="{{ route('admin.lead-status.index',['type'=>'lead-type']) }}" class="btn btn-success form-control text-white mt-2">{{ __('Lead Type') }}</a>
                               <a href="{{ route('admin.lead-status.index',['type'=>'lead-source']) }}" class="btn btn-warning form-control text-white mt-2">{{ __('Lead Source') }}</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
