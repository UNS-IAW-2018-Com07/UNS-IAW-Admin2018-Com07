<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use Illuminate\Http\Request;

class ControladorPropietarios extends Controller{

    public function destroy($id){

    	$cuit = Propietario::find($id,['cuit'])->cuit;

    	$collection = Vivienda::where('propietario', $cuit)->get(['_id']);

    	$array_ids;
    	foreach ($collection as $id)
    		$array_ids[]=$id->_id;

     	Vivienda::destroy($array_ids);

     	//Retorna si pudo eliminar el propietario o dio error, pero no dice nada sobre que paso con las viviendas.

    	return Propietario::destroy($id); //deberiamos ver que se desaparezcan los li de las viviendas que borramos.
    }
}
