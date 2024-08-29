@extends('layouts.admin')
@section('title', 'Edit Company')
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
                <h4 class="page-title">Edit Company</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <!-- end page title -->
    <div class="row">
        <div class="col-sm-12">
            <form id="productForm" method="POST" action="{{ route('admin.insurance-companies.update', $company->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 {{ $errors->has('company') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="company">Company Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company" name="company"
                                    placeholder="Enter Company Name" value="{{ old('company', $company->company) }}" autofocus>
                                @error('company')
                                    <span id="company-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6 {{ $errors->has('enabled') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="enabled">Enabled<span
                                        class="text-danger">*</span></label>
                                <select name="enabled" id="enabled" class="form-select">
                                    <option value="1" {{ old('enabled', $company->enabled) == '1' ? 'selected' : old('enabled') }}>Yes</option>
                                    <option value="0" {{ old('enabled', $company->enabled) == '0' ? 'selected' : old('enabled') }}>No</option>
                                </select>
                                @error('enabled')
                                    <span id="enabled-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="description" class="col-form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter Company Description" rows="4">{{ old('description', $company->description) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-12">
                                <label for="logo" class="col-form-label">Company Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo"
                                onchange="loadPreview(this);">
                                @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <img id="preview_img" src="{{ $company->logo }}" class="mt-2" width="240"
                                    height="120" />
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
@push('scripts')
    <script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(240)
                        .height(120);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
