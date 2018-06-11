<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use App\Http\Requests\AddOwnerRequest;
use App\Http\Requests\EditOwnerRequest;

class ControladorPropietarios extends Controller{
    public function index($id){

        $propietario=Propietario::find($id);

        return view('add-owner',[
            'title' => 'Editar propietario',
                'propietario' => $propietario  
        ]);
    }

    public function store(AddOwnerRequest $request){

        if(Propietario::create(
            request(['nombre', 'cuit', 'telefono','correoElectronico'])))
            return view('alert',[
                'title' => 'Operación exitosa.',
                'href' => '/agregarPropietario'
            ]);
        else
            return view('alert',[
                'title' => 'Ocurrió un error inesperado.',
                'href' => '/agregarPropietario'
            ]);
    }

    public function update(EditOwnerRequest $request,$id){

        $propietario =  Propietario::find($id);

        $propietario->nombre = $request->nombre;
        $propietario->telefono = $request->telefono;
        $propietario->correoElectronico = $request->correoElectronico;
      
        if($propietario->save())
            return redirect('/');
        else
            return view('alert',[
                'title' => 'Ocurrió un error inesperado.',
                'href' => '/agregarPropietario/'+$id
            ]);
    }

    public function destroy($id){

    	$prop = Propietario::find($id,['cuit']);

        if($prop){

            $cuit=$prop->cuit;

            $collection = Vivienda::where('propietario', $cuit)->get(['_id']);

            $array_ids=array();

            foreach ($collection as $id)
                $array_ids[]=$id->_id;

            Vivienda::destroy($array_ids);

            if(Propietario::destroy($id)){
                return response($array_ids,200); 
            }
            else 
                return response("No existe el propietario", 404);
            }
        else
            return response("No existe el propietario", 404);

    	
    }
}
