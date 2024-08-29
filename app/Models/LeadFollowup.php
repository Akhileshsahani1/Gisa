<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadFollowup extends Model
{
    use HasFactory;

     protected $fillable = [
        'lead_id',
        'contacted_via',
        'comment',
        'follow_up_date',
        'follow_up_time',
        'added_by'
    ];

     public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class, 'added_by', 'id');
    }
}
