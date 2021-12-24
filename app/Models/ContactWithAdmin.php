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
        'phone_number'
    ];

    public function property()
    {
        return $this->belongsto(Property::class, 'property_id', 'id');
    }
}
