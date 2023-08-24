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
        //dd($request);
        // dd($request->arrEquipos);  //"[object Object]"
        $equipos=$request->arrEquipos;
        //  var_dump($equipos);
        //  dd('murio');
        //dd($request->txtNombreSolicitante);
        // dd($request->checkDirector);
        $arr = json_decode($equipos);
        //  var_dump($arr[0]->id_tipo_equipo,$arr[0]->desc_tipo_equipo);
        //   var_dump($arr);
        //   dd('murio');

        $arrTarea=$arr[0]->aTarea;
        // var_dump($arrTarea);

        // foreach ($arrTarea as $p) {
        //     echo $p->idTarea;
        // }

        $nombreSoliictante='';  /// SI ES DIRECTOR O NO QUE TOME NOMBRE EN SOLICITANTE O NO

        if($request->checkDirector == true){
            $nombreSoliictante = $request->nombreSol; // quitar comillas dobles "nombre"
            // $nombreSoliictante = preg_replace('([^A-Za-z0-9])', '', $nombreSoliictante);
            $nombreSoliictante = str_replace('"', '', $nombreSoliictante);
            $nombreSoliictante = trim($nombreSoliictante);
        }else{
            $nombreSoliictante = $request->txtNombreSolicitante;
        }

        //SI FUNCIONAA  SP
        //$insSolicServicio =  DB::select("CALL cas_cete.spinsertsolicservicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$request->txtNombreSolicitante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',2,1,13,".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."')");
        $vidModoCaptacion=2;
        $vid_usuario=Auth()->user()->id;
        //FUNCIONinssolicservicioPrueba2
        // $insSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.InsSolicServicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$request->txtNombreSolicitante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."')");
        $insSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.InsSolicServicioPrueba2(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$nombreSoliictante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."')");
    
        $catTipoOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden()");
        // $catTipoServicio =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoServicio()");]
        $catTipoEquipo =  DB::connection('pgsql')->select("select * from cas_cete.getCatTiposEquipo()");
        $catAreasAtiendeOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatAreasAtiendeOrden()"); 

        $result1 =$insSolicServicio[0]->inssolicservicioprueba2;
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

        $catTipoOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden()");
        $catTipoEquipo =  DB::connection('pgsql')->select("select * from cas_cete.getCatTiposEquipo()");
        $catAreasAtiendeOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatAreasAtiendeOrden()"); 
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
        // dd($request);
        // dd($request->arrEquipos);  //"[object Object]"
        //dd($request->txtIdSolic);
        $equipos=$request->arrEquipos;
        $equiposElim=$request->arrEquiposElim;
        // var_dump($equipos);

        $nombreSoliictante='';  /// SI ES DIRECTOR O NO QUE TOME NOMBRE EN SOLICITANTE O NO

        if($request->checkDirector == true){
            $nombreSoliictante = $request->nombreSol; // quitar comillas dobles "nombre"
            $nombreSoliictante = preg_replace('([^A-Za-z0-9])', '', $nombreSoliictante);
        }else{
            $nombreSoliictante = $request->txtNombreSolicitante;
        }

        $vidModoCaptacion=2;
        $vid_usuario=Auth()->user()->id;
        $arr = json_decode($equipos);
        // var_dump($arr[0]->id_tipo_equipo,$arr[0]->desc_tipo_equipo);

        $arrTarea=$arr[0]->aTarea;
        // var_dump($arrTarea);

        // foreach ($arrTarea as $p) {
        //     echo $p->idTarea;
        // }
        // $insSolicServicio =  DB::connection('pgsql')->select("CALL cas_cete.spinsertsolicservicio(".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$request->txtNombreSolicitante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."',true,'".$request->txtDescripcionReporte."',2,1,13,".$request->txtLongitud.",".$request->txtLatitud.")");
        $updSolicServicio =  DB::connection('pgsql')->select("select * from  cas_cete.updSolicServicio(".$request->txtIdSolic.",".$request->txtIdCCT.",'".$request->txtClaveCCT."','".$nombreSoliictante."','".$request->txtTelefonoSolicitante."','".$request->txtCorreoSolicitante."','".$request->checkDirector."','".$request->txtDescripcionReporte."',".$vidModoCaptacion.",".$request->selTipoOrden.",".$vid_usuario.",".$request->selDepAtiende.",".$request->txtLongitud.",".$request->txtLatitud.",'".$equipos."','".$equiposElim."')");

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
        $ordenes = DB::connection('pgsql')->select("select * from cas_cete.getTOrdenes2(".$request->coordinacion_id.",".$request->estatus_id.",'".$request->fecha_inicio."','".$request->fecha_fin."','".$request->clavecct."',".$vModoCaptacion.")");
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
                $msje_correo='Lamentablemente no podemos proceder con su solicitud de servicio número ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                $band_ventanilla='1';
                $folio2=$folio_solic;
            }else{
                $msje_asunto='No es posible atender su orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Lamentablemente no podemos proceder con su orden de servicio número '; 
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
                'ventanilla' => $msje_ventanilla
            ];

            Mail::to("$correo")->send(new MailSendO($details));

            return response()->json($exito);
        }else{

        }
        
    }

    public function updIniciar(Request $request){
        //  dd($request->All());
       $exito = DB::connection('pgsql')->select("select * from cas_cete.insIniciaSolicitud(".$request->idSolicServ.")");
       // dd($exito);
    //    return response()->json($exito);
        if($exito != null || $exito != ''){ 
            $folio = $request->folio;
            $folio_solic = $request->folioSol;
            $correo = $request->correo;
            $nombrecct = $request->nombrecct;
            $solicitante = $request->solicitante;

            if($folio_solic != null  && $folio_solic != "null"){ // si viene desde solicitud
                $msje_asunto='Se ha iniciado la solicitud de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha iniciado la solicitud de servicio con el folio número ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                $band_ventanilla='1';
                $folio2=$folio_solic;
            }else{
                $msje_asunto='Se ha iniciado la orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha iniciado la orden de servicio con el folio número '; 
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
                
                'body3' => 'De igual manera, le recomendamos mantener el número de folio de su orden para que pueda contactarnos para su seguimiento.',
                'body4' => '',

                'firma1' => 'Atentamente.',
                'firma2' => 'Centro Estatal de Tecnología Educativa',
                'band_ventanilla' => $band_ventanilla,
                'ventanilla' => $msje_ventanilla
            ];

            Mail::to("$correo")->send(new MailSendO($details));

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

    public function updCerrar(Request $request){
        // dd($request, $_FILES["archivoCierre"]);
        //   dd($request);
        
        $vusuario=Auth()->user()->id;

        $vidSolicServ=$request->hdIdOrdenCierra;

        $file2 = $_FILES["archivoCierre"];
        
        if($request->hasfile('archivoCierre')){ 

            $file=$request->file("archivoCierre");
            // dd($file[0]);
            $ext=substr($file[0]->getClientOriginalName(), -3);
            
            if($ext === "pdf" ){
                $nombre = uniqid() .'_'. $vidSolicServ.'.'.$ext;
                
                $ruta = public_path("cierreOrden/".$nombre);
            
                copy($file[0], $ruta);
            }
    
        }else{
            dd('no entro');
        }
        
        $ruta_archivo=$ruta;
        $nombre_archivo=$nombre;
        
        // $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$request->idSolicServ.",".$vusuario.",'".$ruta."')");
        $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$vidSolicServ.",".$vusuario.",'".$nombre_archivo."','".$ruta_archivo."')");
                
        //  return response()->json($exito);
        if($exito != null || $exito != ''){
            $folio = $request->hdFolioCierra;
            $folio_solic = $request->hdFolioSolCierra;
            $correo = $request->correoCierre;
            $nombrecct = $request->nombrecctCierre;
            $solicitante = $request->solicitanteCierre;

            if($folio_solic != null ){ // si viene desde solicitud
                $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha finalizado la solicitud de servicio con el folio número ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                $band_ventanilla='1'; 
                $folio2=$folio_solic;
            }else{
                $msje_asunto='Finalización de orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='Se ha finalizado la orden de servicio con el folio número '; 
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
                'ventanilla' => $msje_ventanilla
            ];

            Mail::to("$correo")->send(new MailSendO($details));

            return response()->json($exito);
        }else{

        }
        
    }

    public function getEquiposSol($idSolic){

        $equiposSol =  DB::connection('pgsql')->select("select * from cas_cete.getEquiposSolic('".$idSolic."')");

        // $equiposSol =  DB::select("select * from cas_cete.pruebatabla()"); prueba de regresar un json

        return response()->json([$equiposSol]);
    }

    public function insTecnico(Request $request){
            // dd($request->All());
        
        $arrTec=$request->tecnicosAuxiliaresArray;
        $arrTec2 = json_decode($arrTec);

        // dd($request->fecha_inicio_prog);
        $vusuario=Auth()->user()->id;
        //$varddd=explode("T",$request->fecha_inicio_prog);
        //dd($varddd[0], " - ", $varddd[1]); 
        // $exito = DB::select("CALL cas_cete.spInsertTecnicos(".$request->idSolModTec.",1,'".$request->fecha_inicio_prog."','".$request->fecha_fin_prog."',".$request->selTecnicoEncargado.",true)");
        $exito = DB::connection('pgsql')->select("select * from cas_cete.fnInsTecnicos(".$request->idSolModTec.",".$vusuario.",'".$request->fecha_inicio_prog."','".$request->fecha_fin_prog."',".$request->selTecnicoEncargado.",'".$request->tecnicosAuxiliaresArray."')");

        // return response()->json($exito);
        
        if($exito != null || $exito != ''){
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

            //  $date1 = new DateTime($fecha_inicio2);
            //  $fechaInicio2 = strval(date_format($date1, 'Y/m/d H:i:s'));
            $fecha_inicio = str_replace("T"," ",$fecha_inicio);

            $folio=$request->folioModTec;
            $solicitante=$request->solicitanteModTec;
            $nombrecct=$request->nombrecctModTec; 
            // date_format($date,"Y/m/d H:i:s");

            if($folio_solic != null){ // si viene desde solicitud
                $msje_asunto='Programación de cita para solicitud de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='La solicitud de servicio con el folio número: ';
                $msje_ventanilla='De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>';
                $band_ventanilla='1';
                $folio2 = $folio_solic;
            }else{
                $msje_asunto='Programación de cita para  orden de servicio - Sistema C.A.S. - C.E.T.E.';
                $msje_correo='La orden de servicio con el folio número: '; 
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
                'body2' => 'ha sido asignada a nuestros técnicos de soporte especializados, quienes estarán presentes en su Centro de Trabajo  el dia '.$fecha_inicio.' para brindar la asistencia.',
                // 'body2' => 'Técnico encargado: '.$nomTecEncargado. ', técnicos auxiliares: '.$nomTecAux,
                'body3' => 'Le recomendamos mantener el número de folio de su orden para que pueda dar seguimiento a su progreso.',
                'body4' => '',

                'firma1' => 'Atentamente.',
                'firma2' => 'Centro Estatal de Tecnología Educativa',
                'band_ventanilla' => $band_ventanilla,
                'ventanilla' => $msje_ventanilla
            ];

            Mail::to("$correo")->send(new MailSendO($details));
            // return array(
            //     "exito" => true
            // );
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

    public function getArchivoCierre($idSolicServ){
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
            
             'body1' => 'Se ha generado una orden de servicio con el folio número:  ',
            'body2' => ' para atender su solicitud, la cual se encuentra',
            'body3' => ' para ser atendida por un técnico de soporte.',
            'body4' => 'Conserve este folio para continuar con el seguimiento de su orden a través de nuestras redes. Nos pondremos en contacto al teléfono proporcionado.',

            'firma1' => 'Atentamente.',
            'firma2' => 'Centro Estatal de Tecnología Educativa',
            'band_ventanilla' => $band_ventanilla,
            'ventanilla' => $msje_ventanilla
        ];
    
        Mail::to("$correo")->send(new MailSendO($details));
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
        
        //Archivo Cierre Equipo
        $file2 = $_FILES["archivoCierreEquipo"];
        
        if($request->hasfile('archivoCierreEquipo')){ 

            $file=$request->file("archivoCierreEquipo");
             
            $ext=substr($file->getClientOriginalName(), -3);
            
            if($ext === "jpg" || $ext === "png" ){
                $nombre = uniqid() .'_'. $vidSolicServ.'_'.$id_equipo_serv.'.'.$ext;
                
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

        $insCierreEquipo =  DB::connection('pgsql')->select("select * from  cas_cete.insCierreEquipo(".$request->hdIdEquipoMC.",".$vid_usuario.",'".$diagnostico."','".$solucion."','".$nombre_archivo."','".$ruta_archivo."','".$base_archivo."')");
        return response()->json($insCierreEquipo);
    }
}
