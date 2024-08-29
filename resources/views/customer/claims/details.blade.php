@extends('layouts.customer')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">@include('customer.includes.sidebar')</div>
            <div class="col-sm-9 mt-2">
                <div class="row">
                    <div class="page-title-box">
                        <h1 class="h1-heading">Detail's for claims process</h1>
                    </div>

                    <!----Result Form ---->

                    <div class="card mt-2">
                        <form>
                            <div class="card-body pt-1">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <label class="form-label">Date of Accident :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="date_of_accident" type="date" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Place of Accident :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="place_of_accident" type="text"
                                            Placeholder="Enter Place of Accident" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Time of Accident :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="time_of_accident" type="text"
                                            Placeholder="Enter Time of Accident" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Description of Accident :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="description_of_accident" type="text"
                                            Placeholder="Enter Description of Accident" />
                                    </div>
                                </div>

                                <div class="row m-3"><strong>OR</strong></div>

                                <div class="row mt-2">
                                    <div class="col-sm-4">
                                        <label class="form-label">Voice Description of Accident :</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <audio controls autoplay></audio>

                                        <fieldset>
                                            <legend>RECORD AUDIO</legend>
                                            <input onclick="startRecording()" type="button" value="start recording" />
                                            <input onclick="stopRecording()" type="button"
                                                value="stop recording and play" />
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Name :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="name" type="text"
                                            Placeholder="Enter Name" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Contact Number :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="contact_number" type="number"
                                            Placeholder="Enter Contact Number" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <label class="form-label">Claim Settlement Type :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select" name="claim_settlement_type">
                                            <option value="">--select--</option>
                                            <option value="Cashless">Cashless</option>
                                            <option value="Reimbursement">Reimbursement</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="row mt-2 justify-center">
                                    <div class="col-12 text-center">
                                        <a href="{{ route('customer.policy.show', $policy->id) }}"
                                            class="btn btn-dark">Cancel</a>
                                        <a onclick="{$('#uploadDocs').submit()}" class="btn btn-success">Update</a>
                                        <form method="POST" action="{{ route('customer.claim.upload-docs') }}" id="uploadDocs">
                                            @csrf
                                            <input type="hidden" name="policy_id" value="{{$policy->id}}">
                                        </form>
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
<script src="{{ url('assets/js/recorder.js') }}"></script>
@push('scripts')
    <script>
        var onFail = function(e) {
            console.log('Rejected!', e);
        };

        var onSuccess = function(s) {
            var context = new webkitAudioContext();
            var mediaStreamSource = context.createMediaStreamSource(s);
            recorder = new Recorder(mediaStreamSource);
            recorder.record();

            // audio loopback
            // mediaStreamSource.connect(context.destination);
        }

        window.URL = window.URL || window.webkitURL;
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
            navigator.msGetUserMedia;

        var recorder;
        var audio = document.querySelector('audio');

        function startRecording() {
            if (navigator.getUserMedia) {
                navigator.getUserMedia({
                    audio: true
                }, onSuccess, onFail);
            } else {
                console.log('navigator.getUserMedia not present');
            }
        }

        function stopRecording() {
            recorder.stop();
            recorder.exportWAV(function(s) {

                audio.src = window.URL.createObjectURL(s);
            });
        }
    </script>
@endpush
