<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Receipts Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.receipts.index') }}">
                    <div class="col-sm-12">
                        <label for="mode" class="col-form-label">Payment Mode</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Payment Mode"
                            id="mode" name="mode" value="{{ $filter['mode'] }}">
                    </div>

                    <div class="col-sm-12">
                        <label for="transaction_id" class="col-form-label">Transaction ID </label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Payment Mode"
                            id="transaction_id" name="transaction_id" value="{{ $filter['transaction_id'] }}">
                    </div>

                    <div class="col-sm-12">
                        <label for="customer" class="col-form-label">Customer Name</label>

                        <select name="customer" id="customer" class="form-select select2">
                            <option value="" selected>Please Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}"  {{ (request()->get('customer') ==  $customer->id) ? 'selected' : '' }}>{{ $customer->firstname }} {{ $customer->lastname }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.receipts.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
