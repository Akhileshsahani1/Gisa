<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Support extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected $fillable = [
        'customer_id',
        'role_id',
        'subject',
        'priority',
        'description',
        'attachment',
        'status',
        'seen'
    ];

    
    public function chats()
    {
        return $this->hasMany(SupportChat::class, 'support_id', 'id');
    }

    public function unseen()
    {
        return $this->hasMany(SupportChat::class, 'support_id', 'id')->where('sender', 'admin')->where('seen', 0);
    }

    public function unseenadmin()
    {
        return $this->hasMany(SupportChat::class, 'support_id', 'id')->where('sender', 'customer')->where('seen', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    public function department()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
