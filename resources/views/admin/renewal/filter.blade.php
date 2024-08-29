<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Renewal Policies Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.renewal.list') }}">
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
                            @foreach ($renewals as $renewal)
                                <option
                                    value="{{ isset($filter['customer_id']) ? $filter['customer_id'] : $renewal->customer?->id }}"
                                    {{ old('customer_id') == $renewal->customer?->id ? 'selected' : '' }}>
                                    {{ $renewal->customer?->firstname }}
                                    {{ $renewal->customer?->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12">
                        <label for="statusd" class="col-form-label"> Status</label>

                        <select id="status1" class="form-select" name="status">
                          <option value="">Choose Renewal Status
                            </option>
                            <option value="New" {{$filter['status']=='New'?'selected':''}}>New
                            </option>
                            <option value="Contacted" {{$filter['status']=='Contacted'?'selected':''}}>
                                Contacted
                            </option>
                            <option value="Nurturing" {{$filter['status']=='Nurturing'?'selected':''}}>
                                Nurturing
                            </option>
                            <option value="Qualified"  {{$filter['status']=='Qualified'?'selected':''}}>
                                Qualified
                            </option>
                            <option value="Unqualified" {{$filter['status']=='Unqualified'?'selected':''}}>
                                Unqualified
                            </option>
                              <option value="Pending" {{ $filter['status'] == 'Pending' ? 'selected' : '' }}>
                                Pending 
                            </option>
                        </select>

                    </div>

                    <div class="col-sm-12">
                        <label class="col-form-label" for="exp_date">Policy Expire Date </label>
                        <input type="date" class="form-control" id="exp_date" name="exp_date"
                            value="{{ $filter['exp_date'] }}">
                    </div>

                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.renewal.list') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->
