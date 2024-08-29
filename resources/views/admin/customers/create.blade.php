<div class="modal fade" id="modal-create-customer">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @include('admin.includes.flash-message')
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Add Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="customerForm" action="{{ route('admin.customers.store') }}">
                    @isset($lead->id)
                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                    @endisset
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="customer_type" class="col-form-label">Customer Type <span
                                    class="text-danger">*</span></label>
                            <select id="customer_type" class="form-select @error('customer_type') is-invalid @enderror"
                                name="customer_type">
                                <option value="">Choose Customer Type</option>
                                <option value="Retail" {{ old('customer_type', isset($lead) ? $lead->lead_type : '') == 'Retail' ? 'selected' : '' }}>Retail
                                </option>
                                <option value="SME" {{ old('customer_type', isset($lead) ? $lead->lead_type : '') == 'SME' ? 'selected' : '' }}>SME
                                </option>
                                <option value="Corporate" {{ old('customer_type', isset($lead) ? $lead->lead_type : '') == 'Corporate' ? 'selected' : '' }}>
                                    Corporate
                                </option>
                            </select>
                            @error('customer_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="salutation" class="col-form-label">Title <span
                                    class="text-danger">*</span></label>
                            <select id="salutation" class="form-select @error('salutation') is-invalid @enderror"
                                name="salutation" autofocus>
                                <option value="">Choose Title</option>
                                <option value="M/s." {{ old('salutation', isset($lead) ? $lead->salutation : '') == 'M/s.' ? 'selected' : '' }}>M/s.
                                </option>
                                <option value="Mr." {{ old('salutation', isset($lead) ? $lead->salutation : '') == 'Mr.' ? 'selected' : '' }}>Mr.
                                </option>
                                <option value="Ms." {{ old('salutation', isset($lead) ? $lead->salutation : '') == 'Ms.' ? 'selected' : '' }}>Ms.
                                </option>
                                <option value="Mrs." {{ old('salutation', isset($lead) ? $lead->salutation : '') == 'Mrs.' ? 'selected' : '' }}>Mrs.
                                </option>
                            </select>
                            @error('salutation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="firstname" class="col-form-label">Firstname <span
                                    class="text-danger">*</span></label>
                            <input id="firstname" type="text"
                                class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                value="{{ old('firstname', isset($lead) ? $lead->firstname : '') }}" placeholder="Enter Customer Firstname">
                            @error('firstname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="lastname" class="col-form-label">Lastname <span
                                    class="text-danger">*</span></label>
                            <input id="lastname" type="text"
                                class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                value="{{ old('lastname', isset($lead) ? $lead->lastname : '') }}" placeholder="Enter Customer Lastname">
                            @error('lastname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="phone">Phone Number <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" name="phone" placeholder="Enter Phone Number"
                                value="{{ old('phone', isset($lead) ? $lead->phone : '') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input id="phone-dial-code" name="phonedialcode" type="hidden"
                                value="{{ isset($lead) ? $lead->dialcode : '' }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="col-form-label" for="whats_app">WhatsApp Number <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('whats_app') is-invalid @enderror"
                                id="whats_app" name="whats_app" placeholder="Enter WhatsApp Number"
                                value="{{ old('whats_app', isset($lead) ? $lead->whats_app : '') }}">
                            @error('whats_app')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input id="whats_app-dial-code" name="whats_app_dialcode" type="hidden"
                                value="{{ isset($lead) ? $lead->whats_app_dialcode : '' }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email" class="col-form-label">Email Address <span
                                    class="text-danger">*</span></label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', isset($lead) ? $lead->email : '') }}" placeholder="Enter Customer Email Address">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="gender" class="col-form-label">Gender <span
                                    class="text-danger">*</span></label>
                            <select id="gender" class="form-select @error('gender') is-invalid @enderror"
                                name="gender" autofocus>
                                <option value="">Choose Customer Gender</option>
                                <option value="Male" {{ old('gender', isset($lead) ? $lead->gender : '') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ old('gender', isset($lead) ? $lead->gender : '') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other" {{ old('gender', isset($lead) ? $lead->gender : '') == 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_of_birth" class="col-form-label">Date of Birth <span
                                    class="text-danger">*</span></label>
                            <input id="date_of_birth" type="date"
                                class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                                value="{{ old('date_of_birth', isset($lead) ? $lead->date_of_birth : '') }}">
                            @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_of_anniversary" class="col-form-label">Date of Anniversary </label>
                            <input id="date_of_anniversary" type="date"
                                class="form-control @error('date_of_anniversary') is-invalid @enderror" name="date_of_anniversary"
                                value="{{ old('date_of_anniversary') }}">
                            @error('date_of_anniversary')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="pan_no" class="col-form-label">Pan No. <span
                                    class="text-danger">*</span></label>
                            <input id="pan_no" required type="test"
                                class="form-control @error('pan_no') is-invalid @enderror" name="pan_no"
                                value="{{ old('pan_no') }}" placeholder="Customer Pan No.">
                            @error('pan_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="gst_no" class="col-form-label">GST No. </label>
                            <input id="gst_no" type="test"
                                class="form-control @error('gst_no') is-invalid @enderror" name="gst_no"
                                value="{{ old('gst_no') }}" placeholder="Customer GST No.">
                            @error('gst_no')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                         <div class="form-group col-md-6">
                            <label for="state" class="col-form-label">State</label>
                            <input id="state" type="test"
                                class="form-control @error('state') is-invalid @enderror" name="state"
                                value="{{ old('state') }}" placeholder="Customer State">
                            @error('state')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                         <div class="form-group col-md-6">
                            <label for="city" class="col-form-label">City </label>
                            <input id="city" type="test"
                                class="form-control @error('city') is-invalid @enderror" name="city"
                                value="{{ old('city') }}" placeholder="Customer City">
                            @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                         <div class="form-group col-md-6">
                            <label for="zipcode" class="col-form-label">ZipCode </label>
                            <input id="zipcode" type="test"
                                class="form-control @error('zipcode') is-invalid @enderror" name="zipcode"
                                value="{{ old('zipcode') }}" placeholder="Customer zipcode">
                            @error('zipcode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                         <div class="form-group col-md-6">
                            <label for="avatar" class="col-form-label">Avatar </label>
                            <input id="avatar" type="file"
                                class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                            @error('avatar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="source" class="col-form-label">Customer Source <span
                                    class="text-danger">*</span></label>
                            <input id="source" type="text"
                                class="form-control @error('source') is-invalid @enderror" name="source"
                                value="{{ old('source', isset($lead) ? $lead->source : '') }}" placeholder="Enter Customer Source">
                            @error('source')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-12">
                            <label for="gender" class="col-form-label">Address <span
                                    class="text-danger">*</span></label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Enter Customer Address">{{ old('address', isset($lead) ? $lead->address : '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="pancard_file" class="col-form-label">Upload Pan Card </label>
                            <input id="pancard_file" type="file"
                                class="form-control @error('pancard_file') is-invalid @enderror" name="pancard_file">
                            @error('pancard_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="gst_file" class="col-form-label">Upload GST Certificate </label>
                            <input id="gst_file" type="file"
                                class="form-control @error('gst_file') is-invalid @enderror" name="gst_file">
                            @error('gst_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="aadhar" class="col-form-label">Upload Aadhar Card </label>
                            <input id="aadhar" type="file"
                                class="form-control @error('aadhar') is-invalid @enderror" name="aadhar">
                            @error('aadhar')
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
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="customerForm">Save</button>
            </div>
        </div>

    </div>
</div>
