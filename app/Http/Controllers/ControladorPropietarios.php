<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use Illuminate\Http\Request;

class ControladorPropietarios extends Controller{

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
