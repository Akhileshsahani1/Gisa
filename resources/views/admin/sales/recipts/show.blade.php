@extends('layouts.admin')
@section('title', 'View Receipt')
@section('head')
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>

                    </div>
                    <h4 class="page-title">Verify Payment</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <form id="leadForm" method="POST" action="{{ route('admin.receipts.update', $recipt->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Payment Receipt</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped dt-responsive nowrap mb-0">
                                <tbody>
                                    <tr role="row">
                                        <td class="table-user">Payment Date</td>
                                        <td class="text-end">{{ $recipt->date }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Payment Mode</td>
                                        <td class="text-end">{{ $recipt->mode }}</td>
                                    </tr>

                                    <tr role="row">
                                        <td class="table-user">Transaction ID</td>
                                        <td class="text-end">{{ $recipt->transactionId }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td colspan="2" style="background-color: #222; text-align: center; color:#fff" class="table-user">Total Amount <br>₹{{ $recipt->amount }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <a href="#" class="btn btn-sm btn-success"><i class="mdi mdi mdi-download me-1"></i>Download Receipt</a>
                                </div>
                                <h4 class="page-title">Payment For</h4>
                            </div>
                            <table class="table table-bordered dt-responsive nowrap mb-2">
                                <thead class="bg-primery">
                                    <tr role="row">
                                        <th >Receipt No</th>
                                        <th >Receipt Date</th>
                                        <th >Receipt Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row">
                                        <td >#{{ $recipt->id }}</td>
                                        <td >{{ $recipt->date }}</td>
                                        <td >₹{{ $recipt->amount }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Payment Verification</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label text-md-end" for="date">Date</label>
                                    <input type="date" name="date" value="{{ old('date', $recipt->date) }}" id="date" class="form-control" placeholder="Date"
                                        required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label text-md-end" for="amount">Amount</label>
                                    <input type="number" name="amount" value="{{ old('amount', $recipt->amount) }}" id="amount" class="form-control"
                                        placeholder="Enter Amount" step="any" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label text-md-end" for="mode">Payment Mode</label>
                                    <input type="text" name="mode" value="{{ old('mode', $recipt->mode) }}" id="mode" class="form-control"
                                        placeholder="Enter Payment Mode" required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label text-md-end" for="transactionId">Transaction ID</label>
                                    <input type="text" name="transactionId" value="{{ old('transactionId', $recipt->transactionId) }}" id="edit_transaction_id" class="form-control"
                                        placeholder="Enter Transaction ID" required>
                                </div>

                                @if(auth()->user()->hasRole('Account') || auth()->user()->hasRole('Admin'))
                                @can('Approve Payment Receipt')
                                <div class="form-group col-sm-12">
                                    <label for="status" class="col-form-label">Status <span  class="text-danger">*</span></label>
                                    <select id="payment-status" class="form-select @error('status') is-invalid @enderror"
                                        name="status" autofocus>
                                        <option value="">Choose Payment Status</option>
                                        <option value="Approve"
                                            {{ old('status', $recipt->status) == 'Approve' ? 'selected' : '' }}>Approve
                                        </option>
                                        <option value="Unapprove"
                                            {{ old('status', $recipt->status) == 'Unapprove' ? 'selected' : '' }}>Unapprove
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                @endcan
                                @endif
                                <div class="col-sm-12 mt-2">
                                    <button type="submit" class="btn btn-primary w-100" form="leadForm"></i>Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title">Customer Information</h4>
                        </div>
                        <div class="card-body">
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Customer Type </span><br>
                                            {{ $recipt->customer->customer_type }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Customer Source </span><br>
                                            {{ $recipt->customer->source }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Customer Name </span><br>
                                            {{ $recipt->customer->salutation }} {{ $recipt->customer->firstname }} {{ $recipt->customer->lastname }}
                                        </td>
                                        <td style="width: 50%"><span class="fw-bold">Gender </span><br> {{ $recipt->customer->gender }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Phone Number </span><br>
                                            {{ $recipt->customer->phone }}</td>
                                        <td style="width: 50%"><span class="fw-bold">WhatsApp Number </span><br>
                                            {{ $recipt->customer->whats_app }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Email </span><br> {{ $recipt->customer->email }}
                                        </td>
                                        <td style="width: 50%"><span class="fw-bold">Address </span><br>
                                            {{ $recipt->customer->address }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Date of Birth </span><br>
                                            {{ $recipt->customer->date_of_birth ?? "Not Found" }}</td>
                                        <td style="width: 50%"><span class="fw-bold">Date of Anniversary </span><br>
                                            {{ $recipt->customer->date_of_anniversary ?? "Not Found" }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%"><span class="fw-bold">Pan No. </span><br>
                                            {{ $recipt->customer->pan_no ?? "Not Found" }}</td>
                                        <td style="width: 50%"><span class="fw-bold">GST No. </span><br>
                                            {{ $recipt->customer->gst_no ?? "Not Found" }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table style="width:100%; margin-bottom:10px">
                                <tbody>
                                    <tr>
                                        <td style="width: 100%"><span class="fw-bold">Created On </span><br>
                                            {{ $recipt->customer->created_at->format('M d, Y h:i:A') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')

@endpush
