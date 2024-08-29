@extends('layouts.admin')
@section('title', 'Edit Role')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('content')

<style type="text/css">

.select2-container--default .select2-results__option--highlighted[aria-selected] {
background-color: black;
color: black;
}

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="RoleForm"><i
                        class="mdi mdi-database me-1"></i>Update</button>
                </div>
                <h4 class="page-title">Edit Role</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="RoleForm" method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="col-form-label">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Role Name"
                                value="{{ old('name', $role->name) }}">
                            @error('name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mb-2 mt-2">
                                <label for="permission" class="col-form-label">Permissions</label>
                                <div class="button-group text-end" >
                                    <span class="btn btn-info btn-sm waves-effect waves-light select-all">Select All</span>
                                    <span class="btn btn-dark btn-sm waves-effect waves-light deselect-all">Deselect All</span>
                                </div>
                            </div>

                            <select class="select2 form-control select2-multiple" id="permission" name="permission[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose permissions ...">
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}" {{ (in_array($permission->name, old('permission', [])) || isset($role) && $role->permissions->pluck('name')->contains($permission->name)) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permission')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="RoleForm"><i
                            class="mdi mdi-database me-1"></i>Update</button>
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
             $('.select-all').click(function() {
                let $select2 = $('#permission').find('option').prop('selected', 'selected').trigger('change')
            })
            $('.deselect-all').click(function() {
                let $select2 = $('#permission').find('option').prop('selected', '').trigger('change')
            })
        });
    </script>
@endpush
