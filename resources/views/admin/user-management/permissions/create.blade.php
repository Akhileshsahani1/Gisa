@extends('layouts.admin')
@section('title', 'Create Permission')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="PermissionForm"><i
                        class="mdi mdi-database me-1"></i>Save</button>
                </div>
                <h4 class="page-title">Create Permission</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="PermissionForm" method="POST" action="{{ route('admin.permissions.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Permisison Name"
                                value="{{ old('name') }}">
                            @error('name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="PermissionForm"><i
                            class="mdi mdi-database me-1"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
