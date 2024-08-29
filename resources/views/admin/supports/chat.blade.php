@extends('layouts.admin')
@section('title', 'Chat')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                </div>
                <h4 class="page-title">Chat</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Ticket Details</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Subject</dt>
                        <dd class="col-sm-8">{{ $ticket->subject }}</dd>
                        <dt class="col-sm-4">Description</dt>
                        <dd class="col-sm-8">{{ $ticket->description }}</dd>
                        <dt class="col-sm-4">Priority</dt>
                        <dd class="col-sm-8">{{ $ticket->priority }}</dd>
                        <dt class="col-sm-4">Department</dt>
                        @if($ticket->role_id)
                        <dd class="col-sm-8"><a href="{{ route('admin.roles.edit', $ticket->role_id) }}" target="_blank" class="btn btn-primary"> {{ $ticket->department->name }} </a></dd>
                        @else
                        <dd class="col-sm-8">None</dd>
                        @endif
                        <dt class="col-sm-4">Status</dt>
                        @if ($ticket->status == 0)
                            <dt class="col-sm-8"><button class="btn btn-sm bg-success" style="color: #fff">Open</button></dt>
                        @else
                            <dt class="col-sm-8"><button class="btn btn-sm bg-danger">Closed</button></dt>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Direct Chat</h4>
                </div>
                <div class="card-body">
                    <ul class="conversation-list" data-simplebar style="max-height: 537px">
                        @forelse ($ticket->chats as $chat)
                            @if ($chat->sender == 'admin')
                                <li class="clearfix odd">
                                    <div class="chat-avatar">
                                        <i class="mdi mdi-account-circle"></i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap d-grid mb-1">
                                            <i>Support Team</i>
                                            <p>{{ $chat->message }}</p>
                                        </div>
                                        <span class="text-start text-muted">{{ \Carbon\Carbon::parse($chat->created_at)->format('d-m-Y h:i A') }}</span>
                                    </div>
                                </li>
                            @else
                                <li class="clearfix">
                                    <div class="chat-avatar">
                                        <i class="mdi mdi-account-circle"></i>
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap d-grid mb-1">
                                            <i>{{ \App\Models\Customer::where('id', $chat->customer_id)->first()->name }}</i>
                                            <p>{{ $chat->message }}</p>
                                        </div>
                                        <span class="text-start text-muted">{{ \Carbon\Carbon::parse($chat->created_at)->format('d-m-Y h:i A') }}</span>
                                    </div>
                                </li>
                            @endif
                        @empty
                            <p class="text-center py-5"> No Chat found</p>
                        @endforelse
                    </ul>
                    <div class="row">
                        <div class="col">
                            @if ($ticket->status==0)
                                <div class="mt-2 bg-light p-3 rounded">
                                    <form action="{{ route('admin.grievances.send-message', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col mb-2 mb-sm-0">
                                                <input type="text" class="form-control border-0" placeholder="Enter your text" required="">
                                                <div class="invalid-feedback">Please enter your messsage</div>
                                            </div>
                                            <div class="col-sm-auto">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                        @error('message')
                                            <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </form>
                                </div>
                            @endif
                        </div> <!-- end col-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>












@endsection
@push('scripts')
@endpush
