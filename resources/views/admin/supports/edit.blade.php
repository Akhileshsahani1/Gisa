@extends('layouts.admin')
@section('title', 'Show Ticket')
@section('head')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
    /* Style the dropdown container */
    .dropdown {
      position: relative;
      display: inline-block;
    }

    /* Style the input field */


    /* Style the dropdown list */
    .dropdown-list {
      position: absolute;
      display: none;
      z-index: 1;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-y: auto;
      width: 100%;
    }

    /* Style list items */
    .dropdown-list-item {
      padding: 8px;
      cursor: pointer;
    }

    /* Highlight the selected item */
    .dropdown-list-item:hover {
      background-color: #ddd;
    }
  </style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="page-title-right">

                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                        class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary" form="ticketForm" onclick="createDisabled();" id="ticketCreateDisabled"><i
                        class="mdi mdi-database me-1"></i>Update</button>
                </div>
                <h4 class="page-title">Edit Ticket</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.grievance.update', $ticket->id) }}" method="POST" id="ticketForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="col-form-label" for="subject">Subject*</label>
                                <input type="text" id="subject" class="form-control" placeholder="Subject" name="subject"
                                    value="{{ old('subject', $ticket->subject) }}" readonly>
                                @error('subject')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label" for="description">Description*</label>
                                <textarea type="text" id="description" class="form-control" rows="4"
                                    placeholder="Please explain about issue here" name="description" readonly>{{ old('description', $ticket->description) }}</textarea>
                                @error('description')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label class="col-form-label" for="priority">Priority*</label>
                                <select name="priority" id="priority" class="form-select" disabled>
                                    <option value="">Please Select</option>
                                    <option value="High" {{ old('priority', $ticket->priority == 'High' ? 'selected' : '') }}>
                                        High</option>
                                    <option value="Low" {{ old('priority', $ticket->priority == 'Low' ? 'selected' : '') }}>
                                        Low</option>
                                    <option value="Medium"
                                        {{ old('priority', $ticket->priority == 'Medium' ? 'selected' : '') }}>Medium</option>
                                </select>
                                @error('priority')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            @isset($ticket->attachment)
                                <div class="col-sm-6">
                                    <label class="col-form-label" for="attachment">Attachment</label>

                                    <ul class="list-group mt-2">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $ticket->attachment }}
                                            <a href="{{ asset('storage/uploads/customers/tickets/' . $ticket->customer_id . '/' . $ticket->attachment) }}"
                                                class="btn btn-sm btn-warning" download><i class="fas fa-download"></i></a>
                                        </li>
                                    </ul>

                                </div>
                            @else
                                <div class="col-sm-6">
                                    <label class="col-form-label" for="attachment">Attachment</label>
                                    <input type="text" class="form-control" value="Not added">
                                </div>
                            @endisset

                            <div class="col-sm-6">
                                <label class="col-form-label" for="statusId">Status*</label>
                                <select name="status" id="statusId" class="form-select" onchange="showdropClose();">
                                    <option value="" {{ old('status', $ticket->status == 0 ? 'selected' : '') }}>Please Select</option>
                                    <option value="0">Open
                                    </option>
                                    <option value="1" {{ old('status', $ticket->status == 1 ? 'selected' : '') }}>Close
                                    </option>
                                </select>
                                @error('status')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-sm-6" id="closeStatusDiv">
                                <label class="col-form-label" for="closeStatus">Close Status*</label>
                                <select name="closeStatus" id="closeStatus" class="form-select">
                                    <option value="">Please Select</option>
                                    <option value="1">Successfull closed
                                    </option>
                                    <option value="0">Unsuccessfull closed
                                    </option>
                                </select>
                                @error('closeStatus')
                                    <span id="subject-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@endpush
<script>

    // document.addEventListener('DOMContentLoaded', function() {
    //     var myDiv = document.getElementById('closeStatus');
    //     myDiv.style.display = 'none';
    // });

    function showdropClose() {
        var value = $('#statusId').val();
        if (value == '1') {
            console.log('sfdgdgf');
            $('#closeStatusDiv').show();
        } else {
            $('#closeStatusDiv').hide();
        }
}


</script>
