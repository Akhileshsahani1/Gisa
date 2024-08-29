@include('admin.dispatch.edit.edit-modal')
@push('scripts')
    <script>
        function getMembers(m = null){
        let members = '<option value="">--select--</option>';
        @if (isset($members))

            @foreach ($members as $member)
                members +=
                    "<option value='{{ $member->id }}'  >{{ $member->firstname . ' ' . $member->lastname }}</option>";
            @endforeach
        @endif
        return members;
        }
        function getCompanies(c = null){

        let companies = '<option value="">--select--</option>';
        @if (isset($companies))

            @foreach ($companies as $company)
                companies += "<option value='{{ $company->value }}' >{{ $company->value }}</option>";
            @endforeach
        @endif
        return companies;
        }

        const getData = (data,field) =>{
           return (data != undefined) ? data[field] : '';
        }

        function whatsappHtm(data = null) {

            return `<hr><div class="row m-2">
                        <div class="col-4 mt-2 text-end">
                            <label for="whatsapp_no" class="form-label">Whatsapp no.</label>
                        </div>
                        <div class="col-6">
                            <input type="text"  required class="form-control" placeholder="Enter whatsaap no." name="whatsapp_no" value="`+getData(data,'whatsapp_no')+`">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label for="send_date" class="form-label">Send Date.</label>
                        </div>
                        <div class="col-6">
                            <input type="date" required class="form-control" name="send_date" value="`+getData(data,'send_date')+`">
                        </div>
                    </div>`;
        }

        function emailHtm(data = null) {
            return `<hr><div class="row m-2">
                            <div class="col-4 mt-2 text-end">
                                <label for="email_id" class="form-label">Email ID.</label>
                            </div>
                            <div class="col-6">
                                <input type="email" required class="form-control" placeholder="Enter Email ID." name="email_id" value="`+getData(data,'email_id')+`">
                            </div>

                            <div class="col-4 mt-2 text-end">
                                <label for="send_date" class="form-label">Send Date.</label>
                            </div>
                            <div class="col-6">
                                <input type="date" required class="form-control" name="send_date" value="`+getData(data,'send_date')+`">
                            </div>
                        </div>`;
        }

        function courierHtm(data = null) {
            return `<hr><div class="row m-2">
                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Dispatch Address</label>
                    </div>
                    <div class="col-6">
                        <input required placeholder="Enter Dispatch Address" class="form-control" name="dispatch_address" type="text" value="`+getData(data,'dispatch_address')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Courier Company</label>
                    </div>
                    <div class="col-6 mt-2">
                        <select required class="form-select" name="courier_company" value="`+getData(data,'courier_company')+`">
                        ` + getCompanies( getData(data,'courier_company') ) + `
                        <select>
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">P.O.D Details</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="text" name="pod_details" placeholder="Enter POD Details" class="form-control" value="`+getData(data,'pod_details')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Recieved Date</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="date" name="received_date" class="form-control" value="`+getData(data,'received_date')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Confirmation date</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="date" name="confirmation_date" class="form-control" value="`+getData(data,'confirmation_date')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Confirmed By</label>
                    </div>
                    <div class="col-6 mt-2">
                       <input type="text" name="confirmed_by" placeholder="Enter Confirmed By" class="form-control" value="`+getData(data,'confirmed_by')+`">
                </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Feedback</label>
                    </div>
                    <div class="col-6 mt-2">
                       <textarea name="feedback" class="form-control" placeholder="Any feedback..">`+getData(data,'feedback')+`</textarea>
                    </div>


                </div>`;
        }

        function employeeHtm( data = null) {
            console.log(data.refrence);
            return `<hr><div class="row m-2">
                        <div class="col-4 mt-2 text-end">
                            <label for="email_id" class="form-label">Dispatch Address</label>
                        </div>
                        <div class="col-6">
                            <input required placeholder="Enter Dispatch Address" class="form-control" name="dispatch_address" type="text" value="`+getData(data,'dispatch_address')+`">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Employee Name</label>
                        </div>
                        <div class="col-6 mt-2">
                            <select required class="form-select" name="employee_name" value="`+getData(data,'employee_name')+`">
                           ` +  getMembers( getData(data,'employee_name') ) + `
                            <select>
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Given To</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="text" name="given_to" placeholder="Enter Given To." class="form-control"  value="`+getData(data,'given_to')+`">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Given Date</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="date" name="given_date" class="form-control"  value="`+getData(data,'given_date')+`">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Confirmation date</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="date" name="confirmation_date" class="form-control"  value="`+getData(data,'confirmation_date')+`">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Confirmed By</label>
                        </div>
                        <div class="col-6 mt-2">
                        <input type="text" name="confirmed_by" placeholder="Enter Confirmed By" class="form-control"  value="`+getData(data,'confirmed_by')+`">
                        </div>

                        <div class="col-4 mt-2 text-end">
                            <label class="form-label">Feedback</label>
                        </div>
                        <div class="col-6 mt-2">
                        <textarea name="feedback" class="form-control" placeholder="Any feedback..">`+getData(data,'feedback')+`</textarea>
                        </div>

                        </div>`;
        }

        function selfHtm( data = null ) {
            return `<hr><div class="row m-2">

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Collector Name</label>
                    </div>
                    <div class="col-6 mt-2">
                        <select required class="form-select" name="collector_name"  value="`+getData(data,'collector_name')+`">
                        ` +  getMembers( getData(data,'collector_name') ) + `
                        <select>
                    </div>


                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Collected Date</label>
                    </div>
                    <div class="col-6 mt-2">
                    <input type="date" name="collected_date" class="form-control"  value="`+getData(data,'collected_date')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Confirmation date</label>
                    </div>
                    <div class="col-6 mt-2">
                    <input type="date" name="confirmation_date" class="form-control"  value="`+getData(data,'confirmation_date')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Confirmed By</label>
                    </div>
                    <div class="col-6 mt-2">
                    <input type="text" name="confirmed_by" placeholder="Enter Confirmed By" class="form-control"  value="`+getData(data,'confirmed_by')+`">
                    </div>

                    <div class="col-4 mt-2 text-end">
                        <label class="form-label">Feedback</label>
                    </div>
                    <div class="col-6 mt-2">
                    <textarea name="feedback" class="form-control" placeholder="Any feedback..">`+getData(data,'feedback')+`</textarea>
                    </div>

                    <!---<div class="col-4 mt-2 text-end">
                        <label class="form-label">Refrence</label>
                    </div>
                    <div class="col-6 mt-2 float-end">
                    <input type="checkbox" name="refrence" id="refrence" checked="`+( (data != undefined) ? (data?.refrence == 'yes' ? true: false) : false)+`" value="yes"> Yes
                    <input type="checkbox" name="refrence" id="refrence" checked="`+( (data != undefined) ? (data?.refrence == 'no' ? true: false) : false)+`" value="no"> No
                    </div>--->

                    </div>`;
        }

        jQuery(document).ready(function($) {

            $('body').delegate('.edit-dispatch','click',function(e) {
                e.preventDefault();
                let mode = $(this).attr('mode');
                let data = JSON.parse($(this).attr('data'));
                let dispatch_date = $(this).attr('dispatch_date');
                let dispatch_id = $(this).attr('did');

                let html = "";
                $('#dispatch_date').val(dispatch_date);
                $('#dispatch_id').val(dispatch_id);
                $("input[value='"+mode+"']").prop('checked',true);

                setTimeout(() => {
                    let selects = document.querySelectorAll('select');
                    selects.forEach((s,i)=>{
                        let vs = s.getAttribute('value');
                        if( vs != ''){
                            $(s).find('option[value="'+vs+'"]').prop('selected',true);
                        }
                    })
                }, 200);

                switch (mode.toString()) {
                    case 'courier':
                        html = courierHtm(data);
                        break;
                    case 'employee':
                        html = employeeHtm(data);
                        break;
                    case 'self':
                        html = selfHtm(data);
                        break;
                    case 'email':
                        html = emailHtm(data);
                        break;
                    case 'whatsapp':
                        html = whatsappHtm(data);
                        break;
                    default:
                        html = "Something went wrong :(";
                }
                $('#formFieldsData').children().remove();
                $('#formFieldsData').append(html);
                $('#dispatch-edit-modal').modal('show');
            })

            $('input[name="dispatch_by"]').on('change', function(e) {
                $('input[name="dispatch_by"]').prop('checked', false);
                $(this).prop('checked', true);
                let val = $(this).val();
                let $htm = '';

                if (val == 'whatsapp') {

                    $('#formFieldsData').children().remove();

                    $htm = whatsappHtm();
                }

                if (val == 'email') {

                    $('#formFieldsData').children().remove();

                    $htm = emailHtm();
                }

                if (val == 'courier') {

                    $('#formFieldsData').children().remove();

                    $htm = courierHtm();
                }

                if (val == 'employee') {

                    $('#formFieldsData').children().remove();

                    $htm = employeeHtm();
                }

                if (val == 'self') {

                    $('#formFieldsData').children().remove();

                    $htm = selfHtm();
                }

                $('#formFieldsData').append($htm);
            });
        })
    </script>
@endpush
