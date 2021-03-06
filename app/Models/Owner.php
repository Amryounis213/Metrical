<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'community_id',
        'passport_copy',
        'title_dead_copy',
        'emirate_id',
        'unit_number',
        'renting_price',
        'direct',
        'full_name',
        'email',
        'mobile',
        'status',
        'passport_expiry_date'
    ];
    protected $appends = ['passport_path', 'title_dead'];
    protected $hidden = ['passport_copy', 'title_dead_copy'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function property()
    {
        return $this->hasMany(Property::class, 'owner_id', 'id');
    }

    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }
    public function getPassportPathAttribute($value)
    {
        if (!$this->passport_copy) {
            return asset('uploads/palceholder.jpg');
        }
        if (stripos($this->passport_copy, 'http') ===  0) {
            return $this->passport_copy;
        }
        return asset('uploads/' . $this->image);
    }
    public function getTitleDeadAttribute($value)
    {
        if (!$this->title_dead_copy) {
            return asset('uploads/palceholder.jpg');
        }
        if (stripos($this->title_dead_copy, 'http') ===  0) {
            return $this->title_dead_copy;
        }
        return asset('uploads/' . $this->title_dead_copy);
    }


    /**
     * 
     */

    public function OwnerAdd($users, $request)
    {
        if ($request->hasFile('passport_copy')) {

            $uploadedFile = $request->file('passport_copy');

            $passport_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'passport_copy' => $passport_copy
            ]);
        }

        if ($request->hasFile('title_dead_copy')) {

            $uploadedFile = $request->file('title_dead_copy');

            $title_dead_copy = $uploadedFile->store('/', 'upload');
            $request->merge([
                'title_dead_copy' => $title_dead_copy
            ]);
        }


        Owner::create([
            'user_id' => $users->id,
            'full_name' => $users->first_name . ' ' . $users->last_name,
            'email' => $users->email,
            'mobile' => $users->mobile_number,
            'passport_copy' => $passport_copy,
            'title_dead_copy' => $title_dead_copy,
            'unit_number' => $request->unit_number,
            'renting_price' => $request->renting_price,
            'community_id' => $request->community_id,
        ]);
        $property = Property::find($request->property);
        $own = Owner::where('user_id', $users->id)->first();
        $property->update([
            'owner_id' => $own->id,
            'ownership_date' => Carbon::now(),
        ]);
    }
}
