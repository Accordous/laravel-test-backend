<?php

namespace App\Observers;

use App\Helpers\ValidateDocuments;
use App\Models\Contract;
use App\Models\Property;
use Illuminate\Validation\ValidationException;

class ContractObserver
{
    /**
     * Handle the contract "creating" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function creating(Contract $contract)
    {
        $validateProperty = Contract::where('property_id', $contract->property_id)->first();
        if ($validateProperty) {
            throw ValidationException::withMessages([
                'message' => trans('messages.property')
            ]);
        }
        $validateDocument = new ValidateDocuments;
        if ($contract->person == 'PF') {
            $document = $validateDocument->validaCPF($contract->document);
            if ($document == true) {
                $contract->document = $contract->document;
            } else {
                throw ValidationException::withMessages([
                    'message' => trans('messages.cpf')
                ]);
            }
        } else {
            $document = $validateDocument->validaCNPJ($contract->document);
            if ($document == true) {
                $contract->document = $contract->document;
            } else {
                throw ValidationException::withMessages([
                    'message' => trans('messages.cnpj')
                ]);
            }
        }
    }

    /**
     * Handle the contract "created" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function created(Contract $contract)
    {
        $property = Property::find($contract->property_id);

        $property->status = 'C';

        $property->save();
    }

    /**
     * Handle the contract "updating" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function updating(Contract $contract)
    {
        $findContract = Contract::where('id', $contract->id)->first();
        $property = Property::find($contract->property_id);

        if ($property->status == 'C') {
            throw ValidationException::withMessages([
                'message' => trans('messages.property')
            ]);
        } elseif ($findContract->property_id != $contract->property_id) {
            $oldProperty = Property::find($findContract->property_id);
            $oldProperty->status = 'NC';
            $oldProperty->save();
            $property->status = 'C';
            $property->save();
        } else {
            $property->status = 'C';
            $property->save();
        }
    }

    /**
     * Handle the contract "updating" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function updated(Contract $contract)
    {
        $property = Property::find($contract->property_id);

        $property->status = 'C';

        $property->save();
    }

    /**
     * Handle the contract "deleted" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function deleted(Contract $contract)
    {
        $property = Property::find($contract->property_id);

        $property->status = 'NC';

        $property->save();
    }
}
