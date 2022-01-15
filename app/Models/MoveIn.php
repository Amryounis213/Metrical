<?php

namespace App\Models;

use Carbon\Carbon;
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
        'date',
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function getStartTimeAttribute($value)
    {
        # code...
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function getEndTimeAttribute($value)
    {
        # code...
        return Carbon::parse($value)->format('Y-m-d');
    }
    public function getCreatedAtAttribute($value)
    {
        # code...
        return Carbon::parse($value)->format('Y-m-d');
    }
}
