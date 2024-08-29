@extends('layouts.customer')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">@include('customer.includes.sidebar')</div>
            <div class="col-sm-9 mt-2">
                <div class="row">
                    <div class="page-title-box">
                        <h1 class="h1-heading">Upload Documents</h1>
                    </div>

                    <!----Result Form ---->

                    <div class="card mt-2">
                        <form>
                            <div class="card-body pt-1">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <label class="form-label">Driving Licence :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="date_of_accident" type="file" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Registration Certificate (RC) :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="registration_certificate" type="file" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Repair Estimate :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="repair_estimate" type="file" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Pan Card of Owner :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="pan_card_of_owner" type="file" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label"> Pan card of Repairer :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="pan_card_of_repairer" type="file" />
                                    </div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Aadhar Card of Owner :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="aadhar_card_of_owner" type="file" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Neft Details
                                            <small>
                                                (Copy of Name Cheque / account holder
                                                printed page of passbook / account
                                                statement)
                                            </small> :</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-control" name="neft_details" type="file" />
                                    </div>

                                </div>


                                <div class="row mt-2 justify-center">
                                    <div class="col-12 text-center">
                                        <a href="{{ route('customer.claim.show', $policy->id) }}"
                                            class="btn btn-dark">Cancel</a>
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!----End Result Form --->

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
