<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\MailSend;
use App\Mail\MailSend2;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;
use Session;
Use Exception;
use Illuminate\Database\QueryException;

class VentanillaController extends Controller
{

    public function index(){
        // dd(uniqid());
         return view('ventanilla.index');
    }

    public function index_mail(){
        return view('ventanilla.index_mail');
    }

    public function consulta(){
        return view('ventanilla.consulta');
    }

    public function consulta_folio(Request $request){
        $vFolio = $request->vFolio;
        // dd($vFolio);
        $fn_solicitud_folio=[];
        $fn_solicitud_folio =  DB::select("select * from cas_cete.fn_solicitud_folio('".$vFolio."')");
        // dd($data);

        if ($fn_solicitud_folio == null) {
            return array(
                "exito" => false
                // "data" => $data
            );
        }
        else{
            return array(
                "exito" => true,
                "data" => $fn_solicitud_folio
            );
        }
        
    }

    public function consulta_folio_correo(Request $request){
        $vCorreo = $request->vCorreo;
        // dd($vCorreo);
        $fn_solicitud_correo=[];
        $fn_solicitud_correo =  DB::select("select * from cas_cete.fn_solicitud_correo('".$vCorreo."')");
        // dd($data);
        if ($request->ajax()) {
            // $data = User::latest()->get();
            return Datatables::of($fn_solicitud_correo)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // dd($row->folio_solicitud);
                    $acciones = '
                    <div class="dropdown btn-group dropstart">
                        <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                            <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a onclick="Mostrar_Solicitud('.$row->id.')" class="dropdown-item"> 
                                    <i class="fa fa-eye" aria-hidden="true"></i> Visualizar
                                </a>
                            </li>
                        </ul>
                    </div>';
                
                return $acciones;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return array(
            // "exito" => false,
            "data" => $fn_solicitud_correo
        );
    }

    public function consulta_folio_solicitud(Request $request){
        $vFolio = $request->vFolio;
        // dd($vCorreo);
        $data=[];
        $fn_solicitud_folio =  DB::select("select * from cas_cete.fn_solicitud_folio('".$vFolio."')");
        // dd($data);
        if ($request->ajax()) {
            // $data = User::latest()->get();
            return Datatables::of($fn_solicitud_folio)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                // dd($row->folio_solicitud);
                    $acciones = '
                    <div class="dropdown btn-group dropstart">
                        <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                            <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a onclick="Mostrar_Solicitud('.$row->id.')" class="dropdown-item"> 
                                    <i class="fa fa-eye" aria-hidden="true"></i> Visualizar
                                </a>
                            </li>
                        </ul>
                    </div>';
                
                return $acciones;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return array(
            // "exito" => false,
            "data" => $fn_solicitud_folio
        );
    }

    public function sendEmail(Request $request){
        $vCorreoVerifica = $request->vCorreoVerifica;
        $token = uniqid();
        $token = strval( $token );
        Session::put('token', $token);
        Session::put('vCorreoVerifica', $vCorreoVerifica);
        $details = [
            'tittle' => 'Correo por Parte de la Secretaria de Educacion',
            'body' => 'Este es el TOKEN con el que podra hacer su Registro de Solicitud : '.$token.''

        ];

        Mail::to("$vCorreoVerifica")->send(new MailSend($details));
        return array(
            "exito" => true,
            "TOKEN" => $token
        );
    }

    public function sendEmail2(Request $request){
        $vCorreoVerifica = $request->vCorreoVerifica;

        $fn_solicitud_correo=[];
        $fn_solicitud_correo =  DB::select("select * from cas_cete.fn_solicitud_correo('".$vCorreoVerifica."')");
        // dd($data);
        if ($fn_solicitud_correo == null) {
            return array(
                "exito" => false
                // "data" => $data
            );
        }
        else{

            $token = uniqid();
            $token = strval( $token );
            Session::put('token', $token);
            Session::put('vCorreoVerifica', $vCorreoVerifica);
            $details = [
                'tittle' => 'Verificación de cuenta',
                
                // 'body1' => 'Estimado usuario: juan - C.C.T.',
                
                'body1' => 'Se ha solicitado autenticar tu cuenta para llevar a cabo una consulta de solicitudes de servicio.',
    
                'body2' => 'Por favor ingresa el siguiente token de seguridad: ',
                'body2.1' => $token,
                'body3' => 'Si el código no funciona, intenta copiando y pegando el mismo desde tu navegador.',
    
                'body4' => 'Atentamente.',
                'body5' => 'Centro Estatal de Tecnología Educativa',
                'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
             <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'
    
            ];
    
            // Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
    
            Mail::to("$vCorreoVerifica")->send(new MailSend2($details));
            return array(
                "exito" => true,
                "TOKEN" => $token
            );
        }



    }

    public function formulario_index(Request $request){

        return view('ventanilla.formulario_index');//->with($data);
    }

    public function formulario_consulta(Request $request){
        // dd($request);
        // $prueba = "1234";
        $fn_getcatcentrotrabajo =  DB::select("select * from cas_cete.getcatcentrotrabajo('".$request->vCentro_Trabajo."')");
        // dd($data);
        if($fn_getcatcentrotrabajo == null){
            return array(
                "exito" => false,
            );
        }
        else{
            return array(
                "exito" => true,
                "data" => $fn_getcatcentrotrabajo
            );
        }
    }

    public function formulario_registro(Request $request){

        $fn_fngenerafolio2 = DB::select("select * from cas_cete.fngenerafolio2(1,0)");
        $pfolio_config  =  $fn_fngenerafolio2[0]->fngenerafolio2;
        // dd($request['arreglo_inf'][0]['vCorreo_Solicitante']);

        // dd($request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['clavecct']);
        $pNombrect = $request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['nombrect'];
        $pId_cct = $request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['id'];
        $pClave_ct = $request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['clavecct'];
        $pSolicitante = $request['arreglo_inf'][0]['vNombre_Solicitante'];
        $pId_coordinacion = $request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['id_coordinacion'];
        $pTelefono_solicitante = $request['arreglo_inf'][0]['vTelefono_Solicitante'];
        $pCorreo_solicitante = $request['arreglo_inf'][0]['vCorreo_Solicitante'];
        $pDirector = $request['arreglo_inf'][0]['vBandera_director'];
        $pDescripcion_reporte = $request['arreglo_inf'][0]['vDescripcion_Reporte'];
        $pCoord_x = $request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['latitud'];
        $pCoord_y = $request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['longitud'];

        $fn_insert_solicitud =  DB::select("select * from cas_cete.fn_insert_solicitud(".$pId_cct.",'".$pClave_ct."','".$pSolicitante."','".$pTelefono_solicitante."','".$pCorreo_solicitante."',".$pDirector.",'".$pDescripcion_reporte."','".$pCoord_x."','".$pCoord_y."',".$pId_coordinacion.",'".$pfolio_config."')");
        // dd($request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['nombrect']);

        // $id_retorno = $data[0]->fn_insert_solicitud;

        // Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
        // $token = uniqid();
        // $token = strval( $token );
        $details = [
            'tittle' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
            
            'body1' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
            
            'body2' => 'Tu solicitud de servicio se encuentra',
            'body2.1' => ' En espera',
            'body2.2' => ' con el folio número:',
            'body2.3' => ' '.$pfolio_config.'.',

            'body3' => 'Conserva este folio para continuar con el seguimiento de tu solicitud, nos pondremos en contacto al teléfono proporcionado.',

            'body4' => 'Atentamente.',
            'body5' => 'Centro Estatal de Tecnología Educativa',
            'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
             <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE.</ins></a>'

        ];

        Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
        return array(
            "exito" => true,
            // "dato" => $pfolio_config,
            "data" => $pfolio_config
        );



    }

    public function index_formulario_solicitud(Request $request){
        $vCorreoVerifica = $request->vCorreoVerifica;

        $fn_correo_verifica = DB::select("select * from fn_correo_verifica('".$vCorreoVerifica."')");
        // dd($fn_correo_verifica);
        if ($fn_correo_verifica == '' || $fn_correo_verifica == null) {
            return array(
                "exito" => false
            );
        }
        else{
            $vNombreCorreo = $fn_correo_verifica[0]->nombre.' '.$fn_correo_verifica[0]->apellidos;
            Session::put('vCorreoVerifica', $vCorreoVerifica);
            Session::put('vNombreCorreo', $vNombreCorreo);
            return array(
                "exito" => true
            );
        }


    }
    
    public function buscar_folio_ventanilla(Request $request){
        // dd($request);
        // $data=[];
        // $data2=[];

        if (isset($request->bandera_orden)) {
            // $data= '';
            // $data2= '';
            if ($request->bandera_orden == 0) {
                $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");
                // dd($fn_solicitud);
                // dd($data[0]->id_estatus);
                if ($fn_solicitud[0]->id_estatus_orden!='' || $fn_solicitud[0]->id_estatus_orden!=null) {
                    $id_estatus = $fn_solicitud[0]->id_estatus_orden;
                }
                else{
                    $id_estatus = $fn_solicitud[0]->id_estatus;
                }
                // dd($id_estatus);
                $fn_detalle_equipos = DB::select("select * from cas_cete.fn_detalle_equipos('".$request->id."')");
                    // dd($data3);
                
                $fn_inf_solicitud = DB::select("select * from fn_inf_solicitud('".$request->id."')");

                if ($id_estatus != 1 && $id_estatus != 6 && $id_estatus != 7) {
                    
                    $fn_inf_orden = DB::select("select * from fn_inf_orden('".$request->id."')");
                    
                    $fn_inf_tecnicos = DB::select("select * from fn_inf_tecnicos('".$request->id."')");
                    
                    // $fn_inf_solicitud = DB::select("select * from fn_inf_solicitud('".$request->id."')");

                    // dd($data4);
                    return array(
                        "exito" => true,
                        "data" => $fn_solicitud,
                        "folio_orden" => $fn_inf_orden[0]->folio,
                        "estatus" => $fn_inf_orden[0]->estatus,
                        "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                        "datos_equipos" => $fn_detalle_equipos,
                        "tecnicos_auxiliares" =>$fn_inf_tecnicos,
                        "id_estatus"=>$id_estatus
                    );
                }

                if ($id_estatus == 6) {


                    // dd($request->id.' entro');
                    $fn_detalle_rechazada = DB::select("select * from fn_detalle_rechazada('".$request->id."')");

                    // $fn_inf_solicitud = DB::select("select * from fn_inf_solicitud('".$request->id."')");

                    return array(
                        "exito" => true,
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
                    "datos_equipos" => $fn_detalle_equipos,
                    "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                    "id_estatus"=>$id_estatus
                        // "folio_orden" => $data2
                );
            }
            // if ($request->bandera_orden == 1) {
            //     $arrEquipos = [];
            //     $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud('".$request->id."')");

            //     $fn_solicitud_equipos =  DB::select("select * from cas_cete.fn_solicitud_equipos('".$data[0]->id."')");
            //     // dd($data[0]->id);
            //     $data3 = DB::select("select ess.id, ess.id_solic_serv, ess.id_tipo_equipo, cte.tipo_equipo, ess.id_usuario_agrega, 
            //     ess.fecha_agrega, ess.activo, ess.desc_problema, ess.etiqueta, ess.ubicacion, ess.diagnostico, ess.solucion,
            //     (
            //         Select array_to_json(array_agg(row_to_json(t)))  From
            //         (Select ff.id, ff.id_equipos_serv, ff.id_equipo_tarea, 
            //          te.id as id_tipo_equipo, te.tipo_equipo, cs.id as id_servicio, cs.servicio,  ct.id as id_tarea, ct.tarea,
            //          ff.id_usuario_agrega, ff.fecha_agrega, ff.activo
            //          From cas_cete.equipos_detalle ff
            //          inner join cas_cete.cat_equipos_tareas eqt on ff.id_equipo_tarea=eqt.id
            //          inner join cas_cete.cat_servicios_tareas st on eqt.id_serv_tarea=st.id
            //          inner join cas_cete.cat_tipos_equipo te on eqt.id_tipo_equipo=te.id
            //          inner join cas_cete.cat_servicios cs on st.id_servicio=cs.id
            //          inner join cas_cete.cat_tareas ct on st.id_tarea=ct.id
            //          where ff.id_equipos_serv=ess.id
            //          and ff.activo = true) t
            //     ) tareas
            //     from cas_cete.equipos_serv_solic ess 
            //     -- 		inner join cas_cete.equipos_detalle edd on ess.id=edd.id_equipos_serv
            //     -- 		inner join cas_cete.cat_equipos_tareas cet on edd.id_equipo_tarea=cet.id
            //     inner join cas_cete.cat_tipos_equipo cte on ess.id_tipo_equipo=cte.id
            //     where ess.id_solic_serv='".$data[0]->id."'
            //     and ess.activo = true
            //     order by ess.id asc");
            //     // dd($data3);
            //     // response ()->json($data3)
            //     return array(
            //         "exito" => false,
            //         "data" => $fn_solicitud,
            //         "data2" => $fn_solicitud_equipos,
            //         "data3" => response ()->json($data3)
            //         // "data2" => $data2
            //     );
            // }
        }


        
    }
}
