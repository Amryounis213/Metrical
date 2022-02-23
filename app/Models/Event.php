<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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
        return $this->belongsTo(Community::class, 'community_id', 'id')->withDefault();
    }



    public function toArray()
    {

        $title = 'title_' . strval($this->name . app()->getLocale());
        $description = 'description_' . strval($this->name . app()->getLocale());
        $cleaner_input = strip_tags($this->$description);

        return [
            'id' => $this->id,
            'title' => $this->$title,
            'brief' => Str::limit($cleaner_input, 150, '...'),
            'description' => $this->$description,
            'address' => $this->address,
            'community_id' => $this->community_id,
            'start_date' => Carbon::parse($this->start_date)->format('Y-m-d'),
            'end_date' => Carbon::parse($this->end_date)->format('Y-m-d'),
            'community_id' => $this->community_id,
            'main_image' => asset('uploads/' . $this->image_url),
        ];
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'interested_users');
    }
}
