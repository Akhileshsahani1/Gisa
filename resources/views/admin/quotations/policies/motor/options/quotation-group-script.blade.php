<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    var options = "";
    @if( isset($companies) )
    @foreach( $companies as $c )
     options += '<option value="{{$c->id}}">{{ $c->company }}</option>';
    @endforeach
    @endif

    jQuery(document).ready(function() {

        $('body').delegate('#quotationForm button[type="submit"]','click',function(e){
            e.preventDefault();
            let sel = $('.incom').val();
            console.log(sel);
            if( sel == '' || sel == undefined){
                alert('Please select insurance company options');
                return;
            } else {
               $('#quotationForm').submit();
            }
        });

        var c = "{{ isset($quotation) && count($quotation->quotationOptions) ? count($quotation->quotationOptions) : 0   }}",
            k = 0;
        $('.add_more_group').on('click', function(e) {
            e.preventDefault();

            var groupHtm = `
            <div class="card-body bg-light" style="border: 1px solid #403ad72e;">
                    <div class="text-end"><a href="#" class="btn btn-sm btn-danger text-end mb-2 remgp"><i
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
                                    <select name="policy[`+c+`][nill_depreciation]" id="claim"
                                        class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Return to Invoice<span
                                            class="text-danger">*</span></label>
                                    <select name="policy[`+c+`][return_to_invoice]" id="claim"
                                        class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Engine & Gear box protection<span
                                            class="text-danger">*</span></label>
                                    <select name="policy[`+c+`][engine_gearbox_protection]" id="claim"
                                        class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Consumables<span
                                            class="text-danger">*</span></label>
                                    <select name="policy[`+c+`][consumables]" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Tyre and Rim Cover<span
                                            class="text-danger">*</span></label>
                                    <select name="policy[`+c+`][tyre_rim_cover]" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">Loss of Key<span
                                            class="text-danger">*</span></label>
                                    <select name="policy[`+c+`][loss_of_key]" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label class="col-form-label" for="claim">IMT23 <span
                                            class="text-danger">*</span></label>
                                    <select name="policy[`+c+`][imt23]" id="claim" class="form-select business_type_new">
                                        <option value="">Choose</option>
                                        <option value="Covered">Covered</option>
                                        <option value="Not Covered">Not Covered</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="previous_financer_name" class="col-form-label">Towing Charges </label>
                                    <input id="previous_financer_name" type="text"
                                        class="form-control business_type_new"
                                        name="policy[`+c+`][towing_charges]" value=""
                                        placeholder="Enter Towing Charges">
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
                                    <select required name="policy[`+c+`][insurance_company]" id="claim"
                                        class="form-select business_type_new incom">
                                        <option value="">Choose</option>
                                        `+options+`
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="claim">Premium Amount<span
                                            class="text-danger">*</span></label>
                                    <input id="previous_financer_name" type="text"
                                        class="form-control business_type_new premium_amount"
                                        name="policy[`+c+`][premium_amount]" value=""
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
                                                <td class="text-end net_premium"></td>
                                            </tr>
                                            <tr>
                                                <td>GST 18%</td>
                                                <td class="text-end gst_18"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Gross Premium</strong></td>
                                                <td class="text-end"><strong class="gross_premium"></strong></td>
                                            </tr>
                                            <input type="hidden" name="policy[`+c+`][net_premium]" id="net_premium" value="">
                                            <input type="hidden" name="policy[`+c+`][gst_18]" id="gst_18" value="">
                                            <input type="hidden" name="policy[`+c+`][gross_premium]" id="gross_premium" value="">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('.coption').append(groupHtm);
            c++;
        })

        $("body").delegate(".premium_amount", "keyup", function(e) {
            e.preventDefault();
            let net_premium = $(this).val();
            let gst18 = (18/100)*net_premium;
            let gross_premium = parseFloat(net_premium)+parseFloat(gst18);

           $(this).parent().parent().find('.net_premium').html(net_premium);
             $(this).parent().parent().find('.gst_18').html(gst18);
             $(this).parent().parent().find('.gross_premium').html(gross_premium);

             $(this).parent().parent().find('#net_premium').val(net_premium);
             $(this).parent().parent().find('#gst_18').val(gst18);
             $(this).parent().parent().find('#gross_premium').val(gross_premium)

        });


        ////////////
        $('body').delegate('.remgp', 'click', function(e) {
            e.preventDefault();

            $(this).parent().parent().remove();
        })

        $('body').delegate('.add-field', 'click', function(e) {

            e.preventDefault();
            var c1 = parseInt($(this).attr('c'));
            var k1 = parseInt($(this).attr('k')) + 1;
            $(this).attr('k', k1);
            var field_htm = `
                <div class="row p-3">
                <div class="col-4">
                    <input name="group[` + c1 + `][meta][` + k1 + `][meta_key]" class="form-control" placeholder="Name">
                </div>
                <div class="col-4">
                    <input name="group[` + c1 + `][meta][` + k1 + `][meta_value]" class="form-control" placeholder="Value">
                </div>
                <div class="col-4">
                    <button class="btn btn-danger rem-field"> Remove Field </button>
                </div>
                </div>
         `;
            $(this).parent().parent().append(field_htm);
        })

        $('body').delegate('.rem-field', 'click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })

        $('.ed').click(function(e) {
            e.preventDefault();

            let mk = $(this).attr('meta_key');
            let mv = $(this).attr('meta_value');
            let id = $(this).attr('id');

            $('.modal_meta_key').val(mk);
            $('.modal_meta_value').val(mv);
            $('.modal_meta_id').val(id);

            $('#edit-meta-modal').modal('show');
        });

        $('body').delegate(".no_col", "change", function(e) {
            let v = $(this).val();
            $(this).parent().parent().find('.apcol').remove();
            $(this).parent().parent().parent().find('.col_none').hide();
            $(this).parent().parent().parent().find('.hvals').remove();
            if (v == 0) {
                $(this).parent().parent().parent().find('.col_none').show();
                return;
            }
            let htm = '<div class="row apcol p-3">';
            let hvals = '<div class="row p-3 hvals">';
            for (i = 1; i <= v; i++) {
                htm += `
               <div class="col-3 p-1">
               <input
                name="headings[${i}][heading]"
                class="form-control"
                placeholder="Enter heading ${i}"
                />
                </div>
               `;

                hvals += `
                <div class="col-3 p-1">
                    <input
                    name="headings[${i}][values][]"
                    class="form-control"
                    placeholder="Enter Value ${i}"
                    />
                </div>
               `;
            }
            htm += "</div>";
            hvals += `
            <div class="col-3 p-1">
                <button class="btn btn-success adval-btn" lp="${v}">Add Row</button>
            </div>`;

            $(this).parent().parent().append(htm);
            $(this).parent().parent().append(hvals);

        });

        $("body").delegate(".adval-btn", "click", function(e) {
            e.preventDefault();
            let lp = $(this).attr('lp');
            console.log(lp);
            let hvals = '<div class="row p-3 hvals">';
            for (i = 1; i <= lp; i++) {

                hvals += `
                <div class="col-3 p-1">
                    <input
                    name="headings[${i}][values][]"
                    class="form-control"
                    placeholder="Enter Value ${i}"
                    />
                </div>
               `;
            }

            hvals += `
            <div class="col-3 p-1">
                <button class="btn btn-danger remval-btn" >Remove Row</button>
            </div>`;

            $(this).parent().parent().append(hvals);

        });

        $("body").delegate(".remval-btn", "click", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });


    });

    function confirmDeleteGroup(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete it!"
        }).then(t => {
            t.isConfirmed && document.getElementById("delete-option" + id).submit()
        })
    }
</script>
