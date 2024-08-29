@extends('layouts.admin')
@section('title', 'Import Lead')
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
                    <h4 class="page-title">Import Lead</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <form id="importForm" method="POST" action="{{ route('admin.leads.import') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="file" class="form-label">Choose File to Import</label>
                                    <input type="file" id="file" class="form-control" name="file">
                                    @error('file')
                                        <span id="file-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="file" class="form-label mt-2"><a
                                            href="{{ asset('assets/workbook/lead-workbook.xlsx') }}"
                                            download="Lead Worksheet">Click here</a> to download sample Lead
                                        Worsheet.</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-grid">
                            <button type="submit" class="btn btn-sm btn-success" form="importForm"><i
                                    class="mdi mdi-download me-1"></i>Import</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
