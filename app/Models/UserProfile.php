<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'contracts', 'contract_expiry', 'title_deed', 'emirates_id', 'passport', 'passport_expiry',
    ];
    //protected $appends = ['contracts'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /*  public function getImagePathAttribute($value)
    {
        if (!$this->image_url) {
            return asset('admin/assets/media/users/300_25.jpg');
        }
        if (stripos($this->image_url, 'http') ===  0) {
            return $this->image_url;
        }
        return asset('uploads/' . $this->image_url);
    }*/




    //title_deed

}
