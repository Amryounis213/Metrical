<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'contracts', 'contract_expiry', 'title_deed','emirates_id'
    ];

    public function user()
    {
       return $this->belongsTo(User::class,'user_profiles');
    }
}
