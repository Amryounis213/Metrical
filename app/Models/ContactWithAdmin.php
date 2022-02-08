<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWithAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'message',
        'phone_number',
        'is_read',
    ];

    public function property()
    {
        return $this->belongsto(Property::class, 'property_id', 'id');
    }

    public function user()
    {
        return $this->belongsto(User::class, 'user_id', 'id');
    }
}
