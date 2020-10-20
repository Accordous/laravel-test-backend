<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropriedadeResource extends JsonResource
{

    public function toArray($request)
    {
   
       return [
        'email_prop' => $this->email_prop,
        'rua' => $this->rua,
        'numero' => $this->numero,
        'complemento' => $this->complemento,
        'bairro' => $this->bairro,
        'cidade' => $this->cidade,
        'estado' => $this->estado
    ];
    }
}