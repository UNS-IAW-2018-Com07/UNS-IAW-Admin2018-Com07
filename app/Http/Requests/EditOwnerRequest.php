<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditOwnerRequest extends FormRequest
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
            'telefono'=> 'required|numeric',
            'correoElectronico' => 'required|email'
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'Nombre es un campo obligatorio.',
            'telefono.required' => 'Teléfono es un campo obligatorio.',
            'telefono.numeric' => 'Teléfono inválido.',
            'correoElectronico.required' => 'Correo electrónico es un campo obligatorio.',
            'correoElectronico.email' => 'Correo electrónico inválido.'
        ];
    }
}
