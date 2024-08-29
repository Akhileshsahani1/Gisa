@extends('layouts.admin')
@section('title', 'Contact History')
@section('head')
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Contact History</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            @forelse ($lead->contactHistories as $history)
                @if ($history->contacted_via == 'Via Phone')
                    <div class="col-lg-6">
                        <div style="min-height: 358.91px;" class="card cta-box bg-primary text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h2 class="my-0"><i class="mdi mdi-phone-classic me-1"></i>Phone</h2>
                                    </div>
                                    <div class="col-6 text-end">
                                        <i class="mdi mdi-clock-outline me-1"></i>{{ \Carbon\Carbon::parse($history->calling_date)->format('M d Y') }} {{ \Carbon\Carbon::parse($history->calling_time)->format('h:i A') }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%"><span class="fw-bold">Caller Name </span><br>
                                                        {{ $history->caller_name }}
                                                    </td>
                                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Receiver Name
                                                        </span><br> {{ $history->receiver_name }}
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%"><span class="fw-bold">Subject </span><br>
                                                        {{ $history->subject }}
                                                    </td>
                                                    <td style="width: 50%" class="text-end"><span class="fw-bold">History Added By
                                                    </span><br> {{ \App\Models\Administrator::find($history->added_by)->firstname.' '.\App\Models\Administrator::find($history->added_by)->lastname ?? "Not Found" }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%"><span class="fw-bold">Comment
                                                        </span><br>
                                                        {{ $history->comment ?? "Not Found" }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%"><span class="fw-bold">Call Recording
                                                        </span><br>
                                                        @isset($history->attachment_call_recording)
                                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/history' . '/' . $history->attachment_call_recording) }}"
                                                                download="{{ $history->attachment_call_recording }}"
                                                                class="btn btn-sm btn-light mt-1"><i
                                                                    class="mdi mdi-download me-1"></i>Download</a>
                                                        </td>
                                                    @else
                                                        Not Uploaded
                                                    @endisset

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                @endif
                @if ($history->contacted_via == 'Via Email')
                    <div class="col-lg-6">
                        <div style="min-height: 358.91px;" class="card cta-box bg-danger text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h2 class="my-0"><i class="mdi mdi-email me-1"></i>Email</h2>
                                    </div>
                                    <div class="col-6 text-end">
                                        <i class="mdi mdi-calendar me-1"></i>{{ \Carbon\Carbon::parse($history->email_sent_date)->format('M d Y') }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%"><span class="fw-bold">Email Sender ID </span><br>
                                                        {{ $history->email_sender_id }}
                                                    </td>
                                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Email Receiver ID
                                                        </span><br> {{ $history->email_receiver_id }}
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%"><span class="fw-bold">Email Subject </span><br>
                                                        {{ $history->email_subject }}
                                                    </td>
                                                    <td style="width: 50%" class="text-end"><span class="fw-bold">History Added By
                                                    </span><br> {{ \App\Models\Administrator::find($history->added_by)->firstname.' '.\App\Models\Administrator::find($history->added_by)->lastname ?? "Not Found" }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%"><span class="fw-bold">Email Body
                                                        </span><br>
                                                        {{ $history->email_body ?? "Not Found" }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%"><span class="fw-bold">Email Attachment
                                                        </span><br>
                                                        @isset($history->attachment_email)
                                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/history' . '/' . $history->attachment_email) }}"
                                                                download="{{ $history->attachment_email }}"
                                                                class="btn btn-sm btn-light mt-1"><i
                                                                    class="mdi mdi-download me-1"></i>Download</a>
                                                        </td>
                                                    @else
                                                        Not Uploaded
                                                    @endisset

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                @endif
                @if ($history->contacted_via == 'Via WhatsApp')
                    <div class="col-lg-6">
                        <div style="min-height: 358.91px;" class="card cta-box bg-success text-white">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h2 class="my-0"><i class="mdi mdi-whatsapp me-1"></i>WhatsApp</h2>
                                    </div>
                                    <div class="col-6 text-end">
                                        <i class="mdi mdi-calendar me-1"></i>{{ \Carbon\Carbon::parse($history->message_date)->format('M d Y') }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%"><span class="fw-bold">WhatsApp From </span><br>
                                                        {{ $history->whats_app_from ?? "Not Found" }}</td>
                                                    <td style="width: 50%" class="text-end"><span class="fw-bold">WhatsApp
                                                            To </span><br>{{ $history->whats_app_to ?? "Not Found" }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%"><span class="fw-bold">WhatsApp Message
                                                        </span><br>
                                                        {{ $history->whatsapp_message ?? "Not Found" }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 100%"><span class="fw-bold">WhatsApp Attachment
                                                        </span><br>
                                                        @isset($history->attachment_whatsapp)
                                                            <a href="{{ asset('storage/uploads/leads/' . $lead->id . '/history' . '/' . $history->attachment_whatsapp) }}"
                                                                download="{{ $history->attachment_whatsapp }}"
                                                                class="btn btn-sm btn-light mt-1"><i
                                                                    class="mdi mdi-download me-1"></i>Download</a>
                                                        </td>
                                                    @else
                                                        Not Uploaded
                                                    @endisset

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                @endif
                @if ($history->contacted_via == 'Via Meet')
                    <div class="col-lg-6">
                        <div style="min-height: 358.91px;" class="card cta-box bg-warning text-dark">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h2 class="my-0"><i class="mdi mdi-bullhorn-outline me-1"></i>Meeting</h2>
                                    </div>
                                    <div class="col-6 text-end">
                                        <i class="mdi mdi-clock-outline me-1"></i>{{ \Carbon\Carbon::parse($history->meeting_date)->format('M d Y') }} {{ \Carbon\Carbon::parse($history->meeting_time)->format('h:i A') }}
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <table style="width:100%; margin-bottom:10px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%"><span class="fw-bold">Who Meet </span><br>
                                                        {{ $history->who_meet ?? "Not Found" }}</td>
                                                    <td style="width: 50%" class="text-end"><span class="fw-bold">Whom Meet
                                                        </span><br> {{ $history->whom_meet ?? "Not Found" }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <table style="width:100%; margin-bottom:10px">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50%"><span class="fw-bold">Meeting Location </span><br>
                                                            {{ $history->meeting_location ?? "Not Found" }}</td>
                                                        <td style="width: 50%" class="text-end"><span class="fw-bold">History Added By
                                                            </span><br> {{ \App\Models\Administrator::find($history->added_by)->firstname.' '.\App\Models\Administrator::find($history->added_by)->lastname ?? "Not Found" }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table style="width:100%; margin-bottom:10px">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 100%"><span class="fw-bold">Meeting Discussion
                                                            </span><br>
                                                            {{ $history->meeting_discussion ?? "Not Found" }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                @endif
            @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="text-center py-5">No History Found</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
@endsection
