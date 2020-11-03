<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyOwner extends Model
{
    protected $fillable = [
        'email_owner',
    ];

    public function property()
    {
        return $this->hasMany(Property::class, 'property_owner_id', 'id');
    }
}
