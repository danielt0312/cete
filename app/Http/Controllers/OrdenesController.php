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

class OrdenesController extends Controller
{

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

        // $data =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden()");
        // return view('ordenes.create')->with("catTipoOrden", $data);

        $catTipoOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoOrden()");
        // $catTipoServicio =  DB::connection('pgsql')->select("select * from cas_cete.getCatTipoServicio()");]
        $catTipoEquipo =  DB::connection('pgsql')->select("select * from cas_cete.getCatTiposEquipo()");
        $catAreasAtiendeOrden =  DB::connection('pgsql')->select("select * from cas_cete.getCatAreasAtiendeOrden()"); 
        
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
            $nombreSoliictante = preg_replace('([^A-Za-z0-9])', '', $nombreSoliictante);
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

        // return response()->json($insSolicServicio);

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
        //  dd($request->All());
        $exito = DB::connection('pgsql')->select("select * from cas_cete.insCancelaSolicitud(".$request->idSolicServ.",".$request->id_motivo_canc.",'".$request->comentarios."',".$request->id_usuario.",'".$request->desc_rol_usr."')");
        // dd($exito);
        // return response()->json([$exito]); 
        return response()->json($exito);
    }

    public function updIniciar(Request $request){
        //dd($request->All());
       $exito = DB::connection('pgsql')->select("select * from cas_cete.insIniciaSolicitud(".$request->idSolicServ.")");
       // dd($exito);
       // return response()->json([$exito]); 
       return response()->json($exito);
   }

    public function downloadPdf($id)
    {
        $ordenServicios = DB::connection('pgsql')->select("select * from cas_cete.gettordendetallepdf(".$id.")");

        // dd($ordenServicios[0]);
        $ordenServiciosObject=$ordenServicios[0];

        // return $ordenServiciosObject;
        // return response()->json([$ordenes]);
    //   $ordenServicios = DB::connection('pgsql')->table('cas_orden_servicio as orden')
    //   ->join('users as user', 'user.id', '=', 'orden.usuario_atiende_id_fk')
    //   ->join('users as tecnico','tecnico.id', '=','orden.tecnico_encargado_id_fk')
    //   ->join('aula_catcentrostrabajo as centro', 'orden.centro_id_fk', '=', 'centro.id')
    //   ->join('cas_cat_areaatencion as area','area.id','=','orden.area_atiende_id_fk')
    //   ->select('orden.id', 'orden.folio as folio', 'orden.nom_quien_reporta','area.nombre as area',
    //   'orden.telefono_quien_reporta', 'orden.cantidad_equipos_aprox', 
    //   'orden.desc_reporte',DB::connection('pgsql')->raw('DATE_FORMAT(orden.fecha_inicio,"%Y-%m-%d") as fecha_inicio'),DB::connection('pgsql')->raw('DATE_FORMAT(orden.fecha_finalizacion,"%Y-%m-%d") as fecha_finalizacion'), 
    //   DB::connection('pgsql')->raw('CONCAT(user.name," ",user.paterno," ",user.materno) as usuario'), DB::connection('pgsql')->raw('CONCAT(tecnico.name," ",tecnico.paterno," ",tecnico.materno) as tecnico_encargado'),
    //   'user.telefono', 'centro.nombrect', 'centro.clavecct', 'centro.domicilio', 'centro.entrecalle', 'centro.ycalle', 'orden.solicitante')
    //   ->where('orden.id', $id)
    //   ->get();
    //   $ordenServiciosObject = $ordenServicios[0];
    //   $folioOrden = $ordenServiciosObject->folio;
    //   $idOrden = $ordenServiciosObject->id;

    //   $existenciaTareas = DB::connection('pgsql')->table('cas_orden_servicio as orden')
    //   ->join('cas_tareas_equipos_servicio as tareaEquipo','tareaEquipo.orden_servicio_id_fk','=','orden.id')
    //   ->select('tareaEquipo.id')
    //   ->where('orden.id', '=', $id)
    //   ->get();

    //   $tecnicos_aux = DB::connection('pgsql')->table('cas_orden_servicio as orden')
    //   ->join('cas_tecnicos_aux_orden_servicio as tecnicos', 'orden.id','=','tecnicos.orden_servicio_id_fk')
    //   ->join('users as usuario','tecnicos.tecnico_auxiliar_id_fk','=','usuario.id')
    //   ->select(DB::connection('pgsql')->raw('CONCAT(usuario.name, " ", usuario.paterno, ", ") as nombre_tec'))
    //   ->where('orden.id', '=', $id)
    //   ->get();

    //   if(count($existenciaTareas) >= 1) {

    //     $equipos = DB::connection('pgsql')->table('cas_orden_servicio as orden')
    //     ->join('cas_equipos_servicio as equipo','equipo.orden_servicio_id_fk','=','orden.id')
    //     ->join('cas_cat_estatus as estatusEquipo','equipo.estatus_equipo','=','estatusEquipo.estatus_id')
    //     ->join('cas_cat_tipo_equipo as Tipoequipo', 'equipo.id_tipo_equipo', '=', 'Tipoequipo.id')
    //     ->join('cas_tareas_equipos_servicio as tareaEquipo','tareaEquipo.equipo_servicio_id_fk','=','equipo.id')
    //     ->join('cas_cat_tarea as tarea','tareaEquipo.id_tarea','=','tarea.tarea_id')
    //     ->join('cas_cat_estatus as estatusTarea','tareaEquipo.id_estatus_tarea','=','estatusTarea.estatus_id')
    //     ->select('equipo.id as id','equipo.nombre_equipo', 
    //     'equipo.numero_serie', 'equipo.numero_inventario', 
    //     'equipo.estatus_equipo', 'equipo.orden_servicio_id_fk as id_orden', 
    //     'estatusEquipo.nombre as estatus', 'Tipoequipo.tipo_equipo as tipo_equipo',
    //     'tarea.nombre as nombreTarea', 'estatusTarea.nombre as estatus_tarea')
    //     ->where('orden.id', '=', $id)
    //     ->orderBy('equipo.numero_serie', 'desc')
    //     ->get();

    //   }else{

    //     $equipos = DB::connection('pgsql')->table('cas_orden_servicio as orden')
    //     ->join('cas_equipos_servicio as equipo','equipo.orden_servicio_id_fk','=','orden.id')
    //     ->join('cas_cat_estatus as estatusEquipo','equipo.estatus_equipo','=','estatusEquipo.estatus_id')
    //     ->join('cas_cat_tipo_equipo as Tipoequipo', 'equipo.id_tipo_equipo', '=', 'Tipoequipo.id')
    //     ->select('equipo.id as id','equipo.nombre_equipo', 
    //     'equipo.numero_serie', 'equipo.numero_inventario', 
    //     'equipo.estatus_equipo', 'equipo.orden_servicio_id_fk as id_orden', 
    //     'estatusEquipo.nombre as estatus', 'Tipoequipo.tipo_equipo as tipo_equipo',)
    //     ->where('orden.id', '=', $id)
    //     ->orderBy('equipo.numero_serie', 'desc')
    //     ->get();

    //   }

      // ,DB::connection('pgsql')->raw('LCASE(CONCAT(tecnico.name," ",tecnico.paterno," ",tecnico.materno)) as tecnico_encargado_equipo')
      
      $options = new Options();
      $options->set('isRemoteEnabled', TRUE);
      $options->set('isHtml5ParserEnabled', TRUE);
      $pdf = new Dompdf($options);

      $path = base_path('public/images/logo/logoTam2022.png');
      $type = pathinfo($path, PATHINFO_EXTENSION);
      $data = file_get_contents($path);
      $pic = 'data:image/'.$type.';base64,'.base64_encode($data);
      $path_footer = base_path('public/images/logo/ceteNI.png');
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
        // dd($request);
        
        $vusuario=Auth()->user()->id;
        
        // $ruta = $request->ruta_evidencia;
        // $ruta = explode('\\', $request->ruta_evidencia);
        // $ruta = $ruta[2];
        $vidSolicServ=$request->hdIdOrdenCierra;
        

        // $request->validate([
        //   'imageFile' => 'required|image|max:2048'
        // ]);

        // "name" => "PRESENTACIÓN SISTEMA C.A.S_VS 16_05_23 (1).pdf"
        // "type" => "application/pdf"
        // "tmp_name" => "C:\Users\Infraestructura\AppData\Local\Temp\phpF07A.tmp"
        // "error" => 0
        // "size" => 3543845

        $file2 = $_FILES["archivoCierre"];

        
        // var_dump($file2);
        //dd($file2);
        // $file_size1 = $file2->size;
        // $file_name1 = $file2->filename;

        // dd($file2, $file_size1, $file_name1);
        
        if($request->hasfile('archivoCierre')){ 

            if($request->hasFile("archivoCierre")){

                $file=$request->file("archivoCierre");
                // dd($file[0]);
                $ext=substr($file[0]->getClientOriginalName(), -3);
                if($ext === "pdf" ){
                    $nombre = uniqid() .'_'. $vidSolicServ.'.'.$ext;
                    
                    $ruta = public_path("cierreOrden/".$nombre);
    
                // if($file->getExtension()()=="pdf"){
                
                    copy($file[0], $ruta);
                    
                 }
    
            }else{
               
            }
    

             /*$i=1;
             foreach($file2 as $file){
                $sub=substr($file[0], -3);
                if($sub === "pdf" ){
                    $nombre = uniqid() .'_'. $vidSolicServ.'.'.$sub;

                    $file=$request->file("archivoCierre");
                    $ruta = public_path("cierreOrden/".$nombre);
                    //   sdd($sub,$fileName,$file,$ruta);
                    copy($file[0], $ruta);  
                    
                    $i++;
                }else{
                }
             }*/
        }else{
            dd('no entro');
        }
        
        $ruta_archivo=$ruta;
        $nombre_archivo=$nombre;
        
        // $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$request->idSolicServ.",".$vusuario.",'".$ruta."')");
        $exito = DB::connection('pgsql')->select("select * from cas_cete.inscierrasolicitud(".$vidSolicServ.",".$vusuario.",'".$nombre_archivo."','".$ruta_archivo."')");
       
         return response()->json($exito);
        
    }

    public function getEquiposSol($idSolic){

        $equiposSol =  DB::connection('pgsql')->select("select * from cas_cete.getEquiposSolic('".$idSolic."')");

        // $equiposSol =  DB::select("select * from cas_cete.pruebatabla()"); prueba de regresar un json

        return response()->json([$equiposSol]);
    }

    public function insTecnico(Request $request){
        //   dd($request->All());
        
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
            $correo='aida.rangel@set.edu.mx';
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
            $folio='ddd';
            $details = [
                'tittle' => 'Estimado usuario:',
                
                // 'body1' => 'Estimado usuario: juan - C.C.T.',
                
                'body1' => 'La orden de servicio con el folio número: '.$folio.'.',

                'body2' => 'Técnico encargado: '.$nomTecEncargado. ', técnicos auxiliares: '.$nomTecAux,
                // 'body3' => 'Si el código no funciona, intenta copiando y pegando el mismo desde tu navegador.',

                'body4' => 'Atentamente.',
                'body5' => 'Centro Estatal de Tecnología Educativa',
            //     'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
            //  <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'
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
        // dd($request); 

        $tareasEquipo=$request->arrTareasEdit;
        $tareasEquipoElim=$request->arrTareasEditElim;
        dd($request->arrTareasEditEli);
        $evidencia='';
        $etiqueta=$request->txtEtiquetaM;

        $vid_usuario=Auth()->user()->id;

        $updTareasEquipo =  DB::connection('pgsql')->select("select * from  cas_cete.updTareasEquipo(".$request->hdIdSolServM.",".$request->hdIdEquipoM.",".$request->hdIdTipoEquipo.",'".$etiqueta."','".$evidencia."',".$vid_usuario.",'".$tareasEquipo."','".$tareasEquipoElim."')");
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
        // $vCorreoVerifica = $request->vCorreoVerifica;
        //  dd($request->folio, $request->correo);
        // $data=[];
        // $data =  DB::select("select * from cas_cete.fn_solicitud_correo('".$vCorreoVerifica."')");
        // // dd($data);
        // if ($data == null) {
        //     return array(
        //         "exito" => false
        //         // "data" => $data
        //     );
        // }
        // else{
            // $vCorreoVerifica='aida.rangel@set.edu.mx';
            // $token = uniqid();
            // $token = strval( $token );

            //  $folio=$request->folio;
            $estatus='en espera';

            // Session::put('token', $token);
            // Session::put('vCorreoVerifica', $vCorreoVerifica);
            $details = [
                'tittle' => 'Estimado usuario: '.$solicitante .' - '. $nombrecct,
                
                // 'body1' => 'Estimado usuario: juan - C.C.T.',
                
                'body1' => 'Se ha generado una orden de servicio con el folio número: '.$folio.' para atender su solicitud, la cual se encuentra '.$estatus.' para ser atendida por un técnico de soporte.',
    
                'body2' => 'Conserva este folio para continuar con el seguimiento de tu orden a través de nuestras redes. Nos pondremos en contacto al teléfono proporcionado',
                // 'body3' => 'Si el código no funciona, intenta copiando y pegando el mismo desde tu navegador.',
    
                'body4' => 'Atentamente.',
                'body5' => 'Centro Estatal de Tecnología Educativa',
            //     'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
            //  <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'
    
            ];
    
            // Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
    
            Mail::to("$correo")->send(new MailSendO($details));
            return array(
                "exito" => true//,
                // "TOKEN" => $token
            );
        // }
    }
}
