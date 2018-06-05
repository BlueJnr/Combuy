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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/homeservicios', 'HomeServiciosController@index');

//EMPRESA
Route::resource('empresa','infoempresaController');
Route::get('mostrarnegocio','infoempresaController@revisarnegocio');

Route::resource('producto','productoController');
//MOSTRAR PARA REGISTRO
Route::get('negocioproducto/{nom}','productoController@selecionnegocio');
//REVISAR O MOSTRAR
Route::get('mostrarproductos/{nom}','productoController@revisarproductos');
//REGISTRO
Route::post('productos','productoController@registro')->name('productos.registro');
Route::get('registroproducto','productoController@registrarproducto');  
//ELIMINAR
Route::delete('eliminarproducto/{id}','productoController@eliminarproducto'); 
Route::delete('eliminarnegocio/{id}','infoempresaController@eliminarnegocio'); 

//Route::get('productos','productoController@revisarproductos')->name('revisarproductos');


