<?php

namespace App\Repositories;

use App\Models\Contract;
use App\Http\Requests\ContractRequest;

class ContractRepository extends AbstractRepository
{
    protected $model = Contract::class;
    protected $myRequest = ContractRequest::class;
}
