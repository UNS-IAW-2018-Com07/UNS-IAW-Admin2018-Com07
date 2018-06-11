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
Route::delete('/eliminarVivienda/{id}', 'ControladorViviendas@destroy')->middleware('auth');

Route::get('/agregarVivienda', 'ControladorViviendas@agregarVivienda')->middleware('auth');

Route::post('/agregarVivienda', 'ControladorViviendas@store')->middleware('auth');

Route::get('/', 'ControladorViviendas@index')->middleware('auth');

//PROPIETARIOS
Route::delete('/eliminarPropietario/{id}', 'ControladorPropietarios@destroy')->middleware('auth');

Route::get('/agregarPropietario', function(){
	return view('add-owner',[
		'title' => 'Añadir propietario',
		'propietario' => [
			'telefono' => '',
			'nombre' => '',
			'correoElectronico' => ''
		]	
	]);
})->middleware('auth');

Route::get('/agregarPropietario/{id}', 'ControladorPropietarios@index')->middleware('auth');

Route::post('/agregarPropietario', 'ControladorPropietarios@store')->middleware('auth');


//AUTENTICACION

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');



