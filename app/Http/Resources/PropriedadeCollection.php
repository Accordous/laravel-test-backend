<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PropriedadeCollection extends ResourceCollection
{

    public function toArray($request)
    {
      
       return [
        'data' => $this->collection->transform(function ($dadosajax){
            return [
                'id' => $dadosajax->id,
                'email_prop' => $dadosajax->email_prop,
                'rua' => $dadosajax->rua,
                'numero' => $dadosajax->numero,
                'complemento' => $dadosajax->complemento,
                'bairro' => $dadosajax->bairro,
                'cidade' => $dadosajax->cidade,
                'estado' => $dadosajax->estado
            ];
        })
    ];
    }
}