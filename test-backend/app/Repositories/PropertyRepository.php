<?php

namespace App\Repositories;

use App\Models\Property;
use App\Http\Requests\PropertyRequest;

class PropertyRepository extends AbstractRepository
{
    protected $model = Property::class;
    protected $myRequest = PropertyRequest::class;
}
