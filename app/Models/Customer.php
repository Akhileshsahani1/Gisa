<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
     use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'customer_type',
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
        'date_of_anniversary',
        'address',
        'gst_no',
        'pan_no',
        'source',
        'pancard_file',
        'gst_file',
        'aadhar',
        'state',
        'city',
        'zipcode',
       ' avatar',
        'other',
        'account_balance'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }

    /**
     * Get all of the quotations for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotations()
    {
        return $this->hasMany(Quotation::class, 'customer_id', 'id');
    }


}
