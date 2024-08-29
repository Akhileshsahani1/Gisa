<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Marine Cargo Policy</h4>
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
                <label for="previous_policy_no" class="col-form-label">Risk Incepption Date</label>
                <input id="previous_policy_no" type="date"
                    class="form-control business_type_new @error('previous_policy_no') is-invalid @enderror"
                    name="previous_policy_no"
                    placeholder="Risk Incepption Date">
            </div>
            <div class="form-group col-sm-6">
                <label for="previous_policy_no" class="col-form-label">Risk Category</label>
                <input id="previous_policy_no" type="text"
                    class="form-control business_type_new @error('previous_policy_no') is-invalid @enderror"
                    name="previous_policy_no"
                    placeholder="Risk Category">
            </div>
            <div class="form-group col-sm-6">
                <label for="previous_policy_no" class="col-form-label">Cargo Description</label>
                <input id="previous_policy_no" type="text"
                    class="form-control business_type_new @error('previous_policy_no') is-invalid @enderror"
                    name="previous_policy_no"
                    placeholder=" Enter Cargo Description">
            </div>
            <div class="form-group col-sm-6">
                <label for="previous_policy_no" class="col-form-label">Packing Details</label>
                <input id="previous_policy_no" type="text"
                    class="form-control business_type_new @error('previous_policy_no') is-invalid @enderror"
                    name="previous_policy_no"
                    placeholder=" Enter Packing Details">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Transit Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Transit Type</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Transit Type"
                    placeholder="Enter Transit type">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Mode of Transit</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name=" Mode of Transit"
                    placeholder="Enter Mode of Transit">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Term of Sale</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Term of Sale"
                    placeholder="Enter Term of Sale">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">From Country</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Country"
                    placeholder="Enter From Country">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">To Country</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Country"
                    placeholder="Enter From Country">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Coverage Starts form</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Coverage Starts"
                    placeholder="Enter Coverage Starts form">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Coverage Ends At</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Coverage Ends"
                    placeholder="Enter Coverage Ends form">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Sellor's Consignor Details</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Sellor's Consignor"
                    placeholder="Enter Sellor's Consignor Details">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Buyer's Consignor Details</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Buyer's Consignor "
                    placeholder="Enter Buyer's Consignor Details">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Invoice No.</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Invoice No"
                    placeholder="Enter Invoice No">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Invoice Date.</label>
                <input id="policy_no" type="date"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Invoice date"
                    placeholder="Enter Invoice Date">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">LR / BL /AWB / RR / Receipt No.</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Receipt No"
                    placeholder="Enter Receipt No">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">LR / BL / AWB / RR / Receipt Date</label>
                <input id="policy_no" type="date"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Receipt Date"
                    placeholder="Enter Receipt Date">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Transporter/Vessel/Airline/Authority Name...</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Postal/Authority Name "
                    placeholder="Enter the name">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Transporter/Vessel/Authority Details...</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Postal/Authority Name "
                    placeholder="Enter the name">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Vessel Year of Built</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Vessel Year of Built "
                    placeholder=" Enter Vessel Year of Built">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Basis of Valuation Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Basic of Valuation</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Valuation"
                    placeholder="Enter of Valuation">
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Invoice Currancy</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="Currancy"
                    placeholder="Enter Currancy">
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

                    <div class="card">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Coverage Details</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="policy_no" class="col-form-label">Coverage Details</label>
                                    <input id="policy_no" type="text"
                                        class="form-control"
                                        name="Coverage"
                                        placeholder="Enter Coverage Details">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="policy_no" class="col-form-label">Capacity</label>
                                    <input id="policy_no" type="text"
                                        class="form-control"
                                        name="Coverage"
                                        placeholder="Enter Capacity">
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
                                    <label for="policy_no" class="col-form-label">Invoice Amount</label>
                                    <input id="policy_no" type="text"
                                        class="form-control @error('policy_no') is-invalid @enderror"
                                        name="Invoice Amoun"
                                        placeholder="Enter Invoice Amounts">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="policy_no" class="col-form-label">% Extra</label>
                                    <input id="policy_no" type="text"
                                        class="form-control @error('policy_no') is-invalid @enderror"
                                        name="Extra"
                                        placeholder="Enter your % Extra">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="policy_no" class="col-form-label">Additional Freight</label>
                                    <input id="policy_no" type="text"
                                        class="form-control @error('policy_no') is-invalid @enderror"
                                        name="Freight"
                                        placeholder="Enter your Additional Freight">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="policy_no" class="col-form-label">Additional Insurance</label>
                                    <input id="policy_no" type="text"
                                        class="form-control @error('policy_no') is-invalid @enderror"
                                        name="Insurance"
                                        placeholder="Enter your Additional Insurance">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="policy_no" class="col-form-label">Additional Duty</label>
                                    <input id="policy_no" type="text"
                                        class="form-control @error('policy_no') is-invalid @enderror"
                                        name="Duty"
                                        placeholder="Enter your Additional Duty">
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
