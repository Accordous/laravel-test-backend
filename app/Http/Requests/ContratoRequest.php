<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return [

                'propriedade_id' => 'required',
                'tp_pessoa' => 'required',
                'documento' => 'required',
                'nome_contrat' => 'required',
                'email_contrat' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'nome_contrat' => 'required'

        ];


    }
    
}
