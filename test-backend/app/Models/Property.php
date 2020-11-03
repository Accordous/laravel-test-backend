<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'email_owner',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'status'
    ];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = mb_strtoupper($value);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'property_id', 'id');
    }
}
