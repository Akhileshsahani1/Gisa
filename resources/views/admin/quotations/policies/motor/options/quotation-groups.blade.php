<div class="card opcard">
    <div class="card-header bg-secondary text-white pb-0">
        <h4 class="card-title">Quotation Option</h4>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="coption">
                @if (isset($quotation) && isset($quotation->quotationOptions))
                    @foreach ($quotation->quotationOptions as $k => $option)

                        <div class="card-body bg-light" style="border: 1px solid #403ad72e;">
                            <div class="text-end"><a onclick="confirmDeleteGroup({{ $option->id }})"
                                    class="btn btn-sm btn-danger text-end mb-2"><i
                                        class="mdi mdi-trash-can me-1"></i>Remove</a></div>

                            <div class="card">
                                <div class="card-header bg-secondary text-white pb-0">
                                    <h4 class="card-title">Addon Coverage</h4>
                                </div>
                                <div class="card-body pt-1">
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">Nil Depreciation<span
                                                    class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][nill_depreciation]" id="claim"
                                                class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'nill_depreciation') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'nill_depreciation') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">Return to Invoice<span
                                                    class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][return_to_invoice]" id="claim"
                                                class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'return_to_invoice') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'return_to_invoice') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">Engine & Gear box
                                                protection<span class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][engine_gearbox_protection]"
                                                id="claim" class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'engine_gearbox_protection') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'engine_gearbox_protection') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">Consumables<span
                                                    class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][consumables]" id="claim"
                                                class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'consumables') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'consumables') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">Tyre and Rim Cover<span
                                                    class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][tyre_rim_cover]" id="claim"
                                                class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'tyre_rim_cover') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'tyre_rim_cover') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">Loss of Key<span
                                                    class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][loss_of_key]" id="claim"
                                                class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'loss_of_key') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'loss_of_key') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label class="col-form-label" for="claim">IMT23 <span
                                                    class="text-danger">*</span></label>
                                            <select name="policy[{{ $k }}][imt23]" id="claim"
                                                class="form-select ">
                                                <option value="">Choose</option>
                                                <option value="Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'imt23') == 'Covered' ? 'selected' : '' }}>
                                                    Covered</option>
                                                <option value="Not Covered"
                                                    {{ motor_meta($option->quotation_id, $option->id, 'imt23') == 'Not Covered' ? 'selected' : '' }}>
                                                    Not Covered</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="previous_financer_name" class="col-form-label">Towing Charges
                                            </label>
                                            <input id="previous_financer_name" type="text"
                                                class="form-control "
                                                name="policy[{{ $k }}][towing_charges]"
                                                value="{{ motor_meta($option->quotation_id, $option->id, 'towing_charges') }}"
                                                vid="{{ $option->id }}" placeholder="Enter Towing Charges">
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
                                            <label class="col-form-label" for="claim">Insurance Company<span
                                                    class="text-danger">*</span></label>
                                            <select required name="policy[{{ $k }}][insurance_company]"
                                                id="claim" class="form-select incom">
                                                <option value="">Choose</option>
                                                @if (isset($companies))
                                                    @foreach ($companies as $c)
                                                        <option value="{{ $c->id }}"
                                                            {{ motor_meta($option->quotation_id, $option->id, 'insurance_company') == $c->id ? 'selected' : '' }}>
                                                            {{ $c->company }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="col-form-label" for="claim">Premium Amount<span
                                                    class="text-danger">*</span></label>
                                            <input id="premium_amount" type="text"
                                                class="form-control  premium_amount"
                                                name="policy[{{ $k }}][premium_amount]" required
                                                value="{{ motor_meta($option->quotation_id, $option->id, 'premium_amount') }}"
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
                                                        <td class="text-end net_premium">
                                                            {{ motor_meta($option->quotation_id, $option->id, 'net_premium') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>GST 18%</td>
                                                        <td class="text-end gst_18">
                                                            {{ motor_meta($option->quotation_id, $option->id, 'gst_18') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Gross Premium</strong></td>
                                                        <td class="text-end"><strong
                                                                class="gross_premium">{{ motor_meta($option->quotation_id, $option->id, 'gross_premium') }}</strong>
                                                        </td>
                                                    </tr>
                                                    <input type="hidden"
                                                        name="policy[{{ $k }}][net_premium]"
                                                        id="net_premium"
                                                        value="{{ motor_meta($option->quotation_id, $option->id, 'net_premium') }}">
                                                    <input type="hidden" name="policy[{{ $k }}][gst_18]"
                                                        id="gst_18"
                                                        value="{{ motor_meta($option->quotation_id, $option->id, 'gst_18') }}">
                                                    <input type="hidden"
                                                        name="policy[{{ $k }}][gross_premium]"
                                                        id="gross_premium"
                                                        value="{{ motor_meta($option->quotation_id, $option->id, 'gross_premium') }}">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="delete-option{{ $option->id }}" method="POST"
                                action="{{ route('admin.quotation.option.delete') }}">
                                @csrf
                                <input type="hidden" name="quotation_company_id" value="{{ $option->id }}">
                            </form>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>


        <div class="text-end"><a href="#" class="btn btn-sm btn-success text-end mb-2 add_more_group"><i
                    class="mdi mdi-plus me-1"></i>Add More Option</a></div>
        <div id="groups"></div>

    </div>
</div>
</div>

@include('admin.quotations.policies.motor.options.quotation-group-script')

