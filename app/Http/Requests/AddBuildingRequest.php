<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBuildingRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
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
            'direccion'=> 'required',
            'tipoVivienda' => 'required',
            'compartido' => 'required',
            'operacion' =>'required',
            'direccion' => 'required',
            'precio' =>'required|numeric|gt:0',
            'anioConstruccion'=>'required|numeric|gt:1800',
            'metrosCuadrados'=>'required|numeric|gt:0',
            'cantAmbientes'=>'required|numeric|gt:0',
            'cantBanios'=>'required|numeric|gt:0',
            'cantCocheras'=> 'required|numeric|gte:0',
            'cantDormitorios'=> 'required|numeric|gt:0|lte:cantAmbientes',
            'propietario'=> 'required|exists:propietarios,cuit',
            'piso' => 'required_if:tipoVivienda,Departamento', 
            'numeroDepto' => 'required_if:tipoVivienda,Departamento'
        ];
    }

    // public function messages(){
    //     return [
    //         'nombre.required' => 'Nombre es un campo obligatorio.',
    //         'cuit.required' => 'CUIT es un campo obligatorio.',
    //         'telefono.required' => 'Teléfono es un campo obligatorio.',
    //         'telefono.numeric' => 'Teléfono inválido.',
    //         'correoElectronico.required' => 'Correo electrónico es un campo obligatorio.',
    //         'cuit.between' => 'Formato de CUIT inválido.',
    //         'cuit.numeric' => 'Formato de CUIT inválido.',
    //         'cuit.unique' => 'CUIT ya correspondiente a otro propietario.',
    //         'correoElectronico.email' => 'Correo electrónico inválido.'
    //     ];
    // }
}
