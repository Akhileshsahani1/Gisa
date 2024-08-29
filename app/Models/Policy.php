<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enabled'
    ];

    public $timestamps = true;

    /**
     * Get all of the types for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function types()
    {
        return $this->hasMany(PolicyType::class, 'policy_id', 'id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'policy_id', 'id');
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'policy_id', 'id');
    }

}
