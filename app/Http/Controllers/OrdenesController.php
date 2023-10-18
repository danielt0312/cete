<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Mail;
// use App\Http\Controllers\Mail; 
use App\Mail\MailSendO;
use DateTime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class OrdenesController extends Controller
{

    function __construct(){
        Cache::flush();
        setPermissionsTeamId(3);
    }

    public function index(){
        $catCoordinaciones =  DB::connection('pgsql')->select("select * from cas_cete.getCatCoordinaciones()");
        $catEstatusOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatEstatusOrden()");
        $catMotivoCancela=  DB::connection('pgsql')->select("select * from cas_cete.getCatMotivoCancela()");

        $vid_usuario=Auth()->user()->id;
        $getUsername=  DB::connection('pgsql')->select("select * from cas_cete.getUsername(".$vid_usuario.")");
        // $getUsername=$getUsername[0]->nameuser;
        // dd ($catEstatusOrden);
        return view('ordenes.index', compact(
            'catCoordinaciones',
            'catEstatusOrden',
            'catMotivoCancela',
            'getUsername'
        ) );
        // return view('ordenes.index');
        
    }

    public function create(){
        // return view('ordenes.create');

        // if ($user->hasRole('Super Administrador' )) {
        //     dd('super');
        // } else{
        //     dd('no admin');
        // }

        $roles = Auth()->user()->roles;
        foreach ($roles as $rol) {
            $idRol= $rol->id; 
        }

        $catTipoOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden(".$idRol.")");
        // $catTipoServicio =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoServicio()");]
        $catTipoEquipo =  DB::connection('pgsql')->select("select * from cas_cete.getCatTiposEquipo()");
        $catAreasAtiendeOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatAreasAtiendeOrden(".$idRol.")"); 
        
        $vid_usuario=Auth()->user()->id;
        $getUsername=  DB::connection('pgsql')->select("select * from cas_cete.getUsername(".$vid_usuario.")");

        return view('ordenes.create', compact(
            'catTipoOrden',
            // 'catTipoServicio',
            'catTipoEquipo',
            'catAreasAtiendeOrden',
            'getUsername'
        ) );
    }

    public function store(Request $request){ 
        //   dd($request); 
        // dd($request->arrEquipos);  //"[object Object]"
        $equipos=$request->arrEquipos; 

        $nombreSoliictante='';  /// SI ES DIRECTOR O NO QUE TOME NOMBRE EN SOLICITANTE O NO
        // dd($request->checkDirector);
        if($request->checkDirector == "true"){
            $nombreSoliictante = $request->nombreSol; // quitar comillas dobles "nombre"
            // $nombreSoliictante = preg_replace('([^A-Za-z0-9])', '', $nombreSoliictante);
            $nombreSoliictante = str_replace('"', '', $nombreSoliictante);
            $nombreSoliictante = trim($nombreSoliictante);
            // dd($nombreSoliictante,1);
        }else{
            $nombreSoliictante = $request->txtNombreSolicitante;
            // dd($nombreSoliictante,2); 
        }

        $roles = Auth()->user()->roles;
        foreach ($roles as $rol) {
            $idRol= $rol->id; 
            $nameRol= $rol->name;
        }
        // dd($nombreSoliictante);

        //SI FUNCIONAA  SP
        //$insSolicServicio =  DB::select("CALL cas_cete.spinsertsolicservicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$request->txtNombreSolicitante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',2,1,13,".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."')");
        $vidModoCaptacion=2;
        $vid_usuario=Auth()->user()->id;
        //FUNCIONinssolicservicioPrueba2
        //// $insSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.InsSolicServicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$request->txtNombreSolicitante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."')");
        // $insSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.insSolicServicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$nombreSoliictante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."')");
        $insSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.insSolicServicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$nombreSoliictante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."','".$nameRol."',".$request->checkSeguimiento.")");
    
        $catTipoOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden(".$idRol.")");
        // $catTipoServicio =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoServicio()");]
        $catTipoEquipo =  DB::connection('pgsql')->select("select * from cas_cete.getCatTiposEquipo()");
        $catAreasAtiendeOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatAreasAtiendeOrden(".$idRol.")"); 

        $result1 =$insSolicServicio[0]->inssolicservicio;
        $result2 = json_decode($result1);

        if($insSolicServicio != null){
            $this->sendCorreo($result2->vpfolio, $request->txtCorreoSolicitante, $nombreSoliictante, $request->txtNombreCCT);

            return response()->json($insSolicServicio);
        }
    }

    public function edit($idOrden){
        
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.getTOrdenDetalle(".$idOrden.")");

        // dd($ordenServicios[0]);
        $ordenServiciosDetalle=$ordenServicios[0];

        $roles = Auth()->user()->roles;
        foreach ($roles as $rol) {
            $idRol= $rol->id; 
        }

        $catTipoOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden(0)");
        $catTipoEquipo =  DB::connection('pgsql')->select("select * from cas_cete.getCatTiposEquipo()");
        $catAreasAtiendeOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatAreasAtiendeOrden(0)"); 
        $vid_usuario=Auth()->user()->id;
        $getUsername=  DB::connection('pgsql')->select("select * from cas_cete.getUsername(".$vid_usuario.")");

        return view('ordenes.edit', compact(
            'ordenServiciosDetalle',
            'catTipoOrden',
            'catTipoEquipo',
            'catAreasAtiendeOrden',
            'getUsername'
        ) );
    }

    public function update(Request $request){
        //  dd($request);
        // dd($request->arrEquipos);  //"[object Object]"
        //dd($request->txtIdSolic);
        $equipos=$request->arrEquipos;
        $equiposElim=$request->arrEquiposElim;
        // var_dump($equipos);

        $nombreSoliictante='';  /// SI ES DIRECTOR O NO QUE TOME NOMBRE EN SOLICITANTE O NO

        if($request->checkDirector == true){
            $nombreSoliictante = $request->nombreSol; // quitar comillas dobles "nombre"
            // $nombreSoliictante = preg_replace('([^A-Za-z0-9])', '', $nombreSoliictante);
            $nombreSoliictante = str_replace('"', '', $nombreSoliictante);
            $nombreSoliictante = trim($nombreSoliictante);
        }else{
            $nombreSoliictante = $request->txtNombreSolicitante;
        } 

        $vidModoCaptacion=2;
        $vid_usuario=Auth()->user()->id;
        // //$arr = json_decode($equipos);
        // var_dump($arr[0]->id_tipo_equipo,$arr[0]->desc_tipo_equipo);

        //// $arrTarea=$arr[0]->aTarea; 
        // var_dump($arrTarea);

        // foreach ($arrTarea as $p) {
        //     echo $p->idTarea;
        // }

        if(isset($request->selTipoOrden)){
            $id_tipoOrden=$request->selTipoOrden;
        }else{
            $id_tipoOrden=0;
        }

        if(isset($request->selDepAtiende)){
            $id_depAtiende=$request->selDepAtiende;
        }else{
            $id_depAtiende=0;
        }

        // $insSolicServicio =  DB::connection('pgsql')->select("CALL cas_cete.spinsertsolicservicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$request->txtNombreSolicitante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."',true,'".$request->txtDescripcionReporte."',2,1,13,".$request->txtLongitud.",".$request->txtLatitud.")");
        $updSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.updSolicServicio(".$request->txtIdSolic.",".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$nombreSoliictante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$id_tipoOrden.",".$vid_usuario.",".$id_depAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."','".$equiposElim."',".$request->checkSeguimiento.")");
        // $updSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.updSolicServicioAida(".$request->txtIdSolic.",".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$nombreSoliictante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."','".$equiposElim."')"); 

        // foreach ($arr as $e) {

        //     if($e->cantidad > 1){
        //         echo $e->cantidad.'<br>';
        //         for ($i=0; $i < $e->cantidad; $i++) { 
        //             echo $e->desc_tipo_equipo .'---'.$i.'<br>';

        //             // echo $e->desc_tipo_equipo.'--'.$e->con.'--<br>';
        //             $arrTarea=$e->aTarea;
        //             foreach ($arrTarea as $p) {
        //                 // echo $p->idTarea.' - '.$p->desc_Tarea.' - '.$p->idServicio.' - '.$p->desc_Servicio.'<br>';//Tareas
        //                 echo $p->idTarea.' - '.$p->desc_Tarea.' - '.$p->idServicio.' - '.$p->desc_Servicio.'<br>';
        //             }
        //         }
        //     }else{
        //         echo '<br>';
        //         echo $e->desc_tipo_equipo.'--'.$e->con.'--<br>';
        //         $arrTarea=$e->aTarea;
        //         foreach ($arrTarea as $p) {
        //             // echo $p->idTarea.' - '.$p->desc_Tarea.' - '.$p->idServicio.' - '.$p->desc_Servicio.'<br>';//Tareas
        //             echo $p->idTarea.' - '.$p->desc_Tarea.' - '.$p->idServicio.' - '.$p->desc_Servicio.'<br>';
        //         }
        //     }
            
        // }
        return response()->json($updSolicServicio);
    }

    public function show(Request $request){
        // dd($request->fecha_inicio,$request->fecha_fin);
        // $ordenes = DB::connection('pgsql')->select("select * from cas_cete.getTOrdenes()");
        $vModoCaptacion=2;
        //  getTOrdenes2 

        $vid_usuario=Auth()->user()->id;

        $roles = Auth()->user()->roles;
        foreach ($roles as $rol) {
            $nameRol= $rol->name; 
        }

        if($nameRol==="Técnico CETE" || $nameRol==="Técnico Coordinaciones" || $nameRol==="Técnico Laboratorista" ||
        $nameRol==="Técnico Torre LP"){
            $ordenes = DB::connection('pgsql')->select("select * from cas_cete.gettordenes2tecnicos(".$request->coordinacion_id.",".$request->estatus_id.",'".$request->fecha_inicio."','".$request->fecha_fin."','".$request->clavecct."',".$vModoCaptacion.",".$vid_usuario.")");
        }else{ 
            $ordenes = DB::connection('pgsql')->select("select * from cas_cete.gettordenes2(".$request->coordinacion_id.",".$request->estatus_id.",'".$request->fecha_inicio."','".$request->fecha_fin."','".$request->clavecct."',".$vModoCaptacion.")");
        }

        // $ordenes = DB::connection('pgsql')->select("select * from cas_cete.getTOrdenes2(".$request->coordinacion_id.",".$request->estatus_id.",'".$request->fecha_inicio."','".$request->fecha_fin."','".$request->clavecct."',".$vModoCaptacion.")");
        // dd($ordenes);
        $tenicosAuxD = DB::select("select * from cas_cete.getCatTecnicosAuxiliares(0,1)");
        $tenicosAux=$tenicosAuxD[0];
        // dd($ordenServicios[0]);
        // return response()->json([$registros, $evaluacion, 'vRol'=>$vRol]);
        // $tenicosAuxD='';
        //  dd($ordenes);
        return response()->json([$ordenes,$tenicosAuxD]);
    }
    
    // public function getTareas($idequi = 0, $idserv = 0){   //$idequi,$idserv
    // public function getTareas($idserv){   //$idequi,$idserv
    public function getTareas(Request $request){   //$idequi,$idserv
        // dd($request);
        // $idequi = 1;
        // $separar=explode($idserv,',');
        // $idE=$separar[0];
        // $idS=$separar[1];

        $catTarea =  DB::connection('pgsql')->select("select * from cas_cete.getCatTarea('".$request->idequi."','".$request->idserv."')");
        // $catTarea =  DB::select("select * from cas_cete.getCatTarea('".$idserv."')");

        return response()->json([$catTarea]);
    }

    public function getServicios($idEquipo){

        $catServicio =  DB::connection('pgsql')->select("select * from cas_cete.getCatServicio('".$idEquipo."')");

        return response()->json([$catServicio]);
    }

    public function getCCT($claveCCT){

        $catCentroTrabajo =  DB::connection('pgsql')->select("select * from cas_cete.getCatCentroTrabajo('".$claveCCT."')");

        $ordenesCentroTrabajo =  DB::connection('pgsql')->select("select * from cas_cete.getOrdenesCentro('".$claveCCT."')");
        // $ordenesCentroTrabajo=null;
         //dd($catCentroTrabajo);
        return response()->json([$catCentroTrabajo,$ordenesCentroTrabajo]);
    }

    // public function getordenesCCT($claveCCT){

    //     $catCentroTrabajo =  DB::select("select * from cas_cete.getOrdenesCentro('".$claveCCT."')");

    //     // $ordenesCentroTrabajo =  DB::select("select * from cas_cete.getOrdenesCentroTrabajo('".$claveCCT."')");
    //     $ordenesCentroTrabajo=null;
    //      //dd($catCentroTrabajo);
    //     return response()->json([$catCentroTrabajo,$ordenesCentroTrabajo]);
    // }

    public function updEstatusOrden(Request $request){
        //   dd($request->All());
        $exito = DB::connection('pgsql')->select("select * from cas_cete.insCancelaSolicitud(".$request->idSolicServ.",".$request->id_motivo_canc.",'".$request->comentarios."',".$request->id_usuario.",'".$request->desc_rol_usr."')");
        // dd($exito);
        // return response()->json($exito);

        if($exito != null || $exito != ''){ 
            $folio = $request->hdFolio;
            $folio_solic = $request->hdFolioSol;
            $correo = $request->hdCorreo;
            $nombrecct = $request->hdNombrecct;
            $solicitante = $request->hdSolicitante; 

            if($folio_solic != null){ // si viene desde solicitud
                $msje_asunto='No es posible atender su solicitud de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Lamentablemente no podemos proceder con su solicitud de servicio con el folio ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                $band_ventanilla='1';
                $folio2=$folio_solic;
            }else{
                $msje_asunto='No es posible atender su orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Lamentablemente no podemos proceder con su orden de servicio con el folio: '; 
                $msje_ventanilla='';
                $band_ventanilla='0';
                $folio2=$folio;
            }
            $details = [
                'asunto' => $msje_asunto,
                'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
                'folio' => $folio2.' ',
                'estatus' => '',
                
                'body1' => $msje_correo,
                
                'body2' => 'en este momento. Nuestro equipo de Mesa de Ayuda se estará comunicando al teléfono proporcionado para explicar los detalles específicos y requerimientos necesarios que permitan llevar a cabo el desarrollo de su solicitud de manera exitosa.',
                
                'body3' => 'Agradecemos su confianza en nuestros servicios. Si tiene alguna duda, agradecemos ponerse en contacto con nuestro equipo de soporte.',
                'body4' => '',

                'firma1' => 'Atentamente.',
                'firma2' => 'Centro Estatal de Tecnología Educativa',
                'band_ventanilla' => $band_ventanilla,
                'ventanilla' => $msje_ventanilla,
                'fecha_hora_asignacion' =>''
                
            ];

            Mail::to("$correo")->send(new MailSendO($details,''));

            return response()->json($exito);
        }else{

        }
        
    }

    public function updIniciar(Request $request){
        //   dd($request->All());

        $exito = DB::connection('pgsql')->select("select * from cas_cete.insIniciaSolicitud(".$request->idSolicServ.")");
       // dd($exito);
    //    return response()->json($exito);
        if($exito != null || $exito != ''){ 
            if($request->seguimiento=='true' ){  // si requere seguimiento
                $folio = $request->folio;
                $folio_solic = $request->folioSol;
                $correo = $request->correo;
                $nombrecct = $request->nombrecct;
                $solicitante = $request->solicitante;

                if($folio_solic != null  && $folio_solic != "null"){ // si viene desde solicitud 
                    $msje_asunto='Se ha iniciado la solicitud de servicio - Sistema C.A.S. - C.E.T.E.';
                    $msje_correo='Se ha iniciado la solicitud de servicio con el folio: ';
                    $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                    <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                    $band_ventanilla='1';
                    $folio2=$folio_solic;
                }else{
                    $msje_asunto='Se ha iniciado la orden de servicio - Sistema C.A.S. - C.E.T.E.';
                    $msje_correo='Se ha iniciado la orden de servicio con el folio: '; 
                    $msje_ventanilla='';
                    $band_ventanilla='0';
                    $folio2=$folio;
                }
                $details = [
                    'asunto' => $msje_asunto,
                    'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
                    'folio' => $folio2.' ',
                    'estatus' => '',
                    
                    'body1' => $msje_correo,
                    
                    'body2' => 'por parte de nuestros técnicos de soporte especializados. Te mantendremos informado sobre el progreso correspondiente.',
                    
                    'body3' => 'Le recomendamos mantener el folio de su orden para que pueda contactarnos para su seguimiento.',
                    'body4' => '',

                    'firma1' => 'Atentamente.',
                    'firma2' => 'Centro Estatal de Tecnología Educativa',
                    'band_ventanilla' => $band_ventanilla,
                    'ventanilla' => $msje_ventanilla,
                    'fecha_hora_asignacion' =>''
                ];

                Mail::to("$correo")->send(new MailSendO($details,''));
            }

            return response()->json($exito);
        }else{

        }
   }

    public function downloadPdf($id)
    {
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.gettordendetallepdf(".$id.")");
        // dd($ordenServicios[0]);
        $ordenServiciosObject=$ordenServicios[0];
      
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $pdf = new Dompdf($options);

        // $path = base_path('public/images/logo/logoTam2022.png');
        // $path = 'http://cascete.io/public/images/logo/logoTam2022.png';
        // $path = asset('images/logo/logoTam2022.png');
        $path = asset('images/logo/logo_cete_3.png');
        //  return $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );   
        // file_get_contents($path, false, stream_context_create($arrContextOptions));

        $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
        $pic = 'data:image/'.$type.';base64,'.base64_encode($data);
        // $path_footer = base_path('public/images/logo/ceteNI.png');
        // $path_footer = asset('images/logo/logoTam2022.png');
        // $path_footer = 'http://cascete.io/public/images/logo/ceteNI.png';
        $path_footer = asset('images/logo/ceteNI.png');
        $type_footer = pathinfo($path_footer, PATHINFO_EXTENSION);
        $data_footer = file_get_contents($path_footer,false, stream_context_create($arrContextOptions));
        $pic_footer = 'data:image/'.$type_footer.';base64,'.base64_encode($data_footer);

        $html = '<img src="data:image;base64,'.base64_encode(@file_get_contents('logoTam2022.png', false, stream_context_create($arrContextOptions))).'">';
        $fecha = date('Y-m-d');

    //   view()->share('servicios::ordenes_servicio/downloadOrden',$ordenServiciosObject, $equipos, $tecnicos_aux);
    //   $pdf = PDF::loadView('servicios::ordenes_servicio/downloadOrden', ['ordenServiciosObject' => $ordenServiciosObject, 'equipos' => $equipos, 'img' => $html, 'pic' => $pic, 'pic_footer' => $pic_footer, 'tecnicos_aux' => $tecnicos_aux]);

        view()->share('ordenes/downloadOrden',$ordenServiciosObject);
        $pdf = PDF::loadView('ordenes/downloadOrden', ['ordenServiciosObject' => $ordenServiciosObject])->setPaper('a4', 'landscape');
        // dd('hola');
    //   return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf'); // para que vaya a la url a descargar directo el pdf
        return $pdf->stream(); /// para abrir una nueva pestaña y que se muestre el pdf
    }

    public function detalleOrden($idOrden){
        
        // $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.getTOrdenDetalle(".$idOrden.")"); //esta es de detalle
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.getOrdenDetalleVer(".$idOrden.")");

        // dd($ordenServicios[0]);
        $ordenServiciosDetalle=$ordenServicios[0];

        return response()->json([$ordenServiciosDetalle]);
        
    }

    public function cargarTecnicosAux($idTenicoEncargado){
        
        $tenicosAuxD = DB::connection('pgsql')->select("select * from cas_cete.getCatTecnicosAuxiliares(".$idTenicoEncargado.",2)");
        // $tenicosAux=$tenicosAuxD[0];
        // dd($tenicosAuxD);
        return response()->json($tenicosAuxD);
    }

    /*public function updCerrar(Request $request){
        // dd($request, $_FILES["archivoCierre"]);
        
        $vusuario=Auth()->user()->id;

        $vidSolicServ=$request->hdIdOrdenCierra;

        $file2 = $_FILES["archivoCierre"];
        
        if($request->hasfile('archivoCierre')){ 

            $file=$request->file("archivoCierre");
            // dd($file[0]);
            $ext=substr($file[0]->getClientOriginalName(), -3);
            
            if($ext === "pdf" ){
                // $nombre = uniqid() .'_'. $vidSolicServ.'.'.$ext;
                $nombre = 'A_'. $vidSolicServ.'.'.$ext; 
                
                $ruta = public_path("cierreOrden/".$nombre);
                
                copy($file[0], $ruta);
            }
    
        }else{
            dd('no entro');
        }
        
        $ruta_archivo=$ruta;
        $nombre_archivo=$nombre;
        
        // $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$request->idSolicServ.",".$vusuario.",'".$ruta."')");
        $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$vidSolicServ.",".$vusuario.",'".$nombre_archivo."','".$ruta_archivo."','".$request->txtObservacionesC."')");
                
        //  return response()->json($exito);
        if($exito != null || $exito != ''){
            $folio = $request->hdFolioCierra;
            $folio_solic = $request->hdFolioSolCierra;
            $correo = $request->correoCierre;
            $nombrecct = $request->nombrecctCierre;
            $solicitante = $request->solicitanteCierre;

            if($folio_solic != null ){ // si viene desde solicitud
                $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha finalizado la solicitud de servicio con el folio: ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                $band_ventanilla='1'; 
                $folio2=$folio_solic;
            }else{
                $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha finalizado la orden de servicio con el folio: '; 
                $msje_ventanilla='';
                $band_ventanilla='0';
                $folio2=$folio;
            }
            $details = [
                'asunto' => $msje_asunto,
                'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
                'folio' => $folio2.' ',
                'estatus' => '',
                
                'body1' => $msje_correo,
                
                'body2' => 'por parte de nuestros técnicos de soporte especializados.',
                
                'body3' => 'Agradecemos su confianza en nuestros servicios. Quedamos a sus órdenes para cualquier duda o aclaración sobre el diagnóstico y solución de su(s) equipos.',
                'body4' => '',

                'firma1' => 'Atentamente.',
                'firma2' => 'Centro Estatal de Tecnología Educativa',
                'band_ventanilla' => $band_ventanilla,
                'ventanilla' => $msje_ventanilla,
                'fecha_hora_asignacion' =>''
            ];

            Mail::to("$correo")->send(new MailSendO($details,$ruta)); 

            return response()->json($exito);
        }else{

        }
        
    }*/

    public function updCerrar(Request $request){
        // dd($request, $_FILES["archivoCierre2"]);
        //    dd($request);
        
        $vusuario=Auth()->user()->id;

        $vidSolicServ=$request->hdIdOrdenCierra;

        // $file2 = $_FILES["archivoCierre"];
        
        // if($request->hasfile('archivoCierre')){ 

        //     $file=$request->file("archivoCierre");
        //     // dd($file[0]);
        //     // $ext=substr($file[0]->getClientOriginalName(), -3);
        //     $ext=substr($file->getClientOriginalName(), -3);
            
        //     if($ext === "pdf" ){
        //         // $nombre = uniqid() .'_'. $vidSolicServ.'.'.$ext;
        //         $nombre = 'A_'. $vidSolicServ.'.'.$ext; 
                
        //         $ruta = public_path("cierreOrden/".$nombre);
                
        //         // copy($file[0], $ruta);
        //         copy($file, $ruta);
        //     }
    
        // }else{
        //     dd('no entro');
        // }

        //--------SUBIR MULTIPLES IMAGENES JPG O PNG
        $misImagenes = $request->file('archivoCierre2'); 
        // dd($misImagenes);
        $con=1; 
        foreach($misImagenes as $qimg => $elimg){

            $nombreImage = $elimg->getClientOriginalName();
            $ext=substr($nombreImage, -3);

            if($ext === "jpg"){
                // $nombre = uniqid() .'_'. $vidSolicServ.'.'.$ext;
                $nombreFinal = $con.'.'. $vidSolicServ.'.'.$ext; 
                
                $ruta = public_path("cierreOrden/".$nombreFinal);
                
                 copy($elimg, $ruta);  

                if (file_exists($ruta)){  
                     $exitod = DB::connection('pgsql')->select("select * from cas_cete.app_ins_cierre_detalle(".$vidSolicServ.",'O','".$nombreFinal."')");
                } 
            }
            $con=$con+1; 
            // dd('hola');
             
        }
        // downloadCierrePdf($vidSolicServ);
        // $this->fnGeneraPDF_app($vidSolicServ);
        //--------
        // $ruta_archivo=$ruta;
        // $nombre_archivo=$nombre;
        $ruta_archivo='';
        $nombre_archivo='';
        
        // $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$request->idSolicServ.",".$vusuario.",'".$ruta."')");
        $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$vidSolicServ.",".$vusuario.",'".$nombre_archivo."','".$ruta_archivo."','".$request->txtObservacionesC."')");
                
        //  return response()->json($exito);
        if($exito != null || $exito != ''){
            
            $respuesta= $this->fnGeneraPDF_app($vidSolicServ); 
            if($respuesta==1){

                $nombrePDF = $vidSolicServ.'.pdf'; 
                $rutaPDF = public_path("cierreOrden/".$nombrePDF);

                $folio = $request->hdFolioCierra;
                $folio_solic = $request->hdFolioSolCierra;
                $correo = $request->correoCierre;
                $nombrecct = $request->nombrecctCierre;
                $solicitante = $request->solicitanteCierre; 

                if($folio_solic != null ){ // si viene desde solicitud
                    $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                    $msje_correo='Se ha finalizado la solicitud de servicio con el folio: ';
                    $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                    <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                    $band_ventanilla='1'; 
                    $folio2=$folio_solic;
                }else{
                    $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                    $msje_correo='Se ha finalizado la orden de servicio con el folio: '; 
                    $msje_ventanilla='';
                    $band_ventanilla='0';
                    $folio2=$folio;
                }
                $details = [
                    'asunto' => $msje_asunto,
                    'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
                    'folio' => $folio2.' ',
                    'estatus' => '',
                    
                    'body1' => $msje_correo,
                    
                    'body2' => 'por parte de nuestros técnicos de soporte especializados.',
                    
                    'body3' => 'Agradecemos su confianza en nuestros servicios. Quedamos a sus órdenes para cualquier duda o aclaración sobre el diagnóstico y solución de su(s) equipos.',
                    'body4' => '',

                    'firma1' => 'Atentamente.',
                    'firma2' => 'Centro Estatal de Tecnología Educativa',
                    'band_ventanilla' => $band_ventanilla,
                    'ventanilla' => $msje_ventanilla,
                    'fecha_hora_asignacion' =>''
                ];

                Mail::to("$correo")->send(new MailSendO($details,$rutaPDF)); 
                return response()->json($exito);
            }else{
                return 'ya existe';
            }
        }else{

        }
        
    }

    public function getEquiposSol($idSolic){

        $equiposSol =  DB::connection('pgsql')->select("select * from cas_cete.getEquiposSolic('".$idSolic."')");

        return response()->json([$equiposSol]);
    }

    public function insTecnico(Request $request){
        // dd($request->All());
        // $segui = str_replace('"', '', $request->seguimientoModTec);  // Seguimiento correo
        // $segui = trim($segui);
        $fecha_inicio=$request->fecha_inicio_prog;
        
        $arrTec=$request->tecnicosAuxiliaresArray;
        $arrTec2 = json_decode($arrTec);

        // dd($request->fecha_inicio_prog);
        $vusuario=Auth()->user()->id;
        //$varddd=explode("T",$request->fecha_inicio_prog);
        //dd($varddd[0], " - ", $varddd[1]); 
        // $exito = DB::select("CALL cas_cete.spInsertTecnicos(".$request->idSolModTec.",1,'".$request->fecha_inicio_prog."','".$request->fecha_fin_prog."',".$request->selTecnicoEncargado.",true)");
        $exito = DB::connection('pgsql')->select("select * from cas_cete.fnInsTecnicos(".$request->idSolModTec.",".$vusuario.",'".$request->fecha_inicio_prog."','".$request->fecha_fin_prog."',".$request->selTecnicoEncargado.",'".$request->tecnicosAuxiliaresArray."')");
        // dd($exito);
        // return response()->json($exito);
        
        if($exito != null || $exito != ''){
            if($request->seguimientoModTec=='true'){
            
                $correo=$request->correoModTec;
                $nomTecEncargado='';
                $nomTecAux='';

                for ($i=0; $i < count($arrTec2); $i++) { 
                    if($arrTec2[$i]->es_responsable==1){
                        $nomTecEncargado=$arrTec2[$i]->nombre_tecnico;
                    }else{
                        if($nomTecAux==''){
                            $nomTecAux=$arrTec2[$i]->nombre_tecnico;
                        }else{
                            $nomTecAux=$nomTecAux.', '.$arrTec2[$i]->nombre_tecnico;
                        }
                    }
                }

                $folio_solic=$request->folioSolModTec;

                // "fecha_inicio_prog" => "2023-08-17T11:44"
                $fecha_inicio=$request->fecha_inicio_prog;
                $fecha_fin=$request->fecha_fin_prog;

                $fecha_inicio = str_replace("T"," ",$fecha_inicio);
                $fecha_inicio2 = explode(" ",$fecha_inicio);
                $fecha_inicio3 = explode("-",$fecha_inicio2[0]);
                $fecha_inicio4 = $fecha_inicio3[2].'-'.$fecha_inicio3[1].'-'.$fecha_inicio3[0];
                $fecha_inicio_final=$fecha_inicio4.', '.$fecha_inicio2[1]; 

                $folio=$request->folioModTec;
                $solicitante=$request->solicitanteModTec;
                $nombrecct=$request->nombrecctModTec; 
                // date_format($date,"Y/m/d H:i:s");

                if($folio_solic != null){ // si viene desde solicitud
                    $msje_asunto='Programación de cita para solicitud de servicio - Sistema C.A.S. - C.E.T.E.';
                    $msje_correo='La solicitud de servicio con el folio: ';
                    $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                    <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                    $band_ventanilla='1';
                    $folio2 = $folio_solic;
                }else{
                    $msje_asunto='Programación de cita para  orden de servicio - Sistema C.A.S. - C.E.T.E.';
                    $msje_correo='La orden de servicio con el folio: '; 
                    $msje_ventanilla='';
                    $band_ventanilla='0';
                    $folio2 = $folio;
                }
                $details = [
                    'asunto' => $msje_asunto,
                    'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
                    'folio' => $folio2.' ',
                    'estatus' => '',
                    
                    'body1' => $msje_correo, 
                    // 'body2' => 'Técnico encargado: '.$nomTecEncargado. ', técnicos auxiliares: '.$nomTecAux,
                    // 'body3' => '',
                    'body2' => 'ha sido asignada a nuestros técnicos de soporte especializados, quienes estarán presentes en su Centro de Trabajo  el dia ',
                    // 'body2' => 'Técnico encargado: '.$nomTecEncargado. ', técnicos auxiliares: '.$nomTecAux,
                    'body3' => ' para brindar la asistencia.',
                    'body4' => 'Le recomendamos mantener el folio de su orden para que pueda dar seguimiento a su progreso.',

                    'firma1' => 'Atentamente.',
                    'firma2' => 'Centro Estatal de Tecnología Educativa',
                    'band_ventanilla' => $band_ventanilla,
                    'ventanilla' => $msje_ventanilla,
                    'fecha_hora_asignacion' => $fecha_inicio_final
                ];

                Mail::to("$correo")->send(new MailSendO($details,''));
                // return array(
                //     "exito" => true
                // );
            }
            // else{
                /////No se envia correo de seguimiento
            // }
            /////////////////////////////////////
            return response()->json($exito);
        }else{

        }
    }

    public function getHistorialEquipo($etiqueta){
        $equipoHistorial =  DB::connection('pgsql')->select("select * from cas_cete.getHistoricoEquipo('".$etiqueta."')");

        return response()->json($equipoHistorial);
    }

    public function getMostDetalleEquipo($idEquipo){
        $equipo =  DB::connection('pgsql')->select("select * from cas_cete.getMostDetalleEquipo('".$idEquipo."')");
        return response()->json($equipo);
    }

    public function updEquipo(Request $request){
        //  dd($request);
        $vid_usuario=Auth()->user()->id;
        $vidSolicServ=$request->hdIdOrdenCierra;
        
        $tareasEquipo=$request->arrTareasEdit;
        $tareasEquipoElim=$request->arrTareasEditElim;
        
        $etiqueta=$request->txtEtiquetaM;
        $desc_problema=$request->txtDescripcionSoporteM;
        $ubicacion=$request->txtUbicacionM;

        $updTareasEquipo =  DB::connection('pgsql')->select("select * from  cas_cete.updTareasEquipo(".$request->hdIdSolServM.",".$request->hdIdEquipoM.",".$request->hdIdTipoEquipo.",'".$etiqueta."','".$desc_problema."','".$ubicacion."',".$vid_usuario.",'".$tareasEquipo."','".$tareasEquipoElim."')");
        return response()->json($updTareasEquipo); 
    }

    public function getArchivoCierre($idSolicServ){ ////PDF
        $archivo =  DB::connection('pgsql')->select("select * from cas_cete.getArchivoCierre('".$idSolicServ."')");
        // dd($archivo);
        // $ruta = public_path("cierreOrden/".$archivo[0]->ruta_evidencia);
        // $nombre = $archivo[0]->ruta_evidencia;
        // dd($ruta);
        //  return response()->json($nombre);
         return response()->json($archivo);
    }

    public function sendCorreo($folio, $correo, $solicitante, $nombrecct){
        //  dd($request->folio, $request->correo);
        $msje_ventanilla='';
        $band_ventanilla='0';
        $estatus='en espera';

        $details = [
            'asunto' => 'Registro exitoso de orden de servicio - Sistema C.A.S. - C.E.T.E.',
            'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
            'folio' => $folio.' ',
            'estatus' => $estatus,
            
             'body1' => 'Se ha generado una orden de servicio con el folio:  ',
            'body2' => ' para atender su solicitud, la cual se encuentra',
            'body3' => ' para ser atendida por un técnico de soporte.',
            'body4' => 'Conserve este folio para continuar con el seguimiento de su orden. Nos pondremos en contacto al teléfono proporcionado.',

            'firma1' => 'Atentamente.',
            'firma2' => 'Centro Estatal de Tecnología Educativa',
            'band_ventanilla' => $band_ventanilla,
            'ventanilla' => $msje_ventanilla,
            'fecha_hora_asignacion' =>''
        ];
        // $folio='64d3f92871550_34.pdf';
        // Mail::to("$correo")->send(new MailSendO($details,$folio));
        Mail::to("$correo")->send(new MailSendO($details,''));
        return array(
            "exito" => true
        );
    }

    public function updCerrarEquipo(Request $request){
        // dd($request);
        $vid_usuario=Auth()->user()->id;
        $vidSolicServ=$request->hdIdSolServMC; 
        $diagnostico=$request->txtDiagnosticoM;
        $solucion=$request->txtSolucionM;
        $id_equipo_serv=$request->hdIdEquipoMC;
        $es_funcional=$request->checkEs_funcional;
        
        //Archivo Cierre Equipo
        $file2 = $_FILES["archivoCierreEquipo"];
        
        if($request->hasfile('archivoCierreEquipo')){ 

            $file=$request->file("archivoCierreEquipo");
             
            $ext=substr($file->getClientOriginalName(), -3);
            
            if($ext === "jpg" || $ext === "png" ){
                $nombre = $id_equipo_serv.'.'.$ext;
                // $nombre = uniqid() .'_'. $vidSolicServ.'_'.$id_equipo_serv.'.'.$ext;
                
                $ruta = public_path("cierreEquipo/".$nombre);
            
                copy($file, $ruta);
            }
            $ruta_archivo=$ruta;
            $nombre_archivo=$nombre;
            $base_archivo='';
        }else{
            $ruta_archivo='';
            $nombre_archivo='';
            $base_archivo='';
        } 

        $insCierreEquipo =  DB::connection('pgsql')->select("select * from  cas_cete.insCierreEquipo(".$request->hdIdEquipoMC.",".$vid_usuario.",'".$diagnostico."','".$solucion."','".$nombre_archivo."','".$ruta_archivo."','".$base_archivo."',".$es_funcional.")");
        return response()->json($insCierreEquipo);
    }

    public function getTecnicos($idSolic){

        $tecnicosSol =  DB::connection('pgsql')->select("select * from cas_cete.getTecnicos('".$idSolic."')");

        return response()->json($tecnicosSol);
    }

    public function updTecnicos(Request $request){
        //  dd($request->All());
 
        $vid_usuario=Auth()->user()->id;

        $updTecnicos = DB::connection('pgsql')->select("select * from cas_cete.updTecnicos(".$request->idSolModTecE.",".$vid_usuario.",'".$request->fecha_inicio_progE."','".$request->fecha_fin_progE."','".$request->tecnicosAuxiliaresArrayE."','".$request->arrTecnicosElim."')");

        return response()->json($updTecnicos);
    }

    public function getclaveCCT(Request $request){
        $arreglo=[];
        $data = DB::connection('pgsql')->select("select * from  cas_cete.getclavecct('".$request->txt."')");
        //  dd($data);

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

    public function getArchivosCierreOrden($idSolicServ){ ///Imagenes
        $archivo =  DB::connection('pgsql')->select("select * from cas_cete.getDetalleCierreSolic('".$idSolicServ."')");

         return response()->json($archivo);
    }

    public function getArchivoEquipo($idEquipo){ ///Imagenes Equipo
        $archivo =  DB::connection('pgsql')->select("select * from cas_cete.getArchivoCierreEquipo('".$idEquipo."')");

        return response()->json($archivo);
    }

    public function downloadPDFima($id) //pdf solo imagenes de cierre orden
    {
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.getImagesCierre(".$id.")");
        // $ordenServiciosObject=$ordenServicios[0];
        // dd($ordenServicios,$ordenServiciosObject);
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $pdf = new Dompdf($options);

        // $path = asset('images/logo/logo_cete_3.png');
        // //  return $path;
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $data = file_get_contents($path);
        // $pic = 'data:image/'.$type.';base64,'.base64_encode($data);

        // $path_footer = asset('images/logo/ceteNI.png');
        // $type_footer = pathinfo($path_footer, PATHINFO_EXTENSION);
        // $data_footer = file_get_contents($path_footer);
        // $pic_footer = 'data:image/'.$type_footer.';base64,'.base64_encode($data_footer);

        // $html = '<img src="data:image;base64,'.base64_encode(@file_get_contents('logoTam2022.png')).'">';
        // $fecha = date('Y-m-d');

        view()->share('ordenes/downloadImages',$ordenServicios);
        $pdf = PDF::loadView('ordenes/downloadImages', ['ordenServicios' => $ordenServicios])->setPaper('a4', 'portrait'); //landscape
 
    //   return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf'); // para que vaya a la url a descargar directo el pdf
        return $pdf->stream(); /// para abrir una nueva pestaña y que se muestre el pdf
    }

    public function downloadCierrePdf($id)  //pdf con info e imagenes de cierre orden
    {
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.gettordendetallepdfcierre(".$id.")");
        // dd($ordenServicios[0]);
        $ordenServiciosObject=$ordenServicios[0];
      
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $pdf = new Dompdf($options);

        // $path = asset('images/logo/logo_cete_3.png');
        // $type = pathinfo($path, PATHINFO_EXTENSION);
        // $data = file_get_contents($path);
        // $pic = 'data:image/'.$type.';base64,'.base64_encode($data);
        // $path_footer = asset('images/logo/ceteNI.png');
        // $type_footer = pathinfo($path_footer, PATHINFO_EXTENSION);
        // $data_footer = file_get_contents($path_footer);
        // $pic_footer = 'data:image/'.$type_footer.';base64,'.base64_encode($data_footer);

        // $html = '<img src="data:image;base64,'.base64_encode(@file_get_contents('logoTam2022.png')).'">';
        // $fecha = date('Y-m-d');

        view()->share('ordenes/downloadCierreOrden',$ordenServiciosObject);
        $pdf = PDF::loadView('ordenes/downloadCierreOrden', ['ordenServiciosObject' => $ordenServiciosObject])->setPaper('a4', 'landscape');

    //   return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf'); // para que vaya a la url a descargar directo el pdf
         return $pdf->stream(); /// para abrir una nueva pestaña y que se muestre el pdf
        
        //Para subir el archivo a carpeta en servidor si no existe el archivo
        // $rutaa="cierreOrden/".$id.".pdf";

        // if(file_exists( $rutaa )){
        //     return 0;
        // }else{
        //     $pdf->save("cierreOrden/".$id.".pdf");
        //     return 1;
        // }
    }

    public function getValidaAcceso(Request $request){
        $idSolicServ=$request->idSolicServ;

        $acceso =  DB::connection('pgsql')->select("select * from cas_cete.getValidaAccesoOrden(".$idSolicServ.")");
        $accesoval=$acceso[0];
        
        return response()->json($accesoval);
    }

    public function updAcceso(Request $request){
        $idSolicServ=$request->idSolicServ;
        $valida=$request->valida;

        $updAcceso =  DB::connection('pgsql')->select("select * from cas_cete.updAccesoOrden(".$idSolicServ.",".$valida.")");
        $updAccesoOrden=$updAcceso[0];
        
        return response()->json($updAccesoOrden);
    }

    public function getEquiposCerrados($idSolicServ){
        $equipCerrados = DB::connection('pgsql')->select("select * from cas_cete.getDetalleEquipoCerrado(".$idSolicServ.")");
        // dd($equipCerrados[0]);
        $equiposCerrados=$equipCerrados[0];

        return response()->json($equiposCerrados);
    }

    public function fnGeneraPDF_app($id)
    {
        // $id=$request->id;
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.app_detalle_cierre_orden(".$id.")");
        //  print_r($ordenServicios);
        $ordenServiciosObject=$ordenServicios[0]; 

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $pdf = new Dompdf($options);

        view()->share('ordenes/downloadCierreOrden',$ordenServiciosObject);
        $pdf = PDF::loadView('ordenes/downloadCierreOrden', ['ordenServiciosObject' => $ordenServiciosObject])->setPaper('a4', 'landscape');

        $rutaa="cierreOrden/".$id.".pdf";
        $rutaaGuardado=public_path($rutaa);

        if(file_exists( $rutaa )){
            return 0;
        }else{
            $pdfnom = $id.".pdf";
            Storage::disk('sftp')->put("cierreOrden/".$pdfnom, $pdf -> output());
            
                //  print_r("cierraPDF");
            $no = DB::connection('pgsql')->select("select * from cas_cete.app_ins_cierre_detalle(".$id.", 'OP', '".$pdfnom."')");
            $this -> updCorreo_app($id, $rutaaGuardado, $pdfnom);
            
                //  print_r("PDF");
            return 1;
        }
    }
    
    public function updCorreo_app($id, $rutaa, $pdfnom){
        $exito = DB::connection('pgsql')->select("select * from cas_cete.app_detalle_correo(".$id.")");
       // print_r($exito);    
           if($exito != null || $exito != ''){
            // print_r($exito[0]->folio);
            // print_r($exito[0]->folio_solic);
            // print_r($exito[0]->correo);
            $folio = $exito[0]->folio;
            $folio_solic = $exito[0]->folio_solic;
            $correo = $exito[0]->correo;
            $nombrecct = $exito[0]->nombrecct;
            $solicitante = $exito[0]->solicitante;
            if($folio_solic != null ){ // si viene desde solicitud
                $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha finalizado la solicitud de servicio con el folio: ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla  nica CETE</ins></a>';
                $band_ventanilla='1'; 
                $folio2=$folio_solic;
            }else{
                $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha finalizado la orden de servicio con el folio: '; 
                $msje_ventanilla='';
                $band_ventanilla='0';
                $folio2=$folio;
            }
            $details = [
                'asunto' => $msje_asunto,
                'tittle' => 'Estimado usuario: '. $solicitante . ' - '. $nombrecct,
                'folio' => $folio2.' ',
                'estatus' => '',
                'body1' => $msje_correo,
                'body2' => 'por parte de nuestros técnicos de soporte especializados.',
                'body3' => 'Agradecemos su confianza en nuestros servicios. Quedamos a sus órdenes para cualquier duda o aclaración sobre el diagnóstico y solución de su(s) equipos.',
                'body4' => '',
                'firma1' => 'Atentamente.',
                'firma2' => 'Centro Estatal de Tecnolog a Educativa',
                'band_ventanilla' => $band_ventanilla,
                'ventanilla' => $msje_ventanilla,
                'fecha_hora_asignacion' =>''
            ];

            Mail::to("$correo")->send(new MailSendO($details,$rutaa)); 

            return response()->json($exito);
        }else{
        }
    }

 /////Materiales
    public function index_materiales($id){
        $vid_usuario=Auth()->user()->id;
        $getUsername =  DB::connection('pgsql')->select("select * from cas_cete.getUsername(".$vid_usuario.")");


        $query = DB::connection('pgsql')->select("select ss.id as id_servicio, cst.id as id_servicio_tarea, ed.id as id_equipo_detalle, ess.desc_problema ,
            ess.cantidad  , cte.tipo_equipo , cs.servicio , ct.tarea  , ct.id as id_tarea , ss.actividad_realizada , ss.nota_tecnica
            from cas_cete.solic_servicios ss , cas_cete.equipos_serv_solic ess ,
            cas_cete.equipos_detalle ed , cas_cete.cat_equipos_tareas cet , cas_cete.cat_tipos_equipo cte ,
            cas_cete.cat_servicios_tareas cst , cas_cete.cat_servicios cs , cas_cete.cat_tareas ct 
            where ss.id = ".$id."
            and ss.id = ess.id_solic_serv 
            and ess.id = ed.id_equipos_serv 
            and ed.id_equipo_tarea  = cet.id 
            and cet.id_tipo_equipo = cte.id 
            and cet.id_serv_tarea = cst.id 
            and cst.id_servicio = cs.id 
            and cst.id_tarea = ct.id ");

        $datos = DB::connection('pgsql')->select("select ss.id as id_solicitud, ss.solicitante , ccdt.clavecct , ccdt.nombrect , ccdt.id_municipio ,
            cn.nivel , cm.municipio , rc.folio , ce2.estatus , sst.fecha , ce2.id as id_esatus
            from cas_cete.solic_servicios ss , insumos.cat_centros_de_trabajo ccdt , insumos.cat_subniveles cs ,
            insumos.cat_niveles cn , insumos.cat_municipios cm , cas_cete.registro_captacion rc , cas_cete.solic_serv_track sst ,
            cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 
            where ss.id_cct = ccdt.id 
            and ccdt.id_subnivel  = cs.id 
            and cs.id_nivel = cn.id 
            and ccdt.id_municipio = cm.id 
            and ss.id = rc.id_solic_serv 
            and rc.id = sst.id_reg_captacion 
            and sst.id_capta_estatus = ce.id 
            and ce.id_estatus = ce2.id 
            and ss.id = ".$id."
            order by sst.fecha desc
            limit 1");

        return view('ordenes.materiales', compact(
            'getUsername',
            'query',
            'datos'
        ) );
        // return view('ordenes.materiales');
    }

    public function select_materiales(Request $request){
        $select_agrupado2 = DB::connection('pgsql')->select
            ("select cp.nombre from cas_cete.cat_producto_servicio cps  , cas_cete.cat_producto cp
                where cps.id_producto = cp.id 
                and cps.id_servicio_tarea = ".$request->id_servicio_tarea."
                group by cp.nombre");
        // dd($select_agrupado2);
        return array(
            "exito" => true,
            "select_agrupado2" => $select_agrupado2
        ); 
    }

    public function cat_materiales2(Request $request){
        // dd($request);
        $cat_productos2 = DB::connection('pgsql')->select("select * from cas_cete.cat_producto_servicio cps , cas_cete.cat_producto cp, cas_cete.cat_medida cm , cas_cete.cat_tipo_producto ctp 
        where cps.id_producto = cp.id and cp.id_tipo_medida = cm.id and
        cp.id_tipo_producto = ctp.id and cps.id_servicio_tarea = ".$request->id_servicio_tarea." and nombre like '%".$request->nombre."%'");
        // dd($cat_productos2);
        return array(
            "exito" => true,
            "select_productos2" => $cat_productos2
        );

    }

    public function guardar_materiales(Request $request){
        // dd($request);
        if ($request->arreglo_eliminar_producto != '' || $request->arreglo_eliminar_producto != null) {
            // dd('entro');
            foreach ($request['arreglo_eliminar_producto'] as $key => $value) {
                if ($value['bandera'] == 1) {
                    $fn_editar_material = DB::select("select * from fn_editar_material(".$value['id_producto_detalle'].")");
                }
                
            }
        }    
        
        foreach ($request['arreglo_productos_guardar2'] as $key => $value) {
            if ($value['update'] == 0) {
                $fn_insert_material = DB::select("select * from fn_insert_material(".$request->id_equipo_detalle.", ".$value['id_producto'].", ".$value['cantidad'].")");
            }
        }

        return array(
            "exito" => true

        );
        
    }

    public function detalle_material(Request $request){
        $detalle_material = DB::connection('pgsql')->select("select cst.id as id_servicio_tarea, cs.id as id_servicio, ct.id as id_tarea,
        cp.id as id_producto, cp.nombre , cp.descripcion , cp.especificacion , cm.medida , ctp.tipo , pd.cantidad , pd.id as id_producto_detalle , pd.activo
        from cas_cete.cat_servicios_tareas cst , cas_cete.cat_servicios cs , cas_cete.cat_tareas ct ,
        cas_cete.cat_producto_servicio cps , cas_cete.cat_producto cp , cas_cete.cat_medida cm , cas_cete.cat_tipo_producto ctp ,
        cas_cete.producto_detalle pd 
        where cst.id_servicio = cs.id 
        and cst.id_tarea = ct.id 
        and cst.id = cps.id_servicio_tarea 
        and cps.id_producto = cp.id 
        and cp.id_tipo_medida = cm.id 
        and cp.id_tipo_producto = ctp.id 
        and cp.id = pd.id_producto 
        and pd.id_equipo_detalle = ".$request->id_equipo_detalle."");

        return array(
            "exito" => true,
            "detalle_material" => $detalle_material
        );
        // dd($detalle_material);
    }

    public function imprimir_material($id_equipo_detalle){
        // dd($id_equipo_detalle);
        $detalle_material = DB::connection('pgsql')->select("select ss.id as id_servicio, ce2.id as id_estatus 
            from cas_cete.solic_servicios ss , cas_cete.registro_captacion rc ,
            cas_cete.solic_serv_track sst , cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 , cas_cete.equipos_serv_solic ess ,
            cas_cete.equipos_detalle ed 
            where ss.id = rc.id_solic_serv 
            and rc.id = sst.id_reg_captacion 
            and sst.id_capta_estatus = ce.id 
            and ce.id_estatus = ce2.id 
            and ss.id = ess.id_solic_serv 
            and ess.id = ed.id_equipos_serv 
            and ed.id = ".$id_equipo_detalle."
            order by sst.fecha desc
            limit 1");
        // dd($detalle_material);
        //8341194720

        $detalle_material2 = DB::connection('pgsql')->select("
            select 
                ss.solicitante , ss.fecha_captacion , ss.telef_solicitante , ss.correo_solic , ss.descrip_reporte , rc.folio ,
                ce2.estatus , cp.nombre , cp.descripcion ,pd.cantidad , cp.especificacion , cm.medida , ctp.tipo ,cs.servicio , ct.tarea ,
                ccdt.clavecct , ccdt.nombrect , ccdt.domicilio , cm2.municipio , cn.nivel , ct2.desc_turno, ccdt.director, cps.id_servicio_tarea ,
                (select rc2.folio from cas_cete.registro_captacion rc2 ,
                cas_cete.solic_serv_track sst2, cas_cete.captacion_estatus ce2, cas_cete.cat_estatus ce22
            where  rc2.id = sst2.id_reg_captacion
            and rc2.id_solic_serv = ".$detalle_material[0]->id_servicio."
            and sst2.id_capta_estatus  = ce2.id 
            and ce2.id_estatus = ce22.id 
            and rc2.id_modo_capta  = 1
            order by sst2.fecha asc 
            LIMIT 1) as primer_folio
            from 
                cas_cete.solic_servicios ss , cas_cete.registro_captacion rc , cas_cete.solic_serv_track sst ,
                cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 , cas_cete.equipos_serv_solic ess , cas_cete.equipos_detalle ed ,
                cas_cete.producto_detalle pd , cas_cete.cat_producto cp , cas_cete.cat_tipo_producto ctp , cas_cete.cat_medida cm  , cas_cete.cat_producto_servicio cps ,
                cas_cete.cat_servicios_tareas cst , cas_cete.cat_servicios cs , cas_cete.cat_tareas ct, insumos.cat_centros_de_trabajo ccdt , insumos.cat_municipios cm2 ,
                insumos.cat_niveles cn , insumos.cat_turnos ct2 
            where 
                ss.id = rc.id_solic_serv 
                and rc.id = sst.id_reg_captacion 
                and sst.id_capta_estatus = ce.id 
                and ce.id_estatus = ce2.id 
                and ss.id = ess.id_solic_serv 
                and ess.id = ed.id_equipos_serv 
                and ed.id = pd.id_equipo_detalle 
                and pd.id_producto = cp.id 
                and cp.id_tipo_producto = ctp.id 
                and cp.id_tipo_medida = cm.id 
                and cp.id = cps.id_producto 
                and cps.id_servicio_tarea = cst.id 
                and cst.id_servicio = cs.id 
                and cst.id_tarea = ct.id 
                and ss.id_cct = ccdt.id 
                and ccdt.id_municipio = cm2.id 
                and ccdt.id_subnivel = cn.id 
                and ccdt.id_turno = ct2.id 
                and ss.id = ".$detalle_material[0]->id_servicio."
                and ce2.id = ".$detalle_material[0]->id_estatus."
                and pd.id_equipo_detalle =".$id_equipo_detalle."");


                $detalle_material3 = DB::connection('pgsql')->select("select 
                cps.id_servicio_tarea  , cs.servicio , ct.tarea 
            from 
                cas_cete.solic_servicios ss , cas_cete.registro_captacion rc , cas_cete.solic_serv_track sst ,
                cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 , cas_cete.equipos_serv_solic ess , cas_cete.equipos_detalle ed ,
                cas_cete.producto_detalle pd , cas_cete.cat_producto cp , cas_cete.cat_tipo_producto ctp , cas_cete.cat_medida cm  , cas_cete.cat_producto_servicio cps ,
                cas_cete.cat_servicios_tareas cst , cas_cete.cat_servicios cs , cas_cete.cat_tareas ct, insumos.cat_centros_de_trabajo ccdt , insumos.cat_municipios cm2 ,
                insumos.cat_niveles cn , insumos.cat_turnos ct2 
            where 
                ss.id = rc.id_solic_serv 
                and rc.id = sst.id_reg_captacion 
                and sst.id_capta_estatus = ce.id 
                and ce.id_estatus = ce2.id 
                and ss.id = ess.id_solic_serv 
                and ess.id = ed.id_equipos_serv 
                and ed.id = pd.id_equipo_detalle 
                and pd.id_producto = cp.id 
                and cp.id_tipo_producto = ctp.id 
                and cp.id_tipo_medida = cm.id 
                and cp.id = cps.id_producto 
                and cps.id_servicio_tarea = cst.id 
                and cst.id_servicio = cs.id 
                and cst.id_tarea = ct.id 
                and ss.id_cct = ccdt.id 
                and ccdt.id_municipio = cm2.id 
                and ccdt.id_subnivel = cn.id 
                and ccdt.id_turno = ct2.id 
                and ss.id = ".$detalle_material[0]->id_servicio."
                and ce2.id = ".$detalle_material[0]->id_estatus."
                and pd.id_equipo_detalle =".$id_equipo_detalle."
                group by cps.id_servicio_tarea, cs.servicio , ct.tarea ");

            // dd($detalle_material3);
        // $id_solicitud = $request->id;

        

        // $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud(".$detalle_material[0]->id_servicio.")");
        // $fn_inf_orden = DB::select("select * from cas_cete.fn_inf_orden(".$detalle_material[0]->id_servicio.")");
        
        // dd($fn_solicitud);
        // dd($ordenServicios[0]);
        // $fn_solicitud=$fn_solicitud[0];
        // if ($fn_inf_orden != null) {
        //     $fn_inf_orden=$fn_inf_orden[0];
        // }
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
        $data = file_get_contents($path);
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
        
        view()->share('ordenes/pdfMaterial',$detalle_material2, $detalle_material3);
        // view()->share('ordenes/pdfMaterial',$fn_solicitud ,$detalle_material2);
        $pdf = PDF::loadView('ordenes/pdfMaterial',['detalle_material2' => $detalle_material2], ['detalle_material3' => $detalle_material3])->setPaper('a4', 'portrait');
        // $pdf = PDF::loadView('ordenes/pdfMaterial', ['fn_solicitud' => $fn_solicitud], ['detalle_material2' => $detalle_material2])->setPaper('a4', 'landscape');
        // dd('hola');
        //   return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf'); // para que vaya a la url a descargar directo el pdf
        return $pdf->stream(); /// para abrir una nueva pestaña y que se muestre el pdf
    }
    public function imprimir_material2($id_servicio){
        // dd($id_servicio);
        $detalle_material = DB::connection('pgsql')->select("select ss.id as id_servicio, ce2.id as id_estatus , ss.actividad_realizada , ss.nota_tecnica 
            from cas_cete.solic_servicios ss , cas_cete.registro_captacion rc ,
            cas_cete.solic_serv_track sst , cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 , cas_cete.equipos_serv_solic ess ,
            cas_cete.equipos_detalle ed 
            where ss.id = rc.id_solic_serv 
            and rc.id = sst.id_reg_captacion 
            and sst.id_capta_estatus = ce.id 
            and ce.id_estatus = ce2.id 
            and ss.id = ess.id_solic_serv 
            and ess.id = ed.id_equipos_serv 
            and ss.id = ".$id_servicio."
            order by sst.fecha desc
            limit 1");
        // dd($detalle_material);
        //8341194720

        $detalle_material2 = DB::connection('pgsql')->select("
            select 
                ss.solicitante , ss.fecha_captacion , ss.telef_solicitante , ss.correo_solic , ss.descrip_reporte , rc.folio ,
                ce2.estatus , cp.nombre , cp.descripcion ,pd.cantidad , cp.especificacion , cm.medida , ctp.tipo ,cs.servicio , ct.tarea ,
                ccdt.clavecct , ccdt.nombrect , ccdt.domicilio , cm2.municipio , cn.nivel , ct2.desc_turno, ccdt.director, cps.id_servicio_tarea ,
                (select rc2.folio from cas_cete.registro_captacion rc2 ,
                cas_cete.solic_serv_track sst2, cas_cete.captacion_estatus ce2, cas_cete.cat_estatus ce22
            where  rc2.id = sst2.id_reg_captacion
            and rc2.id_solic_serv = ".$detalle_material[0]->id_servicio."
            and sst2.id_capta_estatus  = ce2.id 
            and ce2.id_estatus = ce22.id 
            and rc2.id_modo_capta  = 1
            order by sst2.fecha asc 
            LIMIT 1) as primer_folio
            from 
                cas_cete.solic_servicios ss , cas_cete.registro_captacion rc , cas_cete.solic_serv_track sst ,
                cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 , cas_cete.equipos_serv_solic ess , cas_cete.equipos_detalle ed ,
                cas_cete.producto_detalle pd , cas_cete.cat_producto cp , cas_cete.cat_tipo_producto ctp , cas_cete.cat_medida cm  , cas_cete.cat_producto_servicio cps ,
                cas_cete.cat_servicios_tareas cst , cas_cete.cat_servicios cs , cas_cete.cat_tareas ct, insumos.cat_centros_de_trabajo ccdt , insumos.cat_municipios cm2 ,
                insumos.cat_niveles cn , insumos.cat_turnos ct2 
            where 
                ss.id = rc.id_solic_serv 
                and rc.id = sst.id_reg_captacion 
                and sst.id_capta_estatus = ce.id 
                and ce.id_estatus = ce2.id 
                and ss.id = ess.id_solic_serv 
                and ess.id = ed.id_equipos_serv 
                and ed.id = pd.id_equipo_detalle 
                and pd.id_producto = cp.id 
                and cp.id_tipo_producto = ctp.id 
                and cp.id_tipo_medida = cm.id 
                and cp.id = cps.id_producto 
                and cps.id_servicio_tarea = cst.id 
                and cst.id_servicio = cs.id 
                and cst.id_tarea = ct.id 
                and ss.id_cct = ccdt.id 
                and ccdt.id_municipio = cm2.id 
                and ccdt.id_subnivel = cn.id 
                and ccdt.id_turno = ct2.id 
                and ss.id = ".$detalle_material[0]->id_servicio."
                and ce2.id = ".$detalle_material[0]->id_estatus."");


                $detalle_material3 = DB::connection('pgsql')->select("select 
                cps.id_servicio_tarea  , cs.servicio , ct.tarea 
            from 
                cas_cete.solic_servicios ss , cas_cete.registro_captacion rc , cas_cete.solic_serv_track sst ,
                cas_cete.captacion_estatus ce , cas_cete.cat_estatus ce2 , cas_cete.equipos_serv_solic ess , cas_cete.equipos_detalle ed ,
                cas_cete.producto_detalle pd , cas_cete.cat_producto cp , cas_cete.cat_tipo_producto ctp , cas_cete.cat_medida cm  , cas_cete.cat_producto_servicio cps ,
                cas_cete.cat_servicios_tareas cst , cas_cete.cat_servicios cs , cas_cete.cat_tareas ct, insumos.cat_centros_de_trabajo ccdt , insumos.cat_municipios cm2 ,
                insumos.cat_niveles cn , insumos.cat_turnos ct2 
            where 
                ss.id = rc.id_solic_serv 
                and rc.id = sst.id_reg_captacion 
                and sst.id_capta_estatus = ce.id 
                and ce.id_estatus = ce2.id 
                and ss.id = ess.id_solic_serv 
                and ess.id = ed.id_equipos_serv 
                and ed.id = pd.id_equipo_detalle 
                and pd.id_producto = cp.id 
                and cp.id_tipo_producto = ctp.id 
                and cp.id_tipo_medida = cm.id 
                and cp.id = cps.id_producto 
                and cps.id_servicio_tarea = cst.id 
                and cst.id_servicio = cs.id 
                and cst.id_tarea = ct.id 
                and ss.id_cct = ccdt.id 
                and ccdt.id_municipio = cm2.id 
                and ccdt.id_subnivel = cn.id 
                and ccdt.id_turno = ct2.id 
                and ss.id = ".$detalle_material[0]->id_servicio."
                and ce2.id = ".$detalle_material[0]->id_estatus."
                group by cps.id_servicio_tarea, cs.servicio , ct.tarea ");

            // dd($detalle_material3);
        // $id_solicitud = $request->id;

        

        // $fn_solicitud =  DB::select("select * from cas_cete.fn_solicitud(".$detalle_material[0]->id_servicio.")");
        // $fn_inf_orden = DB::select("select * from cas_cete.fn_inf_orden(".$detalle_material[0]->id_servicio.")");
        
        // dd($fn_solicitud);
        // dd($ordenServicios[0]);
        // $fn_solicitud=$fn_solicitud[0];
        // if ($fn_inf_orden != null) {
        //     $fn_inf_orden=$fn_inf_orden[0];
        // }
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
        $data = file_get_contents($path);
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
        
        view()->share('ordenes/pdfMaterial',$detalle_material2, $detalle_material3, $detalle_material3);
        // view()->share('ordenes/pdfMaterial',$fn_solicitud ,$detalle_material2);
        $pdf = PDF::loadView('ordenes/pdfMaterial',array('detalle_material2' => $detalle_material2, 'detalle_material3' => $detalle_material3, 'detalle_material' => $detalle_material))->setPaper('a4', 'portrait');
        // $pdf = PDF::loadView('ordenes/pdfMaterial',['detalle_material2' => $detalle_material2], ['detalle_material3' => $detalle_material3])->setPaper('a4', 'portrait');
        // $pdf = PDF::loadView('ordenes/pdfMaterial', ['fn_solicitud' => $fn_solicitud], ['detalle_material2' => $detalle_material2])->setPaper('a4', 'landscape');
        // dd('hola');
        //   return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf'); // para que vaya a la url a descargar directo el pdf
        return $pdf->stream(); /// para abrir una nueva pestaña y que se muestre el pdf
    }

    public function revisar_detalle(Request $request){
        // dd($request);
        $revisar_detalle = DB::connection('pgsql')->select("select * from cas_cete.producto_detalle pd 
            where pd.id_equipo_detalle = ".$request->id_equipo_detalle."");
            // dd($revisar_detalle);
            if ($revisar_detalle == null || $revisar_detalle =='') {
                return array(
                    "exito" => false
                );
            }
            else{
                return array(
                    "exito" => true
                );
            }
            
    }
    public function editar_actividad(Request $request){
        // dd($request);
            $update_actividad_nota =  DB::connection('pgsql')->select("
            select * from cas_cete.fn_editar_actividad_nota(".$request->id_servicio.", '".$request->actividad_realizada."','".$request->nota_tecnica."')");

            return array(
                "exito" => true
            );
    }

}
