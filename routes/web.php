<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//VIVIENDAS
Route::delete('/eliminarVivienda/{id}', 'ControladorViviendas@destroy');

Route::get('/agregarVivienda', 'ControladorViviendas@agregarVivienda');

Route::post('/agregarNuevaVivienda', 'ControladorViviendas@store');

Route::get('/', 'ControladorViviendas@index');

//LOGIN
Route::get('/login', function () {

    return view('login', [
    	'title' => 'Iniciar Sesion'
    ]);

});

//PROPIETARIOS
Route::delete('/eliminarPropietario/{id}', 'ControladorPropietarios@destroy');

Route::get('/agregarPropietario', function(){
	return view('add-owner',[
		'title' => 'Añadir propietario'
	]);
});

Route::post('/agregarPropietario', 'ControladorPropietarios@store');

//ALERTS
Route::get('/alert/error/propietario', function(){
	return view('alert',[
		'title' => 'Hubo un error inesperado.'

	]);
});

Route::get('/alert/ok/propietario', function(){
	return view('alert',[
		'title' => 'Operación exitosa.'
	]);
});
