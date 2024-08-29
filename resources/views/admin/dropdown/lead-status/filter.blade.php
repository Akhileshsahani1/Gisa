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
            <form action="{{ route('admin.lead-status.index') }}">
                <input type="hidden" name="type" value="{{ Request::get('type') }}">
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label for="name" class="col-form-label">Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Name"
                            id="name" name="name" value="{{ $filter['name'] }}">
                    </div>
                    
                    <div class="col-sm-12">
                        <label for="status" class="col-form-label">status</label>
                        <select class="form-select" name="status" autofocus>
                            <option value="">Choose status</option>
                            <option value="1" {{ $filter['status'] == '1' ? 'selected' : '' }}>Enabled
                            </option>
                            <option value="0" {{ $filter['status'] == '0' ? 'selected' : '' }}>Disabled
                            </option>
                        </select>

                    </div>

                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
