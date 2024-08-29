<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'comment',
        'comment_by'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(Administrator::class, 'id', 'comment_by');
    }
}
