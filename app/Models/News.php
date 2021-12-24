<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'title_gr',
        'description_ar',
        'description_en',
        'description_gr',
        'image_url', 'images', 'community_id'
    ];

    protected $appends = ['image_path'];
    protected $hidden = ['image_url'];

    protected $casts = [
        'images' => 'array',
    ];
    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id', 'id');
    }


    public function toArray()
    {

        $title = 'title_' . strval($this->name . app()->getLocale());
        $description = 'description_' . strval($this->name . app()->getLocale());

        return [
            'id' => $this->id,
            'title' => $this->$title,
            'description' => $this->$description,
            'main_image' => $this->image_path,
            'images' => $this->images,
            'community_id' => $this->community_id,
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
