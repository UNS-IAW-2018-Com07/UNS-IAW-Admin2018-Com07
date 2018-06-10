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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
