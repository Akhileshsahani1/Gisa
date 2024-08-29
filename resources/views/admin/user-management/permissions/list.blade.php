@extends('layouts.admin')
@section('title', 'Permissions')
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
                        <a href="{{ route('admin.permissions.create') }}"
                            class="btn btn-sm btn-primary float-end"><i class="mdi mdi-plus"></i> Add New Permission</a>
                        <a style="display: none;" class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                                class="mdi mdi-filter me-1"></i> Filter
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all"><i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Permissions</h4>
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
                                <th class="bg-secondary text-white">Permission</th>
                                <th class="bg-secondary text-white">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning"> Edit </a>
                                        <button type="button" onclick="confirmDelete({{$permission->id}})" class="btn btn-sm btn-danger"> Delete </button>
                                        <form id='delete-form{{$permission->id}}' action='{{route('admin.permissions.destroy', $permission->id)}}' method='POST'>
                                            <input type='hidden' name='_token' value='{{ csrf_token()}}'>
                                            <input type='hidden' name='_method' value='DELETE'>
                                        </form>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $permissions->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

