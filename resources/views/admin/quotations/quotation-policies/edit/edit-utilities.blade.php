@if (!$customer_exists)
    <script>
        $(document).ready(function() {
            $('#modal-create-customer').modal('show');
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        getProductType();
    });
</script>
<script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
<script>
    phone = document.querySelector("#phone"),
        dialCode = document.querySelector("#phone-dial-code");

    // init plugin
    var iti = window.intlTelInput(phone, {
        initialCountry: "{{ old('iso2', 'IN') }}",
        formatOnDisplay: false,
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });
</script>
<script>
    whatsapp = document.querySelector("#whats_app"),
        whatsapp_dialCode = document.querySelector("#whats_app-dial-code");

    // init plugin
    var iti = window.intlTelInput(whatsapp, {
        initialCountry: "{{ old('iso2', 'IN') }}",
        formatOnDisplay: false,
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });
</script>
<script src="{{ asset('assets/js/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
<script type="text/javascript">
    var route = "{{ url('admin/search/customers') }}";
    $('#autocomplete').typeahead({
        display: 'value',
        minLength: 3,
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function(data) {
                return process(data);
            });
        },

        updater: function(item) {
            $('#customer_id').val(item.id);
            $('#customer_name').text(item.firstname + ' ' + item.lastname);
            $('#customer_email').text(item.email);
            $('#customer_phone').text(item.phone);
            $('#customer_whats_app').text(item.whats_app)
            $('#customer_pan_number').text(item.pan_no)
            $('#customer_address').text(item.address);
            $('#customer-detail').slideDown();
            $('#choose-customer').css('display', 'none');
            return item;
        }
    });
</script>
<script>
    function getProductType() {

        $("#policy_type_id").html('');
        //$('#policy_id').val();
        var policy_id = '{{ $policy?->quotation?->policy_id }}';
        var type_id = '{{ $policy?->quotation?->policy_type_id }}';

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('admin.policies.getType') }}",
            data: {
                policy_id: policy_id
            },
            success: function(data) {
                var list = $("#policy_type_id");
                var pname = '';
                let pid = '';
                $.each(data.types, function(index, type) {
                    if (type.id == type_id) {
                        pname = type.type;
                        pid = type.id;
                        list.append(new Option(type.type, type.id, 'selected'));
                    }
                    // else
                    // list.append( new Option(type.type, type.id) );
                });
                list.val('{{ old('policy_type_id') }}')

                list.html('<option value="' + pid + '">' + pname + '</option>')

                @if (old('policy_type_id'))
                    getPolicyForm();
                @endif
            }

        });
        getPolicyForm();
    }
</script>
<script>
    function getPolicyForm() {
        $('#policy_form_div').html('<div class="text-center"><span class="loader">Loading</span></div>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        var formData = {
            policy_type_id: '{{ $policy?->quotation?->policy_type_id }}',
            quotation_id: '{{ $policy?->quotation?->id }}',
            id: '{{ $policy->id }}'
        };
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.quotation-policy.edit.form') }}',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                //
            },
            success: function(res, status) {
                $('#policy_form_div').html(res);
                showErrors();
            },
            error: function(res, status) {
                console.log(res);
            }
        });
    }
</script>
<script>
    function previousPolicyOption() {
        var business_type = $('#business_type').val();
        switch (business_type) {
            case 'New':
                $('.business_type_new').parent().parent().parent().parent().hide();
                // $('.business_type_new').attr('disabled', 'disabled');
                break;

            default:
                $('.business_type_new').parent().parent().parent().parent().show();
                //  $('.business_type_new').removeAttr("disabled");
                break;
        }
    }
</script>
<script>
    function showErrors() {

        @error('new')
            $('.new_error').show();
        @enderror

        @error('engine_no')
            $('.engine_no_error').show();
        @enderror

        @error('chassis_no')
            $('.chasis_no_error').show();
        @enderror

        @error('year_of_manufacture')
            $('.year_of_manufacture_error').show();
        @enderror

        @error('previous_insurance_company')
            $('.prevous_insurance_company_error').show();
        @enderror

        @error('previous_ncb')
            $('.previous_ncb_error').show();
        @enderror

        @error('claim')
            $('.claim_error').show();
        @enderror


        @error('agency')
            $('.agency_error').show();
        @enderror

        @error('ncb')
            $('.ncb_error').show();
        @enderror
    }
</script>
<script>
    jQuery(document).ready(function($) {
        $('body').delegate('#gross_od', 'keyup', function(e) {

            let val = $(this).val();
            let gst_od = (18 / 100) * val;
            let gross_tp = $('#gross_tp').val();
            let gst_tp = $('.gst_tp').val();

            let net_premium = parseFloat(val) + parseFloat(gross_tp);

            $('#gst_od').val(gst_od);
            $('#net_premium').val(net_premium);

        });
        $('body').delegate('#gross_od', 'keyup', function(e) {

            let val = $(this).val();
            let gst_od = (18 / 100) * val;
            let gross_tp = $('#gross_tp').val();
            let gst_tp = $('.gst_tp').val();

            let net_premium = parseFloat(val) + parseFloat(gross_tp);

            $('#gst_od').val(gst_od);
            $('#net_premium').val(net_premium);

        });
    })
</script>
@if (!$customer_exists)
    <script>
        $(document).ready(function() {
            $('#modal-create-customer').modal('show');
        });
    </script>
@endif
<script>
    $(document).ready(function() {
        getProductType();
    });
</script>
<script src="{{ asset('assets/js/plugins/intl-tel-input/js/intlTelInput.min.js') }}"></script>
<script>
    phone = document.querySelector("#phone"),
        dialCode = document.querySelector("#phone-dial-code");

    // init plugin
    var iti = window.intlTelInput(phone, {
        initialCountry: "{{ old('iso2', 'IN') }}",
        formatOnDisplay: false,
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });
</script>
<script>
    whatsapp = document.querySelector("#whats_app"),
        whatsapp_dialCode = document.querySelector("#whats_app-dial-code");

    // init plugin
    var iti = window.intlTelInput(whatsapp, {
        initialCountry: "{{ old('iso2', 'IN') }}",
        formatOnDisplay: false,
        utilsScript: "{{ asset('assets/js/plugins/intl-tel-input/js/utils.js') }}" // just for formatting/placeholders etc
    });
</script>
<script src="{{ asset('assets/js/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
<script type="text/javascript">
    var route = "{{ url('admin/search/customers') }}";
    $('#autocomplete').typeahead({
        display: 'value',
        minLength: 3,
        source: function(query, process) {
            return $.get(route, {
                query: query
            }, function(data) {
                return process(data);
            });
        },

        updater: function(item) {
            $('#customer_id').val(item.id);
            $('#customer_name').text(item.firstname + ' ' + item.lastname);
            $('#customer_email').text(item.email);
            $('#customer_phone').text(item.phone);
            $('#customer_whats_app').text(item.whats_app)
            $('#customer_pan_number').text(item.pan_no)
            $('#customer_address').text(item.address);
            $('#customer-detail').slideDown();
            $('#choose-customer').css('display', 'none');
            return item;
        }
    });
</script>
<script>
    function getProductType() {

        $("#policy_type_id").html('');
        //$('#policy_id').val();
        var policy_id = '{{ $policy?->quotation?->policy_id }}';
        var type_id = '{{ $policy?->quotation?->policy_type_id }}';

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('admin.policies.getType') }}",
            data: {
                policy_id: policy_id
            },
            success: function(data) {
                var list = $("#policy_type_id");
                var pname = '';
                let pid = '';
                $.each(data.types, function(index, type) {
                    if (type.id == type_id) {
                        pname = type.type;
                        pid = type.id;
                        list.append(new Option(type.type, type.id, 'selected'));
                    }
                    // else
                    // list.append( new Option(type.type, type.id) );
                });
                list.val('{{ old('policy_type_id') }}')

                list.html('<option value="' + pid + '">' + pname + '</option>')

                @if (old('policy_type_id'))
                    getPolicyForm();
                @endif
            }

        });
        getPolicyForm();
    }
</script>
<script>
    function getPolicyForm() {
        $('#policy_form_div').html('<div class="text-center"><span class="loader">Loading</span></div>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        var formData = {
            policy_type_id: '{{ $policy?->quotation?->policy_type_id }}',
            quotation_id: '{{ $policy?->quotation?->id }}',
            id: '{{ $policy->id }}'
        };
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.quotation-policy.edit.form') }}',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                //
            },
            success: function(res, status) {
                $('#policy_form_div').html(res);
                showErrors();
            },
            error: function(res, status) {
                console.log(res);
            }
        });
    }
</script>
<script>
    function previousPolicyOption() {
        var business_type = $('#business_type').val();
        switch (business_type) {
            case 'New':
                $('.business_type_new').parent().parent().parent().parent().hide();
                // $('.business_type_new').attr('disabled', 'disabled');
                break;

            default:
                $('.business_type_new').parent().parent().parent().parent().show();
                //  $('.business_type_new').removeAttr("disabled");
                break;
        }
    }
</script>
<script>
    function showErrors() {

        @error('new')
            $('.new_error').show();
        @enderror

        @error('engine_no')
            $('.engine_no_error').show();
        @enderror

        @error('chassis_no')
            $('.chasis_no_error').show();
        @enderror

        @error('year_of_manufacture')
            $('.year_of_manufacture_error').show();
        @enderror

        @error('previous_insurance_company')
            $('.prevous_insurance_company_error').show();
        @enderror

        @error('previous_ncb')
            $('.previous_ncb_error').show();
        @enderror

        @error('claim')
            $('.claim_error').show();
        @enderror


        @error('agency')
            $('.agency_error').show();
        @enderror

        @error('ncb')
            $('.ncb_error').show();
        @enderror
    }
</script>
<script>
    jQuery(document).ready(function($) {

        $('body').delegate('#claim', 'change', function(e) {
            let cval = $(this).val();

            let pv = $('#previous_policy_expiry_date').val();
            let cv = $('#policy_start_date').val();

            const date1 = new Date(pv);
            const date2 = new Date(cv);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

            if (cval == 'Yes' || diffDays >= 90) {
                $('#ncb option[value="0%"]').prop('selected', true);
                $('#ncb').attr('disabled', true);
            } else {
                $('#ncb').removeAttr('disabled');
            }
        });

        $('body').delegate('#policy_start_date', 'change', function(e) {
            let pv = $('#previous_policy_expiry_date').val();
            let cv = $(this).val();

            const date1 = new Date(pv);
            const date2 = new Date(cv);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            if( diffDays >= 90 || $('#claim').val() =='Yes'){
                $('#ncb option[value="0%"]').prop('selected', true);
                $('#ncb').attr('disabled', true);
            } else {
                $('#ncb').removeAttr('disabled');
            }
        });

        $('body').delegate('#gross_od', 'keyup', function(e) {

            let val = $(this).val();

            let gst_od = (18 / 100) * val;
            let gross_tp = $('#gross_tp').val() ? $('#gross_tp').val() : 0;

            let gst_tp = gross_tp ? (18 / 100) * gross_tp : 0;

            let net_premium = parseFloat(val) + parseFloat(gross_tp);

            let gross_premium = (net_premium) + parseFloat(gst_od) + parseFloat(gst_tp);

            $('#gst_od').val(gst_od);
            $('#net_premium').val(net_premium);
            $('#gross_premium').val(gross_premium);

        });
        $('body').delegate('#gross_tp', 'keyup', function(e) {

            let val = $(this).val();

            let gst_tp = (18 / 100) * val;
            let gross_od = $('#gross_od').val() ? $('#gross_od').val() : 0;

            let gst_od = gross_od ? (18 / 100) * gross_od : 0;

            let net_premium = parseFloat(val) + parseFloat(gross_od);
            let gross_premium = (net_premium) + parseFloat(gst_od) + parseFloat(gst_tp);

            $('#gst_tp').val(gst_tp);
            $('#net_premium').val(net_premium);

            $('#gross_premium').val(gross_premium);

        });
    })
</script>
