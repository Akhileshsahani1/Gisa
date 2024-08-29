<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>Quotations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.png">
    <meta content="Protect what matters most with GISA. Our comprehensive insurance solutions offer peace of mind for your home, car, health, and more. Get personalized coverage and competitive rates today." name="description" />
    <meta name="keywords" content="Insurance, Home Insurance, Car Insurance, Health Insurance, Life Insurance, Coverage, Protection, Security, GISA">
    <meta name="author" content="N2R Technologies"/>

    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('assets/js/plugins/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="wrapper">
        <!-- ========== Content Section Start ======= -->
        <div class="">
            <div class="content">
    @include('admin.includes.flash-message')
    <div class="text-center mt-4 mb-2">
        <a href="{{ route('quotation.print-view',base64_encode($quotation->id)) }}" class="btn btn-secondary">Print View</a>
    </div>
    <div class="quote-form">
        <div class="quotation-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="q-logo">
                        <img src="{{ asset('assets/images/gisa-logo.png') }}" alt="logo">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="company-info">
                        <h2>{{ $company->company }}</h2>
                        <h4>GST Number: <span>{{ $company->gstin }}</span></h4>
                        <p>{{ $company->address_line_1 }}, {{ $company->address_line_2 }}, {{ $company->zipcode }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="person-info">
            <div class="row">
                <div class="col-sm-6"><h4><i class="mdi mdi-email"></i> <span><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></span>
                </h4></div>
                <div class="col-sm-6 text-end"><h5><i class="mdi mdi-web"></i> <span><a href="https://gisaimf.com/">www.gisaimf.com</a></span></h5></div>
            </div>
        </div>
        <div class="billed-to">
            <div class="customer-info">
                <h5>Billed To</h5>
                <h1>{{ $quotation?->customer?->salutation }} {{ $quotation?->customer?->firstname }}
                    {{ $quotation?->customer?->lastname }}</h1>
                <ul>
                    <li><a href="#"><i
                                class="mdi mdi-map-marker"></i><span>{{ $quotation?->customer?->address }}</span></a></li>
                    <li><a href="tel:{{ $quotation?->customer?->phone }}"><i
                                class="mdi mdi-phone"></i><span>{{ $quotation?->customer?->phone }}</span></a></li>
                    <li><a href="tel:{{ $quotation?->customer?->whats_app }}"><i
                                class="mdi mdi-whatsapp"></i><span>{{ $quotation?->customer?->whats_app }}</span></a></li>
                    <li><a href="mailto:{{ $quotation?->customer?->email }}"><i
                                class="mdi mdi-email"></i><span>{{ $quotation?->customer?->email }}</span></a></li>
                </ul>
            </div>
            <div class="company-details">
                <h5>Quoted By</h5>
                <h2>{{ $quotation?->salesExecutive?->firstname }} {{ $quotation?->salesExecutive?->lastname }}</h2>
                <h4><a href="tel:{{ $quotation?->salesExecutive?->phone }}">{{ $quotation?->salesExecutive?->phone }}</a>
                </h4>
                <p>Quotation ID: <span>{{ $quotation?->id }}</span></p>
                <p>Date: <span>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d M, Y') }}</span></p>

            </div>
        </div>
        <div class="seprate">
            <hr>
            <p>Policy Type: <span>{{ $quotation?->policyType?->type }}</span></p>
            <hr>
        </div>
        <div class="vehicle-detail">
            <table class="table table-striped dt-responsive nowrap">
                <thead class="bg-dark">
                    <tr role="row">
                        <th class="bg-secondary text-white">Vehicle Details</th>
                        <th class="bg-secondary text-white"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr role="row">
                        <td class="table-user">Vehicle No.</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'registration_number') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Make</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'make') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Model</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'model') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Cubic Capacity / G.V.W</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'gvw') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Seating Capacity</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'seating_capicity') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Date of registration</td>
                        <td class="text-end">30 Aug, 2022</td>
                    </tr>
                </tbody>
            </table>
            @if( motor_form($quotation->id, 'business_type') != 'New')
            <table class="table table-striped dt-responsive nowrap">
                <thead class="bg-dark">
                    <tr role="row">
                        <th class="bg-secondary text-white">Previous Policy Details</th>
                        <th class="bg-secondary text-white"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr role="row">
                        <td class="table-user">Previous Policy Expiry Date</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'previous_policy_expiry_date') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">NCB on Previous Policy</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'previous_ncb') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Insured Declared Value</td>
                        <td class="text-end">₹{{ motor_form($quotation->id, 'insured_declared_value') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">NCB</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'ncb') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">CPA Owner Driver</td>
                        <td class="text-end">{{ motor_form($quotation->id, 'claim') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">Unnamed Passenger </td>
                        <td class="text-end">{{ motor_form($quotation->id, 'previous_financer_name') }}</td>
                    </tr>
                    <tr role="row">
                        <td class="table-user">LL to Paid Driver and Cleaner </td>
                        <td class="text-end">{{ motor_form($quotation->id, 'll_to_paid_driver_and_cleaner') }}</td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>

        <div class="quotation-option">
            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            @if ($quotation->quotationOptions && $quotation->status == 'Pending' || $quotation->status == 'quoted-request')
                    @foreach ($quotation->quotationOptions as $k => $option)
                    @php
                        $policy = \App\Models\InsuranceCompany::find(motor_meta($quotation->id, $option->id, 'insurance_company'))?->company;
                    @endphp
                        <li class="nav-item scompany">
                            <a href="#home{{ $k }}" data-toggle="tab" aria-expanded="false"
                                class="nav-link rounded-0 @if ($k == 0) active @endif">
                                <h5>Option {{ $k + 1 }}</h5>
                                <h2
                                    id="sdata"
                                    premium="{{ motor_meta($quotation->id, $option->id, 'gross_premium') }}"
                                    policy="{{ $policy }}"
                                    insurance_id="{{ motor_meta($quotation->id, $option->id,'insurance_company') }}"
                                    net_premium = "{{motor_meta($quotation->id, $option->id, 'net_premium')}}"
                                    option_id="{{ $option->id }}"

                                 >₹{{ motor_meta($quotation->id, $option->id, 'gross_premium') }}</h2>

                                 <p>{{ $policy }}
                                </p>
                            </a>
                        </li>
                    @endforeach
                    @elseif( $quotation->status == 'Accepted')
                    <li class="nav-item">
                        <a href="#home-selected" data-toggle="tab" aria-expanded="false"
                            class="nav-link rounded-0 active">
                            <h5>Option selected</h5>
                            <h2

                            >₹{{ motor_form($quotation->id, 'selected_insurance_amount') }}</h2>

                             <p>{{ motor_form($quotation->id, 'selected_insurance') }}
                            </p>
                        </a>
                    </li>

            @endif

            </ul>

            @if (isset($quotation) && isset($quotation->quotationOptions))
                <div class="tab-content">

                    @foreach ($quotation->quotationOptions as $k => $option)


                        @if( $quotation->status == 'Accepted'
                        && motor_form($quotation->id , 'selected_option_id') == $option->id)
                          <div class="tab-pane show active" id="home-selected">
                        @elseif( $quotation->status == 'Pending' || $quotation->status == 'quoted-request'  && $k == 0 )
                          <div class="tab-pane show active" id="home{{$k}}">
                        @else
                            <div class="tab-pane show" id="home{{$k}}">
                        @endif

                            <table class="table table-striped dt-responsive nowrap">
                                <thead class="bg-dark">
                                    <tr role="row">
                                        <th class="bg-secondary text-white">Addon Coverage</th>
                                        <th class="bg-secondary text-white"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row">
                                        <td class="table-user">Nil Depreciation</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'nill_depreciation') }}
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Return to Invoice</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'return_to_invoice') }}
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Engine & Gear box protection</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'engine_gearbox_protection') }}
                                        </td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Consumables</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'consumables') }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Tyre and Rim Cover</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'tyre_rim_cover') }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Loss of Key</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'loss_of_key') }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">IMT23</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'imt23') }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Towing Charges</td>
                                        <td class="text-end">
                                            {{ motor_meta($quotation->id, $option->id, 'towing_charges') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-striped dt-responsive nowrap">
                                <thead class="bg-dark">
                                    <tr role="row">
                                        <th class="bg-secondary text-white">Premium Details</th>
                                        <th class="bg-secondary text-white"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row">
                                        <td class="table-user">Net Premium</td>
                                        <td class="text-end">
                                            ₹{{ motor_meta($quotation->id, $option->id, 'net_premium') }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">GST 18%</td>
                                        <td class="text-end">
                                            ₹{{ motor_meta($quotation->id, $option->id, 'gst_18') }}</td>
                                    </tr>
                                    <tr role="row">
                                        <td class="table-user">Gross Premium</td>
                                        <td class="text-end">
                                            <strong>₹{{ motor_meta($quotation->id, $option->id, 'gross_premium') }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            @endif
            @if( $quotation?->status =='Accepted' )
            <div class="row">
                <div class="p-2 bg-dark text-white">Terms and Conditions</div>
                <div class="col-10 m-2">
                   {!! motor_form($quotation->id,'terms') !!}
                </div>
            </div>
            @endif

        </div><!--Option main div-->


        @if ($quotation->status == 'Pending' || $quotation->status == 'quoted-request')
            <div class="accept-btn">
                <form id="accept-policy"
                    action="{{ route('quotation.status', ['id' => $quotation->id, 'status' => 'Accepted']) }}"
                    method="POST">
                    @csrf

                    <input type="hidden" id="selected_insurance" name="selected_insurance" value="">
                    <input type="hidden" id="selected_insurance_amount" name="selected_insurance_amount" value="">
                    <input type="hidden" id="insurance_id" name="selected_insurance_company" value="">
                    <input type="hidden" id="net_premium" name="net_premium" value="">
                    <input type="hidden" id="gst_18" name="gst_18" value="">
                    <input type="hidden" id="option_id" name="selected_option_id" value="">

                    <div class="custom-control custom-checkbox custom-checkbox-info">
                        <input type="checkbox" required class="custom-control-input" id="customCheckcolor3">
                        <label class="custom-control-label" for="customCheckcolor3">
                            I have read and agree to the
                        </label>
                        <a class="showtc cursor-pointer">Terms & Conditions</a>
                    </div>
                    <div class="text-center">
                        <button type="button" onclick="acceptPolicy()"
                            class="btn btn-primary mt-3">Accept</button>
                    </div>
                </form>
            </div>
        @elseif($quotation->status == 'Accepted')
            <div class="accept-btn">
                <div class="text-center">
                    <button class="btn btn-success mt-3">Accepted</button>
                </div>
            </div>
        @endif

    </div>
    <!-- Full width modal -->

    <div id="tc-modal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Terms and conditions</h4>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row tc m-2"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('.showtc').click(function(e) {
                e.preventDefault();

                $('.tc').html(`{!! motor_form($quotation->id, 'terms') !!}`);
                $('#tc-modal').modal('show');
            });
            $('.close').click(function(e) {
                e.preventDefault();
                $('#tc-modal').modal('hide');
            });

        });

        function acceptPolicy() {

            let check = $('#customCheckcolor3').prop('checked');
            if( !check ){
                alert('Please accept terms and conditions');
                return;
            }
            let premium  = $('.scompany').find('.active #sdata').attr('premium');
            let net_premium  = $('.scompany').find('.active #sdata').attr('net_premium');
            let policy   = $('.scompany').find('.active #sdata').attr('policy');
            let insurance_id   = $('.scompany').find('.active #sdata').attr('insurance_id');
            let option_id   = $('.scompany').find('.active #sdata').attr('option_id');
            let gst_18 = parseInt(net_premium)*(18/100);
            $('#selected_insurance_amount').val(premium);
            $('#selected_insurance').val(policy);
            $('#insurance_id').val(insurance_id);
            $('#net_premium').val(net_premium);
            $('#gst_18').val(gst_18);
            $('#option_id').val(option_id);

            Swal.fire({
                title: "<strong>Please Confirm</strong>",
                icon: "info",
                html: `
                    You selected <b>` + policy + `</b>
                    <span>with a premium of<span>
                        <b>` + premium + `</b>
                `,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Accept',
                confirmButtonAriaLabel: "Thumbs up, great!",
                cancelButtonText: 'Cancel',
                cancelButtonAriaLabel: "Thumbs down"

            }).then(t => {
                t.isConfirmed && document.getElementById("accept-policy").submit()
            })
        }
    </script>
 </div>
        </div>
        <!-- ========== Content Section End ========= -->

    </div>
    @include('admin.includes.script')
</body>

</html>
