<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveOut extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'country',
        'email',
        'mobile',
        'data',
        'start_time',
        'end_time',
        'agree',
        'user_id',
        'property_id',
    ];
}
