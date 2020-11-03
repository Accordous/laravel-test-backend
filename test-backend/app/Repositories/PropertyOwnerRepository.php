<?php

namespace App\Repositories;

use App\Models\PropertyOwner;
use App\Http\Requests\PropertyOwnerRequest;

class PropertyOwnerRepository extends AbstractRepository
{
    protected $model = PropertyOwner::class;
    protected $myRequest = PropertyOwnerRequest::class;
}
