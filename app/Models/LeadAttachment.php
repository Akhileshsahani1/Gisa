<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'name',
        'title',
        'quotation_id',
        'quotation_policy_id'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
}
