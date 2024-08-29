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
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">User Management</li>
                        <li class="breadcrumb-item active">Online Users</li>
                        </ol>
                </div>
                <h4 class="page-title">Online Users</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form-filter" class="inline-form" action="{{ route('admin.online.users') }}">
                        <div class="row">
                            <div class="col-sm-9">
                                <label class="col-form-label" for="business_type">Filter By Login Status</label>
                                <select name="filter_online_status" id="filter_online_status" class="form-select ">
                                    <option value="">-select login status--</option>
                                    <option value="online"  {{ $filterOnlineStatus == 'online' ? 'selected' : '' }}>Online</option>
                                    <option value="offline" {{ $filterOnlineStatus == 'offline' ? 'selected' : '' }}>Offline</option>

                                </select>
                            </div>

                            <div class="col-sm-3 text-end">
                                <button type="submit" class="btn btn-primary me-1 mt-4" form="form-filter">Filter</button>
                                <a href="{{ route('admin.online.users') }}" class="btn btn-dark mt-4" id="reset-filter">Reset Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
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
                                <th class="bg-secondary text-white">Name</th>
                                <th class="bg-secondary text-white">Last Seen</th>
                                <th class="bg-secondary text-white">Login Count</th>
                                <th class="bg-secondary text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>@if(Cache::has('user-is-online-' . $user->id))
                                <span class="text-success" style="font-size:10px"><i class="fa fa-circle"></i></span>
                            @else
                                <span class="text-danger" style="font-size:10px"><i class="fa fa-circle"></i></span>
                            @endif{{ $user->firstname }} {{ $user->lastname }}  </td>
                                <td>
                                {{ $user->last_seen ? Carbon\Carbon::parse($user->last_seen)->format("d-m-Y h:i A") : "Not available" }}
                            </td>

                            @if($user->login_count > 1)
                            <td><span style="background-color: red; border-radius: 50%; width: 30px; height: 30px; display: inline-block; text-align: center; line-height: 30px; color:white;"><b>{{$user->login_count ?? ''}}</b></span>
                            </td>
                            @else
                                <td>{{$user->login_count ?? ''}}</td>
                            @endif
                            <td><input type="checkbox" name="my-checkbox" {{ $user->is_active == 1 ? 'checked' : '' }} onchange="toggleStatus(this, {{ $user->id }})"  data-bootstrap-switch ></td>
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
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script>
  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch();
    })
</script>
<script>
  function toggleStatus(element, user_id) {
    if(element.checked) {
       $.ajax({
        type: "POST",
        url: "{{ route('admin.users.toggle-status') }}",
        data: {
          'is_active' : 1,
          'user_id' : user_id,
          "_token": "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function (response) {
          alert('User is active now')
        }
       });
    }else{
      $.ajax({
        type: "POST",
        url: "{{ route('admin.users.toggle-status') }}",
        data: {
          'is_active' : 0,
          'user_id' : user_id,
          "_token": "{{ csrf_token() }}"
        },
        dataType: "json",
        success: function (response) {
          alert('User is Inactive now')
        }
       });
    }
};
</script>
@endpush
