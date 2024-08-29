<!-- Right Sidebar -->
<div class="end-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Lead Filter</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar>
        <div class="container">
            <form action="{{ route('admin.leads.index') }}">
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label for="lead_type" class="col-form-label">Lead Type</label>
                        <select id="lead_type" class="form-select" name="lead_type">
                            <option value="">Choose Lead Type</option>
                            <option value="Retail" {{ $filter['lead_type'] == 'Retail' ? 'selected' : '' }}>Retail
                            </option>
                            <option value="SME" {{ $filter['lead_type'] == 'SME' ? 'selected' : '' }}>SME
                            </option>
                            <option value="Corporate" {{ $filter['lead_type'] == 'Corporate' ? 'selected' : '' }}>
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
                    <div class="col-sm-12">
                        <label for="lead_status" class="col-form-label">Lead Status</label>
                        <select id="lead_status" class="form-select" name="lead_status">
                            <option value="">Choose Lead Status</option>
                            <option value="New" {{ $filter['lead_status'] == 'New' ? 'selected' : '' }}>New
                            </option>
                            <option value="Contacted" {{ $filter['lead_status'] == 'Contacted' ? 'selected' : '' }}>
                                Contacted
                            </option>
                            <option value="Nurturing" {{ $filter['lead_status'] == 'Nurturing' ? 'selected' : '' }}>
                                Nurturing
                            </option>
                            <option value="Qualified" {{ $filter['lead_status'] == 'Qualified' ? 'selected' : '' }}>
                                Qualified
                            </option>
                            <option value="Unqualified"
                                {{ $filter['lead_status'] == 'Unqualified' ? 'selected' : '' }}>
                                Unqualified
                            </option>
                        </select>

                    </div>
                    <div class="col-sm-12">
                        <label for="lead_source" class="col-form-label">Lead Source</label>
                        <input id="lead_source" type="text" class="form-control" name="lead_source"
                            value="{{ $filter['lead_source'] }}" placeholder="Enter Lead Source">
                    </div>
                    <div class="col-sm-12">
                        <label for="assigned_to" class="col-form-label">Assigned To </label>
                        <select id="assigned_to" class="form-select" name="assigned_to">
                            <option value="">Choose User</option>
                            @foreach ($users as $user)
                                @php
                                    $filteredId = isset($filter[$user->id]) ? $filter[$user->id] : $user->id;
                                @endphp
                                <option value="{{ $filteredId }}"
                                    {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endforeach
                        </select>

                    </div>


                    <div class="col-sm-12">
                        <label class="col-form-label" for="policy_id">Type of Product </label>
                        <select name="policy_id" id="policy_id" class="form-select" onchange="getProductType()">
                            <option value="">Choose Product</option>
                            @foreach ($policies as $policy)
                                <option value="{{ isset($filter['policy_id']) ? $filter['policy_id'] : $policy->id }}"
                                    {{ old('policy_id') == $policy->id ? 'selected' : '' }}>
                                    {{ $policy->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label class="col-form-label" for="policy_type_id">Type of Insurance Policy </label>
                        <select name="policy_type_id" id="policy_type_id" class="form-select">
                            <option value="">Choose Policy Type</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label" for="created_at">Created On </label>
                        <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $filter['created_at'] }}">
                    </div>
                    <div class="col-sm-12">
                        <label for="by_time" class="col-form-label">By Time</label>
                        <select id="by_time" class="form-select" name="by_time">
                            <option value="">All</option>
                            <option value="This Week" {{ $filter['by_time'] == 'This Week' ? 'selected' : '' }}>This Week</option>
                            <option value="This Month" {{ $filter['by_time'] == 'This Month' ? 'selected' : '' }}>This Month</option>                           
                        </select>

                    </div>
                    <div class="col-sm-12 mb-2 text-end">
                        <button type="submit" class="btn btn-sm btn-secondary">Filter</button>
                        <a href="{{ route('admin.leads.index') }}" class="btn btn-sm btn-dark ms-1">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /Right-bar -->

