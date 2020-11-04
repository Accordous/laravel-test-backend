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
        $property = Property::where('id', $id)->with('contract')->first();
        if($property){
            return $property;
        }else {
            return response()->json(['error' => trans('messages.404')], 404);
        }
    }
}
