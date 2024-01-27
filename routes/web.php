<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\InicioController;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

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

// Route::get('/', function() {
//     return view('auth/login');
// })->name('login');

// Route::get('/', function() {
//     // return view('/logout');
// })->name('logout');

// Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\Http\Controllers\InicioController@index')->name('inicio');
    Route::get('/show', 'App\Http\Controllers\InicioController@show')->name('show');
    Route::get('/filtrar', 'App\Http\Controllers\InicioController@filtrar')->name('filtrar');

    Route::group(['prefix' => 'proyectos'], function() {
        Route::get('/index', 'App\Http\Controllers\ProyectosController@index')->name('index_proyectos');
        Route::get('/grabar/{id}', 'App\Http\Controllers\ProyectosController@show')->name('grabar');
        Route::get('/documentos/{id}', 'App\Http\Controllers\DocumentosController@index')->name('grabar');
        Route::get('/ciclo-vida/{id}', 'App\Http\Controllers\CicloVidaController@index')->name('ciclo-vida');
    });

    Route::group(['prefix' => 'solicitudes'], function(){
        Route::get('/index', 'App\Http\Controllers\SolicitudesController@index2')->name('index_solicitud');
    });

    Route::get('/etapas', 'App\Http\Controllers\EtapasController@index')->name('etapas');
// });
