@extends('layouts.admin')
@section('title', 'Users')
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
                        <a href="#modal-create-customer" data-bs-toggle="modal" role="button"
                            class="btn btn-sm btn-primary float-end"><i class="mdi mdi-plus"></i> Add New Customer</a>
                        <a class="btn btn-sm btn-warning me-1 end-bar-toggle" href="javascript:void(0);"><i
                                class="mdi mdi-filter me-1"></i> Filter
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger float-end me-1" style="display: none"
                            id="delete-all"><i class="mdi mdi-delete"></i> {{ __('Delete') }}</a>
                    </div>
                    <h4 class="page-title">Customers</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                    @foreach ($user->roles as $role)
                                                    <span class="badge bg-info">{{ $role->name }}</span>
                                                    @endforeach
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning"> Edit </a>
                                                <button type="button" onclick="confirmDelete({{$user->id}})" class="btn btn-danger">Delete </button>
                                                <form id='delete-form{{$user->id}}' action='{{route('admin.users.destroy', $user->id)}}' method='POST'>
                                                    <input type='hidden' name='_token' value='{{ csrf_token()}}'>
                                                    <input type='hidden' name='_method' value='DELETE'>
                                                </form>
                                                <a style="display:none; " href="#" class="btn btn-warning" onclick="userLogin({{ $user->id }});"> Login </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
  function userLogin(userId) {

          if (userId == '') {
              $("#email_errror").html('User Id not Found!!').fadeIn(2000).fadeOut(10000);
              return;
          }

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
              type: 'POST',
              url: '{{ route("admin.users.index") }}',
              data: { 'customerId': userId, 'type': 'User' },
              success: function (response) {
                  if (response.status == 'success') {
                      window.location.href = '/admin';
                  } else if (response.status == 'failed') {
                      $("#email_errror").html(response.msg).fadeIn(2000).fadeOut(10000);
                  } 
              }
          });
      }
</script>
