<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index (){ 
        // $total_sol=DB::select("select * from cas_cete.getCountOrdenes('ALL')");
        $total_sol=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('ALL')");
        $total_solicitudes=$total_sol[0];

        $total_enesp=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('E')");
        $total_enespera=$total_enesp[0];
        
        $total_asig=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('AS')");
        $total_asignadas=$total_asig[0];

        $total_trab=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('T')");
        $total_trabajando=$total_trab[0];

        $total_aten=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('AT')");
        $total_atendidas=$total_aten[0]; 

        $total_espSol=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('SE')");
        $total_enesperaSol=$total_espSol[0]; 

        $total_aprob=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('SA')");
        $total_aprobadasSol=$total_aprob[0]; 

        $total_rech=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('SR')");
        $total_rechazadas=$total_rech[0]; 

        $total_canSol=DB::connection('pgsql')->select("select * from cas_cete.getCountOrdenes('SC')");
        $total_canceladasSol=$total_canSol[0]; 

        $vid_usuario=Auth()->user()->id;
        $getUsername=  DB::connection('pgsql')->select("select * from cas_cete.getUsername(".$vid_usuario.")");
       
        return view('inicio', compact(
            'total_solicitudes',
            'total_enespera',
            'total_asignadas',
            'total_trabajando',
            'total_atendidas',
            'getUsername',
            'total_enesperaSol',
            'total_aprobadasSol',
            'total_rechazadas',
            'total_canceladasSol'

        ) );
        // return view('inicio');
    }

    public function login (){
        return view('login');
    }


    public function ordenes (){
        return view('ordenes');
    }

    public function logout(){

    }

    public function show(){
    }

    public function filtrar(){
    }
}
