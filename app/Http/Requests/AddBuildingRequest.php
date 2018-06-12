<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;

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
    public function rules(){
        return [
            'direccion'=> 'required',
            'tipoVivienda' => 'required',
            'compartido' => 'required',
            'operacion' =>'required',
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

    public function messages(){
        return [
            'direccion.required' => 'Dirección es un campo obligatorio.',
            'tipoVivienda.required' => 'Tipo de vivienda es un campo obligatorio.',
            'compartido.required' => 'Se debe especificar si la vivienda es compartida o no lo es.',
            'operacion.required' => 'Tipo de operación es un campo obligatorio',
            'precio.required' => 'Precio es un campo obligatorio',
            'precio.numeric' => 'Formato de <b> precio </b> inválido. Precio debe ser un número.',
            'precio.gt' => 'Precio debe ser mayor a cero.',
            'anioConstruccion.required' => 'Año construccion es un campo obligatorio.', 
            'anioConstruccion.numeric' => 'Año construccion debe ser un número entero.',
            'anioConstruccion.gt' => 'Año construccion debe ser mayor a 1800.',
            'metrosCuadrados.required' => 'Metros cuadrados es un campo obligatorio',
            'metrosCuadrados.numeric' => 'Metros cuadrados debe ser un número entero.',
            'metrosCuadrados.gt' => 'Metros cuadrados debe ser mayor a 0.',
            'cantAmbientes.required' =>'Ambientes es un campo obligatorio',
            'cantAmbientes.numeric' => 'Ambientes debe ser un número entero.',
            'cantAmbientes.gt' => 'Ambientes debe ser mayor a 0.',
            'cantBanios.required' =>'Baños es un campo obligatorio',
            'cantBanios.numeric' => 'Baños debe ser un número entero.',
            'cantBanios.gt' => 'Baños debe ser mayor a 0.',
            'cantCocheras.required' =>'Cocheras es un campo obligatorio',
            'cantDormitorios.required' =>'Dormitorios es un campo obligatorio',
            'cantDormitorios.lte' =>'Dormitorios debe ser menor o igual a Ambientes.',
            'propietario.required' =>'El CUIT del propietario es un campo obligatorio',
            'piso.required' =>'Piso es un campo obligatorio si se está ingresando una vivienda de tipo Departamento',
            'numeroDepto.required' =>'Número Depto es un campo obligatorio si se está ingresando una vivienda de tipo Departamento'
        ];
    }

    public function response(array $errors){
        return response()->json(array('errors'=> $errors), 422); 
    }
}
