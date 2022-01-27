<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'community_id',
        'passport_copy',
        'visa_copy',
        'unit_number',
        'full_name',
        'email',
        'mobile',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function rent()
    {
        return $this->hasMany(Rent::class, 'tenant_id', 'id');
    }

    public function property()
    {
        return $this->hasMany(Property::class, 'tenant_id', 'id');
    }


    public function TenantAdd($users, $request)
    {

        Tenant::create([
            'user_id' => $users->id,
            'full_name' => $users->first_name . ' ' . $users->last_name,
            'email' => $users->email,
            'mobile' => $users->mobile_number,
            'passport_copy' => $request->passport_copy,
            'visa_copy' => $request->visa_copy,
            'unit_number' => $request->unit_number,
            'community_id' => $request->community_id,
        ]);
    }
}
