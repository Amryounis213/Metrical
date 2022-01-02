<?php

namespace App\Models;

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
}
