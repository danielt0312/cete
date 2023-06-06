<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index (){ 
        $total_sol=DB::select("select * from cas_cete.getCountOrdenes('ALL')");
        $total_solicitudes=$total_sol[0];

        $total_enesp=DB::select("select * from cas_cete.getCountOrdenes('E')");
        $total_enespera=$total_enesp[0];
        
        $total_asig=DB::select("select * from cas_cete.getCountOrdenes('AS')");
        $total_asignadas=$total_asig[0];

        $total_trab=DB::select("select * from cas_cete.getCountOrdenes('T')");
        $total_trabajando=$total_trab[0];

        $total_aten=DB::select("select * from cas_cete.getCountOrdenes('AT')");
        $total_atendidas=$total_aten[0];
        
       
        return view('inicio', compact(
            'total_solicitudes',
            'total_enespera',
            'total_asignadas',
            'total_trabajando',
            'total_atendidas',
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
