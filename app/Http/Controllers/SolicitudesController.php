<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend3;
use App\Mail\MailSend4;
use Illuminate\Support\Facades\Cache;
use Dompdf\Options;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;

class SolicitudesController extends Controller
{

    function __construct()
    {   
        Cache::flush();
        setPermissionsTeamId(3);
    }

    public function index(Request $request){
        // $receivers = Receiver::pluck('email');
        // Mail::to($receivers)->send(new EmergencyCallReceived());
        // dd('hola');
        $vid_usuario=Auth()->user()->id;
        $getUsername=  DB::connection('pgsql')->select("select * from cas_cete.getUsername(".$vid_usuario.")");

        $data=[];
        $data =  DB::select("select * from cas_cete.fn_listado(1)");
        // dd($data);
        if ($request->ajax()) {
            // $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $roles = Auth()->user()->roles;
                        foreach ($roles as $rol) {
                            $idRol= $rol->id; 
                        }
                        // dd($row->folio_solicitud);
                        if ($idRol == 16 || $idRol == 17 || $idRol == 18 || $idRol == 19 || $idRol == 20 || $idRol == 21 || 
                        $idRol == 22 || $idRol == 23 || $idRol == 24 || $idRol == 25 || $idRol == 28) {
                            if ($row->id_estatus == 6) {
                                $acciones = '
                                <div class="dropdown btn-group dro pstart">
                                    <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a onclick="fnMostrarInfo('.$row->id.')" class="dropdown-item"> 
                                            <i class="fa fa-eye"></i>
                                                Ver Detalles Solicitud
                                            </a>
                                            <a onclick="fnImprimirSolicitud('.$row->id.')" class="dropdown-item"> 
                                            <i class="fas fa-download"></i>
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
                                            <i class="fa fa-eye"></i>
                                                Ver Detalles Solicitud
                                            </a>
                                            <a onclick="fnImprimirSolicitud('.$row->id.')" class="dropdown-item"> 
                                            <i class="fas fa-download"></i>
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
                                            <i class="fa fa-eye"></i>
                                                Ver Detalles Solicitud
                                            </a>
                                            <a onclick="fnActualizarSolicitud('.$row->id.')" class="dropdown-item"> 
                                            <i class="fas fa-edit"></i>
                                                Editar Solicitud
                                            </a>
                                            <a onclick="fnAprobarSolicitud('.$row->id.')" class="dropdown-item"> 
                                            <i class="fa fa-check"></i>
                                                Aprobar Solicitud
                                            </a>
                                            <a onclick="fnRechazarSolicitud('.$row->id.')" class="dropdown-item"> 
                                            <i class="	fas fa-times"></i>
                                                Rechazar Solicitud
                                            </a>
                                            <a onclick="fnImprimirSolicitud('.$row->id.')" class="dropdown-item"> 
                                            <i class="fas fa-download"></i>
                                                Imprimir Solicitud
                                            </a>
                                        </li>
                                    </ul>
                                </div>';
                            }
                        }
                        else{
                            $acciones = '';
                        }

                        
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // $datatable->setData($data);
        // dd($datatable);
        // return $datatable;
        return view('solicitudes.index', compact(
            'getUsername'
        ) );
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
            // $data= '';
            // $data2= '';
            if ($request->bandera_orden == 0) {
                $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
                // dd($data);
                if ($fn_solicitud[0]->id_estatus_orden!='' || $fn_solicitud[0]->id_estatus_orden!=null) {
                    $id_estatus = $fn_solicitud[0]->id_estatus_orden;
                }
                else{
                    $id_estatus = $fn_solicitud[0]->id_estatus;
                }
                $fn_detalle_equipos = DB::select("select * from cas_cete.fn_detalle_equipos('".$request->id."')");
                    // dd($data3);
                
                $fn_inf_solicitud = DB::select("select * from fn_inf_solicitud('".$request->id."')");

                if ($id_estatus != 1 && $id_estatus != 6 && $id_estatus != 7) {
                    
                    
                    $fn_inf_orden = DB::select("select * from fn_inf_orden('".$request->id."')");

                    $fn_inf_tecnicos = DB::select("select * from fn_inf_tecnicos('".$request->id."')");
                    

                    // dd($data4);
                    return array(
                        "exito" => false,
                        "data" => $fn_solicitud,
                        "folio_orden" => $fn_inf_orden[0]->folio,
                        "estatus" => $fn_inf_orden[0]->estatus,
                        "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                        "datos_orden" => $fn_detalle_equipos,
                        "tecnicos_auxiliares" =>$fn_inf_tecnicos,
                        "id_estatus"=>$id_estatus
                    );
                }

                if ($id_estatus == 6) {

                    $fn_detalle_rechazada = DB::select("select * from fn_detalle_rechazada('".$request->id."')");

                    return array(
                        "exito" => false,
                        "data" => $fn_solicitud,
                        "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                        "motivo_rechazo" =>$fn_detalle_rechazada,
                        "id_estatus"=>$id_estatus
                    );
                }

                if ($id_estatus == 7) {

                    
                    $fn_inf_orden = DB::select("select * from fn_inf_orden('".$request->id."')");

                    // $fn_inf_solicitud = DB::select("select * from fn_inf_solicitud('".$request->id."')");

                    $fn_detalle_cancelada = DB::select("select * from fn_detalle_cancelada('".$request->id."')");
                                
                    
                    // dd($fn_detalle_cancelada);
                    return array(
                        "exito" => true,
                        "data" => $fn_solicitud,
                        "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                        "folio_orden" => $fn_inf_orden[0]->folio,
                        "estatus" => $fn_inf_orden[0]->estatus,
                        // "datos_equipos" => $fn_detalle_equipos,
                        "motivo_cancelada" =>$fn_detalle_cancelada,
                        "id_estatus"=>$id_estatus
                    );
                }
                
                return array(
                    "exito" => false,
                    "data" => $fn_solicitud,
                    "estatus" => $fn_solicitud[0]->estatus,
                    "datos_orden" => $fn_detalle_equipos,
                    "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                    "id_estatus"=>$id_estatus
                        // "folio_orden" => $data2
                );
            }
            if ($request->bandera_orden == 1) {
                $arrEquipos = [];
                $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");

                $data2 =  DB::select("select * from cas_cete.fn_solicitud_equipos('".$data[0]->id."')");
                // dd($data[0]->id);
                $data3 = DB::select("select ess.id, ess.id_solic_serv, ess.id_tipo_equipo, cte.tipo_equipo, ess.id_usuario_agrega, 
                ess.fecha_agrega, ess.activo, ess.desc_problema, ess.etiqueta, ess.ubicacion, ess.diagnostico, ess.solucion,
                (
                    Select array_to_json(array_agg(row_to_json(t)))  From
                    (Select ff.id, ff.id_equipos_serv, ff.id_equipo_tarea, 
                     te.id as id_tipo_equipo, te.tipo_equipo, cs.id as id_servicio, cs.servicio,  ct.id as id_tarea, ct.tarea,
                     ff.id_usuario_agrega, ff.fecha_agrega, ff.activo
                     From cas_cete.equipos_detalle ff
                     inner join cas_cete.cat_equipos_tareas eqt on ff.id_equipo_tarea=eqt.id
                     inner join cas_cete.cat_servicios_tareas st on eqt.id_serv_tarea=st.id
                     inner join cas_cete.cat_tipos_equipo te on eqt.id_tipo_equipo=te.id
                     inner join cas_cete.cat_servicios cs on st.id_servicio=cs.id
                     inner join cas_cete.cat_tareas ct on st.id_tarea=ct.id
                     where ff.id_equipos_serv=ess.id
                     and ff.activo = true) t
                ) tareas
                from cas_cete.equipos_serv_solic ess 
                -- 		inner join cas_cete.equipos_detalle edd on ess.id=edd.id_equipos_serv
                -- 		inner join cas_cete.cat_equipos_tareas cet on edd.id_equipo_tarea=cet.id
                inner join cas_cete.cat_tipos_equipo cte on ess.id_tipo_equipo=cte.id
                where ess.id_solic_serv='".$data[0]->id."'
                and ess.activo = true
                order by ess.id asc");
                // dd($data3);
                // response ()->json($data3)
                return array(
                    "exito" => false,
                    "data" => $data,
                    "data2" => $data2,
                    "data3" => response ()->json($data3)
                    // "data2" => $data2
                );
            }
        }


        
    }

    public function rechazar_solicitud(Request $request){
        // dd($request);
        $pId_solic_ser = $request->id;
        $data_correo = DB::select("select ss.solicitante , ccdt.nombrect, ss.correo_solic  from cas_cete.solic_servicios ss,
        insumos.cat_centros_de_trabajo ccdt 
        where ss.id = ".$pId_solic_ser."
        and ccdt.id = ss.id_cct ");
        // dd($data_correo[0]->correo_solic);
        $pCorreo_solicitante = $data_correo[0]->correo_solic;
        $vNombre_solicitante = $data_correo[0]->solicitante;
        $vNombrect = $data_correo[0]->nombrect;

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
        $folio_solicitud = $data[0]->fn_rechazar_solicitud;
        $details = [
            // 'tittle' => 'Estimado usuario: ',
            'tittle' => 'Estimado usuario: '.$vNombre_solicitante.' - '.$vNombrect.'',
            
            'body1' => 'Lamentablemente no podemos proceder con su solicitud de servicio número: ',
            'body1.2' => $folio_solicitud,
            'body1.3' =>'. Nuestro equipo de Mesa de Ayuda se estará comunicando al teléfono proporcionado para explicar los detalles específicos y requerimientos necesarios que permitan llevar a cabo el desarrollo de su solicitud de manera exitosa.
            ',
            'body1.4' =>'Agradecemos su confianza en nuestros servicios. Si tiene alguna duda, contacte a nuestro equipo de soporte.',
            // 'body1' => 'Se ha aprobado tu solicitud con el numero de folio: '.$pfolio_config.'. 
            // Se ha creado una orden en espera de ser asignada con el personal tecnico especializado.',
            
            'body2' => 'Agradecemos su confianza en nuestros servicios. Si tienes alguna duda, agradecemos ponerte en contacto 
            con nuestro equipo de soporte.',

            // 'body3' => 'Te recomendamos mantener el numero de folio de tu solicitud para que puedas dar seguimiento a su progreso.',

            'body4' => 'Atentamente.',
            'body5' => 'Centro Estatal de Tecnología Educativa',
            'body6' => 'De igual manera, puedes consultar las observaciones de su solicitud de servicio a través del sitio:
             <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'

        ];

        Mail::to("$pCorreo_solicitante")->send(new MailSend3($details));
        // return array(
        //     "exito" => true,
        //     // "dato" => $pfolio_config,
        //     "data" => $pfolio_config
        // );

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
        // dd($request->id_solicitud);

        
        $id_solicitud = $request->id_solicitud;

        $validacion_equipos = DB::select("select * from cas_cete.solic_servicios ss, cas_cete.equipos_serv_solic ess  
        where ss.id = ess.id_solic_serv 
        and ss.id = ".$id_solicitud."");
        // dd($validacion_equipos);
        if ($validacion_equipos ==  null) {
            // dd('entro1');
            return array(
                "respuesta" => false
            );
        }
        else{

            // dd('entro2');
            $data_correo = DB::select("select ss.solicitante , ccdt.nombrect, ss.correo_solic,(select rc2.folio  from  cas_cete.registro_captacion rc2,
            cas_cete.solic_serv_track sst2, cas_cete.captacion_estatus ce2, cas_cete.cat_estatus ce22 
            where rc2.id = sst2.id_reg_captacion
            and sst2.id_capta_estatus = ce2.id
            and ce2.id_estatus = ce22.id  
            and rc2.id_solic_serv = ss.id
            and rc2.id_modo_capta = 1
            order by sst2.fecha desc 
            limit 1) as folio_solicitud  from cas_cete.solic_servicios ss,
            insumos.cat_centros_de_trabajo ccdt 
            where ss.id = ".$id_solicitud."
            and ccdt.id = ss.id_cct ");
            // dd($data_correo[0]->correo_solic);
            $pCorreo_solicitante = $data_correo[0]->correo_solic;
            $vNombre_solicitante = $data_correo[0]->solicitante;
            $vNombrect = $data_correo[0]->nombrect;
            $vFolio = $data_correo[0]->folio_solicitud;
            // $comentario_rechazar = $request->comentario_rechazar;
            // $data =  DB::select("select * from cas_cete.fn_solicitud('".$id_solicitud."')");

            // $folio_solicitud = $data[0]->folio;
            // dd($folio_solicitud);
            

            $data = DB::select("select * from cas_cete.fn_aprobar_solicitud(".$id_solicitud.")");
            // dd($data);

            $data2 = DB::select("select rc.folio  from cas_cete.registro_captacion rc 
            where rc.id_modo_capta = 1 
            and rc.id_solic_serv = ".$id_solicitud."");

            $details = [
                'tittle' => 'Estimado usuario: '.$vNombre_solicitante.' - '.$vNombrect.'',
                // 'tittle' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
                
                'body1' => 'Se ha aprobado tu solicitud con el numero de folio:',
                'body1.1' => ' '.$vFolio.' ',
                'body1.2' => ' .Se ha creado una orden',
                'body1.3' => ' En Espera',
                'body1.4' => ' de ser asignada con el personal técnico especializado.',
                // 'body1' => 'Se ha aprobado tu solicitud con el numero de folio: '.$pfolio_config.'. 
                // Se ha creado una orden en espera de ser asignada con el personal tecnico especializado.',
                
                'body2' => 'Te recomendamos mantener el numero de folio de tu solicitud para que puedas dar seguimiento a su progreso.',

                // 'body3' => 'Te recomendamos mantener el numero de folio de tu solicitud para que puedas dar seguimiento a su progreso.',

                'body4' => 'Atentamente.',
                'body5' => 'Centro Estatal de Tecnología Educativa',
                'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
                <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'

            ];
            

            if($data != ''){
                Mail::to("$pCorreo_solicitante")->send(new MailSend4($details));
                return array(
                    "respuesta" => true,
                    "folio" => $data[0]->fn_aprobar_solicitud,
                    "folio_solicitud" =>$data2[0]->folio
                );
            }
            else{
                return array(
                    "respuesta" => false
                );
            }
        }

        
        
    }

    public function actualizar_solicitud(Request $request){
        // dd($request);
        // $prueba = json_decode($request['arrEquipos'][0]['aTarea'], true);

        // dd($prueba);
        // dd($request);

        $pfolio_solicitud_global = $request->folio_solicitud_global;
        $pid_solicitud_global = $request->id_solicitud_global;
        $vid_usuario=Auth()->user()->id;

        $data =  DB::select("select * from cas_cete.fn_editar_solicitud(
            ".$pid_solicitud_global.",
            '".$request['editar_nombre_solicitante']."',
            '".$request['editar_telefono_solicitante']."',
            '".$request['editar_descripcion_solicitante']."')");


        if ($request['arrEliminarEquipos']!='') {
            foreach ($request['arrEliminarEquipos'] as $key => $value) {
                $data2 =  DB::select("select * from cas_cete.fn_editar_equipos(".$value['id_elimina'].")");
            }
        }
        if ($request['arrEquipos']!='') {
            foreach ($request['arrEquipos'] as $key => $value) {
            
                if ($value['vJson'] == 0) {
                    $data2 =  DB::select("select * from cas_cete.fn_insert_solicitud_equipos(".$pid_solicitud_global.",".$value['id_tipo_equipo'].",'".$value['descripcionSoporte']."', ".$vid_usuario.")");
                    // dd($data[0]->fn_insert_solicitud_equipos);
                    foreach ($value['aTarea'] as $key2 => $value2) {
                        $data3 =  DB::select("select * from cas_cete.fn_insert_solicitud_tareas(".$data2[0]->fn_insert_solicitud_equipos.",".$value['id_tipo_equipo'].",".$value2['idServicio'].",".$value2['idTarea'].",".$vid_usuario.")");
        
                    }            
                }
            }
            // dd('se logro');
            return array(
                "exito" => true
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

    public function downloadPdf_solicitud($id){

        // dd($request->id);
        

        $id_solicitud = $id;
        $bandera = 0;
        $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud('".$id_solicitud."')");
        $fn_inf_orden = DB::select("select * from cas_cete.fn_inf_orden('".$id_solicitud."')");
        
        // dd($Datos_solicitud);
        // dd($ordenServicios[0]);
        $fn_solicitud=$fn_solicitud[0];
        if ($fn_inf_orden != null) {
            $fn_inf_orden=$fn_inf_orden[0];
        }

        // dd($fn_inf_orden);
      
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $pdf = new Dompdf($options);

        $path = base_path('public/images/logo/logoTam2022.png');
        // $path = 'http://cascete.io/public/images/logo/logoTam2022.png';
        // $path = asset('images/logo/logoTam2022.png');
        //  return $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/'.$type.';base64,'.base64_encode($data);
        $path_footer = base_path('public/images/logo/ceteNI.png');
        // $path_footer = asset('images/logo/logoTam2022.png');
        // $path_footer = 'http://cascete.io/public/images/logo/ceteNI.png';
        // $path_footer = asset('images/logo/ceteNI.png');
        $type_footer = pathinfo($path_footer, PATHINFO_EXTENSION);
        $data_footer = file_get_contents($path_footer);
        $pic_footer = 'data:image/'.$type_footer.';base64,'.base64_encode($data_footer);

        $html = '<img src="data:image;base64,'.base64_encode(@file_get_contents('logoTam2022.png')).'">';
        $fecha = date('Y-m-d');

        //   view()->share('servicios::ordenes_servicio/downloadOrden',$Datos_solicitudObject, $equipos, $tecnicos_aux);
        //   $pdf = PDF::loadView('servicios::ordenes_servicio/downloadOrden', ['Datos_solicitudObject' => $Datos_solicitudObject, 'equipos' => $equipos, 'img' => $html, 'pic' => $pic, 'pic_footer' => $pic_footer, 'tecnicos_aux' => $tecnicos_aux]);
        
        view()->share('solicitudes/downloadSolicitud',$fn_solicitud,$fn_inf_orden);
        $pdf = PDF::loadView('solicitudes/downloadSolicitud', ['fn_solicitud' => $fn_solicitud], ['fn_inf_orden' => $fn_inf_orden])->setPaper('a4', 'landscape');
        // dd('hola');
        //   return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf'); // para que vaya a la url a descargar directo el pdf
        return $pdf->stream(); /// para abrir una nueva pestaña y que se muestre el pdf
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
