@extends('layouts.admin')
@section('title', 'Show Customer')
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
                        @can('Edit Expense')
                        <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="btn btn-sm btn-primary  me-1"><i
                                class="mdi mdi-pencil me-1"></i>Edit</a>
                        @endcan
                        @can('Delete Expense')
                        <a href="javascript:void(0)" onclick="confirmDelete({{ $expense->id }})"
                            class="btn btn-sm btn-danger"><i class="mdi mdi-delete"></i>Delete</a>
                        @endcan
                        <form id='delete-form{{ $expense->id }}'
                            action='{{ route('admin.expenses.destroy', $expense->id) }}' method='POST'>
                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                            <input type='hidden' name='_method' value='DELETE'>
                        </form>
                    </div>
                    <h4 class="page-title">Customer Details</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Category </span><br>
                                        {{ $expense->expenseCategory->category }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Name </span><br>
                                        {{ $expense->name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Note </span><br>
                                        {{ $expense->note }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Date </span><br>
                                        {{ $expense->date }}</td>
                                    <td style="width: 50%"><span class="fw-bold">Amount </span><br>
                                        {{ $expense->amount }}</td>
                                </tr>
                            </tbody>
                        </table>


                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 50%"><span class="fw-bold">Payment Mode </span><br>
                                         {{ $expense->mode }}
                                    </td>
                                    <td style="width: 50%"><span class="fw-bold">Refrence </span><br> {{ $expense->reference }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%; margin-bottom:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 100%"><span class="fw-bold">Customer</span><br>
                                        {{ $expense->customer->firstname }} {{ $expense->customer->lastname }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Uploaded Documents</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if (isset($expense->attachment))
                                @isset($expense->attachment)
                                    <div class="card my-1 shadow-none border">
                                        <div class="ps-1">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    Attachmnet
                                                </div>
                                                <div class="col text-end">
                                                    <!-- Button -->
                                                    <a href="{{ asset('storage/uploads/expenses/' . $expense->id . '/documents' . '/' . $expense->attachment) }}"
                                                        download="{{ $expense->date . ' ' . $expense->name . ' ' . $expense->mode }}: attachment"
                                                        class="btn btn-primary text-white text-muted">
                                                        <i class="dripicons-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                
                            @else
                                <p class="text-center py-4">No Documents Uploaded</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
