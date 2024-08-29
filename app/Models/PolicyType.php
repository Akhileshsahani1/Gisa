<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'type',
        'enabled',
        'commissions'
    ];

    /**
     * Get the product that owns the ProductType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'policy_id', 'id');
    }

    public function commissionData()
    {
        return $this->hasMany(PolicyTypeCommission::class, 'policy_type_id', 'id');
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'policy_id', 'id');
    }
}
