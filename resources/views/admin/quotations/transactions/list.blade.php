@extends('layouts.admin')
@section('title', 'Transactions')
@section('content')
    <div class="container-fluid mt-4">
        @include('admin.includes.flash-message')
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-start">{{ __('Transactions') }}</h3>

                        <a href="javascript:void(0)" class="btn btn-sm btn-success float-end" data-bs-toggle="modal"
                            data-bs-target="#modal-transaction"><i class="fe fe-plus btn-icon"></i>Add</a>

                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark float-end me-1">
                            <i class="fa fa-chevrons-left btn-icon"></i>Back</a>
                            @if( $quotation->status == 'Accepted' )
                        <button class="btn btn-sm btn-danger float-end me-2">Balance:
                            ₹{{ !is_null(motor_form($quotation?->id,'selected_insurance_amount')) ? number_format(motor_form($quotation?->id,'selected_insurance_amount') - $quotation?->transactions?->sum('amount'), 2) : '' }}</button>
                        <button class="btn btn-sm btn-success float-end me-1">Paid:
                            ₹{{ number_format($quotation?->transactions?->sum('amount'), 2) }}</button>
                        <button class="btn btn-sm btn-info float-end me-1">Total:
                            ₹{{ !is_null(motor_form($quotation?->id,'selected_insurance_amount')) ? number_format(motor_form($quotation?->id,'selected_insurance_amount'), 2) : '' }}</button>
                        @else
                        <button class="btn btn-sm btn-warning float-end me-1">Not Accepted</button>
                        @endif
                    </div>
                    <div class="card-body">

                        <table id="transactionsDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Mode</th>
                                    <th>Transaction Id</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                                        <td>₹{{ $transaction->amount }}</td>
                                        <td>{{ ucfirst($transaction->mode) }}</td>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>
                                            <div class="btn-group">

                                                    <a href="javascript:void(0)" class="btn btn-warning edit-transaction"
                                                        data-bs-toggle="modal" data-bs-target="#modal-edit-transaction"
                                                        data-id="{{ $transaction->id }}" data-date="{{ $transaction->date }}"
                                                        data-amount="{{ $transaction->amount }}"
                                                        data-mode="{{ $transaction->mode }}"
                                                        data-transaction="{{ $transaction->transaction_id }}"><i
                                                            class="mdi mdi-pen"></i>Edit</a>

                                                    <button type="button" onclick="confirmDelete('{{ $transaction->id }}')"
                                                        class="btn btn-danger"><i class="mdi mdi-trash"></i> Delete</button>
                                                    <form id='delete-form{{ $transaction->id }}' action='{{ route('admin.quotation-transaction.delete', $transaction->id) }}'
                                                        method='POST'>
                                                        <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                                    </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-transaction">
        <div class="modal-dialog modal-transaction">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Transaction</h4>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="transactionForm" action="{{ route('admin.quotation-transactions.store') }}">
                        @csrf
                        <input type="hidden" name="quotation_id" value="{{ $quotation?->id }}">
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Date"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="amount">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control"
                                placeholder="Enter Amount"
                                value="{{ (motor_form($quotation?->id,'selected_insurance_amount')) != '' && (motor_form($quotation?->id,'selected_insurance_amount')) != 'N/A' ? ( number_format(motor_form($quotation?->id,'selected_insurance_amount') - (int)$quotation?->transactions?->sum('amount'), 2) ) : '' }}" 
                                required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="mode">Payment Mode</label>
                            <input type="text" name="mode" id="mode" class="form-control"
                                placeholder="Enter Payment Mode" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="transaction_id">Transaction ID</label>
                            <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                                placeholder="Enter Transaction ID" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="transactionForm">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit-transaction">
        <div class="modal-dialog modal-edit-transaction">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Transaction</h4>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="updatetransactionForm" action="{{ route('admin.quotation-transactions.edit') }}">
                        @csrf
                        <input type="hidden" name="quotation_id" value="{{ $quotation?->id }}">
                        <input type="hidden" value="" name="id" id="transction_id">
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="edit_date">Date</label>
                            <input type="date" name="date" id="edit_date" class="form-control" placeholder="Date"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="edit_amount">Amount</label>
                            <input type="number" name="amount" id="edit_amount" class="form-control"
                                placeholder="Enter Amount" step="any" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="edit_mode">Payment Mode</label>
                            <input type="text" name="mode" id="edit_mode" class="form-control"
                                placeholder="Enter Payment Mode" required>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label text-md-end" for="edit_transaction_id">Transaction ID</label>
                            <input type="text" name="transaction_id" id="edit_transaction_id" class="form-control"
                                placeholder="Enter Transaction ID" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="updatetransactionForm">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(function() {
            $("#transactionsDataTable").DataTable({
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "processing": true,
                "serverSide": false,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": true,
                "language": {
                    searchPlaceholder: "Search all columns here"
                }
            }).buttons().container().appendTo('#transactionsDataTable_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        function confirmDelete(no) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Delete it!"
            }).then(t => {
                t.isConfirmed && document.getElementById("delete-form" + no).submit()
            })
        }
    </script>
    <script>
        $(".edit-transaction").click(function() {
            var id = $(this).data('id');
            var date = $(this).data('date');
            var amount = $(this).data('amount');
            var mode = $(this).data('mode');
            var transaction = $(this).data('transaction');
            $('#edit_date').val(date);
            $("#edit_amount").val(amount).change();
            $('#edit_mode').val(mode);
            $('#edit_transaction_id').val(transaction);
            $('#transction_id').val(id);
        });
    </script>
@endpush
