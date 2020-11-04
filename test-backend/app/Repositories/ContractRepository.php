<?php

namespace App\Repositories;

use App\Models\Contract;
use App\Http\Requests\ContractRequest;

class ContractRepository extends AbstractRepository
{
    protected $model = Contract::class;
    protected $myRequest = ContractRequest::class;

    public function all()
    {
        $data =  Contract::with('property')->get();
        if(sizeof($data) > 0){
            return response()->json($data);
        }else {
            return response()->json(['error' => trans('messages.404')], 404);
        }
    }
}
