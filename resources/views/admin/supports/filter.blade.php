<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Ticket Filter</h5>
    </div>
    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form id="form-filter" action="{{ route('admin.grievance.index') }}">
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label class="col-form-label" for="filter_date_from">Date from</label>
                        <input type="date" class="form-control" id="filter_date_from"  name="filter_date_from" value="{{ $filter_date_from}}" class="form-control" placeholder="Select Date">
                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label" for="filter_date_to">Date to</label>
                        <input type="date" class="form-control" id="filter_date_to" name="filter_date_to" value="{{ $filter_date_to}}" class="form-control" placeholder="Select Date">
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label class="col-form-label" for="filter_status">Status</label>
                        <select class="form-select" name="filter_status">
                        <option value="">Select Status</option>
                        <option @if (@$filter_status == '0') selected @endif value="0">Open</option>
                        <option @if (@$filter_status == '1') selected @endif value="1">Closed</option>
                        </select>
                    </div>
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary" id="filter">Filter</button>
                        <a href="{{ route('admin.grievance.index') }}" class="btn btn-sm btn-dark ms-1" id="reset-filter">Reset Filter</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="rightbar-overlay"></div>
