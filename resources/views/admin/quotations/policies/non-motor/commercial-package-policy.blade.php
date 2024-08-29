<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Commercial Package Policy</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label class="col-form-label" for="business_type">Business Type <span class="text-danger">*</span></label>
                <select name="business_type" id="business_type"
                    class="form-select @error('business_type') is-invalid @enderror" onchange="previousPolicyOption()">
                    <option value="">Choose Business Type</option>
                    <option value="New" {{ old('business_type', isset($quotation->business_type) ? $quotation->business_type : '') == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Roll Over" {{ old('business_type', isset($quotation->business_type) ? $quotation->business_type : '') == 'Roll Over' ? 'selected' : '' }}>Roll Over
                    </option>
                    <option value="Renewal" {{ old('business_type', isset($quotation->business_type) ? $quotation->business_type : '') == 'Renewal' ? 'selected' : '' }}>Renewal</option>
                </select>
               <div class="invalid-feedback business_type_error" style="display: none;">Please choose Business Type</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="sales_executive_id">Sales Executive <span
                        class="text-danger">*</span></label>
                <select name="sales_executive_id" id="sales_executive_id"
                    class="form-select @error('sales_executive_id') is-invalid @enderror">
                    <option value="">Choose Sales Executive</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('sales_executive_id', isset($quotation->sales_executive_id) ? $quotation->sales_executive_id : '') == $user->id ? 'selected' : '' }}>
                            {{ $user->firstname }} {{ $user->lastname }}</option>
                    @endforeach
                </select>
                 <div class="invalid-feedback sales_executive_error" style="display: none;">Please choose Sales Executive</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="service_executive_id">Service Executive <span
                        class="text-danger">*</span></label>
                <select name="service_executive_id" id="service_executive_id"
                    class="form-select @error('service_executive_id') is-invalid @enderror">
                    <option value="">Choose Service Executive</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('service_executive_id', isset($quotation->service_executive_id) ? $quotation->service_executive_id : '') == $user->id ? 'selected' : '' }}>
                            {{ $user->firstname }} {{ $user->lastname }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback service_executive_error" style="display: none;">Please choose Service Executive</div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Risk Occupancy</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="risk_occupancy" class="col-form-label">Risk Occupancy</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Risk Occupancy">
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Safety Features Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Any Basement/Lower Ground Floor Involved</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Any Basement/Lower">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Plinth Height</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Risk Occupancy">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Any Electric Supply Inside the premises</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Any Electric Supply">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">No. of Fire Extinguisher</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="No. of Fire Extinguisher">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">How old Building was</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="How old Building was">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Wheather security Guard present 24*7 Hrs</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Wheather security Guard">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Distance of Nearest water body</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Distance of Nearest water body">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Past Claim History of Last Years</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Past Claim History ">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Any skylights. If yes, Protection for Skylights</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Any skylights">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Burglar Alarm:</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Burglar Alarm">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">CCTV :</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="CCTV">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Any Fire Protection Devidces Installed</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Any Fire Protection">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Policy Period</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="new">From Date<span class="text-danger">*</span></label>
                <input id="" type="date"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Vehicle Registration Date">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="new">To Date<span class="text-danger">*</span></label>
                <input id="" type="date"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Vehicle Registration Date">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Quotation Option</h4>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body bg-light" style="border: 1px solid #403ad72e;">
                <div class="text-end"><a href="#" class="btn btn-sm btn-danger text-end mb-2"><i
                    class="mdi mdi-trash-can me-1"></i>Remove</a></div>

                    <div class="card" style="border: 1px solid #0c0c0c21;
                    background: #02020212 !important;">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Coverage & Sum Insured</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-end"><a href="#" class="btn btn-sm btn-danger text-end mb-2"><i class="mdi mdi-trash-can me-1"></i>Remove Location</a></div>
                            <div class="card">
                                <div class="card-body pt-1">
                                    <h5 style="margin: 0" class="mt-2">Location</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Complete Address</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Enter Complete Address">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">1.) Standard Fire & special perils cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="risk_occupancy" class="col-form-label">Buildingd</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Buildingd">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="risk_occupancy" class="col-form-label">Stock</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Stock">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="risk_occupancy" class="col-form-label">Furniture, Fixtures & Fittings</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Furniture, Fixtures & Fittings">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="risk_occupancy" class="col-form-label">Plant & Machinery</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Plant & Machinery">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="risk_occupancy" class="col-form-label">Electrical Items</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Electrical Items">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="risk_occupancy" class="col-form-label">Other Content</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Other Content">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">2.) Burglary Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Burglary Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Burglary Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">3.) Money Insurance Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="risk_occupancy" class="col-form-label">In Transit</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="In Transit">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="risk_occupancy" class="col-form-label">In Counter</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="In Counter">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="risk_occupancy" class="col-form-label">In Safe</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="In Safe">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">4.) Plate Glass Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Plate Glass Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Plate Glass Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">5.) Machinery Breakdown Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Machinery Breakdown Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Machinery Breakdown Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">6.) Neon Sign Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Neon Sign Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Neon Sign Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">7.) Electronic Equipment Insurance Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Electronic Equipment Insurance Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Electronic Equipment Insurance Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">8.) Fidelity Guarantee</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Fidelity Guarantee</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Fidelity Guarantee">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">9.) Group Personal Accident Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Group Personal Accident Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Group Personal Accident Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">10.) Public Liability Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Public Liability Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Public Liability Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">11.) Workmen Compensation Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Workmen Compensation Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Workmen Compensation Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">12.) Portable Equipment Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Portable Equipment Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Portable Equipment Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">13.) Baggage Insurance Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Baggage Insurance Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Baggage Insurance Cover">
                                        </div>
                                    </div>
                                    <h5 style="margin: 0" class="mt-2">14.) Business Intruption Cover</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="risk_occupancy" class="col-form-label">Business Intruption Cover</label>
                                            <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Business Intruption Cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end"><a href="#" class="btn btn-sm btn-success text-end mb-2"><i class="mdi mdi-plus me-1"></i>Add More Locations</a></div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Premium Details</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="claim">Insurance Company<span class="text-danger">*</span></label>
                                    <select name="claim" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Bajaj Allianz General Insurance Co. Ltd.</option>
                                        <option value="Not Covered">Reliance Nippon Life Insurance Company</option>
                                        <option value="Not Covered">Bharti AXA Life Insurance Co. Ltd.</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="claim">Premium Amount<span class="text-danger">*</span></label>
                                    <input id="previous_financer_name" type="text"
                                        class="form-control business_type_new"
                                        name="previous_financer_name"
                                        value=""
                                        placeholder="Enter Premium Amount">
                                </div>
                                <div class="form-group col-sm-6">

                                </div>
                                <div class="form-group col-sm-6">
                                    <table class="table table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Premium Details</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Net Premium</td>
                                                <td class="text-end">5,000.00</td>
                                            </tr>
                                            <tr>
                                                <td>GST 18%</td>
                                                <td class="text-end">900.00</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gross Premium</strong></td>
                                                <td class="text-end"><strong>5,900.00</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Applicable Excess</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label class="col-form-label">Applicable Excess<span class="text-danger">*</span></label>
                                    <input id="" type="text"
                                    class="form-control" name="registration_date"
                                    value="" placeholder="Enter Building Super Structure">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="text-end"><a href="#" class="btn btn-sm btn-success text-end mb-2"><i
            class="mdi mdi-plus me-1"></i>Add More Option</a></div>
    </div>
</div>

<div class="card">
    <div class="card-footer text-end">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
        <button type="submit" class="btn btn-sm btn-primary" form="quotationForm"><i
                class="mdi mdi-database me-1"></i>Save</button>
    </div>
</div>
