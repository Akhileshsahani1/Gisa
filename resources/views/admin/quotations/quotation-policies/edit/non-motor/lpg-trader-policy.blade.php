<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">LPG Trader Policy</h4>
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
        <h4 class="card-title">Risk Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">           
            <div class="form-group col-sm-12">
                <label for="risk_location" class="col-form-label">Risk Location</label>
                <input id="risk_location" type="text" class="form-control @error('risk_location') is-invalid @enderror" name="risk_location" value="{{ old('risk_location', isset($quotation->risk_location) ? $quotation->risk_location : '') }}" placeholder="Risk Location">
                @error('risk_location')
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
        <h4 class="card-title">Previous Insurance Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="previous_policy_no" class="col-form-label">Previous Policy No.</label>
                <input id="previous_policy_no" type="text"
                    class="form-control business_type_new @error('previous_policy_no') is-invalid @enderror"
                    name="previous_policy_no"
                    value="{{ old('previous_policy_no', isset($quotation->previous_policy_no) ? $quotation->previous_policy_no : '') }}"
                    placeholder="Enter Previous Policy No.">
                @error('previous_policy_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="previous_insurance_company">Previous Insurance Company <span
                        class="text-danger">*</span></label>
                <select name="previous_insurance_company" id="previous_insurance_company"
                    class="form-select business_type_new @error('previous_insurance_company') is-invalid @enderror">
                    <option value="">Choose Previous Insurance Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ old('previous_insurance_company', isset($quotation->previous_insurance_company_id) ? $quotation->previous_insurance_company_id : '') == $company->id ? 'selected' : '' }}>
                            {{ $company->company }}</option>
                    @endforeach
                </select>
                @error('previous_insurance_company')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>   
            <div class="form-group col-sm-6">
                <label for="previous_policy_start_date" class="col-form-label">Previous Policy Start
                    Date </label>
                <input id="previous_policy_start_date" type="date"
                    class="form-control business_type_new @error('previous_policy_start_date') is-invalid @enderror"
                    name="previous_policy_start_date"
                    value="{{ old('previous_policy_start_date', isset($quotation->previous_policy_start_date) ? $quotation->previous_policy_start_date : '') }}"
                    placeholder="Previous Policy Start Date">
                @error('previous_policy_start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="form-group col-sm-6">
                <label for="previous_policy_expiry_date" class="col-form-label">Previous Policy Expiry
                    Date </label>
                <input id="previous_policy_expiry_date" type="date"
                    class="form-control business_type_new @error('previous_policy_expiry_date') is-invalid @enderror"
                    name="previous_policy_expiry_date"
                    value="{{ old('previous_policy_expiry_date', isset($quotation->previous_policy_expiry_date) ? $quotation->previous_policy_expiry_date : '') }}"
                    placeholder="Previous Policy Expiry Date">
                @error('previous_policy_expiry_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="previous_sum_insured" class="col-form-label">Previous Total Sum Insured</label>
                 <input id="previous_sum_insured" type="number"
                    class="form-control business_type_new @error('previous_sum_insured') is-invalid @enderror"
                    name="previous_sum_insured"
                    value="{{ old('previous_sum_insured', isset($quotation->previous_sum_insured) ? $quotation->previous_sum_insured : '') }}"
                    placeholder="Previous Total Sum Insured">
                @error('previous_sum_insured')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
                    
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="claim">Claim Taken<span class="text-danger">*</span></label>
                <select name="claim" id="claim" class="form-select business_type_new @error('claim') is-invalid @enderror">
                    <option value="">Choose</option>
                    <option value="Yes" {{ old('claim', isset($quotation->claim) ? $quotation->claim : '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('claim', isset($quotation->claim) ? $quotation->claim : '') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @error('claim')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="claim_amount" class="col-form-label">Claim Amount</label>
                <input id="claim_amount" type="number"
                    class="form-control business_type_new @error('claim_amount') is-invalid @enderror"
                    name="claim_amount"
                    value="{{ old('claim_amount', isset($quotation->claim_amount) ? $quotation->claim_amount : '') }}"
                    placeholder="Claim Amount">
                @error('claim_amount')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="previous_net_premium" class="col-form-label">Net Premium</label>
               <input id="previous_net_premium" type="number" class="form-control business_type_new @error('previous_net_premium') is-invalid @enderror" name="previous_net_premium" value="{{ old('previous_net_premium', isset($quotation->previous_net_premium) ? $quotation->previous_net_premium : '') }}" placeholder="Enter Previous Net Preimum">
                @error('previous_net_premium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="previous_gst" class="col-form-label">GST 18 %</label>
                <input id="previous_gst" type="number" class="form-control business_type_new @error('previous_gst') is-invalid @enderror" name="previous_gst" value="{{ old('previous_gst', isset($quotation->previous_gst) ? $quotation->previous_gst : '') }}" placeholder="Enter GST 18 %">
                @error('previous_gst')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="previous_gross_premium" class="col-form-label">Gross Premium</label>
               <input id="previous_gross_premium" type="number" class="form-control business_type_new @error('previous_gross_premium') is-invalid @enderror" name="previous_gross_premium" value="{{ old('previous_gross_premium', isset($quotation->previous_gross_premium) ? $quotation->previous_gross_premium : '') }}" placeholder="Enter Previous Gross Premium">
                @error('previous_gross_premium')
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
                    value="{{ old('policy_no', isset($quotation->policy_no) ? $quotation->policy_no : '') }}"
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
                    value="{{ old('policy_start_date', isset($quotation->policy_start_date) ? $quotation->policy_start_date : '') }}"
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
                    value="{{ old('policy_expiry_date', isset($quotation->policy_expiry_date) ? $quotation->policy_expiry_date : '') }}"
                    placeholder="Policy Expiry Date">
                @error('policy_expiry_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="erf_fund" class="col-form-label">ERF Fund</label>
                <input id="erf_fund" type="text"
                    class="form-control @error('erf_fund') is-invalid @enderror"
                    name="erf_fund"
                    value="{{ old('erf_fund') }}"
                    placeholder="Enter ERF Fund">
                @error('erf_fund')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="sum_insured" class="col-form-label">Total Sum Insured</label>
                <input id="sum_insured" type="number"
                    class="form-control @error('sum_insured') is-invalid @enderror"
                    name="sum_insured"
                    value="{{ old('sum_insured', isset($quotation->sum_insured) ? $quotation->sum_insured : '') }}"
                    placeholder="Total Sum Insured">
                @error('sum_insured')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> 
            <div class="form-group col-sm-6">
                <label class="col-form-label" for="declaration_frequency">Declaration Frequency <span
                        class="text-danger">*</span></label>
                <select name="declaration_frequency" id="declaration_frequency"
                    class="form-select @error('declaration_frequency') is-invalid @enderror">
                    <option value="">Choose Declaration Frequency</option>
                    <option value="Monthly" {{ old('declaration_frequency', isset($quotation->declaration_frequency) ? $quotation->declaration_frequency : '') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="Quartely" {{ old('declaration_frequency', isset($quotation->declaration_frequency) ? $quotation->declaration_frequency : '') == 'Quartely' ? 'selected' : '' }}>Quartely</option>
                    <option value="Half Yearly" {{ old('declaration_frequency', isset($quotation->declaration_frequency) ? $quotation->declaration_frequency : '') == 'Half Yearly' ? 'selected' : '' }}>Half Yearly</option>
                    <option value="Annually"{{ old('declaration_frequency', isset($quotation->declaration_frequency) ? $quotation->declaration_frequency : '') == 'Annually' ? 'selected' : '' }}>Annually</option>
                </select>
                @error('declaration_frequency')
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
                        <option value="{{ $company->id }}" {{ old('insurance_company', isset($quotation->insurance_company_id) ? $quotation->insurance_company_id : '') == $company->id ? 'selected' : '' }}>
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
                        <option value="{{ $agency->id }}" {{ old('agency', isset($quotation->agency_id) ? $quotation->agency_id : '') == $agency->id ? 'selected' : '' }}>
                            {{ $agency->agency }}</option>
                    @endforeach
                </select>
                @error('agency')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>            

            <div class="form-group col-sm-6">
                <label for="net_premium" class="col-form-label">Net Premium</label>
                <input id="net_premium" type="number" class="form-control @error('net_premium') is-invalid @enderror" name="net_premium" value="{{ old('net_premium', isset($quotation->net_premium) ? $quotation->net_premium : '') }}" placeholder="Enter Net Premium">
                @error('net_premium')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="gst" class="col-form-label">GST 18 %</label>
                <input id="gst" type="number" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ old('gst', isset($quotation->gst) ? $quotation->gst : '') }}" placeholder="Enter GST 18 %">
                @error('gst')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="gross_premium" class="col-form-label">Gross Premium</label>
                <input id="gross_premium" type="number" class="form-control @error('gross_premium') is-invalid @enderror" name="gross_premium" value="{{ old('gross_premium', isset($quotation->gross_premium) ? $quotation->gross_premium : '') }}" placeholder="Enter Gross Premium">
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
                <label for="quotation" class="col-form-label">Upload Quotation </label>
                <input id="quotation" type="file"
                    class="form-control @error('quotation') is-invalid @enderror" name="quotation">
                @error('quotation')
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
                <label for="previous_policy" class="col-form-label">Upload Previous Policy </label>
                <input id="previous_policy" type="file"
                    class="form-control @error('previous_policy') is-invalid @enderror" name="previous_policy">
                @error('previous_policy')
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
</div>
