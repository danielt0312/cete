<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrdenesController extends Controller
{

    public function index(){
        $catEstatusOrden =  DB::select("select * from cascete.getCatEstatusOrden()");
        // dd ($catEstatusOrden);
        return view('ordenes.index', compact(
            'catEstatusOrden'
        ) );
        // return view('ordenes.index');
        
    }

    public function create(){
        // return view('ordenes.create');

        // $data =  DB::select("select * from cascete.getCatTipoOrden()");
        // return view('ordenes.create')->with("catTipoOrden", $data);

        $catTipoOrden =  DB::select("select * from cascete.getCatTipoOrden()");
        $catTipoServicio =  DB::select("select * from cascete.getCatTipoServicio()");

        return view('ordenes.create', compact(
            'catTipoOrden',
            'catTipoServicio'
        ) );
    }

    public function store(Request $request){
        // dd($request->arrEquipos);  //"[object Object]"
        $equipos=$request->arrEquipos;
        // var_dump($equipos);

        $arr = json_decode($equipos);
        // var_dump($arr[0]->id_tipo_equipo,$arr[0]->desc_tipo_equipo);

        $arrTarea=$arr[0]->aTarea;
        // var_dump($arrTarea);

        // foreach ($arrTarea as $p) {
        //     echo $p->idTarea;
        // }

        foreach ($arr as $e) {
            echo $e->desc_tipo_equipo.'--'.$e->con.'--<br>';
            $arrTarea=$e->aTarea;
            foreach ($arrTarea as $p) {
                // echo $p->idTarea.' - '.$p->desc_Tarea.' - '.$p->idServicio.' - '.$p->desc_Servicio.'<br>';//Tareas
                echo $p->idTarea.' - '.$p->desc_Tarea.' - '.$p->idServicio.' - '.$p->desc_Servicio.'<br>';
            }
        }
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function show(){
        
        $ordenes = DB::select("select * from cascete.getTOrdenes()");
        // return response()->json([$registros, $evaluacion, 'vRol'=>$vRol]);

        // dd($ordenes);
        return response()->json([$ordenes]);
    }
    
    public function getTareas($idserv){

        $catTarea =  DB::select("select * from cascete.getCatTarea('".$idserv."')");

        return response()->json([$catTarea]);
    }

    public function getCCT($claveCCT){

        $catCentroTrabajo =  DB::select("select * from cascete.getCatCentroTrabajo('".$claveCCT."')");
        // dd($catCentroTrabajo);
        return response()->json([$catCentroTrabajo]);
    }

    public function updEstatusOrden(Request $request){
        // dd($request->All());
        $exito = DB::select("select * from cascete.updEstatusOrden(".$request->idOrden.",".$request->idEstatusOrden.")");
        // dd($exito);
        // return response()->json([$exito]); 
        return response()->json($exito);
    }

    public function downloadPdf($id)
    {
        $ordenServicios = DB::select("select * from cascete.getTOrdenDetalle(".$id.")");

        // dd($ordenServicios[0]);
        $ordenServiciosObject=$ordenServicios[0];
        
        // return response()->json([$ordenes]);
    //   $ordenServicios = DB::table('cas_orden_servicio as orden')
    //   ->join('users as user', 'user.id', '=', 'orden.usuario_atiende_id_fk')
    //   ->join('users as tecnico','tecnico.id', '=','orden.tecnico_encargado_id_fk')
    //   ->join('aula_catcentrostrabajo as centro', 'orden.centro_id_fk', '=', 'centro.id')
    //   ->join('cas_cat_areaatencion as area','area.id','=','orden.area_atiende_id_fk')
    //   ->select('orden.id', 'orden.folio as folio', 'orden.nom_quien_reporta','area.nombre as area',
    //   'orden.telefono_quien_reporta', 'orden.cantidad_equipos_aprox', 
    //   'orden.desc_reporte',DB::raw('DATE_FORMAT(orden.fecha_inicio,"%Y-%m-%d") as fecha_inicio'),DB::raw('DATE_FORMAT(orden.fecha_finalizacion,"%Y-%m-%d") as fecha_finalizacion'), 
    //   DB::raw('CONCAT(user.name," ",user.paterno," ",user.materno) as usuario'), DB::raw('CONCAT(tecnico.name," ",tecnico.paterno," ",tecnico.materno) as tecnico_encargado'),
    //   'user.telefono', 'centro.nombrect', 'centro.clavecct', 'centro.domicilio', 'centro.entrecalle', 'centro.ycalle', 'orden.solicitante')
    //   ->where('orden.id', $id)
    //   ->get();
    //   $ordenServiciosObject = $ordenServicios[0];
    //   $folioOrden = $ordenServiciosObject->folio;
    //   $idOrden = $ordenServiciosObject->id;

    //   $existenciaTareas = DB::table('cas_orden_servicio as orden')
    //   ->join('cas_tareas_equipos_servicio as tareaEquipo','tareaEquipo.orden_servicio_id_fk','=','orden.id')
    //   ->select('tareaEquipo.id')
    //   ->where('orden.id', '=', $id)
    //   ->get();

    //   $tecnicos_aux = DB::table('cas_orden_servicio as orden')
    //   ->join('cas_tecnicos_aux_orden_servicio as tecnicos', 'orden.id','=','tecnicos.orden_servicio_id_fk')
    //   ->join('users as usuario','tecnicos.tecnico_auxiliar_id_fk','=','usuario.id')
    //   ->select(DB::raw('CONCAT(usuario.name, " ", usuario.paterno, ", ") as nombre_tec'))
    //   ->where('orden.id', '=', $id)
    //   ->get();

    //   if(count($existenciaTareas) >= 1) {

    //     $equipos = DB::table('cas_orden_servicio as orden')
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

    //     $equipos = DB::table('cas_orden_servicio as orden')
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

      // ,DB::raw('LCASE(CONCAT(tecnico.name," ",tecnico.paterno," ",tecnico.materno)) as tecnico_encargado_equipo')
      
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
      $pdf = PDF::loadView('ordenes/downloadOrden', ['ordenServiciosObject' => $ordenServiciosObject]);

      return $pdf->download('OrdenDeServicio-'.$id.'-'.$fecha.'.pdf');
      // return $pdf->stream();
    }
}
