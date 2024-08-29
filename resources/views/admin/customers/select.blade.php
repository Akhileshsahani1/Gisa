<div class="col-md-7 mx-auto">
    <div class="form-group">
        <div class="card mb-2">
            <div class="card-body pb-1">
                <div class="form-group">
                    <label for="customer_id" class="col-form-label">Billed To (Customer details)</label>
                    @if ($customer_exists)
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $customer->id }}">
                    @else
                        <input type="hidden" name="customer_id" id="customer_id">
                    @endif
                    <!-- @if ($customer_exists)
                        <input type="text" id="autocomplete" placeholder="Search" class="form-control"
                            value="{{ $customer->name }}" />
                    @else
                        <input type="text" id="autocomplete" placeholder="Search" class="form-control" />
                    @endif -->

                    @error('customer_id')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>

                <div class="card-body text-white pt-0 pb-0" id="customer-detail" @if ($customer_exists) style="display: block;" @else style="display: none;" @endif>
                    <p class="bg-secondary text-center m-0">Customer Details</p>
                    <table class="table table-sm mb-0">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td id="customer_name" class="text-end">
                                    @if ($customer_exists){{ $customer->firstname.' '.$customer->lastname }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td id="customer_email" class="text-end">
                                    @if ($customer_exists){{ $customer->email }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td id="customer_phone" class="text-end">
                                    @if ($customer_exists){{ $customer->phone }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Whatsapp Number</td>
                                <td id="customer_whats_app" class="text-end">
                                    @if ($customer_exists){{ $customer->whats_app }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Pan Number</td>
                                <td id="customer_pan_number" class="text-end">
                                    @if ($customer_exists){{ $customer->pan_no }}
                                    @endif
                                </td>
                            </tr>
                            <tr style="border-style: none;border-color: snow;">
                                <td>Address</td>
                                <td id="customer_address" class="text-end">
                                    @if ($customer_exists){{ $customer->address }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-body pt-2 text-center" id="choose-customer" @if ($customer_exists) style="display: none;" @else style="display: block;" @endif>
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 84 84.002">
                        <g transform="translate(-5678.929 -3706.424)">
                            <path fill="#eff2f8" d="M5762.929,3748.424a41.879,41.879,0,1,1,0-.245Z"
                                transform="translate(0 0.001)"></path>
                            <path fill="#d3dceb" d="M5719.508,3730.817a14.006,14.006,0,1,1,0-.009Z"
                                transform="translate(15.454 12.777)"></path>
                            <path fill="#d3dceb"
                                d="M5740.918,3749.938a41.97,41.97,0,0,1-55.631.043,29.741,29.741,0,0,1,55.631-.043Z"
                                transform="translate(7.827 29.924)"></path>
                        </g>
                    </svg>
                    <p class=" mb-0 mt-2">Select a Customer from list</p>
                    <p class="my-1">or</p>
                    <a href="#modal-create-customer" class="btn btn-sm btn-primary" data-bs-toggle="modal" role="button">
                        <i class="fas fa-plus btn-icon"></i> {{ __('Add Customer') }}</a>
                </div>

        </div>
    </div>
</div>
