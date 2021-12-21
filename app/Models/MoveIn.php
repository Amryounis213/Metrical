<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'country',
        'email',
        'aduls',
        'passport_number',
        'trn_number',
        'nationalty',
        'mobile',
        'emirate_id',
        'children_number',
        'data',
        'start_time',
        'end_time',
        'tenancy_contract',
        'contract_expiry',
        'passport',
        'passport_expiry',
        'title_dead',
        'emirateId_image',
        'registration_number_vehicle',
        'agree',
        'user_id',
        'property_id',
    ];
}
