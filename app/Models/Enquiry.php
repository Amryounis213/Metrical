<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['user_id', 'full_name',  'email', 'mobile', 'subject', 'message', 'property_id'];
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
