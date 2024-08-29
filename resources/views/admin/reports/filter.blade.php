<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Policy Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.reports.index') }}">
                <div class="row">   

                    <div class="col-sm-12">
                        <label class="col-form-label" for="date">Date</label>
                        <input type="date" class="form-control" id="date"  name="date" value="{{ request()->date}}" class="form-control" placeholder="Select Date">
                    </div>

                    <div class="col-sm-12">
                        <label class="col-form-label" for="date_from">Date from</label>
                        <input type="date" class="form-control" id="date_from"  name="date_from" value="{{ request()->date_from}}" class="form-control" placeholder="Select Date">
                    </div>

                    <div class="col-sm-12">
                        <label class="col-form-label" for="date_to">Date to</label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request()->date_to}}" class="form-control" placeholder="Select Date">
                    </div>      


                    <div class="col-sm-12">
                        <label for="product" class="col-form-label">Product Name</label>

                        <select name="product" id="product" class="form-select select2">
                            <option value="" selected>Please Select Product</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}"  {{ (request()->get('product') ==  $product->id) ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>

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

                     <div class="col-sm-12">
                        <label for="company" class="col-form-label">Company Name</label>

                        <select name="company" id="company" class="form-select select2">
                            <option value="" selected>Please Select Company</option>
                            @foreach($companies as $company)
                            <option value="{{ $company->id }}"  {{ (request()->get('company') ==  $company->id) ? 'selected' : '' }}>{{ $company->company }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-sm-12 mb-2 text-end" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->