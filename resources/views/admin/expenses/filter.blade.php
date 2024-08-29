<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Expences Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.expenses.index') }}">
                    <div class="col-sm-12">
                        <label for="name" class="col-form-label">Expense Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Name"
                            id="name" name="name" value="{{ $filter['name'] }}">
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
                        <a href="{{ route('admin.expenses.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
