<div class="card">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Employee Compensation Policy</h4>
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
          <h4 class="card-title">Work Details</h4>
      </div>
      <div class="card-body pt-1">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label class="col-form-label" for="business_type">Particular of works to be covered in details<span class="text-danger">*</span></label>
                    <input id="" type="text" class="form-control" value="" placeholder="Enter Particular of works to be covered in details">
                </div>
            </div>
        </div>
</div>
<div class="card">
      <div class="card-header bg-secondary text-white pb-0">
          <h4 class="card-title">Risk Location Adress</h4>
      </div>
      <div class="card-body pt-1">
            <div class="row">
                <div class="form-group col-sm-12">
                    <label class="col-form-label" for="business_type">Risk Location Adress<span class="text-danger">*</span></label>
                    <textarea class="form-control" name="risk_location" value="" placeholder="Enter Risk Location Adress"></textarea>
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
        <h4 class="card-title">Employee Details</h4>
    </div>
    <div class="card-body pt-1">
        <div class="row">
            <table>
                <tr>
                    <th>Type of Employee</th>
                    <th>No. of Employee</th>
                    <th>Wages of Employee Per Month</th>
                    <th>Total Sum Insured</th>
                </tr>
                <tr>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Type of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter No. of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Wages of Employee Per Month"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Total Sum Insured"></td>
                </tr>
                <tr>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Type of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter No. of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Wages of Employee Per Month"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Total Sum Insured"></td>
                </tr>
                <tr>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Type of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter No. of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Wages of Employee Per Month"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Total Sum Insured"></td>
                </tr>
                <tr>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Type of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter No. of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Wages of Employee Per Month"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Total Sum Insured"></td>
                </tr>
                <tr>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Type of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter No. of Employee"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Wages of Employee Per Month"></td>
                    <td><input id="" type="text" class="form-control mt-2" value="" placeholder="Enter Total Sum Insured"></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card">
      <div class="card-header bg-secondary text-white pb-0">
          <h4 class="card-title">Claim History</h4>
      </div>
      <div class="card-body pt-1">
        <div class="row">
            <div class="form-group col-sm-12">
                <label class="col-form-label" for="business_type">Nill Loss in Last Three Years.<span class="text-danger">*</span></label>
                <input id="" type="text" class="form-control" value="" placeholder="Enter Nill Loss in Last Three Years">
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
                                <h4 class="card-title">Addon Coverage</h4>
                            </div>
                            <div class="card-body pt-1">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Coverage of Medical Extension<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Coverage of Medical Extension">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Coverage of Contractor and Sub Contractor Employee<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Coverage of Contractor and Sub Contractor Employee">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Road Ambulance Cover<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Road Ambulance Cover">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Occupatinal Disease<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Occupatinal Disease">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="col-form-label" for="business_type">Transportation of Mortal Remains<span class="text-danger">*</span></label>
                                        <input id="" type="text" class="form-control" value="" placeholder="Enter Transportation of Mortal Remains">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-secondary text-white pb-0">
                            <h4 class="card-title">Coverage</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="business_type">Employee Compensation<span class="text-danger">*</span></label>
                                    <input id="" type="text" class="form-control" value="" placeholder="Enter Employee Compensation">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="business_type">Fatal Accident<span class="text-danger">*</span></label>
                                    <input id="" type="text" class="form-control" value="" placeholder="Enter Fatal Accident">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="business_type">Common Law<span class="text-danger">*</span></label>
                                    <input id="" type="text" class="form-control" value="" placeholder="Enter Common Law">
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
                            <h4 class="card-title">Nature Of Work Classification Number Details</h4>
                        </div>
                        <div class="card-body pt-1">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label">Nature of work<span class="text-danger">*</span></label>
                                    <input id="" type="text"
                                    class="form-control" name="registration_date"
                                    value="" placeholder="Enter Nature of work<">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label">Classification Number<span class="text-danger">*</span></label>
                                    <input id="" type="text"
                                    class="form-control" name="registration_date"
                                    value="" placeholder="Enter Classification Number<">
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
