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
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use File;

class VentanillaController extends Controller
{

    public function pruebaJC(Request $request){
        // $data =  DB::select("select * from insumos.cat_centros_de_trabajo");
        // dd($data);
        // $string = "8470593 - 3015500750 - 3148212797";
        // $string4 = explode(" - ", $string);
        // dd($string4[0]);

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
                          

                        
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // $datatable->setData($data);
        // dd($datatable);
        // return $datatable;
        return view('ventanilla.pruebaJC', compact(
            'getUsername'
        ) );

        // return view('ventanilla.pruebaJC');
    }
    public function pruebaJC2(Request $request){
        // dd($request);
        $arreglo=[];
        $data =  DB::select("select * from cas_cete.getclavecct('%".$request->txt."%')");
        // dd($data);

        foreach ($data as $key => $value) {
            array_push($arreglo, $value);
        }

        $new_arr = array_values($arreglo);
        // dd($new_arr);

        return array(
            "exito" => true,
            "arreglo" => $new_arr
        );
    }

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
        $fn_solicitud_correo =  DB::select("select * from cas_cete.fn_solicitud_correo2('".$vCorreo."')");
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
                                    <i class="fa fa-eye"></i> Visualizar
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
        // dd($fn_solicitud_folio);
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
             <a href="http://devcete.tamaulipas.gob.mx/cascete/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'
    
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
        $vCentro_Trabajo = explode(" - ", $request->vCentro_Trabajo);
        // $vCentro_Trabajo = $request->vCentro_Trabajo;
        $fn_getcatcentrotrabajo =  DB::select("select * from cas_cete.getcatcentrotrabajo('".$vCentro_Trabajo[0]."')");
        // $fn_getcatcentrotrabajo =  DB::select("select * from cas_cete.getcatcentrotrabajo('".$vCentro_Trabajo."')");
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
        $pSeguimiento = $request['seguimiento'];
        $fn_insert_solicitud =  DB::select("select * from cas_cete.fn_insert_solicitud(".$pId_cct.",'".$pClave_ct."','".$pSolicitante."','".$pTelefono_solicitante."','".$pCorreo_solicitante."',".$pDirector.",'".$pDescripcion_reporte."','".$pCoord_x."','".$pCoord_y."',".$pId_coordinacion.",'".$pfolio_config."',".$pSeguimiento.")");
        // dd($request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['nombrect']);

        $id_retorno = $fn_insert_solicitud[0]->fn_insert_solicitud;

        // Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
        // $token = uniqid();
        // $token = strval( $token );

        $id_solicitud = $id_retorno;
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

        $path = asset('images/logo/logoTam2022.png');
        // $path = 'http://cascete.io/public/images/logo/logoTam2022.png';
        // $path = asset('images/logo/logoTam2022.png');
        //  return $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        // $data = file_get_contents($path);
        $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
        $pic = 'data:image/'.$type.';base64,'.base64_encode($data);
        $path_footer = asset('images/logo/ceteNI.png');
        // $path_footer = asset('images/logo/logoTam2022.png');
        // $path_footer = 'http://cascete.io/public/images/logo/ceteNI.png';
        // $path_footer = asset('images/logo/ceteNI.png');
        $type_footer = pathinfo($path_footer, PATHINFO_EXTENSION);
        // $data_footer = file_get_contents($path_footer);
        $data_footer = file_get_contents($path_footer, false, stream_context_create($arrContextOptions));
        $pic_footer = 'data:image/'.$type_footer.';base64,'.base64_encode($data_footer);

        // $html = '<img src="data:image;base64,'.base64_encode(@file_get_contents('logoTam2022.png')).'">';
        $html = '<img src="data:image;base64,'.base64_encode(@file_get_contents('logoTam2022.png', false, stream_context_create($arrContextOptions))).'">';
        $fecha = date('Y-m-d');

        //   view()->share('servicios::ordenes_servicio/downloadOrden',$Datos_solicitudObject, $equipos, $tecnicos_aux);
        //   $pdf = PDF::loadView('servicios::ordenes_servicio/downloadOrden', ['Datos_solicitudObject' => $Datos_solicitudObject, 'equipos' => $equipos, 'img' => $html, 'pic' => $pic, 'pic_footer' => $pic_footer, 'tecnicos_aux' => $tecnicos_aux]);
        
        view()->share('ventanilla/pdfVentanilla',$fn_solicitud,$fn_inf_orden);
        $pdf = PDF::loadView('ventanilla/pdfVentanilla', ['fn_solicitud' => $fn_solicitud], ['fn_inf_orden' => $fn_inf_orden])->setPaper('a4', 'landscape')->save(public_path('pdfSolicitud/').'Solicitud_'.$pfolio_config.'.pdf');
        
        chmod(public_path('pdfSolicitud/').'Solicitud_'.$pfolio_config.'.pdf', 0777);
        

        // dd('hola');

        $details = [
            'tittle' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
            
            'body1' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
            
            'body2' => 'Tu solicitud de servicio se encuentra',
            'body2.1' => ' En espera',
            'body2.2' => ' con el folio:',
            'body2.3' => ' '.$pfolio_config.'.',

            'body3' => 'Conserva este folio para continuar con el seguimiento de tu solicitud, nos pondremos en contacto al teléfono proporcionado.',

            'body4' => 'Atentamente.',
            'body5' => 'Centro Estatal de Tecnología Educativa',
            'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
             <a href="http://devcete.tamaulipas.gob.mx/cascete/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE.</ins></a>'

        ];

        Mail::to("$pCorreo_solicitante")->send(new MailSend($details,$pfolio_config));

        File::delete(public_path('pdfSolicitud/').'Solicitud_'.$pfolio_config.'.pdf');
        
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

        // if (isset($request->bandera_orden)) {
            // $data= '';
            // $data2= '';
            // if ($request->bandera_orden == 0) {
                $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud_orden('".$request->id."')");
                // dd($fn_solicitud);
                if ($fn_solicitud[0]->bandera == 0) {
                    $fn_inf_atendida = '';
                    if ($fn_solicitud[0]->id_estatus_orden!='' || $fn_solicitud[0]->id_estatus_orden!=null) {
                        $id_estatus = $fn_solicitud[0]->id_estatus_orden;
                    }
                    else{
                        $id_estatus = $fn_solicitud[0]->id_estatus;
                    }
                    $fn_detalle_equipos = DB::select("select * from cas_cete.fn_detalle_equipos('".$request->id."')");
                    
                    $fn_inf_solicitud = DB::select("select * from fn_inf_solicitud('".$request->id."')");
    
                    if ($id_estatus != 1 && $id_estatus != 6 && $id_estatus != 7) {
                        
                        $fn_inf_orden = DB::select("select * from fn_inf_orden('".$request->id."')");
                        // dd($fn_inf_orden);
                        $fn_inf_tecnicos = DB::select("select * from fn_inf_tecnicos('".$request->id."')");
                        // if ($fn_inf_orden[0]->id_estatus_orden == 5) {
                            $fn_inf_atendida = DB::select("select * from cas_cete.cierre_solic_serv where id_solic_serv = '".$request->id."'");
                            // dd($fn_inf_atendida);
                            // return array(
                            //     "exito" => true,
                            //     "data" => $fn_solicitud,
                            //     "folio_orden" => $fn_inf_orden[0]->folio,
                            //     "estatus" => $fn_inf_orden[0]->estatus,
                            //     "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                            //     "datos_equipos" => $fn_detalle_equipos,
                            //     "tecnicos_auxiliares" =>$fn_inf_tecnicos,
                            //     "id_estatus"=>$id_estatus,
                            //     "inf_atendida" => $fn_inf_atendida,
                            //     "id_estatus_orden"=>$fn_inf_orden[0]->id_estatus_orden
    
                            // );
                        // }
                        
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
                            "id_estatus"=>$id_estatus,
                            "inf_atendida" => $fn_inf_atendida,
                            "id_estatus_orden"=>$fn_inf_orden[0]->id_estatus_orden

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
                            "inf_atendida" => $fn_inf_atendida,
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
                            "inf_atendida" => $fn_inf_atendida,
                            "id_estatus"=>$id_estatus
                        );
                    }
                    
                    return array(
                        "exito" => false,
                        "data" => $fn_solicitud,
                        "estatus" => $fn_solicitud[0]->estatus,
                        "datos_equipos" => $fn_detalle_equipos,
                        "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                        "inf_atendida" => $fn_inf_atendida,
                        "id_estatus"=>$id_estatus
                            // "folio_orden" => $data2
                    );
                }
                else{
                    $fn_detalle_equipos = DB::select("select * from cas_cete.fn_detalle_equipos('".$request->id."')");
                    // $fn_inf_orden = DB::select("select * from fn_inf_orden('".$request->id."')");
                        
                    $fn_inf_tecnicos = DB::select("select * from fn_inf_tecnicos('".$request->id."')");
                    // dd($fn_solicitud[0]->id_estatus);
                    if($fn_solicitud[0]->id_estatus == 7){
                        // $fn_inf_cancelada = DB::select("select * from cas_cete.cierre_solic_serv where id_solic_serv = '".$request->id."'");
                        $fn_detalle_cancelada = DB::select("select * from fn_detalle_cancelada('".$request->id."')");
                        // dd($fn_detalle_cancelada);

                        return array(
                            "exito" => false,
                            "data" => $fn_solicitud,
                            "estatus" => $fn_solicitud[0]->estatus,
                            "datos_equipos" => $fn_detalle_equipos,
                            "tecnicos_auxiliares" => $fn_inf_tecnicos,
                            "motivo_cancelada" =>$fn_detalle_cancelada,
                            "bandera"=>$fn_solicitud[0]->bandera,
                            "id_estatus"=>$fn_solicitud[0]->id_estatus
                                // "folio_orden" => $data2
                        );
                    }

                    if($fn_solicitud[0]->id_estatus == 5){
                        $fn_inf_atendida = DB::select("select * from cas_cete.cierre_solic_serv where id_solic_serv = '".$request->id."'");
                        // dd($fn_inf_atendida);
                        return array(
                            "exito" => false,
                            "data" => $fn_solicitud,
                            "estatus" => $fn_solicitud[0]->estatus,
                            "datos_equipos" => $fn_detalle_equipos,
                            "tecnicos_auxiliares" => $fn_inf_tecnicos,
                            "inf_atendida" => $fn_inf_atendida,
                            "bandera"=>$fn_solicitud[0]->bandera,
                            "id_estatus"=>$fn_solicitud[0]->id_estatus
                                // "folio_orden" => $data2
                        );
                    }

                    return array(
                        "exito" => false,
                        "data" => $fn_solicitud,
                        "estatus" => $fn_solicitud[0]->estatus,
                        "datos_equipos" => $fn_detalle_equipos,
                        "tecnicos_auxiliares" => $fn_inf_tecnicos,
                        // "estatus_solicitud" => $fn_inf_solicitud[0]->estatus,
                        "bandera"=>$fn_solicitud[0]->bandera,
                        "id_estatus"=>$fn_solicitud[0]->id_estatus
                            // "folio_orden" => $data2
                    );
                }
                
            // }
        // }


        
    }
}
