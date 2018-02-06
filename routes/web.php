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

//CAMBIA VISTA LOGIN COMO INICIO DE SITIO
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

//RUTAS DE USUARIO LARAVEL
Auth::routes();

//RUTA DE VISTA, UNA VEZ QUE SE ESTA LOGUEADO
Route::get('/home', 'HomeController@index');

//RUTAS ADMINISTRACION DE USUARIOS
Route::resource('users','UsersController');

//RUTAS ASIGNAR ROLES
Route::get('users/asignRole/{user}', 'UsersController@asignRole');
Route::post('users/saveRole', 'UsersController@saveRole');

//RUTAS ASIGNAR ESTABLECIMIENTOS
Route::get('users/asignEstab/{user}', 'UsersController@asignEstab');
Route::post('users/saveEstab', 'UsersController@saveEstab');

//RUTAS TIPO ESTABLECIMIENTO
Route::resource('tipoEstabs','TipoEstabsController');

//RUTAS COMUNAS
Route::resource('comunas','ComunasController');

//RUTA ESTABLECIMIENTOS
Route::resource('establecimientos','EstablecimientosController');

//RUTA LOGIN AJAX
Route::get('getEstab/{mail}','Auth\LoginController@getEstab');