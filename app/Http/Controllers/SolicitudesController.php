<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Mail;
class SolicitudesController extends Controller
{

    public function index(Request $request){
        // $receivers = Receiver::pluck('email');
        // Mail::to($receivers)->send(new EmergencyCallReceived());
        // dd('hola');
        $data=[];
        $data =  DB::select("select * from cas_cete.fn_listado(1)");
        // dd($data);
        if ($request->ajax()) {
            // $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        // dd($row->folio_solicitud);
                        if ($row->id_estatus == 6) {
                            $acciones = '
                            <div class="dropdown btn-group dropstart">
                                <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                                    <i class="fa fa-ellipsis-v text-xs"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a onclick="fnMostrarInfo('.$row->id.')" class="dropdown-item"> 
                                            Ver Detalles Solicitud...
                                        </a>
                                        <a onclick="fnImprimirSolicitud('.$row->id.')" class="dropdown-item"> 
                                            Imprimir Solicitud
                                        </a>
                                    </li>
                                </ul>
                            </div>';
                        }
                        else if ($row->id_estatus == 2) {
                            $acciones = '
                            <div class="dropdown btn-group dropstart">
                                <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                                    <i class="fa fa-ellipsis-v text-xs"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a onclick="fnMostrarInfo('.$row->id.')" class="dropdown-item"> 
                                            Ver Detalles Solicitud...
                                        </a>
                                        <a onclick="fnImprimirSolicitud('.$row->id.')" class="dropdown-item"> 
                                            Imprimir Solicitud
                                        </a>
                                    </li>
                                </ul>
                            </div>';
                        }
                        else{
                            $acciones = '
                            <div class="dropdown btn-group dropstart">
                                <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                                    <i class="fa fa-ellipsis-v text-xs"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a onclick="fnMostrarInfo('.$row->id.')" class="dropdown-item"> 
                                            Ver Detalles Solicitud...
                                        </a>
                                        <a onclick="fnActualizarSolicitud('.$row->id.')" class="dropdown-item"> 
                                            Editar Solicitud...
                                        </a>
                                        <a onclick="fnAprobarSolicitud('.$row->id.')" class="dropdown-item"> 
                                            Aprobar Solicitud...
                                        </a>
                                        <a onclick="fnRechazarSolicitud('.$row->id.')" class="dropdown-item"> 
                                            Rechazar Solicitud...
                                        </a>
                                        <a onclick="fnImprimirSolicitud('.$row->id.')" class="dropdown-item"> 
                                            Imprimir Solicitud
                                        </a>
                                    </li>
                                </ul>
                            </div>';
                        }
                        
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // $datatable->setData($data);
        // dd($datatable);
        // return $datatable;
        return view('solicitudes.index');
    }

    public function selects_equipo_servicio(Request $request){

        $data = [];
        
        // $data['tipo_servicio'];
        $data['tipo_equipo'] =  DB::select("select * from cas_cete.fn_cat_equipo()");
        
        $data['tipo_servicio'] =  DB::select("select * from cas_cete.fn_cat_servicio()");
        
        $data['tipo_tarea'] = DB::select("select * from cas_cete.fn_cat_tarea()");
        
        // $data['tipo_equipo_tarea'] = DB::select("select * from cas_cete.fn_cat_equipo_tarea()");
        
        // $data['tipo_servicio_tarea'] = DB::select("select * from cas_cete.fn_cat_servicio_tarea()");


        // dd($data['tipo_servicio_tarea']);
        // dd($data['tipo_servicio']);
        // dd($data);
        return array(
            "data" => $data
        );
    }

    public function select_servicio(Request $request){
        // dd($request);
        $pId_equipo = $request->pId_equipo;
        $data['tipo_servicios'] = DB::select("select * from cas_cete.fn_servicios(".$pId_equipo.")");
        return array(
            "data" => $data
        );
    }

    public function select_tarea(Request $request){
        $pId_equipo = $request->pId_equipo;
        $pId_servicio = $request->pId_servicio;
        $data['tipo_tareas'] = DB::select("select * from cas_cete.fn_tareas(".$pId_equipo.", ".$pId_servicio.")");
        return array(
            "data" => $data
        );
    }

    public function prueba(){
        return view('solicitudes.prueba');
    }
    public function prueba2(Request $request){
        dd($request);
    }

    public function buscar_folio(Request $request){
        // dd($request);
        // $data=[];
        // $data2=[];

        if (isset($request->bandera_orden)) {
            $data= '';
            // $data2= '';
            if ($request->bandera_orden == 0) {
                $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
                
                if ($data[0]->id_estatus <> 1 || $data[0]->id_estatus <> 6 || $data[0]->id_estatus <> 7) {
                    // dd($data);
                    $data2 = DB::select("
                                select rc.folio, ce2.estatus  
                                from cas_cete.registro_captacion rc, cas_cete.solic_serv_track sst,
                                cas_cete.captacion_estatus ce, cas_cete.cat_estatus ce2 
                                where rc.id = sst.id_reg_captacion 
                                and sst.id_capta_estatus = ce.id
                                and ce.id_estatus = ce2.id 
                                and rc.id_solic_serv = '".$request->id."' 
                                and rc.id_modo_capta = 2
                                order by sst.fecha desc
                                limit 1"); 

                    // dd($data2[0]->folio);
                    return array(
                        "exito" => false,
                        "data" => $data,
                        "folio_orden" => $data2[0]->folio,
                        "estatus" => $data2[0]->estatus
                    );
                }
                return array(
                    "exito" => false,
                    "data" => $data
                    // "folio_orden" => $data2
                );
            }
            if ($request->bandera_orden == 1) {
                $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
                return array(
                    "exito" => false,
                    "data" => $data
                    // "data2" => $data2
                );
            }
            // if ($request->bandera_orden == 1) {
            //     $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
            //     return array(
            //         "exito" => false,
            //         "data" => $data
            //         // "data2" => $data2
            //     );
            // }
        }

        // if (isset($request->cond_show_edit)) {
        //     // dd('entro2');
        //     if ($request->cond_show_edit == 0) {
        //         $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
        //         return array(
        //             "exito" => false,
        //             "data" => $data
        //         );
        //     }
        // }

        // if (isset($request->cond_show_edit)) {
        //     // dd('entro3');
        //     $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
        //     $data2 = DB::select("select * from cas_cete.fn_editar_solicitud_equipos('".$request->id."')");
        //     // dd($data2);
        //     return array(
        //         "exito" => false,
        //         "data" => $data,
        //         "data2" => $data2
        //     );
        // }
        
        
        // dd($data);
        

        
    }

    public function rechazar_solicitud(Request $request){
        // dd($request);
        $pId_solic_ser = $request->id;
        // dd($pId_solic_ser);
        $comentario_rechazar = $request->comentario_rechazar;
        $select_rechazar = $request->select_rechazar;
        // $folio_solicitud = 'S2023-'.$request->id;
        // // dd($folio_solicitud);
    
        // $data1 = DB::select("select * from cas_cete.fn_solicitud_folio('".$folio_solicitud."')"); 
        // $pId_solic_ser = $data1[0]->id;
        // // dd($data1);
        // $data2 = DB::select("select * from cas_cete.registro_captacion where folio = '".$data1[0]->folio."'");
        // // dd($pId_reg_captacion = $data2[0]->id);
        // $pId_reg_captacion = $data2[0]->id;
        $data = DB::select("select * from cas_cete.fn_rechazar_solicitud(".$pId_solic_ser.",".$select_rechazar." ,'".$comentario_rechazar."',1 ,'Administrador',3 )");
        // dd($data);
        if($data != ''){
            return array(
                "folio_solicitud" => $data[0]->fn_rechazar_solicitud,
                "respuesta" => true
            );
        }
        else{
            return array(
                "respuesta" => false
            );
        }
        
    }

    public function aprobar_solicitud(Request $request){
        // dd($request->id_solicitud);No. de Solicitud: S2023-00006
        $id_solicitud = $request->id_solicitud;
        // $comentario_rechazar = $request->comentario_rechazar;
        // $data =  DB::select("select * from cas_cete.fn_solicitud('".$id_solicitud."')");

        // $folio_solicitud = $data[0]->folio;
        // dd($folio_solicitud);

        $data = DB::select("select * from cas_cete.fn_aprobar_solicitud(".$id_solicitud.")");
        // dd($data);

        if($data != ''){
            return array(
                "respuesta" => true,
                "folio" => $data[0]->fn_aprobar_solicitud
            );
        }
        else{
            return array(
                "respuesta" => false
            );
        }
        
    }

    public function actualizar_solicitud(Request $request){
        // dd($request['arrEquipos']);
        $pfolio_solicitud_global = $request->folio_solicitud_global;
        $pid_solicitud_global = $request->id_solicitud_global;
        if ($request['arrEquipos'] == null) {
            // dd($request);
            $data =  DB::select("select * from cas_cete.fn_editar_solicitud(
                ".$pid_solicitud_global.",
                '".$request['editar_nombre_solicitante']."',
                '".$request['editar_telefono_solicitante']."',
                '".$request['editar_descripcion_solicitante']."')");
            return array(
                "exito" => true
            );
        }
        // $arreglo_insert_equipos = [];
        
        // dd($pfolio_solicitud_global);
        // dd($request['arrEquipos']);
        

        foreach ($request['arrEquipos'] as $key => $value) {
            foreach ($value['aTarea'] as $key2 => $value2) {
                // dd($value2['idTarea']);
                // $pId_equipo_tarea = $value['desc_Tarea'];
                $pId_equipo_tarea =  DB::select("select * from cas_cete.fn_id_equipos_tareas(".$value['id_tipo_equipo'].",".$value2['idServicio'].",".$value2['idTarea'].")");
                // dd($pId_equipo_tarea[0]->id);
                
                $data =  DB::select("select * from cas_cete.fn_insert_solicitud_equipos(".$pid_solicitud_global.",".$pId_equipo_tarea[0]->id.",'".$value['descripcionSoporte']."')");
                
                // $data =  DB::select("select * from cas_cete.fn_insert_solicitud_equipos(".$pid_solicitud_global.",".$pId_equipo_tarea.",".$value['descripcionSoporte'].")");
                // dd($pId_equipo_tarea);
                // echo $pId_equipo_tarea;
                // select cet.id ,cte.tipo_equipo , cs.servicio , ct.tarea 
                //     from cat_equipos_tareas cet , cat_servicios_tareas cst,
                //     cat_tipos_equipo cte, cat_servicios cs, cat_tareas ct 
                //     where cet.id_tipo_equipo = cte.id 
                //     and cet.id_serv_tarea = cst.id 
                //     and cst.id_servicio = cs.id 
                //     and cst.id_tarea = ct.id 
                //     and cte.id = 11 
                //     and cs.id = 1
                //     and ct.id  = 7
            // echo $value['desc_Tarea'].'<br>';
            }
        }
        // dd($data[0]->fn_insert_solicitud_equipos);
        if ($data[0]->fn_insert_solicitud_equipos != '') {
            return array(
                "exito" => true
            );
        }
        else{
            return array(
                "exito" => false
            );
        }


    }

    public function select_rechaza_solicitud(Request $request){
        $data = [];
        
        // $data['tipo_servicio'];
        $data['tipo_rechazo'] =  DB::select("select * from cas_cete.fn_cat_rechazo_solicitud()");
        return array(
            "respuesta" => true,
            "data" =>$data
        );
        // dd($data['tipo_rechazo']);
    }

    public function store(){
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function show(){
        // return view('ordenes.index');
    }
}
