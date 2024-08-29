@extends('layouts.admin')
@section('title', 'Create User')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="RoleForm"><i
                        class="mdi mdi-database me-1"></i>Save</button>
                </div>
                <h4 class="page-title">Create User</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="RoleForm" method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="firstname" class="col-form-label">First Name</label>
                                <input type="text" class="form-control" id="name" name="firstname" placeholder="Enter Full Name"
                                    value="{{ old('firstname') }}">
                                @error('firstname')
                                    <span id="firstname-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="lastname" class="col-form-label">Last Name</label>
                                <input type="text" class="form-control" id="name" name="lastname" placeholder="Enter Full Name"
                                    value="{{ old('lastname') }}">
                                @error('lastname')
                                    <span id="lastname-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="email" class="col-form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="d-flex justify-content-between mb-2 mt-2">
                                    <label for="role" class="col-form-label">Roles</label>
                                    <div class="button-group text-end">
                                        <span class="btn btn-info btn-sm waves-effect waves-light select-all">Select All</span>
                                        <span class="btn btn-dark btn-sm waves-effect waves-light deselect-all">Deselect All</span>
                                    </div>
                                </div>
                                <select class="form-control" id="role" name="roles[]" multiple="multiple">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ in_array($role->name, old('roles', [])) ||(isset($user) && $user->roles->contains($role->name))? 'selected': '' }}>
                                            {{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="RoleForm"><i
                            class="mdi mdi-database me-1"></i>Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('#role').select2({
                theme: 'bootstrap4'
            })
            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('#role')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })
            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('#role')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });
    </script>
@endpush
