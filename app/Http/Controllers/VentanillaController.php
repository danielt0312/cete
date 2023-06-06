<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Mail;
use Session;

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
        $data=[];
        $data =  DB::select("select * from cas_cete.fn_solicitud_folio('".$vFolio."')");
        // dd($data);

        if ($data == null) {
            return array(
                "exito" => false
                // "data" => $data
            );
        }
        else{
            return array(
                "exito" => true,
                "data" => $data
            );
        }
        

        
    }

    public function consulta_folio_correo(Request $request){
        $vCorreo = $request->vCorreo;
        // dd($vCorreo);
        $data=[];
        $data =  DB::select("select * from cas_cete.fn_solicitud_correo('".$vCorreo."')");
        // dd($data);
        

        return array(
            // "exito" => false,
            "data" => $data
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

    public function formulario_index(Request $request){

        // $correo_verifica = $request->correo_verifica;

        // $data=[];
        // // $data['correo_verifica'] = $request->correo_verifica;
        // $data['data_serv'] =  DB::select("select * from public.fn_consulta_servicios()");
        // // $data['data_mun'] =  DB::select("select * from public.fn_consulta_municipios()");
        // $data['data_equipo'] =  DB::select("select * from public.fn_consulta_equipos()");
        // $data['data_tipo_servicios'] =  DB::select("select * from public.fn_consulta_tipo_servicios()");
        
        
        // dd($data);
        return view('ventanilla.formulario_index');//->with($data);
    }

    public function formulario_consulta(Request $request){
        // dd($request);
        // $prueba = "1234";
        $data =  DB::select("select * from cas_cete.getcatcentrotrabajo('".$request->vCentro_Trabajo."')");
        // dd($data);
        if($data == null){
            return array(
                "exito" => false,
            );
        }
        else{
            return array(
                "exito" => true,
                "data" => $data
            );
        }
    }

    public function formulario_registro(Request $request){
        // dd($request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['clavecct']);
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
        $data =  DB::select("select * from cas_cete.fn_insert_solicitud(".$pId_cct.",'".$pClave_ct."','".$pSolicitante."','".$pTelefono_solicitante."','".$pCorreo_solicitante."',".$pDirector.",'".$pDescripcion_reporte."','".$pCoord_x."','".$pCoord_y."',".$pId_coordinacion.")");
        // dd($data);
        // ("select * from cas_cete.fn_insert_solicitud(".$pId_cct.",'".$pClave_ct."','".$pSolicitante."','".$pTelefono_solicitante."','".$pCorreo_solicitante."',".$pDirector.",'".$pDescripcion_reporte."','".$pCoord_x."','".$pCoord_y."',".$pId_coordinacion.")");;
        $id_retorno = $data[0]->fn_insert_solicitud;
        // dd($id_retorno);
        $data2 = DB::select("select id_reg_captacion from cas_cete.solic_serv_track where id = ".$id_retorno."");
        
        $data3 = DB::select("select folio from cas_cete.registro_captacion where id = ".$data2[0]->id_reg_captacion."");
        // dd($data2[0]->folio);

        // $data2 =  DB::select("select * from cas_cete.fn_solicitud(".$id_retorno.")");




        // dd($data[0]->fn_insert_solicitud);

        // foreach ($request['arreglo_tabla'] as $key => $value) {
        //     // $persona = DB::select("CALL public.sp_insert_solicitud_detalle($data[0]->fn_insert_solicitud,
        //     //                     $value['vTipo_equipo'], $value['vTipo_servicio'], $value['vDescripcion_Problema'])");
        //     $data2=  DB::select("CALL public.sp_insert_solicitud_detalle('".$data[0]->fn_insert_solicitud."','".$value['vTipo_equipo']."','".$value['vTipo_servicio']."','".$value['vDescripcion_Problema']."')");

        //     // return $persona;
        // }
        // dd($data2);

        return array(
            "exito" => true,
            "data" => $data3[0]->folio
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
