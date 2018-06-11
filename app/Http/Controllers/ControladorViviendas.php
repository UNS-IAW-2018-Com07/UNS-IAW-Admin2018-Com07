<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use App\Http\Requests\AddBuildingRequest;

class ControladorViviendas extends Controller{

    public function index(){
        $viviendas = Vivienda::orderBy('direccion', 'ASC')->get();
        $propietarios = Propietario::orderBy('cuit', 'ASC')->get(); 

        return view('buildings-list', [
            'title' => 'Inicio', 
            'viviendas' => $viviendas,
            'propietarios' => $propietarios
        ]);
    }

    public function destroy($id){
        return Vivienda::findOrFail($id)->destroy($id);
    }

    public function agregarVivienda(){
        $propietarios = Propietario::orderBy('cuit', 'ASC')->get();

        return view('add-building', [
            'title' => 'Agregar Vivienda',
            'propietarios' => $propietarios,
            'vivienda' => [
                'tipoVivienda' => '', 
                'compartido' => '', 
                'operacion' => '', 
                'direccion' => '',
                'precio' => '', 
                'anioConstruccion' => '', 
                'metrosCuadrados' => '', 
                'cantAmbientes' => '', 
                'cantBanios' => '', 
                'cantCocheras' => '', 
                'cantDormitorios' => '', 
                'descripcion' => '', 
                'propietario' => '',
                'piso' => '',
                'numeroDepto' => ''
            ] 
        ]);
    }

    public function store(AddBuildingRequest $input){
        return Vivienda::create(request(['tipoVivienda', 'compartido', 'operacion', 'direccion', 'precio', 'anioConstruccion', 'metrosCuadrados', 'cantAmbientes', 'cantBanios', 'cantCocheras', 'cantDormitorios', 'descripcion', 'propietario','piso','numeroDepto','imagenes']));
    }

    public function indexEdit($id){
        $vivienda=Vivienda::find($id); 
        $propietarios = Propietario::orderBy('cuit', 'ASC')->get();

        return view('add-building', [
            'title' => 'Editar Vivienda',
            'propietarios' => $propietarios, 
            'vivienda' => $vivienda, 
            'sinLogout' => 'true'
        ]);
    }

    public function update(AddBuildingRequest $request,$id){
        $vivienda=Vivienda::find($id); 

        $vivienda->tipoVivienda = $request->tipoVivienda; 
        $vivienda->compartido = $request->compartido; 
        $vivienda->operacion = $request->operacion; 
        $vivienda->direccion = $request->direccion; 
        $vivienda->precio = $request->precio; 
        $vivienda->anioConstruccion = $request->anioConstruccion; 
        $vivienda->metrosCuadrados = $request->metrosCuadrados; 
        $vivienda->cantAmbientes = $request->cantAmbientes; 
        $vivienda->cantBanios = $request->cantBanios; 
        $vivienda->cantCocheras = $request->cantCocheras; 
        $vivienda->cantDormitorios = $request->cantDormitorios;
        $vivienda->descripcion = $request->descripcion;
        $vivienda->propietario = $request->propietario;
        $vivienda->piso = $request->piso;
        $vivienda->numeroDepto = $request->numeroDepto;

        $vivienda->save(); 
        return redirect('/');
    }
}
