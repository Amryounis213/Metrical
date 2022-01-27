<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stopoffer extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'mobile', 'reason', 'full_name', 'offer_id', 'user_id'];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
}
