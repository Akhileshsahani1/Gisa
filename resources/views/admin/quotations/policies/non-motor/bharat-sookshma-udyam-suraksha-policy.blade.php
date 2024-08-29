<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Bharat Sookshma Udyam Suraksha Policy</h4>
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
                <label for="risk_occupancy" class="col-form-label">Occupancy</label>
                <input id="risk_occupancy" type="text" class="form-control @error('risk_occupancy') is-invalid @enderror" name="risk_occupancy" value="{{ old('risk_occupancy', isset($quotation->risk_occupancy) ? $quotation->risk_occupancy : '') }}" placeholder="Risk Occupancy">
                @error('risk_occupancy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Risk Location Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="risk_location" class="col-form-label">Risk Location Address</label>
                <textarea class="form-control" placeholder="Enter Risk Location"></textarea>
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
        <h4 class="card-title">Sum Insured Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="col-form-label">Building Super Structure Incl Tin Shed and Boundry wall<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Building Super Structure">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label">Plant & Machinery<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Plant & Machinery">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label">Stock<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Stock">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label">Furniture, Fixture & Fittings<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Furniture, Fixture & Fittings">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label">Electrical Insallation<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Electrical Insallation">
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label">Other Contant<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Other Contant">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Safety Features Available in Premises</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="col-form-label">Age of Building<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Building Super Structure">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">Any Basement & Lower Ground Floor involved<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">Plint Height<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Building Super Structure">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">No. of Fire Extinguisher<span class="text-danger">*</span></label>
                <input id="" type="text"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Building Super Structure">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">Smoke Detector Installed<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">water Hydrant System Installed<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">CCTV Camera Installed<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">Security Guard 24*7<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label">Any Electric Supply Inside the premises<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
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
                            <h4 class="card-title">Coverage</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Fire<span class="text-danger">*</span></label>
                                    <select name="claim" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">STFI<span class="text-danger">*</span></label>
                                    <select name="claim" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Earthquake<span class="text-danger">*</span></label>
                                    <select name="claim" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Terrorism<span class="text-danger">*</span></label>
                                    <select name="claim" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Escalation <span class="text-danger">*</span></label>
                                    <select name="claim" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="">Upto 10%</option>
                                        <option value="">Upto 20%</option>
                                        <option value="">Upto 30%</option>
                                        <option value="">Upto 40%</option>
                                        <option value="">Upto 50%</option>
                                    </select>
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
