<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['full_name', 'email', 'mobile', 'passport_copy', 'title_dead_copy', 'emirate_id', 'sale_price', 'rent_price', 'rent_start_date', 'rent_end_date', 'type', 'property_id', 'user_id', 'status'];

    use HasFactory;
    public function property()
    {
        return  $this->belongsTo(Property::class, 'property_id', 'id');
    }
    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function stopoffer()
    {
        return  $this->hasOne(Stopoffer::class, 'offer_id', 'id');
    }


    public function toArray()
    {
        if ($this->type = 'sale') {
            return [
                "id" => $this->id,
                "full_name" => $this->full_name,
                "email" => $this->email,
                "mobile" => $this->mobile,
                "passport_copy" => $this->passport_copy,
                "title_dead_copy" => $this->title_dead_copy,
                "emirate_id" => $this->emirate_id,
                "sale_price" => $this->sale_price,
                "type" => "sale",
                "property_id" => $this->property_id,
                "user_id" => $this->user_id,
                "status" => $this->status,
            ];
        } else {
            return [
                "id" => $this->id,
                "full_name" => $this->full_name,
                "email" => $this->email,
                "mobile" => $this->mobile,
                "passport_copy" => $this->passport_copy,
                "title_dead_copy" => $this->title_dead_copy,
                "emirate_id" => $this->emirate_id,
                "rent_price" => $this->rent_price,
                "rent_start_date" => $this->rent_start_date,
                "rent_end_date" => $this->rent_end_date,
                "type" => "rent",
                "property_id" => $this->property_id,
                "user_id" => $this->user_id,
                "status" => $this->status,
            ];
        }
    }
}
