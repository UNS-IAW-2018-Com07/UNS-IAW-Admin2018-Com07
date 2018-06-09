<?php

use App\Vivienda;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */

// Route::get('/', function () {

// 	$viviendas = DB::collection('viviendas')->get();

//     return view('buildings-list', [

//     	'title' => 'Inicio', 
//     	'viviendas' => $viviendas

//     ]);

// });

Route::get('/', 'ControladorViviendas@index');

Route::get('/agregarVivienda', function () {

    return view('add-building', [
    	'title' => 'Agregar Vivienda'
    ]);

});

Route::get('/login', function () {

    return view('login', [
    	'title' => 'Iniciar Sesion'
    ]);

});