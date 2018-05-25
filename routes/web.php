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
Route::get('/homeserv_product', 'HomeServ_productController@index');
Route::resource('empresa','infoempresaController');
Route::resource('producto','productoController');
Route::get('/registroproducto','productoController@registrarproducto');
Route::get('productos','productoController@revisarproductos')->name('revisarproductos');


