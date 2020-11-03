<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'property_id',
        'person',
        'document',
        'contractor_email',
        'name',
    ];

    public function getDocumentAttribute($value)
    {
        if ($this->person == 'PJ') {
            return $this->Mask("##.###.###/####-##", $value);
        }
        return $this->Mask("###.###.###-##", $value);
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = preg_replace("/[^0-9]/", "", $value);
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    function Mask($mask, $str)
    {
        $str = str_replace(" ", "", $str);
        for ($i = 0; $i < strlen($str); $i++) {
            $mask[strpos($mask, "#")] = $str[$i];
        }
        return $mask;
    }
}
