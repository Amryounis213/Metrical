<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        'description_en',
        'description_gr',
        'city',
        'location_latitude',
        'location_longitude',
        'image_url',
        'images',
        'video_url',
        'floor',
        'type',
        'offer_type',
        'status',
        'community_id',
        'owner_id',
        'amenities',
        'ownership_date',
        'tenant_id',

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
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }
    public function enquires()
    {
        return $this->hasMany(Enquiry::class, 'property_id', 'id');
    }


    public function contact()
    {
        return $this->hasMany(ContactWithAdmin::class, 'property_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Images::class, 'property_id', 'id');
    }
    /**
     * 
     * 
     * Functions For Program
     */
    public function scopePercentage()
    {
        $rentedNow = $this->whereHas('rent', function ($query) {
            $query->where('status', 'active');
        })->count();
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
        $cleaner_input = strip_tags($this->$description);
        $address = 'address_' . strval($this->name . app()->getLocale());
        $community = Community::find($this->community_id);
        $rentNow = Rent::where('property_id', $this->id)->where('status', 1)->exists();
        $owner = Owner::find($this->owner_id);
        $tenant = Tenant::find($this->tenant_id);
        $images = Images::where('property_id', $this->id)->get('path');


        $checker = false;
        $found = $owner->user_id ?? null;
        $found2 = $tenant->user_id ?? null;
        if ($found != null) {

            if ($owner->user_id == Auth::guard('sanctum')->id()) {
                $checker = true;
            } else {
                $checker = false;
            }
        } else {
            if ($found2 != null) {

                if ($tenant->user_id == Auth::guard('sanctum')->id()) {
                    $checker = true;
                } else {
                    $checker = false;
                }
            }
        }


        foreach ($images as $img) {
            $data[] = asset('uploads/' . $img->path);
        }
        $offer = Offer::where('property_id', $this->id)->latest()->first();
        if ($offer) {
            if ($offer->type == 'sale') {
                $offer = [
                    "id" => $offer->id,
                    "sale_price" => $offer->sale_price,
                    "type" => "sale",
                    "property_id" => $offer->property_id,
                    "user_id" => $offer->user_id,
                    "status" => $offer->status,
                ];
            } else if ($offer->type == 'rent') {
                $offer = [
                    "id" => $offer->id,
                    "rent_price" => $offer->rent_price,
                    "rent_start_date" => $offer->rent_start_date,
                    "rent_end_date" => $offer->rent_end_date,
                    "type" => "rent",
                    "property_id" => $offer->property_id,
                    "user_id" => $offer->user_id,
                    "status" => $offer->status,
                ];
            } else {
                $offer = [];
            }
        }

        return [
            'id' => $this->id,
            'name' => $this->$name,
            'brief' => Str::limit($cleaner_input, 150, '...'),
            'description' => $this->$description,
            'area' => $this->area,
            'main_image' => $this->image_path,
            'video' => $this->video_url,
            'images' => $data ?? [],
            'reference' => $this->reference,
            'feminizations' => $this->feminizations,
            'type' => $this->type,
            'is_shortterm' => $this->is_shortterm,
            'bedroom' => $this->bedroom,
            'bathroom' => $this->bathroom,
            'date_added' => $this->created_at,
            'address' => $this->$address,
            'status' => $this->status ?? 0,
            'offer_type' => $this->offer_type,
            'location_longitude' => $this->location_longitude,
            'location_latitude' => $this->location_latitude,
            'amenities' => $this->amenities ?? [],
            'floor' => $this->floor,
            'community' => [
                'id' => $community->id ?? null,
                'name' => $community->$name ?? '',
                'status' => $community->status ?? 0,
                'properties_count' => $community->properties->count(),
                'image' => $community->image_path,
                'percentage' => $community->readness_percentage,
            ],
            'owner' => $this->owner_id ?
                [
                    'name' => $owner->full_name ?? 0,
                    'mobile' => $owner->mobile,
                    'image' => User::find($owner->user_id)->image_path,
                    'email' => $owner->email,
                ] : null,
            'ownership_date' => $this->ownership_date,
            'has_this_property' => $checker,
            'rent_now' => $rentNow,
            'current_rent' => $rentNow ? Rent::where('property_id', $this->id)->where('status', 'active')->first(['from', 'to']) : null,
            'offer' => $offer,
        ];
    }

    public function getImagePathAttribute($value)
    {
        if (!$this->image_url) {
            return asset('admin/assets/media/users/300_25.jpg');
        }
        if (stripos($this->image_url, 'http') ===  0) {
            return $this->image_url;
        }
        return asset('uploads/' . $this->image_url);
    }
}
