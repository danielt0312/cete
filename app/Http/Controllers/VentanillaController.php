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
            "data" => $data
        );
    }

    public function consulta_folio_solicitud(Request $request){
        $vFolio = $request->vFolio;
        // dd($vCorreo);
        $data=[];
        $data =  DB::select("select * from cas_cete.fn_solicitud_folio('".$vFolio."')");
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

    public function sendEmail2(Request $request){
        $vCorreoVerifica = $request->vCorreoVerifica;

        $data=[];
        $data =  DB::select("select * from cas_cete.fn_solicitud_correo('".$vCorreoVerifica."')");
        // dd($data);
        if ($data == null) {
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
                'tittle' => 'Verificacion de cuenta',
                
                // 'body1' => 'Estimado usuario: juan - C.C.T.',
                
                'body1' => 'Se ha solicitado autenticar tu cuenta para llevar a cabo una consulta de solicitudes de servicio.',
    
                'body2' => 'Por favor ingresa el siguiente token de seguridad: '.$token.'',
                'body3' => 'Si el código no funciona, intenta copiando y pegando el mismo desde tu navegador.',
    
                'body4' => 'Atentamente.',
                'body5' => 'Centro Estatal de Tecnología Educativa',
                'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
             <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a>'
    
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
        $data =  DB::select("select * from cas_cete.fn_insert_solicitud(".$pId_cct.",'".$pClave_ct."','".$pSolicitante."','".$pTelefono_solicitante."','".$pCorreo_solicitante."',".$pDirector.",'".$pDescripcion_reporte."','".$pCoord_x."','".$pCoord_y."',".$pId_coordinacion.",'".$pfolio_config."')");
        // dd($request['arreglo_inf'][0]['arreglo_centrotrabajo'][0]['nombrect']);

        // $id_retorno = $data[0]->fn_insert_solicitud;

        // Mail::to("$pCorreo_solicitante")->send(new MailSend($details));
        // $token = uniqid();
        // $token = strval( $token );
        $details = [
            'tittle' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
            
            'body1' => 'Estimado usuario: '.$pSolicitante.' - '.$pNombrect.'',
            
            'body2' => 'Tu solicitud de servicio se encuentra',
            'body2.1' => ' En espera',
            'body2.2' => ' con el folio número:',
            'body2.3' => ' '.$pfolio_config.'.',

            'body3' => 'Conserva este folio para continuar con el seguimiento de tu solicitud, nos pondremos en contacto al teléfono proporcionado.',

            'body4' => 'Atentamente.',
            'body5' => 'Centro Estatal de Tecnología Educativa',
            'body6' => 'De igual manera, puedes consultar el seguimiento de tu solicitud de servicio a través del sitio:
             <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE.</ins></a>'

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

        $data_correo = DB::select("select * from insumos.cat_base_correos cbc where cbc.correo = '$vCorreoVerifica'");

        if ($data_correo == '' || $data_correo == null) {
            return array(
                "exito" => false
            );
        }
        else{
            $vNombreCorreo = $data_correo[0]->nombre.' '.$data_correo[0]->apellidos;
            Session::put('vCorreoVerifica', $vCorreoVerifica);
            Session::put('vNombreCorreo', $vNombreCorreo);
            return array(
                "exito" => true
            );
        }


    }
}
