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
}
