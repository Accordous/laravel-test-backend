<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'property_owner_id',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'status'
    ];

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = mb_strtoupper($value);
    }

    public function propertyOwner()
    {
        return $this->belongsTo(PropertyOwner::class, 'property_owner_id', 'id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'property_id', 'id');
    }
}
