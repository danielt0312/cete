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

        $data4 = DB::select("select * from cas_cete.fngenerafolio2(1,0)");
        $pfolio_config  =  $data4[0]->fngenerafolio2;
        $dato='';
        // dd($request['arreglo_inf'][0]['vCorreo_Solicitante']);

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
        $data =  DB::select("select * from cas_cete.fn_insert_solicitud(".$pId_cct.",'".$pClave_ct."','".$pSolicitante."','".$pTelefono_solicitante."','".$pCorreo_solicitante."',".$pDirector.",'".$pDescripcion_reporte."','".$pCoord_x."','".$pCoord_y."',".$pId_coordinacion.",'".$pfolio_config."')");
        // dd($data);

        // $id_retorno = $data[0]->fn_insert_solicitud;

        // Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
        // $token = uniqid();
        // $token = strval( $token );
        $details = [
            'tittle' => 'Correo por Parte de la Secretaria de Educacion',
            'body' => 'Este es el Folio de la Solicitud #'.$pfolio_config.',
                    Un agente lo estará contactando por teléfono en el menor tiempo posible..'

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
        Session::put('vCorreoVerifica', $vCorreoVerifica);
        return array(
            "exito" => true
        );
    }
}
