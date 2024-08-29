<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">{{ $title }} Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.quotations.index') }}">
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label for="customer_type" class="col-form-label">Customer Type</label>
                        <select id="customer_type" class="form-select" name="customer_type">
                            <option value="">Choose Customer Type</option>
                            <option value="Retail" {{ $filter['customer_type'] == 'Retail' ? 'selected' : '' }}>Retail
                            </option>
                            <option value="SME" {{ $filter['customer_type'] == 'SME' ? 'selected' : '' }}>SME
                            </option>
                            <option value="Corporate" {{ $filter['customer_type'] == 'Corporate' ? 'selected' : '' }}>
                                Corporate
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="name" class="col-form-label">Customer Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Name"
                            id="name" name="name" value="{{ $filter['name'] }}">
                    </div>
                    <div class="col-sm-12">
                        <label for="pan_no" class="col-form-label">Pan No.</label>
                        <input id="pan_no" type="text" class="form-control" name="pan_no"
                            value="{{ $filter['pan_no'] }}" placeholder="Enter Customer Pan No">
                    </div>
                    <div class="col-sm-12">
                        <label for="gst_no" class="col-form-label">GST No.</label>
                        <input id="gst_no" type="text" class="form-control" name="gst_no"
                            value="{{ $filter['gst_no'] }}" placeholder="Enter Customer gst_no">
                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label" for="phone">Phone Number </label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            placeholder="Enter Phone Number" value="{{ $filter['phone'] }}">
                    </div>

                    <div class="col-sm-12">
                        <label class="col-form-label" for="whats_app">WhatsApp Number</label>
                        <input type="text" class="form-control" id="whats_app" name="whats_app"
                            placeholder="Enter WhatsApp Number" value="{{ $filter['whats_app'] }}">
                    </div>
                    <div class="col-sm-12">
                        <label for="name">Email</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Name"
                            id="name" name="email" value="{{ $filter['email'] }}">
                    </div>
                    <div class="col-sm-12">
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" class="form-select" name="gender" autofocus>
                            <option value="">Choose Customer Gender</option>
                            <option value="Male" {{ $filter['gender'] == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ $filter['gender'] == 'Female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="Other" {{ $filter['gender'] == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>

                    </div>

                    <div class="col-sm-12">
                        <label for="address" class="col-form-label">Address</label>
                        <input id="address" type="text" class="form-control" name="address"
                            value="{{ $filter['address'] }}" placeholder="Enter Customer Address">
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label for="source" class="col-form-label">Customer Source</label>
                        <input id="source" type="text" class="form-control" name="source"
                            value="{{ $filter['source'] }}" placeholder="Enter Customer Source">
                    </div>

                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.quotations.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
