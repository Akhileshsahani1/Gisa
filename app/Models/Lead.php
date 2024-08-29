<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';


    protected $fillable = [
        'lead_type',
        'salutation',
        'firstname',
        'lastname',
        'dialcode',
        'phone',
        'whats_app_dialcode',
        'whats_app',
        'email',
        'gender',
        'date_of_birth',
        'address',
        'lead_source',
        'assigned_to',
        'lead_status',
        'policy_id',
        'policy_type_id',
        'previous_policy_expiry_date',
        'special_remark',
        'contacted_via',
        'company_name',
        'company_phone',
        'customer_type',
        'seen_by',
        'is_claimed'
    ];

    /**
     * Get the Policy that owns the Lead
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }

    public function policyType()
    {
        return $this->belongsTo(PolicyType::class, 'policy_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class, 'assigned_to', 'id');
    }

    public function contactHistories()
    {
        return $this->hasMany(LeadContactHistory::class, 'lead_id', 'id');
    }
    public function leadContactHistories()
    {
        return $this->hasMany(LeadContactHistory::class, 'lead_id', 'id')->orderBy('id','DESC')->limit(5);;
    }
    public function follows()
    {
        return $this->hasMany(LeadFollowup::class, 'lead_id', 'id')->orderBy('id','DESC')->limit(5);
    }

    public function latestContactHistory(){
        return $this->hasOne(LeadContactHistory::class)->orderBy('id','DESC')->latest();

    }

    public function attachments()
    {
        return $this->hasMany(LeadAttachment::class, 'lead_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(LeadComment::class,'lead_id')->orderBy('id','DESC');
    }

}
