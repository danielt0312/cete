<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\VentanillaController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'App\Http\Controllers\InicioController@index')->name('inicio'); 
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

        Route::get('/crearOrden', 'App\Http\Controllers\OrdenesController@create')->name('crearOrden');//->middleware('permission:193-menu-nueva-orden');
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
        Route::get('/consclaveCCT','App\Http\Controllers\OrdenesController@getclaveCCT')->name('consclaveCCT');
        // Route::get('/consOrdenesCCT/{claveCCT}','App\Http\Controllers\OrdenesController@getOrdenesCCT')->name('consOrdenesCCT');

        //Actualizar Estatus Orden
        Route::post('/updEstatusO','App\Http\Controllers\OrdenesController@updEstatusOrden')->name('updEstatusO');
        Route::post('/updEstatusI','App\Http\Controllers\OrdenesController@updIniciar')->name('updEstatusI'); 

        Route::get('download-pdf/{id}', 'App\Http\Controllers\OrdenesController@downloadPDF')->name('download-pdf');
        Route::get('download-pdf-ima/{id}', 'App\Http\Controllers\OrdenesController@downloadPDFima')->name('download-pdf-ima');
        Route::get('download-cierre-pdf/{id}', 'App\Http\Controllers\OrdenesController@downloadCierrePDF')->name('download-cierre-pdf');

        //Cerrar Orden
        Route::get('/verDetalleOrden/{id}', 'App\Http\Controllers\OrdenesController@detalleOrden')->name('verDetalleOrden');
        Route::post('/cerrarOrden', 'App\Http\Controllers\OrdenesController@updCerrar')->name('cerrarOrden');
        Route::get('/verArchivoCierre/{id}', 'App\Http\Controllers\OrdenesController@getArchivoCierre')->name('verArchivoCierre');
        Route::get('/verImagenesCierre/{id}', 'App\Http\Controllers\OrdenesController@getArchivosCierreOrden')->name('verImagenesCierre');

        Route::get('/cargarTecAux/{id}', 'App\Http\Controllers\OrdenesController@cargarTecnicosAux')->name('cargarTecAux');

        //Equipos
        Route::get('/consEquipos/{idSolic}','App\Http\Controllers\OrdenesController@getEquiposSol')->name('consEquipos');
        Route::get('/historialEquipo/{etiqueta}','App\Http\Controllers\OrdenesController@getHistorialEquipo')->name('historialEquipo');
        Route::get('/mostDetalleEquipo/{id}','App\Http\Controllers\OrdenesController@getMostDetalleEquipo')->name('mostDetalleEquipo');
        Route::post('/actualizarEquipo', 'App\Http\Controllers\OrdenesController@updEquipo')->name('actualizarEquipo'); //31/07/2023
        Route::get('/verArchivoEquipo/{id}', 'App\Http\Controllers\OrdenesController@getArchivoEquipo')->name('verArchivoEquipo');
        Route::post('/cerrarEquipo', 'App\Http\Controllers\OrdenesController@updCerrarEquipo')->name('cerrarEquipo'); //20/08/2023
        ///PENDIENTEE 
        Route::get('/verImagenesCierreE/{id}', 'App\Http\Controllers\OrdenesController@getArchivoEquipo')->name('verImagenesCierreE');

        //Tecnicos
        Route::post('/asignarTecnico','App\Http\Controllers\OrdenesController@insTecnico')->name('asignarTecnico');
        Route::get('/consTecnicos/{idSolic}','App\Http\Controllers\OrdenesController@getTecnicos')->name('consTecnicos');
        Route::post('/actualizarTecnicos','App\Http\Controllers\OrdenesController@updTecnicos')->name('actualizarTecnicos'); 
        //Correo
        Route::post('/enviarCorreo', 'App\Http\Controllers\OrdenesController@sendCorreo')->name('enviarCorreo');
        //ValidaAcceso validaAcceso
        Route::post('/validaAcceso', 'App\Http\Controllers\OrdenesController@getValidaAcceso')->name('validaAcceso');
        Route::post('/actualizaAcceso', 'App\Http\Controllers\OrdenesController@updAcceso')->name('actualizaAcceso');
        //verEquiosCerrados en cerrarOrden 
        Route::get('/equipoAtendido/{id}', 'App\Http\Controllers\OrdenesController@getEquiposCerrados')->name('equipoAtendido');
        
        //-----RUTAS MATERIALES 
        Route::get('/index_materiales/{id}', 'App\Http\Controllers\OrdenesController@index_materiales')->name('index_materiales');
        // Route::get('/index_materiales', 'App\Http\Controllers\OrdenesController@index_materiales')->name('index_materiales');
        Route::get('/agregar_materiales', 'App\Http\Controllers\OrdenesController@agregar_materiales')->name('agregar_materiales');
        Route::get('/cat_materiales', 'App\Http\Controllers\OrdenesController@cat_materiales')->name('cat_materiales');
    });  

    Route::group(['prefix' => 'solicitudes'], function(){
        Route::get('/index', 'App\Http\Controllers\SolicitudesController@index2')->name('index_solicitud')->middleware('permission:204-ver-registros-solicitudes');
        Route::get('/showSolicitudes', 'App\Http\Controllers\SolicitudesController@showSolicitudes')->name('showSolicitudes')->middleware('permission:204-ver-registros-solicitudes');
        
        Route::get('/solicitudes_registros', 'App\Http\Controllers\SolicitudesController@index')->name('solicitudes_registros')->middleware('permission:204-ver-registros-solicitudes');
        Route::get('/actualiza_acesso', 'App\Http\Controllers\SolicitudesController@actualiza_acesso')->name('actualiza_acesso');
        Route::get('/prueba', 'App\Http\Controllers\SolicitudesController@prueba')->name('prueba');
        Route::get('/prueba2', 'App\Http\Controllers\SolicitudesController@prueba2')->name('prueba2');
        Route::get('/buscar_folio', 'App\Http\Controllers\SolicitudesController@buscar_folio')->name('buscar_folio');
        Route::get('/rechazar_solicitud', 'App\Http\Controllers\SolicitudesController@rechazar_solicitud')->name('rechazar_solicitud');
        Route::get('/aprobar_solicitud', 'App\Http\Controllers\SolicitudesController@aprobar_solicitud')->name('aprobar_solicitud');
        Route::get('/selects_equipo_servicio', 'App\Http\Controllers\SolicitudesController@selects_equipo_servicio')->name('selects_equipo_servicio');
        Route::get('/select_servicio', 'App\Http\Controllers\SolicitudesController@select_servicio')->name('select_servicio');
        Route::get('/select_tarea', 'App\Http\Controllers\SolicitudesController@select_tarea')->name('select_tarea');
        // Route::get('/actualizar_solicitud', 'App\Http\Controllers\SolicitudesController@actualizar_solicitud')->name('actualizar_solicitud');
        Route::post('/actualizar_solicitud', 'App\Http\Controllers\SolicitudesController@actualizar_solicitud')->name('actualizar_solicitud');
        Route::get('/select_rechaza_solicitud', 'App\Http\Controllers\SolicitudesController@select_rechaza_solicitud')->name('select_rechaza_solicitud');
        Route::get('/downloadPdf_solicitud/{id}', 'App\Http\Controllers\SolicitudesController@downloadPdf_solicitud')->name('downloadPdf_solicitud');
        // Route::get('/crearOrdenVentanilla', 'App\Http\Controllers\VentanillaController@create')->name('crearOrdenVentanilla');
        // Route::get('/formulario_index', 'App\Http\Controllers\VentanillaController@formulario_index')->name('formulario_index');
        // Route::get('/formulario_consulta', 'App\Http\Controllers\VentanillaController@formulario_consulta')->name('formulario_consulta');
        // Route::get('/formulario_registro', 'App\Http\Controllers\VentanillaController@formulario_registro')->name('formulario_registro');
        // Route::get('/formulario_index')->name('formulario_index');
        // Route::post('/guardarOrden', 'App\Http\Controllers\OrdenesController@store');
    }); 
}); 
    
Route::group(['prefix' => 'ventanilla'], function(){
    Route::get('/buscar_folio_ventanilla', 'App\Http\Controllers\VentanillaController@buscar_folio_ventanilla')->name('buscar_folio_ventanilla');
    Route::get('/indexVentanilla', 'App\Http\Controllers\VentanillaController@index')->name('indexVentanilla');
    Route::get('/indexMail', 'App\Http\Controllers\VentanillaController@index_mail')->name('indexMail');
    Route::get('/consulta', 'App\Http\Controllers\VentanillaController@consulta')->name('consulta');
    Route::get('/pruebaJC', 'App\Http\Controllers\VentanillaController@pruebaJC')->name('pruebaJC');
    Route::get('/pruebaJC2', 'App\Http\Controllers\VentanillaController@pruebaJC2')->name('pruebaJC2');
    Route::get('/consulta_folio', 'App\Http\Controllers\VentanillaController@consulta_folio')->name('consulta_folio');
    Route::get('/consulta_folio_correo', 'App\Http\Controllers\VentanillaController@consulta_folio_correo')->name('consulta_folio_correo');
    Route::get('/consulta_folio_solicitud', 'App\Http\Controllers\VentanillaController@consulta_folio_solicitud')->name('consulta_folio_solicitud');
    Route::get('/sendEmail', 'App\Http\Controllers\VentanillaController@sendEmail')->name('sendEmail');
    Route::get('/sendEmail2', 'App\Http\Controllers\VentanillaController@sendEmail2')->name('sendEmail2');
    
    // Route::get('/crearOrdenVentanilla', 'App\Http\Controllers\VentanillaController@create')->name('crearOrdenVentanilla');
    Route::get('/formulario_index', 'App\Http\Controllers\VentanillaController@formulario_index')->name('formulario_index');
    Route::get('/formulario_consulta', 'App\Http\Controllers\VentanillaController@formulario_consulta')->name('formulario_consulta');
    Route::get('/formulario_registro', 'App\Http\Controllers\VentanillaController@formulario_registro')->name('formulario_registro');
    //// NUEVAS RUTAS CAMBIOS 04.07.23
    Route::get('/index_formulario_solicitud', 'App\Http\Controllers\VentanillaController@index_formulario_solicitud')->name('index_formulario_solicitud');

    // Route::get('/formulario_index')->name('formulario_index');
    // Route::post('/guardarOrden', 'App\Http\Controllers\OrdenesController@store');
    // Route::get('/sendEmail','App\Http\Controllers\MailController@sendEmail')->name('sendEmail');
}); 

Route::group(['prefix' => 'app_cas'], function(){
    Route::get('/list_ordenes_servicio', function(Request $request){
        $exito = DB::connection('pgsql')->select("select * from cas_cete.app_list_ordenes(".$request->pid_encargado.")");
        dd($exito);
        return $exito; // return response()->json($exito);
    });
});

    // Route::get('/logout', 'App\Http\Controllers\InicioController@logout');
// });     

// Route::get('/listadoOrdenes', [OrdenesController::class,"index"] );  // Si  finciona de esta manera
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/clear_cache', function () {
    $clear[0] = \Artisan::call('cache:clear');
    $clear[1] = \Artisan::call('route:clear');
    $clear[2] = \Artisan::call('optimize:clear');
    $clear[3] = \Artisan::call('config:cache');
    $clear[4] = \Artisan::call('view:clear');
    $clear[5] = \Artisan::call('clear-compiled');
    $clear[6] = \Artisan::call('config:clear');
    dd($clear);
});
