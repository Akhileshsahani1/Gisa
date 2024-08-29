<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Goods Carrying Vehicle Liabiity Policy</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label class="col-form-label" for="business_type">Business Type <span class="text-danger">*</span></label>
                <select name="business_type" id="business_type"
                    class="form-select @error('business_type') is-invalid @enderror" onchange="previousPolicyOption()">
                    <option value="">Choose Business Type</option>
                    <option value="New" {{ old('business_type', !is_null(motor_form($quotation->id,'business_type')) ? motor_form($quotation->id,'business_type') : '') == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Roll Over" {{ old('business_type', !is_null(motor_form($quotation->id,'business_type')) ? motor_form($quotation->id,'business_type') : '') == 'Roll Over' ? 'selected' : '' }}>Roll Over
                    </option>
                    <option value="Renewal" {{ old('business_type', !is_null(motor_form($quotation->id,'business_type')) ? motor_form($quotation->id,'business_type') : '') == 'Renewal' ? 'selected' : '' }}>Renewal</option>
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
        <h4 class="card-title">Vehicle Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="registration_number">Vehicle Number </label>
                 <input id="registration_number" type="text"
                    class="form-control" name="registration_number"
                    value="" placeholder="Enter Vehicle Number">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="make">Make <span class="text-danger">*</span></label>
                <input id="make" type="text" class="form-control"
                    name="make" value="" placeholder="Enter Vehicle Make">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="model">Model <span class="text-danger">*</span></label>
              <input id="model" type="text" class="form-control"
                    name="model" value="" placeholder="Enter Vehicle Model">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="gvw">Cubic Capacity / G.V.W <span
                        class="text-danger">*</span></label>
                <input id="gvw" type="text"
                    class="form-control" name="gvw"
                    value="" placeholder="Enter Cubic Capacity / G.V.W">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="registration_date">Seating Capacity <span
                        class="text-danger">*</span></label>
                <input id="registration_date" type="text"
                    class="form-control" name=""
                    value="" placeholder="Enter Seating Capacity">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="new">Date of Registration<span class="text-danger">*</span></label>
                <input id="" type="date"
                class="form-control" name="registration_date"
                value="" placeholder="Enter Vehicle Registration Date">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Previous Policy Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-4">
                <label for="previous_policy_expiry_date" class="col-form-label">Previous Policy Expiry
                    Date </label>
                <input id="previous_policy_expiry_date" type="date"
                    class="form-control business_type_new"
                    name="previous_policy_expiry_date"
                    value=""
                    placeholder="Previous Policy Expiry Date">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="previous_ncb">NCB on Previous Policy <span class="text-danger">*</span></label>
                <select name="previous_ncb" id="previous_ncb"
                    class="form-select business_type_new @error('previous_ncb') is-invalid @enderror">
                    <option value="">Choose Previous NCB</option>
                    <option value="20%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '20%' ? 'selected' : '' }}>20%</option>
                    <option value="25%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '25%' ? 'selected' : '' }}>25% </option>
                    <option value="35%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '35%' ? 'selected' : '' }}>35%</option>
                    <option value="45%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '45%' ? 'selected' : '' }}>45% </option>
                    <option value="50%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '50%' ? 'selected' : '' }}>50%</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="previous_insurance_company">Insured Declared Value <span
                        class="text-danger">*</span></label>
                <input id="registration_date" type="text"
                    class="form-control" name=""
                    value="" placeholder="Enter Insured Declared Value">
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="previous_ncb">NCB <span class="text-danger">*</span></label>
                <select name="previous_ncb" id="previous_ncb"
                    class="form-select business_type_new @error('previous_ncb') is-invalid @enderror">
                    <option value="">Choose Previous NCB</option>
                    <option value="20%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '20%' ? 'selected' : '' }}>20%</option>
                    <option value="25%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '25%' ? 'selected' : '' }}>25% </option>
                    <option value="35%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '35%' ? 'selected' : '' }}>35%</option>
                    <option value="45%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '45%' ? 'selected' : '' }}>45% </option>
                    <option value="50%" {{ old('previous_ncb', isset($quotation->previous_ncb) ? $quotation->previous_ncb : '') == '50%' ? 'selected' : '' }}>50%</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="col-form-label" for="claim">CPA Owner Driver<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new">
                    <option value="">Choose</option>
                    <option value="Covered">Covered</option>
                    <option value="Not Covered">Not Covered</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label for="previous_financer_name" class="col-form-label">Unnamed Passenger </label>
                <input id="previous_financer_name" type="text"
                    class="form-control business_type_new"
                    name="previous_financer_name"
                    value=""
                    placeholder="Enter Unnamed Passenger">
            </div>
            <div class="form-group col-sm-4">
                <label for="previous_financer_name" class="col-form-label">LL to Paid Driver and Cleaner </label>
                <input id="previous_financer_name" type="text"
                    class="form-control business_type_new"
                    name="previous_financer_name"
                    value=""
                    placeholder="Enter LL to Paid Driver">
            </div>
        </div>
    </div>
</div>

@include('admin.quotations.policies.motor.options.quotation-groups')

<div class="card">
    <div class="card-footer text-end">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
        <button type="submit" class="btn btn-sm btn-primary" form="quotationForm"><i
                class="mdi mdi-database me-1"></i>Save</button>
    </div>
</div>

