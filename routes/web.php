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

//ADMINISTRADOR

Route::group([
    'middleware' => [
        'admin',
    ],
], function() {
    Route::resource('admin','administradorController');
    Route::get('sugerencias/{nom}','administradorController@revisarsugerencias');
   
});

Route::group([
    'middleware' => [
        'user',
    ],
], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    //USUARIO
    Route::resource('usuario','usuarioController');
    Route::post('usuarioedit','usuarioController@usuarioedit')->name('usuarioedit'); 
    
    Route::get('datauser','usuarioController@datauser'); 
    Route::post('datosusuario','usuarioController@datosusuario')->name('datosusuario'); 
    //EMPRESA
    Route::resource('empresa','infoempresaController');
    Route::get('mostrarnegocio','infoempresaController@revisarnegocio');
    //PRODUCTOS
    Route::resource('producto','productoController');
    //MOSTRAR PARA REGISTRO
    Route::get('negocioproducto/{nom}/{page?}','productoController@selecionnegocio');
    //REVISAR O MOSTRAR
    Route::get('mostrarproductos/{nom}','productoController@revisarproductos');
    //REGISTRO
    Route::post('productos','productoController@registro')->name('productos.registro');
    Route::get('registroproducto','productoController@registrarproducto');  
    //ELIMINAR
    Route::delete('eliminarproducto/{id}','productoController@eliminarproducto'); 
    Route::delete('eliminarnegocio/{id}','infoempresaController@eliminarnegocio'); 
});



