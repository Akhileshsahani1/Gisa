<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Single Transit Marine Policy</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label class="col-form-label" for="business_type">Business Type <span class="text-danger">*</span></label>
                <select name="business_type" id="business_type"
                    class="form-select @error('business_type') is-invalid @enderror">
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
                <label for="financer_name" class="col-form-label">Financer Name</label>
                 <input id="financer_name" type="text"
                    class="form-control @error('financer_name') is-invalid @enderror"
                    name="financer_name"
                    value="{{ old('financer_name', isset($quotation->financer_name) ? $quotation->financer_name : '') }}"
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
                <label for="lr" class="col-form-label">Upload LR </label>
                <input id="lr" type="file"
                    class="form-control @error('lr') is-invalid @enderror" name="lr">
                @error('lr')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="e_way_bill" class="col-form-label">Upload E Way Bill </label>
                <input id="e_way_bill" type="file"
                    class="form-control @error('e_way_bill') is-invalid @enderror" name="e_way_bill">
                @error('e_way_bill')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="pre_dispatch_survey_report" class="col-form-label">Upload Pre Dispatch Survey Report </label>
                <input id="pre_dispatch_survey_report" type="file"
                    class="form-control @error('pre_dispatch_survey_report') is-invalid @enderror" name="pre_dispatch_survey_report">
                @error('pre_dispatch_survey_report')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="destination_survey_report" class="col-form-label">Destination Survey Report </label>
                <input id="destination_survey_report" type="file"
                    class="form-control @error('destination_survey_report') is-invalid @enderror" name="destination_survey_report">
                @error('destination_survey_report')
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
</div>
