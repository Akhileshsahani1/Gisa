@extends('layouts.admin')
@section('title', 'Roles')
@section('head')
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ route('admin.roles.create') }}"
                        class="btn btn-sm btn-primary float-end"><i class="mdi mdi-plus"></i> Add New Role</a>
                </div>
                <h4 class="page-title">Roles</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                        <thead class="bg-dark">
                            <tr>
                                <th class="bg-secondary text-white">Id</th>
                                <th class="bg-secondary text-white">Role</th>
                                <th class="bg-secondary text-white">Permissions</th>
                                <th class="bg-secondary text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission)
                                    <span class="badge bg-info">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning"> Edit</a>
                                    <button type="button" onclick="confirmDelete({{$role->id}})" class="btn btn-sm btn-danger">Delete </button>
                                    <form id='delete-form{{$role->id}}' action='{{route('admin.roles.destroy', $role->id)}}' method='POST'>
                                        <input type='hidden' name='_token' value='{{ csrf_token()}}'>
                                        <input type='hidden' name='_method' value='DELETE'>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>






</div>





@endsection
@push('scripts')
@endpush
