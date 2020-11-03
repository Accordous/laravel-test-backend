<?php

namespace App\Repositories;

use App\Models\Property;
use App\Http\Requests\PropertyRequest;

class PropertyRepository extends AbstractRepository
{
    protected $model = Property::class;
    protected $myRequest = PropertyRequest::class;

    public function contract($id)
    {
        return Property::where('id', $id)->with('contract')->first();
    }
}
