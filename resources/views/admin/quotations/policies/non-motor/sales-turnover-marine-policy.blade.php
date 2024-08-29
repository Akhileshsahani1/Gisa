<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Sales Turnover Marine Policy</h4>
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
        <h4 class="card-title">Risk and Coverage Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Policy Period<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Policy Period">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Cargo Description<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Cargo Description">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Packing Description<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Packing Description">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Mode of Transit<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Mode of Transit">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Sum Insured Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Total Sales<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Total Sales">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Extra 10%<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Extra 10%">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Capital goods<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Capital goods">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">Total Sum Insured<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Total Sum Insured">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Journey Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">From<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter From">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="business_type">To<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter To">
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Voyage and Basis of Valuation Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
                <table>
            <tr>
                <th>Transit Type</th>
                <th>Transit Covered From</th>
                <th>Transit Covered To</th>
                <th>Basis of Valuation</th>
                <th>Sum Insured</th>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            <tr>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Type"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered From"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Transit Covered To"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Basis of Valuation"></td>
                <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Sum Insured"></td>
            </tr>
            </table>
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

                        <div class="card">
                            <div class="card-header bg-secondary text-white pb-0">
                                <h4 class="card-title">Limits</h4>
                            </div>
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Per Sending Limit (IN INR)<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Per Sending Limit (IN INR)">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Per Location Limit (IN INR)<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Per Location Limit (IN INR)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Coverage Details</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="business_type">Coverage Details<span class="text-danger">*</span></label>
                                    <input id="" type="text" class="form-control" value="" placeholder="Enter Coverage Details">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="business_type">Capacity<span class="text-danger">*</span></label>
                                    <input id="" type="text" class="form-control" value="" placeholder="Enter Capacity">
                                </div>
                            </div>
                        </div>
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
                                    value="" placeholder="Enter Application Excess">
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
