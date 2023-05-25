<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\VentanillaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('/login');
})->name('login');

// Route::get('/', function() {
//     // return view('/logout');
// })->name('logout');

// Route::group(['middleware' => 'auth'], function () {
    Route::get('/inicio', 'App\Http\Controllers\InicioController@index')->name('inicio'); 
    Route::get('/show', 'App\Http\Controllers\InicioController@show')->name('show');
    Route::get('/filtrar', 'App\Http\Controllers\InicioController@filtrar')->name('filtrar');

    Route::group(['prefix' => 'auntenticar'], function(){
        Route::post('/iniciarSesion', 'App\Http\Controllers\LoginController@login')->name('iniciarSesion'); 
    });


    Route::group(['prefix' => 'ordenes'], function(){
        Route::get('/listadoOrdenes', 'App\Http\Controllers\OrdenesController@index')->name('listadoOrdenes');
        Route::get('/mostrarOrdenes', 'App\Http\Controllers\OrdenesController@show')->name('showOrdenes');
        // Route::post('/mostrarOrdenes', 'App\Http\Controllers\OrdenesController@show')->name('showOrdenes');
        Route::get('/filtrarOrdenes', 'App\Http\Controllers\OrdenesController@filtrar')->name('filtrarOrdenes');

        Route::get('/crearOrden', 'App\Http\Controllers\OrdenesController@create')->name('crearOrden');
        Route::post('/guardarOrden', 'App\Http\Controllers\OrdenesController@store')->name('guardarOrden');

        Route::get('/editarOrden/{id}', 'App\Http\Controllers\OrdenesController@edit')->name('editarOrden');
        Route::post('/actualizarOrden', 'App\Http\Controllers\OrdenesController@update')->name('actualizarOrden');

        //catalogos 
        // Route::get('/consTarea/{idserv}','App\Http\Controllers\OrdenesController@getTareas')->name('consTarea');
        // Route::get('/consTarea/{idequi}/{idserv}','App\Http\Controllers\OrdenesController@getTareas')->name('consTarea');
        Route::post('/consTarea','App\Http\Controllers\OrdenesController@getTareas')->name('consTarea');
        Route::get('/consServicio/{idEquipo}','App\Http\Controllers\OrdenesController@getServicios')->name('consServicio'); 

        //info Centro Trabajo
        Route::get('/consCCT/{claveCCT}','App\Http\Controllers\OrdenesController@getCCT')->name('consCCT');
        // Route::get('/consOrdenesCCT/{claveCCT}','App\Http\Controllers\OrdenesController@getOrdenesCCT')->name('consOrdenesCCT');

        //Actualizar Estatus Orden
        Route::post('/updEstatusO','App\Http\Controllers\OrdenesController@updEstatusOrden')->name('updEstatusO');

        Route::get('download-pdf/{id}', 'App\Http\Controllers\OrdenesController@downloadPDF')->name('download-pdf');

        //Cerrar Orden
        Route::get('/verDetalleOrden/{id}', 'App\Http\Controllers\OrdenesController@detalleOrden')->name('verDetalleOrden');
        Route::post('/cerrarOrden', 'App\Http\Controllers\OrdenesController@updCerrar')->name('cerrarOrden');

        Route::get('/cargarTecAux/{id}', 'App\Http\Controllers\OrdenesController@cargarTecnicosAux')->name('cargarTecAux');

        //Equipos
        Route::get('/consEquipos/{idSolic}','App\Http\Controllers\OrdenesController@getEquiposSol')->name('consEquipos');

    }); 
    
    Route::group(['prefix' => 'ventanilla'], function(){
        Route::get('/indexVentanilla', 'App\Http\Controllers\VentanillaController@index')->name('indexVentanilla');
        Route::get('/crearOrdenVentanilla', 'App\Http\Controllers\VentanillaController@create')->name('crearOrdenVentanilla');
        // Route::post('/guardarOrden', 'App\Http\Controllers\OrdenesController@store');
    }); 

    // Route::get('/logout', 'App\Http\Controllers\InicioController@logout');
// });     

// Route::get('/listadoOrdenes', [OrdenesController::class,"index"] );  // Si  finciona de esta manera