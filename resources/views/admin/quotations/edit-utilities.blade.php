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
        var policy_id = $('#policy_id').val();
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{ route('admin.policies.getType') }}",
            data: {
                policy_id: policy_id
            },
            success: function(data) {
                var list = $("#policy_type_id");
                list.html('<option value="">Choose Policy Type</option>')
                $.each(data.types, function(index, type) {
                    list.append(new Option(type.type, type.id));
                });
                list.val('{{ old("policy_type_id", $quotation->policy_type_id) }}')
                getPolicyEditableForm();
               
            }

        });
    }
</script>

<script>
    function previousPolicyOption() { 
        var business_type = $('#business_type').val();
        switch (business_type) {
            case 'New':
                $('.business_type_new').attr('disabled', 'disabled');
                break;            
        
            default:
                $('.business_type_new').removeAttr("disabled");
                break;
        }
    }
</script>
<script>
    function getPolicyEditableForm() {
        $('#policy_form_div').html('<div class="text-center"><span class="loader">Loading</span></div>');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        var formData = {
            policy_type_id: $("#policy_type_id").val(),
            quotation_id: "{{ $quotation->id }}"
        };
        $.ajax({
            type: 'POST',
            url: '{{ route("admin.quotations.get-editable-form") }}',
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                //
            },
            success: function(res, status) {
                $('#policy_form_div').html(res);
                previousPolicyOption();
            },
            error: function(res, status) {
                console.log(res);
            }
        });
    }
</script>
<script type="text/javascript">
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
