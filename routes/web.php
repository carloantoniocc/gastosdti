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

//RUTAS ADMINISTRACION DE USUARIOS
Route::resource('users','UsersController');

//RUTAS ASIGNAR ROLES
Route::get('users/asignRole/{user}', 'UsersController@asignRole');
Route::post('users/saveRole', 'UsersController@saveRole');

//RUTAS ASIGNAR ESTABLECIMIENTOS
Route::get('users/asignEstab/{user}', 'UsersController@asignEstab');
Route::post('users/saveEstab', 'UsersController@saveEstab');

//Rutas de facturas
Route::resource('facturas','FacturaController');
Route::get('facturas/categoria/{categorie}', 'FacturaController@getItems');
Route::get('facturas/provider/{provider}', 'FacturaController@getCategories');


Route::get('facturas/cmfacturas','FacturaController@cmfacturas');
Route::post('facturas/importarfact', 'FacturaController@getimportarfact');


//Provider
Route::resource('providers','ProviderController');
Route::get('/providers/asignCategorie/{provider}', 'ProviderController@asignCategorie');
Route::post('/providers/asignCategorie', 'ProviderController@saveCategorie');

//carga importar uf
Route::post('dolars/importar', 'DolarController@postimportar');


//carga masiva uf
Route::get('dolars/cmdolar', 'DolarController@getcmdolar');

//carga descargar file
Route::get('ufs/downloadfile/{file}', 'UfController@downloadFile');

//carga descargar file
Route::get('ufs/downloadfilenamestorage/{file}', 'UfController@downloadfilenamestorage');


//RUTAS DE USUARIO LARAVEL
Auth::routes();

//RUTA DE VISTA, UNA VEZ QUE SE ESTA LOGUEADO
Route::get('/home', 'HomeController@index');



//RUTAS TIPO ESTABLECIMIENTO
Route::resource('tipoEstabs','TipoEstabsController');

//RUTAS COMUNAS
Route::resource('comunas','ComunasController');

//RUTA ESTABLECIMIENTOS
Route::resource('establecimientos','EstablecimientosController');

//RUTA LOGIN AJAX
Route::get('getEstab/{mail}','Auth\LoginController@getEstab');


//Resumen Factura
Route::resource('resumenfactura','ResumenFacturaController');
Route::get('resumenfactura/{factura}/cuadroresumen','ResumenFacturaController@cuadroresumen')->name('cuadroresumen');
Route::get('resumenfactura/{resumen_factura}/borrar','ResumenFacturaController@borrar');


//Detalle Facturas
Route::resource('detallefacturas','DetalleFacturaController');
Route::get('detallefacturas/{resumen_factura}/detalleitem','DetalleFacturaController@detalleitem');


//Api
Route::get('api/v1/facturas','FacturaController@getfacturas');


//Categorie
Route::resource('categories','CategorieController');
//Route::get('categories/{id}/crearitem','CategorieController@crearitem');
Route::get('categories/showcategorie/{categorie}','CategorieController@showcategorie');
Route::get('categories/edit/item/{id}','CategorieController@edititem');
Route::post('categories/update/item/{id}', 'CategorieController@postupdateitem');


//Item
Route::resource('items','ItemController');


//Moneda
Route::resource('monedas','MonedaController');



//carga masiva uf
Route::get('ufs/cmuf', 'UfController@getcmuf');


//carga importar uf
Route::post('ufs/importar', 'UfController@getimportar');

//Uf
Route::resource('ufs','UfController');

//Dolar
Route::resource('dolars','DolarController');

//Upload
Route::resource('uploads','UploadController');
Route::get('uploads/{id}/inicio','UploadController@inicio');

//index de carga masiva
Route::get('uploadsfactura/{factura}/uploadfactura','UploadController@uploadfactura');
Route::get('uploadsfactura/{resumenfactura}/upload','UploadController@upload');
//importar file

Route::post('uploadsfactura/{resumenfactura}/importar','UploadController@importar');
Route::post('uploadsfactura/{factura}/importarfactura','UploadController@importarfactura');
//descargar
Route::get('uploadsfactura/storage/{storage}/downloadfile','UploadController@downloadfile');


//reportes
//index
Route::resource('/tablereports','TableReportController');
Route::get('tablereportsest/{id}','TableReportController@getEstablecimientos');
Route::post('/tablereports/getFormulario','TableReportController@getFormulario');

Route::resource('storages','StorageController');

Route::resource('entelcodes','EntelcodeController');
Route::get('entelcodes/{establecimiento}/editcode','EntelcodeController@editcode');
Route::post('entelcodes/{establecimiento}/updatecode','EntelcodeController@updatecode');



