<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Community extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'name_gr', 'area', 'location_longitude', 'location_latitude', 'image', 'status', 'readness_percentage'];

    protected $appends = ['image_path'];
    protected $hidden = ['image'];

    public function properties()
    {
        return $this->hasMany(Property::class, 'community_id', 'id');
    }

    public function owner()
    {
        return $this->hasMany(Owner::class, 'community_id', 'id');
    }

    public function tenant()
    {
        return $this->hasMany(Tenant::class, 'community_id', 'id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'community_id', 'id');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'community_id', 'id');
    }
    /* public function scopeData($query)
    {
        $query->select(['name_' . app()->getLocale() . ' as name', 'area', 'location_longitude', 'location_latitude', 'address', 'image', 'status']);
    }*/

    public function toArray()
    {

        $name = 'name_' . strval($this->name . app()->getLocale());
        $title = 'title_' . strval($this->name . app()->getLocale());
        $description = 'description_' . strval($this->name . app()->getLocale());
        $news = News::where('community_id', $this->id)->get();
        return [
            'id' => $this->id,
            'name' => $this->$name,
            'area' => $this->area,
            'address' => $this->address,
            'image' => $this->image_path,
            'number_properties' => $this->properties()->count(),
            'status' => $this->status ? 'Ready' : 'Under constuction',
            'ready_properties' => $this->properties()->where('status', 1)->count(),
            'under_properties' => $this->properties()->where('status', 0)->count(),
            'villas_count' => $this->properties()->count(),
            'gates_count' => $this->properties()->sum('gate'),
            'properties' => $this->properties,
            'news' => $this->news()->get(),
            'events' => $this->event,

        ];
    }

    public function getImagePathAttribute($value)
    {
        if (!$this->image) {
            return asset('uploads/palceholder.jpg');
        }
        if (stripos($this->image, 'http') ===  0) {
            return $this->image;
        }
        return asset('uploads/' . $this->image);
    }
}