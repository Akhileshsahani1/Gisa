@extends('layouts.admin')
@section('title', 'Show Lead')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark"><i
                            class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <a href="{{ route('admin.leads.edit', $lead->id) }}" class="btn btn-sm btn-primary"><i
                            class="mdi mdi-pencil me-1"></i>Edit</a>
                    <a href="javascript:void(0)" onclick="confirmDelete({{ $lead->id }})"
                        class="btn btn-sm btn-danger"><i class="mdi mdi-delete me-1"></i>Delete</a>
                    <form id='delete-form{{ $lead->id }}' action='{{ route('admin.leads.destroy', $lead->id) }}'
                        method='POST'>
                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                        <input type='hidden' name='_method' value='DELETE'>
                    </form>
                </div>
                <h4 class="page-title">Lead Details <span class="badge bg-info">{{ $lead->lead_status }}</span></h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="col-md-12 assign-message-div" style="display: none">
        <div class="alert alert-success assign-message alert-dismissible fade show" role="alert"
            style="display: none">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body custom_policy">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Customer Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Lead Details</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                <span class="d-none d-md-block">Attachments</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="home">
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Customer Name </span><br>
                                            {{ $lead->salutation }} {{ $lead->firstname }} {{ $lead->lastname }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Gender </span><br> {{ $lead->gender }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Phone Number </span><br>
                                            {{ $lead->phone }}</td>
                                        <td style="width: 50%"><span class="fw-bold">WhatsApp Number </span><br>
                                            {{ $lead->whats_app }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Email </span><br> {{ $lead->email }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Address </span><br> {{ $lead->address }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="profile">
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Lead Type</span><br>
                                            {{ $lead->lead_type }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Lead Source </span><br>
                                            {{ $lead->lead_source }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Assigned To </span><br>
                                            {{ $lead->user?->firstname }} {{ $lead->user?->lastname }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Lead Status </span><br> <span
                                                class="badge bg-secondary py-1 px-3"
                                                id="statuses">{{ $lead->lead_status }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Product Type </span><br>
                                            {{ $lead->policy?->name }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Insurance Type </span><br>
                                            {{ $lead->policyType?->type }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Policy Expiry Date </span><br>
                                            {{ \Carbon\Carbon::parse($lead->policy_expiry_date)->format('M d, Y') }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Lead Generated </span><br>
                                            {{ \Carbon\Carbon::parse($lead->created_at)->format('M d, Y h:i:A') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 100%"><span class="fw-bold">Special Remark </span><br>
                                            {{ $lead->special_remark ?? 'Not Found' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="settings">
                            @forelse($lead->attachments as  $attachment)
                            <div class="card mb-1 shadow-none border">
                                <div class="p-2">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            {{ $attachment->name }}
                                        </div>
                                        <div class="col text-end">
                                            <!-- Button -->
                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/attachments' . '/' . $attachment->name) }}"
                                                download="" class="btn btn-link btn-lg text-muted">
                                                <i class="dripicons-download"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-center py-4">No Attachmant Found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0 d-flex justify-content-between">
                    <h4 class="card-title">Upcoming Follow Up</h4>
                    <div>
                    <button type="button" class="btn btn-primary text-end mr-1" id="add-follow-up">Add Follow Up</button>
                     <a href="{{ route('admin.leads.show-follow', $lead->id) }}" class="btn btn-light text-end" id="add-follow-up">View All</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="invoiceTable" class="table table-bordered table-striped dataTable no-footer dtr-inline" aria-describedby="invoiceTable_info">
                        <thead class="bg-dark">
                            <tr>
                                <th class="bg-secondary text-white">Date & Time</th>
                                <th class="bg-secondary text-white">Contacted Via</th>
                                <th class="bg-secondary text-white">Comment</th>
                                <th class="bg-secondary text-white">Follower</th>
                                <th class="bg-secondary text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lead->follows as $follow)
                            <tr>
                                @php $date_time = $follow->follow_up_date.' '.$follow->follow_up_time @endphp
                                <td> <span class="badge bg-danger"><i class="fas fa-user"></i>{{ date('d M, Y g:i A', strtotime($date_time)) ?? '' }}</span></td>
                                <td>{{ $follow->contacted_via }}</td>
                                <td>{{ $follow->comment }}</td>
                                <td>{{ $follow->user->firstname }} {{ $follow->user->lastname }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm me-1 edit-follow-button" data-id="{{ $follow->id}}"
                                            data-contacted_via="{{ $follow->contacted_via}}"
                                            data-comment="{{ $follow->comment}}"
                                            data-follow_up_date="{{ $follow->follow_up_date}}"
                                            data-follow_up_time="{{ $follow->follow_up_time }}"
                                        ><i class="mdi mdi-pencil"></i></button>
                                        <a href="javascript:void(0);" onclick="confirmFollowDelete({{$follow->id}})" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                        <form id='delete-form-follow{{ $follow->id }}'
                                            action='{{ route('admin.leads.delete-follow', $follow->id) }}'
                                            method='POST'>
                                            <input type='hidden' name='_token'
                                                value='{{ csrf_token() }}'>
                                            <input type='hidden' name='_method' value='DELETE'>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No Follow Up Found.</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Assign to Service Executive</h4>
                </div>
                <div class="card-body pt-1">
                    <form action="{{ route('admin.leads.quote-request', $lead->id) }}" method="POST" id="quote-request-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label class="col-form-label" for="policy_id">Product Type <span class="text-danger">*</span></label>
                                <select name="policy_id" id="policy_id" class="form-select " onchange="getProductType()">
                                    <option value="">Choose Product</option>
                                    <option value="1">Motor</option>
                                    <option value="2">Non Motor</option>
                                    <option value="3">Health</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label" for="policy_type_id">Insurance Policy Type <span class="text-danger">*</span></label>
                                <select name="policy_type_id" id="policy_type_id" class="form-select ">
                                    <option value="">Choose Policy Type</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="col-form-label" for="service_executive_id">Service Executive <span class="text-danger">*</span></label>
                                <select name="service_executive_id" id="service_executive_id" class="form-select ">
                                    <option value="">Choose Service Executive</option>
                                    @foreach($service_exceutives as $exceutive)
                                    <option value="{{ $exceutive->id }}">{{ $exceutive->firstname }} {{ $exceutive->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="col-form-label" for="description">Description <small>(Breif of policy)</small></label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            @can('Convert Lead To Quotation')
                            <div class="d-grid mt-2">
                                <a href="javascript:void(0)" onclick="convertLead()" class="btn btn-success"><i
                                        class="mdi mdi-check me-1"></i> Request Quote </a>
                            </div>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body customer_tab">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#activity" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Activity</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#notes" data-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Note</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="activity">
                            <div class="accordion activity-accordion" id="accordionExample">
                                @foreach($lead->leadContactHistories as $key => $history)
                                 @if ($history->contacted_via == 'Via Phone')
                                <div class="card mb-1">
                                    <div class="card-header b-warning" id="headingOne">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title d-block pt-2 pb-2"
                                                data-toggle="collapse" href="#collapse{{$key}}"
                                                aria-expanded="true" aria-controls="collapse{{$key}}">
                                                <i class="mdi mdi-phone me-1"></i>Phone<i class="uil-angle-down mx-1"></i>
                                                <span class="font-12" style="float: right;"><i class="mdi mdi-calendar me-1"></i>{{ \Carbon\Carbon::parse($history->calling_date)->format('M d Y') }}</span>
                                            </a>

                                        </h5>
                                    </div>

                                    <div id="collapse{{$key}}" class="collapse"
                                        aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Caller Name:</h6>
                                                    <p>{{ $history->caller_name }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Receiver Name:</h6>
                                                    <p>{{ $history->receiver_name }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Subject:</h6>
                                                    <p>{{ $history->subject }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">History Added By:</h6>
                                                    <p>{{ \App\Models\Administrator::find($history->added_by)->firstname.' '.\App\Models\Administrator::find($history->added_by)->lastname ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Comment:</h6>
                                                    <p>{{ $history->comment ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Call Recording:</h6>
                                                    <p>   @isset($history->attachment_call_recording)
                                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/history' . '/' . $history->attachment_call_recording) }}"
                                                                download="{{ $history->attachment_call_recording }}"
                                                                class="btn btn-sm btn-light mt-1"><i
                                                                    class="mdi mdi-download me-1"></i>Download</a>
                                                        </td>
                                                    @else
                                                        Not Uploaded
                                                    @endisset</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($history->contacted_via == 'Via WhatsApp')
                                <div class="card mb-1">
                                    <div class="card-header b-success" id="heading{{ $key }}">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title text-white collapsed d-block pt-2 pb-2"
                                                data-toggle="collapse" href="#collapse{{ $key }}"
                                                aria-expanded="false" aria-controls="collapse{{ $key }}">
                                                <i class="mdi mdi-whatsapp me-1"></i>WhatsApp<i class="uil-angle-down mx-1"></i>
                                                <span class="font-12" style="float: right;"><i class="mdi mdi-calendar me-1"></i>{{ \Carbon\Carbon::parse($history->message_date)->format('M d Y') }}</span>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse{{ $key }}" class="collapse" aria-labelledby="heading{{ $key }}"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">WhatsApp From:</h6>
                                                    <p>{{ $history->whats_app_from ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">WhatsApp To:</h6>
                                                    <p>{{ $history->whats_app_to ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Comment:</h6>
                                                    <p>{{ $history->whatsapp_message ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Call Recording:</h6>
                                                    <p> @isset($history->attachment_whatsapp)
                                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/history' . '/' . $history->attachment_whatsapp) }}"
                                                                download="{{ $history->attachment_whatsapp }}"
                                                                class="btn btn-sm btn-light mt-1"><i
                                                                    class="mdi mdi-download me-1"></i>Download</a>
                                                        </td>
                                                    @else
                                                        Not Uploaded
                                                    @endisset</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($history->contacted_via == 'Via Meet')
                                <div class="card mb-2">
                                    <div class="card-header b-primary" id="heading{{ $key }}">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title text-white collapsed d-block pt-2 pb-2"
                                                data-toggle="collapse" href="#collapse{{ $key }}"
                                                aria-expanded="false" aria-controls="collapse{{ $key }}">
                                                <i class="mdi mdi-video me-1"></i>Meeting<i class="uil-angle-down mx-1"></i>
                                                <span class="font-12" style="float: right;"><i class="mdi mdi-calendar me-1"></i>{{ \Carbon\Carbon::parse($history->meeting_date)->format('M d Y') }}</span>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse{{ $key }}" class="collapse"
                                        aria-labelledby="heading{{ $key }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Who Meet:</h6>
                                                    <p>{{ $history->who_meet ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Whom Meet:</h6>
                                                    <p>{{ $history->whom_meet ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Meeting Location:</h6>
                                                    <p>{{ $history->meeting_location ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">History Added By:</h6>
                                                    <p>{{ \App\Models\Administrator::find($history->added_by)->firstname.' '.\App\Models\Administrator::find($history->added_by)->lastname ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Meeting Discussion:</h6>
                                                    <p>{{ $history->meeting_discussion ?? "Not Found" }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if ($history->contacted_via == 'Via Email')
                                <div class="card mb-0">
                                    <div class="card-header b-danger" id="heading{{ $key }}">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title text-white collapsed d-block pt-2 pb-2"
                                                data-toggle="collapse" href="#collapse{{ $key }}"
                                                aria-expanded="false" aria-controls="collapse{{ $key }}">
                                                <i class="mdi mdi-email me-1"></i>Email<i class="uil-angle-down mx-1"></i>
                                                <span class="font-12" style="float: right;"><i class="mdi mdi-calendar me-1"></i>{{ \Carbon\Carbon::parse($history->email_sent_date)->format('M d Y') }}</span>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapse{{ $key }}" class="collapse"
                                        aria-labelledby="heading{{ $key }}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Email Sender ID:</h6>
                                                    <p>{{ $history->email_sender_id }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Email Receiver ID:</h6>
                                                    <p>{{ $history->email_receiver_id }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">Email Subject:</h6>
                                                    <p>{{ $history->email_subject }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h6 class="font-14">History Added By:</h6>
                                                    <p>{{ \App\Models\Administrator::find($history->added_by)->firstname.' '.\App\Models\Administrator::find($history->added_by)->lastname ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Email Body:</h6>
                                                    <p>{{ $history->email_body ?? "Not Found" }}</p>
                                                </div>
                                                <div class="col-sm-12">
                                                    <h6 class="font-14">Email Attachment:</h6>
                                                    <p> @isset($history->attachment_email)
                                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/history' . '/' . $history->attachment_email) }}"
                                                                download="{{ $history->attachment_email }}"
                                                                class="btn btn-sm btn-light mt-1"><i
                                                                    class="mdi mdi-download me-1"></i>Download</a>
                                                        </td>
                                                    @else
                                                        Not Uploaded
                                                    @endisset</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="notes">
                            <form method="POST" action="{{ route('admin.leads.comment',$lead->id) }}" enctype="multipart/form-data" id="commentForm">
                            @csrf
                            <div class="form-group col-sm-12">
                                <label for="comment" class="col-form-label">Note</label>
                                <textarea class="form-control" row="5" name="comment" required></textarea>
                                @error('comment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning mt-2 w-100" form="commentForm"><i class="mdi mdi-update me-1"></i>Save Note</button>
                            </form>
                            <div class="card-header mt-3 p-0 d-flex justify-content-between">
                                <h4 class="card-title">Recent Notes</h4>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#full-width-modal">View All</a>
                            </div>
                            <table id="invoiceTable" class="table table-bordered table-striped dataTable no-footer dtr-inline" aria-describedby="invoiceTable_info">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="bg-secondary text-white">Added By</th>
                                        <th class="bg-secondary text-white">Comments</th>
                                    </tr>
                                    <tbody>
                                    @forelse ($lead->comments as $key => $comment)
                                    @if($key < 5)
                                    <tr>
                                        <td>
                                             <span class="badge bg-danger"><i class="fas fa-user"></i>{{ $comment->user?->firstname }} {{ $comment->user?->lastname }}</span>
                                                                <br>
                                                                <span class="badge bg-info"> <i class="fas fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($comment->created_at)) ?? '' }}</span>
                                                                <br>
                                                                <span class="badge bg-success"><i class="fas fa-clock"></i>{{ date('g:i A', strtotime($comment->created_at)) ?? '' }}</span>
                                        </td>
                                        <td>{{ $comment->comment }}</td>
                                    </tr>
                                    @endif
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No Comment Found.</td>
                                    </tr>
                                    @endforelse



                                    </tbody>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>






            <form action="{{ route('admin.leads.update-status', $lead->id) }}" method="POST" id="statusForm">
                @csrf
                @method('PUT')
                <div class="card mb-0">
                    <div class="card-body pt-1">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="lead_status" class="col-form-label">Lead Status</label>
                                <select id="lead_status" class="form-select" name="lead_status"
                                    onchange="getContactOptions();" required>
                                    <option value="">Choose Lead Status</option>
                                    <option value="New">New
                                    </option>
                                    <option value="Contacted">
                                        Contacted
                                    </option>
                                    <option value="Nurturing">
                                        Nurturing
                                    </option>
                                    <option value="Qualified">
                                        Qualified
                                    </option>
                                    <option value="Unqualified">
                                        Unqualified
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                @include('admin.leads.new-contact')
                <div class="card mt-0 d-grid">
                    <button type="submit" class="btn btn-primary" form="statusForm"><i class="mdi mdi-update me-1"></i>Update</button>
                </div>
            </form>
            <div class="card">
                <div class="card-body pt-1">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="assigned_to" class="col-form-label">Transfer Lead</label>
                            <select id="assigned_to" class="form-select @error('assigned_to') is-invalid @enderror"
                                name="assigned_to">
                                <option value="">Choose User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('assigned_to', $lead->assigned_to) == $user->id ? 'selected' : '' }}>
                                        {{ $user->firstname }} {{ $user->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>





            {{-- <form action="{{ route('admin.leads.comment', $lead->id) }}" method="POST" id="commentForm">
                @csrf
                <div class="card mb-0">
                    <div class="card-body pt-1">
                        <div class="row">
                             <div class="form-group col-sm-12">
                                <label for="comment" class="col-form-label">Comment</label>
                                <textarea class="form-control" row="5" name="comment"></textarea>
                                @error('comment')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card mt-0 p-1"  style="flex-direction: row !important;">
                    <button type="submit" class="btn btn-primary" form="commentForm" style="width:49%; margin-right:4px;"><i class="mdi mdi-update me-1"></i>Save Comment</button>

                    <button  type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#full-width-modal" style="width:49%">View Comment</button>

                </div>
            </form>
            <div class="card mt-0 p-1" style="flex-direction: row !important;">
                <a href="{{ route('admin.leads.contact-history', $lead->id) }}" class="btn btn-warning" style="width:49%; margin-right:4px;"><i class="mdi mdi-eye me-1"></i>Contact History</a>

                <button  type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#follow-up-modal" style="width:49%">Follow Up</button>
            </div> --}}
        </div>
    </div>
</div>
@include('admin.leads.comment')
@include('admin.leads.follow-up')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<div id="save_comments" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('admin.leads.comment', $lead->id) }}" method="POST" >
                @csrf
                <div class="row">
                        <div class="form-group col-sm-12">
                        <label for="comment" class="col-form-label">Comment</label>
                        <textarea class="form-control" row="5" name="comment" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Comment</button>
            </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
    <script>
        function confirmDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + e).submit()
            })
        }
        function confirmFollowDelete(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form-follow" + e).submit()
            })
        }
    </script>
    <script>
        whats_app_from = document.querySelector("#whats_app_from"),
            whats_app_from_dialCode = document.querySelector("#whats_app_from-dial-code");

        // init plugin
        var iti = window.intlTelInput(whats_app_from, {
            initialCountry: "{{ old('iso2', 'IN') }}",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });
    </script>
    <script>
        whats_app_to = document.querySelector("#whats_app_to"),
            whats_app_to_dialCode = document.querySelector("#whats_app_to-dial-code");

        // init plugin
        var iti = window.intlTelInput(whats_app_to, {
            initialCountry: "{{ old('iso2', 'IN') }}",
            utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
        });
    </script>
    <script>
        $('#assigned_to').change(function() {
            var assigned_to = this.value;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.leads.transfer') }}",
                data: {
                    'assigned_to': assigned_to,
                    'lead_id': "{{ $lead->id }}",
                    '_token': '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('.assign-message-div').css('display', 'block');
                    $('.assign-message').css('display', 'block');
                    $(".assign-message").html('<center>' + data.success + '</center>');
                    $(function() {
                        setTimeout(function() {
                            $('.assign-message').slideUp();
                        }, 6000);
                    });
                }
            });

        })
    </script>
    <script>
        function getContactOptions() {
            var status = $('#lead_status').val();

            switch (status) {
                case 'Contacted':
                    $('#contacted_div').show();
                    break;
                case 'Nurturing':
                    $('#contacted_div').show();
                    break;
                default:
                    $('#contacted_div').hide();
                    break;
            }
        }
    </script>
    <script>
        function getContactSubOptions() {
            var contacted_via = $('#contacted_via').val();

            switch (contacted_via) {
                case 'Via Phone':
                    $('#phone_div').show();
                    $('#email_div').hide();
                    $('#whatsapp_div').hide();
                    $('#meet_div').hide();
                    break;
                case 'Via Email':
                    $('#phone_div').hide();
                    $('#email_div').show();
                    $('#whatsapp_div').hide();
                    $('#meet_div').hide();
                    break;
                case 'Via WhatsApp':
                    $('#phone_div').hide();
                    $('#email_div').hide();
                    $('#whatsapp_div').show();
                    $('#meet_div').hide();
                    break;
                case 'Via Meet':
                    $('#phone_div').hide();
                    $('#email_div').hide();
                    $('#whatsapp_div').hide();
                    $('#meet_div').show();
                    break;
                default:
                    $('#phone_div').hide();
                    $('#email_div').hide();
                    $('#whatsapp_div').hide();
                    $('#meet_div').hide();
                    break;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            getContactSubOptions();
        });
    </script>
    <script>
        function convertLead() {
            let error = false;
            let policy_id = $('#policy_id').val();
            let policy_type_id = $('#policy_type_id').val();
            let service_executive_id = $('#service_executive_id').val();
            $('.error-custom').remove();
            if(policy_id == ''){
                $('#policy_id').after('<span class="text-danger error-custom">Product Type is Required.</span>');
                error = true;
            }
            if(policy_type_id == ''){
                $('#policy_type_id').after('<span class="text-danger error-custom">Insurance Policy Type is Required.</span>');
                error = true;
            }
            if(service_executive_id == ''){
                $('#service_executive_id').after('<span class="text-danger error-custom">Service Executive is Required.</span>');
                error = true;
            }
            console.log(error);
            if(error){
             return false;
            }

            $('#quote-request-form').submit();
            // Swal.fire({
            //     title: "Are you sure?",
            //     text: "You want to convert this Lead!",
            //     icon: "warning",
            //     showCancelButton: !0,
            //     confirmButtonColor: "#3085d6",
            //     cancelButtonColor: "#d33",
            //     confirmButtonText: "Yes, Convert it!"
            // }).then(t => {
            //     if (t.isConfirmed) {
                    // var url = '{{ route('admin.leads.convert', ':lead') }}';
                    // url = url.replace(':lead', "{{ $lead->id }}");
                    // url = url+'?policy_id=' + policy_id +'&policy_type_id='+policy_type_id;
                    // window.location.href = url;
            //     }
            // })
        }
    </script>
    <script>
        function getProductType() {
            $("#policy_type_id").html('');
            var policy_id = $('#policy_id').val();
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('admin.policies.getType') }}",
                data: {
                    policy_id: policy_id
                },
                success: function(data) {
                    var list = $("#policy_type_id");
                    list.html('<option value="">Choose Policy Type</option>')
                    $.each(data.types, function(index, type) {
                        list.append(new Option(type.type, type.id));
                    });
                    list.val('{{ old("policy_type_id") }}')
                    @if(old("policy_type_id"))
                        getPolicyForm();

                    @endif
                }

            });
        }
    </script>
    <script type="text/javascript">
        $('.edit-follow-button').on('click',function(e){
          let follow_id = $(this).attr('data-id');
          let contacted_via = $(this).attr('data-contacted_via');
          let follow_up_date = $(this).attr('data-follow_up_date');
          let follow_up_time = $(this).attr('data-follow_up_time');
          let comment = $(this).attr('data-comment');
          $('#edit_follow_id').val(follow_id);
          $('#edit_follow_contacted_via').val(contacted_via);
          $('#edit_follow_up_date').val(follow_up_date);
          $('#edit_follow_time').val(follow_up_time);
          $('#edit_follow_comment').val(comment);
          $('#follow-up-modal').modal('show');
        });
        $('#add-follow-up').on('click',function(){
          $('#edit_follow_id').val(0);
          $('#edit_follow_contacted_via').val('');
          $('#edit_follow_up_date').val('');
          $('#edit_follow_time').val('');
          $('#edit_follow_comment').val('');
          $('#follow-up-modal').modal('show');
        });
    </script>
@endpush
