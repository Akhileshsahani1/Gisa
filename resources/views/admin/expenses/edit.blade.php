@extends('layouts.admin')
@section('title', 'Edit Expense')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="productForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                    <h4 class="page-title">Edit Expense</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->

    <div class="row">
        <div class="col-12">
            <form id="expenseForm" method="POST" action="{{ route('admin.expenses.update', $expense->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="name">Expense Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Expense Name" value="{{ old('lastname', isset($expense) ? $expense->name : '') }}" autofocus>
                                @error('name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6">
                                <label for="attachment" class="col-form-label">Upload Attachment </label>
                                <input id="attachment" type="file"
                                    class="form-control @error('attachment') is-invalid @enderror" name="attachment">
                                @error('attachment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                @isset($expense->attachment)
                                    <div class="card my-1 shadow-none border">
                                        <div class="ps-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    Attachment
                                                </div>
                                                <div class="col text-end">
                                                    <!-- Button -->
                                                    <a href="{{ asset('storage/uploads/expenses/' . $expense->id . '/documents' . '/' . $expense->attachment) }}"
                                                        download="{{ $expense->date.' '.$expense->name.' '. $expense->mode}}: Pan Card" class="btn btn-primary text-white text-muted">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endisset

                            </div>

                            <div class="col-sm-12 {{ $errors->has('note') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="name">Note </label>
                               <textarea id="note" class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Enter Customer note">{{ old('note', isset($expense) ? $expense->note : '') }}</textarea>
                                @error('note')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-sm-6 {{ $errors->has('expense_category_id') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="expense_category_id">Expense Category<span
                                        class="text-danger">*</span></label>
                                <select name="expense_category_id" id="expense_category_id" class="form-select">
                                    <option value="">Please Select Expense Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('expense_category_id', isset($expense) ? $expense->expense_category_id : '') == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                @error('expense_category_id')
                                    <span id="expense_category_id-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-sm-6 {{ $errors->has('customer_id') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="customer_id">Customer<span
                                        class="text-danger"></span></label>
                                <select name="customer_id" id="customer_id" class="form-select select2">
                                    <option value="" selected>Please Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"  {{ old('customer_id', isset($expense) ? $expense->customer_id : '') ==  $customer->id ? 'selected' : '' }}>{{ $customer->firstname }} {{ $customer->lastname }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <span id="customer_id-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="date" class="col-form-label">Date <span
                                        class="text-danger">*</span></label>
                                <input id="date" type="date"
                                    class="form-control @error('date') is-invalid @enderror" name="date"
                                    value="{{ old('date', isset($expense) ? $expense->date : '') }}">
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="amount" class="col-form-label">Amount<span
                                        class="text-danger">*</span></label>
                                <input id="amount" type="number"
                                    class="form-control business_type_new @error('amount') is-invalid @enderror"
                                    name="amount"
                                    value="{{ old('amount', isset($expense) ? $expense->amount : '') }}"
                                    placeholder="Amount">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="col-sm-6 {{ $errors->has('mode') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="mode">Payment Mode <span
                                        class="text-danger"></span></label>
                                <input type="text" class="form-control" id="mode" name="mode"
                                    placeholder="Enter Payment Mode" value="{{ old('mode', isset($expense) ? $expense->mode : '') }}" autofocus>
                                @error('mode')
                                    <span id="mode-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-sm-6 {{ $errors->has('reference') ? 'has-error' : '' }}">
                                <label class="col-form-label" for="reference">Reference # <span
                                        class="text-danger"></span></label>
                                <input type="text" class="form-control" id="reference" name="reference"
                                    placeholder="Enter Reference #" value="{{ old('reference', isset($expense) ? $expense->reference : '') }}" autofocus>
                                @error('reference')
                                    <span id="reference-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
                        <button type="submit" class="btn btn-sm btn-primary" form="expenseForm"><i
                                class="mdi mdi-database me-1"></i>Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
