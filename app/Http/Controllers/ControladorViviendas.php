<?php

namespace App\Http\Controllers;

use App\Vivienda;
use Illuminate\Http\Request;

class ControladorViviendas extends Controller{

    public function index(){
    	$viviendas = Vivienda::all(); 

	    return view('buildings-list', [
	    	'title' => 'Inicio', 
	    	'viviendas' => $viviendas
	    ]);
    }

}
