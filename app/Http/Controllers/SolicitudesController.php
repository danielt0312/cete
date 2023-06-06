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
                                        Actualizar Solicitud...
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
        // dd($data['tipo_equipo']);
        // dd($data['tipo_servicio']);
        // dd($data);
        return array(
            "data" => $data
        );
    }

    public function prueba(){
        return view('solicitudes.prueba');
    }

    public function buscar_folio(Request $request){
        // dd($request->folio_solicitud);
        $data=[];
        $data =  DB::select("select * from cas_cete.fn_solicitud('".$request->folio_solicitud."')");
        // dd($data);
        

        return array(
            "exito" => false,
            "data" => $data
        );
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
