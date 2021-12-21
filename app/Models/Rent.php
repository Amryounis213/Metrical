<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $fillable = ['from', 'to', 'price', 'property_id', 'tenant_id', 'status'];

    public function tenet()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
