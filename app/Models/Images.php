<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'property_id',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }





    public function toArray()
    {
        return [
            'path' => asset('uploads/' . $this->path),
        ];
    }
}
