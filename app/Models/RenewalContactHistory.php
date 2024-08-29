<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalContactHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'renewal_id',
        'contacted_via',
        'caller_name',
        'receiver_name',
        'calling_date',
        'calling_time',
        'subject',
        'comment',
        'attachment_call_recording',
        'email_sent_date',
        'email_sender_id',
        'email_receiver_id',
        'email_subject',
        'email_body',
        'attachment_email',
        'message_date',
        'whats_app_from',
        'whats_app_from_dialcode',
        'whats_app_to',
        'whats_app_to_dialcode',
        'whatsapp_message',
        'attachment_whatsapp',
        'who_meet',
        'whom_meet',
        'meeting_date',
        'meeting_time',
        'meeting_location',
        'meeting_discussion',
        'follow_up_date',
        'follow_up_time',
        'added_by'
    ];

    public function renewal()
    {
        return $this->belongsTo(RenewalPolicies::class, 'renewal_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class, 'added_by', 'id');
    }
}
