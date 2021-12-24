<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'name_gr',
        'area',
        'reference',
        'feminizations',
        'is_shortterm',
        'bedroom',
        'bathroom',
        'gate',
        'date_added',
        'address_ar',
        'address_en',
        'address_gr',
        'description_ar',
        'description_ar',
        'description_ar',
        'city',
        'location_latitude',
        'location_longitude',
        'image_url',
        'images',
        'type',
        'offer_type',
        'status',
        'community_id',
        'owner_id',
        'amenities',
        'ownership_date',



    ];
    protected $appends = ['image_path'];
    protected $hidden = ['image_url'];


    protected $casts = ['amenities' => 'json', 'images' => 'json'];
    /**
     * 
     * Relations &_&
     */
    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }
    public function rent()
    {
        return $this->hasMany(Rent::class, 'property_id', 'id');
    }
    public function amenity()
    {
        return $this->belongsToMany(Amenity::class, 'amenities_properties ', 'property_id', 'amenity_id');
    }

    public function offer()
    {
        return $this->hasMany(Offer::class, 'property_id', 'id');
    }
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    public function enquires()
    {
        return $this->hasMany(Enquiry::class, 'property_id', 'id');
    }


    public function contact()
    {
        return $this->hasMany(ContactWithAdmin::class, 'property_id', 'id');
    }
    /**
     * 
     * 
     * Functions For Program
     */
    public function scopePercentage()
    {
        $rentedNow = $this->whereHas('rent')->count();
        $total = $this->count();
        if ($rentedNow != 0) {
            $per = $rentedNow  / $total * 100;
        }

        return $per  ??  0;
    }

    public function toArray()
    {
        $name = 'name_' . strval($this->name . app()->getLocale());
        $description = 'description_' . strval($this->name . app()->getLocale());
        $community = Community::find($this->community_id);
        $rentNow = Rent::where('property_id', $this->id)->where('status', 1)->exists();
        $owner = Owner::find($this->owner_id);
        return [
            'id' => $this->id,
            'name' => $this->$name,
            'description' => $this->$description,
            'area' => $this->area,
            'main_image' => $this->image_path,
            'images' => $this->images ?? [],
            'reference' => $this->reference,
            'feminizations' => $this->feminizations,
            'type' => $this->type,
            'is_shortterm' => $this->is_shortterm,
            'bedroom' => $this->bedroom,
            'bathroom' => $this->bathroom,
            'date_added' => $this->created_at,
            'address' => $this->address,
            'status' => $this->status,
            'offer_type' => $this->offer_type,
            'location_longitude' => $this->location_longitude,
            'location_latitude' => $this->location_latitude,
            'amenities' => $this->amenities,
            'community' => [
                'name' => $community->$name ?? '',
                'status' => $community->status ? 'under constraction' : 'ready',
                'properties_count' => $community->properties->count() ?? 'null',
                'image' => $community->image_path,
            ],
            'owner' => $this->owner_id ?
                [
                    'name' => $owner->full_name ?? 0,
                    'mobile' => $owner->mobile,
                    'image' => User::find($owner->user_id)->image_path,


                ] : null,
            'ownership_date' => $this->ownership_date,
            'rent_now' => $rentNow,
            'current_rent' => $rentNow ? Rent::where('property_id', $this->id)->where('status', 'active')->first(['from', 'to']) : null,
            'offer' => Offer::whereHas('property', function ($query) {
                $query->where('owner_id', $this->owner_id);
            })->where('status', 0)->get(),
        ];
    }

    public function getImagePathAttribute($value)
    {
        if (!$this->image_url) {
            return asset('uploads/palceholder.jpg');
        }
        if (stripos($this->image_url, 'http') ===  0) {
            return $this->image_url;
        }
        return asset('uploads/' . $this->image_url);
    }
}
