<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropriedadeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       return [

                'email_prop' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'rua' => 'required',
                'bairro' => 'required',
                'cidade' => 'required',
                'estado' => 'required'

        ];


    }
}
