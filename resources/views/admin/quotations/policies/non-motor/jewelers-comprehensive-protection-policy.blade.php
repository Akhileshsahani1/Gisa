<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Jewelers Comprehensive Protection Policy</h4>
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
        <h4 class="card-title">Risk Location Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="risk_location" class="col-form-label">Risk Location</label>
                <textarea class="form-control" name="risk_location" value="" placeholder="Risk Location"></textarea>
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
                <label for="risk_occupancy" class="col-form-label">Whether commercial (market) place/ residential area/ Shopping complex/ Individual shop, Area with only Jewellery shops</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Whether commercial (market) place">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Details about the adjacent property</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Details about the adjacent property">
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
                <label for="risk_occupancy" class="col-form-label">Watchman : 24 hrs/ 12 hrs</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Watchman : 24 hrs/ 12 hr">
            </div>

            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Safe : ( Make / Model / Mfg Year  ) - Refer Definition below.</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Safe : ( Make / Model / Mfg Year  )">
            </div>
            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Number of doors and Protection for doors</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Number of doors and Protection for doors">
            </div>

            <div class="form-group col-sm-6">
                <label for="risk_occupancy" class="col-form-label">Number of Windows and Protection for Windows</label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Number of Windows and Protection">
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
                <label for="risk_occupancy" class="col-form-label">Premises occupied by proposer in the night: </label>
                <input id="risk_occupancy" type="text" class="form-control" name="risk_occupancy" value="" placeholder="Premises occupied by propose">
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
@include('admin.quotations.policies.quotation-groups')
<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Quotation Option</h4>
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
