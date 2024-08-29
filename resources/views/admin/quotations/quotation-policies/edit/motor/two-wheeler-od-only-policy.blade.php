<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Two Wheeler OD Only Policy</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
           
            <div class="form-group col-sm-12">
                <label class="col-form-label" for="business_type">Business Type <span class="text-danger">*</span></label>
                <select disabled name="business_type" id="business_type"
                    class="form-select @error('business_type') is-invalid @enderror" onchange="previousPolicyOption()">
                    <option value="">Choose Business Type</option>
                    <option value="New" {{ old('business_type',  isset($quotation) && !is_null(motor_form($quotation->id, 'business_type')) ? motor_form($quotation->id, 'business_type') : '') == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Roll Over" {{ old('business_type', isset($quotation) && !is_null(motor_form($quotation->id, 'business_type')) ? motor_form($quotation->id, 'business_type') : '') == 'Roll Over' ? 'selected' : '' }}>Roll Over
                    </option>
                    <option value="Renewal" {{ old('business_type',  isset($quotation) && !is_null(motor_form($quotation->id, 'business_type')) ? motor_form($quotation->id, 'business_type') : '') == 'Renewal' ? 'selected' : '' }}>Renewal</option>
                </select>
               <div class="invalid-feedback business_type_error" style="display: none;">Please choose Business Type</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="sales_executive_id">Sales Executive <span
                        class="text-danger">*</span></label>
                <select name="sales_executive_id" disabled id="sales_executive_id"
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
                <select name="service_executive_id" disabled id="service_executive_id"
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
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="registration_number">Registration Number <span
                        class="text-danger">*</span></label>
                 <input id="registration_number" type="text" readonly
                    class="form-control @error('registration_number') is-invalid @enderror" name="registration_number"
                    value="{{ old('registration_number', isset($quotation) ? motor_form($quotation->id,'registration_number' ) : '') }}" placeholder="Enter Registration Number">
                @error('registration_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="new">Is Vehicle New ?<span class="text-danger">*</span></label>
                <select name="new" id="new"  class="form-select @error('new') is-invalid @enderror">
                    <option value="">Choose</option>
                    <option value="Yes" {{ old('new', policy_data($policy->id,'new')) == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('new', policy_data($policy->id,'new')) == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('new')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="make">Make <span class="text-danger">*</span></label>
                <input id="make" type="text" class="form-control @error('make') is-invalid @enderror" readonly
                    name="make"  value="{{ isset($quotation) ?  motor_form($quotation->id, 'make') : '' }}" placeholder="Enter Vehicle Make">
                @error('make')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="model">Model <span class="text-danger">*</span></label>
              <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" readonly
                    name="model" value="{{ isset($quotation) ?  motor_form($quotation->id, 'model') : '' }}" placeholder="Enter Vehicle Model">
                @error('model')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="cubic_capacity">Cubic Capacity (CC) <span
                        class="text-danger">*</span></label>
                 <input id="cubic_capacity" type="text" readonly
                    class="form-control @error('cubic_capacity') is-invalid @enderror" name="cubic_capacity"
                    value="{{ isset($quotation) ?  motor_form($quotation->id, 'gvw') : '' }}"  placeholder="Enter Vehicle Cubic Capacity">
                @error('cubic_capacity')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="year_of_manufacture">Year of Manufacture <span
                        class="text-danger">*</span></label>
                <select name="year_of_manufacture"  id="year_of_manufacture"
                    class="form-select @error('year_of_manufacture') is-invalid @enderror">
                    <option value="">Choose Year of Manufacture</option>
                    @php
                        $year = 1900;
                        $currentYear = date('Y');
                    @endphp
                     @while ($year <= $currentYear)
                     <option value="{{ $year }}" {{ old('year_of_manufacture', 
                      policy_data($policy->id,'year_of_manufacture'))  == $year ? "selected" : "" }}>{{ $year }}</option>
                     {{ $year++ }}
                 @endwhile
                </select>
                @error('year_of_manufacture')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="registration_date">Registration Date <span
                        class="text-danger">*</span></label>
                <input id="registration_date" type="date" readonly
                    class="form-control @error('registration_date') is-invalid @enderror" name="registration_date"
                    value="{{ isset($quotation) ? motor_form($quotation->id, 'registration_date') : ''}}" placeholder="Enter Vehicle Registration Date">
                @error('registration_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label class="col-form-label" for="engine_no">Engine No. <span
                        class="text-danger">*</span></label>
                <input id="engine_no" type="text"
                    class="form-control @error('engine_no') is-invalid @enderror" name="engine_no"
                    value="{{ old('engine_no', policy_data($policy->id,'engine_no')) }}" placeholder="Enter Vehicle Engine No.">
                @error('engine_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label class="col-form-label" for="chassis_no">Chassis No. <span
                        class="text-danger">*</span></label>
                <input id="chassis_no" type="text"
                    class="form-control @error('chassis_no') is-invalid @enderror" name="chassis_no"
                    value="{{ old('chassis_no', policy_data($policy->id,'chassis_no')) }}" placeholder="Enter Vehicle Chassis No.">
                @error('chassis_no')
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
        <h4 class="card-title">Previous OD Policy Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="previous_od_policy_no" class="col-form-label">Previous OD Policy No.</label>
                <input id="previous_od_policy_no" type="text"
                    class="form-control business_type_new @error('previous_od_policy_no') is-invalid @enderror"
                    name="previous_od_policy_no"
                    value="{{ old('previous_policy_no',policy_data($policy->id,'previous_policy_no')) }}"                    
                    placeholder="Enter Previous OD Policy No.">
                @error('previous_od_policy_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="previous_od_policy_expiry_date" class="col-form-label">Previous Policy Expiry
                    Date </label>
                <input id="previous_od_policy_expiry_date" type="date"
                    class="form-control business_type_new @error('previous_od_policy_expiry_date') is-invalid @enderror"
                    name="previous_od_policy_expiry_date"
                    value="{{ old('previous_policy_expiry_date', policy_data($policy->id,'previous_policy_expiry_date') ) }}"
                    placeholder="Previous Policy Expiry Date">
                @error('previous_od_policy_expiry_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="previous_od_insurance_company">Previous OD Insurance Company <span
                        class="text-danger">*</span></label>
                <select name="previous_od_insurance_company" id="previous_od_insurance_company"
                    class="form-select business_type_new @error('previous_od_insurance_company') is-invalid @enderror">
                    <option value="">Choose Previous OD Insurance Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('previous_od_insurance_company', isset($quotation->previous_od_insurance_company_id) ? $quotation->previous_od_insurance_company_id : '') == $company->id ? 'selected' : '' }}>
                            {{ $company->company }}</option>
                    @endforeach
                </select>
                @error('previous_od_insurance_company')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="previous_ncb">Previous NCB <span class="text-danger">*</span></label>
                <select name="previous_ncb" id="previous_ncb"
                    class="form-select business_type_new @error('previous_ncb') is-invalid @enderror">
                    <option value="">Choose Previous NCB</option>
                    <option value="20%" {{ old('previous_ncb', policy_data($policy->id,'previous_ncb')) == '20%' ? 'selected' : '' }}>20%</option>
                    <option value="25%" {{ old('previous_ncb', policy_data($policy->id,'previous_ncb')) == '25%' ? 'selected' : '' }}>25% </option>
                    <option value="35%" {{ old('previous_ncb', policy_data($policy->id,'previous_ncb')) == '35%' ? 'selected' : '' }}>35%</option>
                    <option value="45%" {{ old('previous_ncb', policy_data($policy->id,'previous_ncb')) == '45%' ? 'selected' : '' }}>45% </option>
                    <option value="50%" {{ old('previous_ncb', policy_data($policy->id,'previous_ncb')) == '50%' ? 'selected' : '' }}>50%</option>
                </select>
                @error('previous_ncb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="invalid-feedback claim_error" style="display: none;">Please choose previous ncb</div>
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="claim">Claim Taken<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new @error('claim') is-invalid @enderror">
                    <option value="">Choose</option>
                    <option value="Yes" {{ old('claim', policy_data($policy->id,'claim')) == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('claim', policy_data($policy->id,'claim')) == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('claim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="invalid-feedback claim_error" style="display: none;">Please select claim taken</div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Previous TP Policy Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="previous_tp_policy_no" class="col-form-label">Previous TP Policy No.</label>
                <input id="previous_tp_policy_no" type="text"
                    class="form-control business_type_new @error('previous_tp_policy_no') is-invalid @enderror"
                    name="previous_tp_policy_no"
                    value="{{ old('previous_tp_policy_no', isset($quotation->previous_tp_policy_no) ? $quotation->previous_tp_policy_no : '') }}"
                    placeholder="Enter Previous TP Policy No.">
                @error('previous_tp_policy_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="previous_tp_policy_expiry_date" class="col-form-label">Previous Policy Expiry
                    Date </label>
                <input id="previous_tp_policy_expiry_date" type="date"
                    class="form-control business_type_new @error('previous_tp_policy_expiry_date') is-invalid @enderror"
                    name="previous_tp_policy_expiry_date"
                    value="{{ old('previous_tp_policy_expiry_date', isset($quotation->previous_tp_policy_expiry_date) ? $quotation->previous_tp_policy_expiry_date : '') }}"
                    placeholder="Previous Policy Expiry Date">
                @error('previous_tp_policy_expiry_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="previous_tp_insurance_company">Previous TP Insurance Company <span
                        class="text-danger">*</span></label>
                <select name="previous_tp_insurance_company" id="previous_tp_insurance_company"
                    class="form-select business_type_new @error('previous_tp_insurance_company') is-invalid @enderror">
                    <option value="">Choose Previous TP Insurance Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('previous_tp_insurance_company', isset($quotation->previous_tp_insurance_company_id) ? $quotation->previous_tp_insurance_company_id : '') == $company->id ? 'selected' : '' }}>
                            {{ $company->company }}</option>
                    @endforeach
                </select>
                @error('previous_tp_insurance_company')
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
        <h4 class="card-title">Current Insurance Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="policy_no" class="col-form-label">Policy No.</label>
                <input id="policy_no" type="text"
                    class="form-control @error('policy_no') is-invalid @enderror"
                    name="policy_no"
                    value="{{ old('policy_no', policy_data($policy->id,'policy_no')) }}"
                    placeholder="Enter Policy No.">
                @error('policy_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_start_date" class="col-form-label">Policy Start
                    Date </label>
                <input id="policy_start_date" type="date"
                    class="form-control @error('policy_start_date') is-invalid @enderror"
                    name="policy_start_date"
                    value="{{ old('policy_start_date', policy_data($policy->id,'policy_start_date')) }}"
                    placeholder="Policy Start Date">
                @error('policy_start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="policy_expiry_date" class="col-form-label">Policy Expiry
                    Date </label>
                <input id="policy_expiry_date" type="date"
                    class="form-control @error('policy_expiry_date') is-invalid @enderror"
                    name="policy_expiry_date"
                    value="{{ old('policy_expiry_date',policy_data($policy->id,'policy_expiry_date')) }}"
                    placeholder="Policy Expiry Date">
                @error('policy_expiry_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="financer_name" class="col-form-label">Financer Name</label>
                 <input id="financer_name" type="text"
                    class="form-control @error('financer_name') is-invalid @enderror"
                    name="financer_name"
                    value="{{ old('financer_name', policy_data($policy->id,'financer_name')) }}"    
                    placeholder="Enter Financer Name">
                @error('financer_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="insurance_company">Insurance Company <span
                        class="text-danger">*</span></label>
                <select name="insurance_company" id="insurance_company"
                    class="form-select @error('insurance_company') is-invalid @enderror">
                    <option value="">Choose Insurance Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('insurance_company', policy_data($policy->id,'insurance_company')) == $company->id ? 'selected' : '' }}>
                            {{ $company->company }}</option>
                    @endforeach
                </select>
                @error('insurance_company')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="agency">Agency Name <span
                        class="text-danger">*</span></label>
                <select name="agency" id="agency"
                    class="form-select @error('agency') is-invalid @enderror">
                    <option value="">Choose Agency</option>
                    @foreach ($agencies as $agency)
                    <option value="{{ $agency->id }}" {{ old('agency',policy_data($policy->id,'agency')) == $agency->id ? 'selected' : '' }}>
                        {{ $agency->agency }}</option>
                            
                    @endforeach
                </select>
                @error('agency')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="invalid-feedback agency_error" style="display: none;">Please choose agency</div>
            </div>
            <div class="form-group col-sm-6">
                <label for="idv" class="col-form-label">IDV</label>
                <input id="idv" type="number" class="form-control @error('idv') is-invalid @enderror" name="idv"  value="{{ old('idv', policy_data($policy->id,'idv')) }}" placeholder="Enter IDV">
                @error('idv')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="ncb">No Claim Bonus (NCB) <span class="text-danger">*</span></label>
                <select name="ncb" id="ncb"
                class="form-select @error('ncb') is-invalid @enderror">
                <option value="">Choose NCB</option>
                <option value="20%" {{ old('ncb', policy_data($policy->id,'ncb')) == '20%' ? 'selected' : '' }}>20%</option>
                <option value="25%" {{ old('ncb', policy_data($policy->id,'ncb')) == '25%' ? 'selected' : '' }}>25% </option>
                <option value="35%" {{ old('ncb', policy_data($policy->id,'ncb')) == '35%' ? 'selected' : '' }}>35%</option>
                <option value="45%" {{ old('ncb', policy_data($policy->id,'ncb')) == '45%' ? 'selected' : '' }}>45% </option>
                <option value="50%" {{ old('ncb', policy_data($policy->id,'ncb')) == '50%' ? 'selected' : '' }}>50%</option>
            </select>
                @error('ncb')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="gross_od" class="col-form-label">Gross OD</label>
               <input id="gross_od" type="number" class="form-control @error('gross_od') is-invalid @enderror" name="gross_od" value="{{ old('gross_od', policy_data($policy->id,'gross_od')) }}" placeholder="Enter Gross OD">
                @error('gross_od')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="gross_tp" class="col-form-label">Gross TP</label>
                <input id="gross_tp" type="number" class="form-control @error('gross_tp') is-invalid @enderror" name="gross_tp" value="{{ old('gross_tp', policy_data($policy->id,'gross_tp')) }}" placeholder="Enter Gross TP">
                @error('gross_tp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="gst_od" class="col-form-label">GST on OD</label>
                <input id="gst_od" type="number" class="form-control @error('gst_od') is-invalid @enderror" name="gst_od" value="{{ old('gst_od', policy_data($policy->id,'gdt_od')) }}" placeholder="Enter GST on OD">
                @error('gst_od')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="gst_tp" class="col-form-label">GST on TP</label>
                <input id="gst_tp" type="number" class="form-control @error('gst_tp') is-invalid @enderror" name="gst_tp"  value="{{ old('gross_tp', policy_data($policy->id,'gross_tp')) }}" placeholder="Enter GST on TP">
                @error('gst_tp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="net_premium" class="col-form-label">Net Premium</label>
                <input id="net_premium" type="number" class="form-control @error('net_premium') is-invalid @enderror" name="net_premium" value="{{ old('net_premium', policy_data($policy->id,'net_premium')) }}" placeholder="Enter Net Premium">
                @error('net_premium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="gross_premium" class="col-form-label">Gross Premium</label>
                <input id="gross_premium" type="number" class="form-control @error('gross_premium') is-invalid @enderror" name="gross_premium" value="{{ old('gross_premium',policy_data($policy->id,'gross_premium')) }}" placeholder="Enter Gross Premium">
                @error('gross_premium')
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
        <h4 class="card-title">Attachments</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="proposal_form" class="col-form-label">Upload Proposal Form </label>
                <input id="proposal_form" type="file"
                    class="form-control @error('proposal_form') is-invalid @enderror" name="proposal_form">
                @error('proposal_form')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="rc" class="col-form-label">Upload RC </label>
                <input id="rc" type="file"
                    class="form-control @error('rc') is-invalid @enderror" name="rc">
                @error('rc')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="previous_od_policy" class="col-form-label">Upload Previous OD Policy </label>
                <input id="previous_od_policy" type="file"
                    class="form-control @error('previous_od_policy') is-invalid @enderror" name="previous_od_policy">
                @error('previous_od_policy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="tp_policy" class="col-form-label">Upload TP Policy </label>
                <input id="tp_policy" type="file"
                    class="form-control @error('tp_policy') is-invalid @enderror" name="tp_policy">
                @error('tp_policy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="pre_inspection_report" class="col-form-label">Upload Pre Inspection Report </label>
                <input id="pre_inspection_report" type="file"
                    class="form-control @error('pre_inspection_report') is-invalid @enderror" name="pre_inspection_report">
                @error('pre_inspection_report')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="invoice_copy" class="col-form-label">Upload Invoice Copy </label>
                <input id="invoice_copy" type="file"
                    class="form-control @error('invoice_copy') is-invalid @enderror" name="invoice_copy">
                @error('invoice_copy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="policy_copy" class="col-form-label">Upload Policy Copy </label>
                <input id="policy_copy" type="file"
                    class="form-control @error('policy_copy') is-invalid @enderror" name="policy_copy">
                @error('policy_copy')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="other" class="col-form-label">Upload Other File </label>
                <input id="other" type="file"
                    class="form-control @error('other') is-invalid @enderror" name="other">
                @error('other')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-dark me-1"><i
                class="mdi mdi-chevron-double-left me-1"></i>Back</a>
        <button type="submit" class="btn btn-sm btn-primary" form="quotationForm"><i
                class="mdi mdi-database me-1"></i>Save</button>
    </div>
</di