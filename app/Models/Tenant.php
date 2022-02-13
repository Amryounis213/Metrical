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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rent()
    {
        return $this->hasMany(Rent::class, 'tenant_id', 'id');
    }

    public function property()
    {
        return $this->hasMany(Property::class, 'tenant_id', 'id');
    }
    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }

    public function TenantAdd($users, $request)
    {

        if ($request->hasFile('visa_copy')) {

            $uploadedFile = $request->file('visa_copy');
            $visa_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'visa_copy' => $visa_copy
            ]);
        }
        if ($request->hasFile('passport_copy')) {

            $uploadedFile = $request->file('passport_copy');

            $passport_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'passport_copy' => $passport_copy
            ]);
        }


        Tenant::create([
            'user_id' => $users->id,
            'full_name' => $users->first_name . ' ' . $users->last_name,
            'email' => $users->email,
            'mobile' => $users->mobile_number,
            'passport_copy' => $passport_copy ?? null,
            'visa_copy' => $visa_copy ?? null,
            'unit_number' => $request->unit_number,
            'community_id' => $request->community_id,
        ]);
    }
}
