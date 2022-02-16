<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'image', 'email', 'mobile',
    ];


    public function toArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'image' => asset($this->image),
            'mobile' => $this->mobile,
        ];
    }
}
