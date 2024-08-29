<div class="col-12" id="contacted_div">
    <div class="card">
        <div class="card-body pt-1">
            <div class="form-group col-md-12">
                <label for="contacted_via" class="col-form-label">Contacted Via <span class="text-danger">*</span></label>
                <select id="contacted_via" class="form-select @error('contacted_via') is-invalid @enderror"
                    name="contacted_via" onchange="getContactSubOptions()">
                    <option value="">Choose One</option>
                    <option value="Via Phone" {{ old('contacted_via', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->contacted_via : "") == 'Via Phone' ? 'selected' : '' }}>
                        Via Phone
                    </option>
                    <option value="Via Email" {{ old('contacted_via', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->contacted_via : "") == 'Via Email' ? 'selected' : '' }}>
                        Via Email
                    </option>
                    <option value="Via WhatsApp" {{ old('contacted_via', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->contacted_via : "") == 'Via WhatsApp' ? 'selected' : '' }}>
                        Via WhatsApp
                    </option>
                    <option value="Via Meet" {{ old('contacted_via', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->contacted_via : "") == 'Via Meet' ? 'selected' : '' }}>
                        Via Meet
                    </option>
                </select>
                @error('contacted_via')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-md-12" id="phone_div">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="caller_name" class="col-form-label">Caller Name </label>
                        <input id="caller_name" type="text"
                            class="form-control @error('caller_name') is-invalid @enderror" name="caller_name"
                            value="{{ old('caller_name', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->caller_name : "") }}" placeholder="Enter Caller Name">
                        @error('caller_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="receiver_name" class="col-form-label">Receiver Name </label>
                        <input id="receiver_name" type="text"
                            class="form-control @error('receiver_name') is-invalid @enderror" name="receiver_name"
                            value="{{ old('receiver_name', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->receiver_name : "") }}" placeholder="Enter Receiver Name">
                        @error('receiver_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="calling_date" class="col-form-label">Calling Date </label>
                        <input id="calling_date" type="date"
                            class="form-control @error('calling_date') is-invalid @enderror" name="calling_date"
                            value="{{ old('calling_date', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->calling_date : "") }}" placeholder="Calling Date">
                        @error('calling_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="calling_time" class="col-form-label">Calling Time </label>
                        <input id="calling_time" type="time"
                            class="form-control @error('calling_time') is-invalid @enderror" name="calling_time"
                            value="{{ old('calling_time', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->calling_time : "") }}" placeholder="Calling Time">
                        @error('calling_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="subject" class="col-form-label">Subject</label>
                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                            name="subject" value="{{ old('subject', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->subject : "") }}" placeholder="Subject">
                        @error('subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="comment" class="col-form-label">Comment</label>
                        <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" name="comment" rows="2" placeholder="Write Comment here">{{ old('comment', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->comment : "") }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="attachment_call_recording" class="col-form-label">Attachment</label>
                        <input type="file" id="attachment_call_recording" class="form-control"
                            name="attachment_call_recording">
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="email_div">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="email_sent_date" class="col-form-label">Email Sent Date </label>
                        <input id="email_sent_date" type="date"
                            class="form-control @error('email_sent_date') is-invalid @enderror" name="email_sent_date"
                            value="{{ old('email_sent_date', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->email_sent_date : "") }}" placeholder="Email Sent Date">
                        @error('email_sent_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="email_sender_id" class="col-form-label">Email Sender ID </label>
                        <input id="email_sender_id" type="email"
                            class="form-control @error('email_sender_id') is-invalid @enderror" name="email_sender_id"
                            value="{{ old('email_sender_id', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->email_sender_id : "") }}" placeholder="Enter Email Sender ID">
                        @error('email_sender_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="email_receiver_id" class="col-form-label">Email Receiver ID </label>
                        <input id="email_receiver_id" type="email"
                            class="form-control @error('email_receiver_id') is-invalid @enderror"
                            name="email_receiver_id" value="{{ old('email_receiver_id', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->email_receiver_id : "") }}"
                            placeholder="Enter Email Receiver ID">
                        @error('email_receiver_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="email_subject" class="col-form-label">Email Subject</label>
                        <input id="email_subject" type="text"
                            class="form-control @error('email_subject') is-invalid @enderror" name="email_subject"
                            value="{{ old('email_subject', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->email_subject : "") }}" placeholder="Email Subject">
                        @error('email_subject')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="email_body" class="col-form-label">Email Body</label>
                        <textarea id="email_body" class="form-control @error('email_body') is-invalid @enderror" name="email_body" rows="2" placeholder="Write Email Body here">{{ old('email_body', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->email_body : "") }}</textarea>
                        @error('email_body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="attachment_email" class="col-form-label">Attachment</label>
                        <input type="file" id="attachment_email" class="form-control" name="attachment_email">
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="whatsapp_div">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="message_date" class="col-form-label">Message Date </label>
                        <input id="message_date" type="date"
                            class="form-control @error('message_date') is-invalid @enderror" name="message_date"
                            value="{{ old('message_date', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->message_date : "") }}" placeholder="Message Date">
                        @error('message_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="whats_app_from">WhatsApp From Number </label>
                        <input type="text" class="form-control @error('whats_app_from') is-invalid @enderror"
                            id="whats_app_from" name="whats_app_from" placeholder="Enter WhatsApp Number"
                            value="{{ old('whats_app_from', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->whats_app_from : "") }}">
                        @error('whats_app_from')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input id="whats_app_from-dial-code" name="whats_app_from_dialcode" type="hidden"
                            value="{{ old('whats_app_from_dialcode', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->whats_app_from_dialcode : "") }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label" for="whats_app_to">WhatsApp To Number </label>
                        <input type="text" class="form-control @error('whats_app_to') is-invalid @enderror"
                            id="whats_app_to" name="whats_app_to" placeholder="Enter WhatsApp Number"
                            value="{{ old('whats_app_to', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->whats_app_to : "") }}">
                        @error('whats_app_to')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input id="whats_app_to-dial-code" name="whats_app_to_dialcode" type="hidden"
                            value="{{ old('whats_app_to_dialcode', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->whats_app_to_dialcode : "") }}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="whatsapp_message" class="col-form-label">Whatsapp Message</label>
                        <textarea id="whatsapp_message" class="form-control @error('whatsapp_message') is-invalid @enderror"
                            name="whatsapp_message" rows="2"
                            placeholder="Write Whatsapp Message here">{{ old('whatsapp_message', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->whatsapp_message : "") }}</textarea>
                        @error('whatsapp_message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="attachment_whatsapp" class="col-form-label">Attachment</label>
                        <input type="file" id="attachment_whatsapp" class="form-control"
                            name="attachment_whatsapp">
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="meet_div">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="who_meet" class="col-form-label">Who Meet ? </label>
                        <input id="who_meet" type="text"
                            class="form-control @error('who_meet') is-invalid @enderror" name="who_meet"
                            value="{{ old('who_meet', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->who_meet : "") }}" placeholder="Who Meet ?">
                        @error('who_meet')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="whom_meet" class="col-form-label">Whom Meet ? </label>
                        <input id="whom_meet" type="text"
                            class="form-control @error('whom_meet') is-invalid @enderror" name="whom_meet"
                            value="{{ old('whom_meet', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->whom_meet : "") }}" placeholder="Whom Meet ?">
                        @error('whom_meet')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="meeting_date" class="col-form-label">Meeting Date </label>
                        <input id="meeting_date" type="date"
                            class="form-control @error('meeting_date') is-invalid @enderror" name="meeting_date"
                            value="{{ old('meeting_date', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->meeting_date : "") }}" placeholder="Meeting Date">
                        @error('meeting_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="meeting_time" class="col-form-label">Meeting Time </label>
                        <input id="meeting_time" type="time"
                            class="form-control @error('meeting_time') is-invalid @enderror" name="meeting_time"
                            value="{{ old('meeting_time', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->meeting_time : "") }}" placeholder="Meeting Time">
                        @error('meeting_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="meeting_location" class="col-form-label">Meeting Location</label>
                        <input id="meeting_location" type="text"
                            class="form-control @error('meeting_location') is-invalid @enderror"
                            name="meeting_location" value="{{ old('meeting_location', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->meeting_location : "") }}"
                            placeholder="Meeting Location">
                        @error('meeting_location')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="meeting_discussion" class="col-form-label">Meeting Discussion</label>
                        <textarea id="meeting_discussion" class="form-control @error('meeting_discussion') is-invalid @enderror"
                            name="meeting_discussion" rows="2"
                            placeholder="Write Meeting Discussion here">{{ old('meeting_discussion', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->meeting_discussion : "") }}</textarea>
                        @error('meeting_discussion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="follow_up_date" class="col-form-label">Next Follow Up Date </label>
                        <input id="follow_up_date" type="date"
                            class="form-control @error('follow_up_date') is-invalid @enderror" name="follow_up_date"
                            value="{{ old('follow_up_date', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->follow_up_date : "") }}" placeholder="Next Follow Up Date">
                        @error('follow_up_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="follow_up_time" class="col-form-label">Next Follow Up Time </label>
                        <input id="follow_up_time" type="time"
                            class="form-control @error('follow_up_time') is-invalid @enderror" name="follow_up_time"
                            value="{{ old('follow_up_time', isset($lead) && isset($lead->latestContactHistory) ? $lead->latestContactHistory->follow_up_time : "") }}" placeholder="follow_up Time">
                        @error('follow_up_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
