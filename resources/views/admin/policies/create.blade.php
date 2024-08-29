@extends('layouts.admin')
@section('title', 'Create Policy')
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="productForm"><i
                            class="mdi mdi-database me-1"></i>Save</button>
                </div>
                <h4 class="page-title">Create Policy</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <form id="productForm" method="POST" action="{{ route('admin.policies.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="name">Policy Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Policy Name" value="{{ old('name') }}" autofocus>
                                @error('name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('enabled') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="enabled">Enabled<span
                                        class="text-danger">*</span></label>
                                <select name="enabled" id="enabled" class="form-select">
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('enabled')
                                    <span id="enabled-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="productForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> <!-- container -->
@endsection
