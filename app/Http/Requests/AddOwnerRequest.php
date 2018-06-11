<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddOwnerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=> 'required',
            'cuit'=> 'required|numeric|between:20000000000,34999999999|unique:propietarios',
            'telefono'=> 'required|numeric',
            'correoElectronico' => 'required|email'
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'Nombre es un campo obligatorio.',
            'cuit.required' => 'CUIT es un campo obligatorio.',
            'telefono.required' => 'Teléfono es un campo obligatorio.',
            'telefono.numeric' => 'Teléfono inválido.',
            'correoElectronico.required' => 'Correo electrónico es un campo obligatorio.',
            'cuit.between' => 'Formato de CUIT inválido.',
            'cuit.numeric' => 'Formato de CUIT inválido.',
            'cuit.unique' => 'CUIT ya correspondiente a otro propietario.',
            'correoElectronico.email' => 'Correo electrónico inválido.'
        ];
    }
}
