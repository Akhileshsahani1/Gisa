<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Dispatch Policies Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.dispatch.list') }}">
                <div class="row mt-2">

                    <div class="col-sm-12">
                        <label class="col-form-label" for="policy_no">Policy No. </label>
                        <input type="text" class="form-control" id="policy_no" name="policy_no"
                            value="{{ $filter['policy_no'] }}" placeholder="Enter Policy No.">
                    </div>

                    <div class="col-sm-12">
                        <label class="col-form-label" for="customer_id">Customer </label>
                        <select name="customer_id" id="customer_id" class="form-select">
                            <option value="">Choose Customer</option>
                            @foreach ($dispatches as $dispatch)
                                <option
                                    value="{{ isset($filter['customer_id']) ? $filter['customer_id'] : $dispatch->policy?->quotation?->customer_id }}"
                                    {{ old('customer_id') == $dispatch->policy?->quotation?->customer_id ? 'selected' : '' }}>
                                    {{ $dispatch->policy?->quotation?->customer?->firstname }}
                                    {{ $dispatch->policy?->quotation?->customer?->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12">
                        <label for="statusd" class="col-form-label"> Status</label>
                        <select id="statusd" class="form-select" name="status">
                            <option value="">Choose Status</option>
                            <option value="Generated" {{ $filter['status'] == 'Generated' ? 'selected' : '' }}>
                                Generated
                            </option>
                            <option value="Filled" {{ $filter['status'] == 'Filled' ? 'selected' : '' }}>
                                Dispatched
                            </option>
                            <option value="Pending" {{ $filter['status'] == 'Pending' ? 'selected' : '' }}>
                                Pending Dispatch
                            </option>
                        </select>

                    </div>

                    <div class="col-sm-12">
                        <label class="col-form-label" for="created_at">Created On </label>
                        <input type="date" class="form-control" id="created_at" name="created_at"
                            value="{{ $filter['created_at'] }}">
                    </div>

                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.dispatch.list') }}"
                            class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
