@extends('layouts.admin')
@section('title', 'Create Agency')
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
                <h4 class="page-title">Edit Agency</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <form id="productForm" method="POST" action="{{ route('admin.agency.update',$agency->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 {{ $errors->has('agency') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="agency">Agency Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="agency" name="agency"
                                    placeholder="Enter Agency Name" value="{{ old('agency',$agency->agency) }}" autofocus>
                                @error('agency')
                                    <span id="agency-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="name">Description </label>
                                <textarea id="description" rows="5" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter Customer description">{{ old('description',$agency->description) }}</textarea>
                                @error('description')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-sm-6 {{ $errors->has('enabled') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="enabled">Enabled<span
                                        class="text-danger">*</span></label>
                                <select name="enabled" id="enabled" class="form-select">
                                    <option value="1" @if($agency->enabled == 1) selected @endif>Yes</option>
                                    <option value="0" @if($agency->enabled == 0) selected @endif>No</option>
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
