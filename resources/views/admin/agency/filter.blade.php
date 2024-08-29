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
            <form action="{{ route('admin.policies.index') }}">
                <div class="row">
                    <div class="col-sm-12 my-2">
                        <label for="name">Policy Name</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Filter by Name" id="name" name="name" value="{{ $filter['name'] }}">
                    </div>              
                    <div class="col-sm-12 mb-2">
                        <label for="enabled">Enabled</label>
                        <select name="enabled" id="enabled" class="form-select form-control-sm">
                            <option value="">All</option>
                            <option value="1" {{ $filter['enabled'] == "1" ? "selected" : "" }}>Yes</option>
                            <option value="0" {{ $filter['enabled'] == "0" ? "selected" : "" }}>No</option>
                        </select>
                    </div>
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.policies.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
