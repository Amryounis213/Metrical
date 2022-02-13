<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['user_id', 'full_name',  'email', 'mobile', 'subject', 'message', 'property_id', 'is_read'];
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
