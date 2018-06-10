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

Route::get('/', 'ControladorViviendas@index');

Route::delete('/eliminarVivienda/{id}', 'ControladorViviendas@destroy');

Route::get('/agregarVivienda', 'ControladorViviendas@agregarVivienda');

Route::get('/login', function () {

    return view('login', [
    	'title' => 'Iniciar Sesion'
    ]);

});

Route::delete('/eliminarPropietario/{id}', 'ControladorPropietarios@destroy');