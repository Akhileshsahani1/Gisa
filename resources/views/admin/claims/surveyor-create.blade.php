<div class="modal fade" id="modal-create-surveyor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @include('admin.includes.flash-message')
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Add Surveyor Detail</h5>
                <button type="button" class="btn btn-light btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="background-color: #fff;
                    opacity: 1;"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="customerForm" action="">
                    @csrf
                    <div class="custom_policy">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">Surveyor Detail’s</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">Vehicle Survey</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu2">Upload Final Documents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu3">Status of Claim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu4">NEFT Detail's</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane pt-2 active" id="home">
                                <div class="form-group col-md-12">
                                    <label for="firstname" class="col-form-label">Name of Surveyor<span
                                            class="text-danger">*</span></label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="contactnumber">Contact Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control @error('contactnumber') is-invalid @enderror"
                                        id="contactnumber" name="contactnumber">
                                    @error('contactnumber')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Email Address<span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary btnNext">Next</a>
                                </div>
                            </div>
                            <div class="tab-pane pt-2 fade" id="menu1">
                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Inspected by Surveyor</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Pending
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Done
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Approval For Dismantle</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault3">
                                            <label class="form-check-label" for="flexRadioDefault3">
                                                Pending
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault4">
                                            <label class="form-check-label" for="flexRadioDefault4">
                                                Done
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">IF Supplementary Estimate Generated
                                        Press Yes
                                        <span class=""
                                            style="display: block;font-size: 12px;font-weight: 400;">( If
                                            press
                                            yes then Ask about 1st , 2nd , 3rd , 4th Supplementary Estimate )
                                        </span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="supplementary_estimate" class="col-form-label">Upload Supplementary
                                        Estimate</label>
                                    <input id="supplementary_estimate" type="file"
                                        class="form-control @error('supplementary_estimate') is-invalid @enderror"
                                        name="supplementary_estimate">
                                    @error('supplementary_estimate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-group text-center mt-3 mb-2">
                                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value=""
                                            id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            Approval Pending for Supplementary Estimate
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Status of Supplementary
                                        Estimate</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault6">
                                            <label class="form-check-label" for="flexRadioDefault6">
                                                Pending
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault7">
                                            <label class="form-check-label" for="flexRadioDefault7">
                                                Approved
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault8">
                                            <label class="form-check-label" for="flexRadioDefault8">
                                                Denied
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Reason of Denial</label>
                                    <textarea class="form-control" cols="2" rows="2"></textarea>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Vehicle Repaired</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault9">
                                            <label class="form-check-label" for="flexRadioDefault9">
                                                Done
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Final Inspection by Surveyor</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault10">
                                            <label class="form-check-label" for="flexRadioDefault10">
                                                Pending
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault11">
                                            <label class="form-check-label" for="flexRadioDefault11">
                                                Done
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary btnPrev">Back</a>
                                    <a class="btn btn-primary btnNext">Next</a>
                                </div>
                            </div>
                            <div class="tab-pane pt-2 fade" id="menu2">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="tax_invoice" class="col-form-label">Tax Invoice</label>
                                        <input id="tax_invoice" type="file"
                                            class="form-control @error('tax_invoice') is-invalid @enderror"
                                            name="tax_invoice">
                                        @error('tax_invoice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group text-center mt-3 mb-2">
                                            <button type="button" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="money_receipt" class="col-form-label">Money Receipt</label>
                                        <input id="money_receipt" type="file"
                                            class="form-control @error('money_receipt') is-invalid @enderror"
                                            name="money_receipt">
                                        @error('money_receipt')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-group text-center mt-3 mb-2">
                                            <button type="button" class="btn btn-sm btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-3 mb-2">
                                    <button type="button" class="btn btn-secondary me-2">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary btnPrev">Back</a>
                                    <a class="btn btn-primary btnNext">Next</a>
                                </div>
                            </div>
                            <div class="tab-pane pt-2 fade" id="menu3">
                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Submission of Final Survey
                                        Report</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault12">
                                            <label class="form-check-label" for="flexRadioDefault12">
                                                Pending
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault13">
                                            <label class="form-check-label" for="flexRadioDefault13">
                                                Done
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <p>( If Final Survey Report Generated then view option of assessment report shows )
                                    </p>
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label me-3">View Assessment Report</label>

                                    <button type="button" class="btn btn-secondary btn-sm me-2"><i
                                            class="mdi mdi mdi-eye"></i> View</button>
                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                            class="mdi mdi mdi-download"></i> Download</button>
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label for="email" class="col-form-label">Claim Approved for settlement</label>

                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault12">
                                            <label class="form-check-label" for="flexRadioDefault14">
                                                Pending
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault13">
                                            <label class="form-check-label" for="flexRadioDefault15">
                                                Done
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary btnPrev">Back</a>
                                    <a class="btn btn-primary btnNext">Next</a>
                                </div>

                            </div>
                            <div class="tab-pane pt-2 fade" id="menu4">

                                <div class="row">
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="amount" class="col-form-label">Amount</label>
                                        <input id="amount" type="number"
                                            class="form-control @error('amount') is-invalid @enderror" name="amount"
                                            >
                                        @error('amount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="holder_name" class="col-form-label">Account Holder Name</label>
                                        <input id="holder_name" type="text"
                                            class="form-control @error('holder_name') is-invalid @enderror" name="holder_name">
                                        @error('holder_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <label for="account_number" class="col-form-label">Account Number</label>
                                        <input id="account_number" type="number"
                                            class="form-control @error('account_number') is-invalid @enderror" name="account_number"
                                            >
                                        @error('account_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <label for="name_of_bank" class="col-form-label">Name of Bank</label>
                                        <input id="name_of_bank" type="text"
                                            class="form-control @error('name_of_bank') is-invalid @enderror" name="name_of_bank">
                                        @error('name_of_bank')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 mb-2">
                                        <label for="email" class="col-form-label me-3">View Payment Voucher</label>

                                        <button type="button" class="btn btn-secondary btn-sm me-2"><i
                                                class="mdi mdi mdi-eye"></i> View</button>
                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                class="mdi mdi mdi-download"></i> Download</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-secondary btnPrev">Back</a>
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            {{-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="customerForm">Submit</button>
            </div> --}}
        </div>

    </div>
</div>

<style>
    .form-check-input{
        border: 1px solid #1e85b2;
    }
    .form-check-input:focus {
        border-color: #1e85b2;
    }
    hr {
        background-color: #dee2e6;
        opacity: 1;
    }
</style>

<script>
    const nextBtn = document.querySelectorAll(".btnNext");
    const prevBtn = document.querySelectorAll(".btnPrev");

    nextBtn.forEach(function(item, index) {
        item.addEventListener('click', function() {
            let id = index + 1;
            let tabElement = document.querySelectorAll("#myTab li a")[id];
            var lastTab = new bootstrap.Tab(tabElement);
            lastTab.show();
        });
    });

    prevBtn.forEach(function(item, index) {
        item.addEventListener('click', function() {
            let id = index;
            let tabElement = document.querySelectorAll("#myTab li a")[id];
            var lastTab = new bootstrap.Tab(tabElement);
            lastTab.show();
        });
    });
</script>
