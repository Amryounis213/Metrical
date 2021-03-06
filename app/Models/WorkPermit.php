<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPermit extends Model
{
    use HasFactory;

    protected $fillable = [

        'contractor_name',
        'contractor_contact_name',
        'country',
        'mobile',
        'number_of_staff',
        'start_time',
        'end_time',
        'description',
        'resident_name',
        'resident_country',
        'children_number',
        'aduls',
        'resident_mobile',
        'officer_country',
        'officer_number',
        'passport_number',
        'trn_number',
        'emirate_id',
        'date',
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
        'contact',

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
