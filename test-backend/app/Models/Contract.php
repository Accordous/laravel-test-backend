<?php

namespace App\Models;

use App\Helpers\ValidateDocuments;
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function getDocumentAttribute($value)
    {
        $validateDocument = new ValidateDocuments;
        if ($this->person == 'PJ') {
            return $validateDocument->Mask("##.###.###/####-##", $value);
        }
        return $validateDocument->Mask("###.###.###-##", $value);
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = preg_replace("/[^0-9]/", "", $value);
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }
}
