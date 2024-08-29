<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'renewal_id',
        'comment',
        'comment_by'
    ];

    public function renewal()
    {
        return $this->belongsTo(RenewalPolicies::class, 'renewal_id', 'id');
    }
    public function user()
    {
        return $this->hasOne(Administrator::class, 'id', 'comment_by');
    }
}
