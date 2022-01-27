<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'title_ar',
        'title_en',
        'title_gr',
        'description_ar',
        'description_en',
        'description_gr',
        'address',
        'start_date',
        'end_date',
        'community_id',
        'image_url'
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
            'address' => $this->address,
            'community_id' => $this->community_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'community_id' => $this->community_id,
            'main_image' => asset('uploads/' . $this->image_url),
        ];
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'interested_users');
    }
}
