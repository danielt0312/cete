@extends('layouts.layout_educacion')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>

.colorTabPrincipal{ 
    background-color: #ab0033!important;
    color:#FFFFFF !important;
}
.colorTabSecondary{ 
    background-color: #e9ecef4a!important;
    color:#000000 !important;
}

    #map {
        /* width: 100%;
        height: 400px; */
        background-color: grey;
    }

    .sweet_loader {
	width: 140px;
	height: 140px;
	margin: 0 auto;
	animation-duration: 0.5s;
	animation-timing-function: linear;
	animation-iteration-count: infinite;
	animation-name: ro;
	transform-origin: 50% 50%;
	transform: rotate(0) translate(0,0);
}
.fixedHeight {
    /* color:red; */
    font-size:10px;
    max-height: 200px;
    margin-bottom: 10px;
    overflow-x: auto;
    overflow-y: auto;
}
@keyframes ro {
	100% {
		transform: rotate(-360deg) translate(0,0);
	}
}
</style>
@section('content')
<div style="height: 15%;"></div>
<div class="card mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 100%;">
    <div class="container-fluid py-4 mt-3">
        <div class="row" style="margin-top: -2.75rem!important;">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="container">
                    <div class="m-4">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#home" id="tab1"  class="nav-link active colorTabPrincipal" data-bs-toggle="tab">DATOS DEL CENTRO DE TRABAJO</a>
                            </li>
                            <li class="nav-item">
                                <a href="#profile" id="tab2" class="nav-link disabled colorTabSecondary" data-bs-toggle="tab">DATOS DEL REPORTE</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#messages" id="tab3" class="nav-link " data-bs-toggle="tab">EQUIPOS</a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home">
                                <br>
                                <div class="row">
                                <div id="hidden_centro_trabajo"></div>
                                <br>
                                <br>
                                <div class="col-7">
                                    <span style="font-size:0.90em;">1.- INGRESA LA CLAVE DE CENTRO DE TRABAJO DEL PLANTEL EDUCATIVO QUE REQUIERE EL SERVICIO</span>

                                </div>
                                    
                                    <!-- <div id="hidden_centro_trabajo" class="col-3" style="text-align: right;"></div> -->
                                    
                                    <!-- <br> -->
                                    <br>
                                    <label style="font-size:0.75em;">CENTRO DE TRABAJO</label>
                                    <!-- <div class="col-3">
                                        <input type="text" class="form-control" maxlength="20" id="vCentro_Trabajo">
                                    </div> -->
                                    <div class="col-9">
                                        <div class="ui-widget">
                                            <input class="form-control" style="text-transform: uppercase;" id="tags">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <!-- <input type="text" class="form-control" id="vCentro_Trabajo"> -->
                                        <button disabled id="btn_consultar" class="btn btn-primary">Consultar</button>
                                        <!-- <span class="input-group-text" id="consultar_cdt">Consultar</i></span> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <span style="font-size:0.90em;">2.- VALIDA LOS DATOS DEL CENTRO DE TRABAJO</span>
                                    <br>
                                    <br>
                                    <div class="col-6">
                                        <label style="font-size:0.90em;">NOMBRE</label>
                                        <input type="text" disabled class="form-control" id="vNombre">
                                    </div>
                                    <div class="col-3">
                                        <label style="font-size:0.90em;">CLAVE</label>
                                        <input type="text" disabled class="form-control" id="vClave">
                                    </div>
                                    <div class="col-3">
                                        <label style="font-size:0.90em;">MUNICIPIO DEL C.T.</label>
                                        <input type="text" disabled class="form-control" id="vMunicipio">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label style="font-size:0.90em;">DIRECTOR</label>
                                        <input type="text" disabled class="form-control" id="vDirector">
                                    </div>
                                    <div class="col-6">
                                        <label style="font-size:0.90em;">DIRECCIÓN</label>
                                        <input type="text" disabled class="form-control" id="vDireccion">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label style="font-size:0.90em;">TURNO</label>
                                        <input type="text" disabled class="form-control" id="vTurno">
                                    </div>
                                    <div class="col-3">
                                        <label style="font-size:0.90em;">NIVEL EDUCATIVO</label>
                                        <input type="text" disabled class="form-control" id="vNivelEducativo">
                                    </div>
                                    <div class="col-3" hidden>
                                        <label style="font-size:0.90em;">TELÉFONO DEL CENTRO DE TRABAJO</label>
                                        <input type="text" disabled class="form-control" id="vTelefono">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <!-- <div class="col-3"> -->
                                        <div class="col-6" style="text-align:left;" id="div_btn_regresar">
                                            <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_regresar3">Cancelar</button>
                                        </div>
                                        <div class="col-6" style="text-align:right;" hidden id="div_btn_siguiente">
                                            <button class="btn btn-secondary" disabled style="font-size:0.80em;" id="btn_siguiente1">Siguiente</button>
                                        </div>
                                    <!-- </div> -->
                                    
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <br>
                                <div class="row">
                                <div id="hidden_centro_trabajo2"></div>
                                <br>
                                <br>
                                <!-- <div id="hidden_centro_trabajo"></div> -->
                                    <div class="col-12">
                                        <span style="font-size:0.90em;">3.- REGISTRA LOS DATOS DE LA SOLICITUD DE SERVICIO</span>
                                    </div>
                                    

                                    <br>
                                    <br>
                                    <div class="col-4">
                                        <label style="font-size:0.90em;">NOMBRE DEL SOLICITANTE</label>
                                        <input type="text" maxlength="100" class="form-control" id="vNombre_Solicitante" value="{{ session('vNombreCorreo') }}">
                                    </div>
                                    <div class="col-4">
                                        <label style="font-size:0.90em;">TELÉFONO DEL SOLICITANTE</label>
                                        <input type="text" maxlength="10" class="form-control" id="vTelefono_Solicitante">
                                    </div>
                                    <div class="col-4">
                                        <label style="font-size:0.90em;">CORREO INSTITUCIONAL DEL SOLICITANTE</label>
                                        <input type="text" class="form-control" disabled id="vCorreo_Solicitante" value="{{ session('vCorreoVerifica') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="check_vNombre_Solicitante">
                                            <label style="font-size:0.90em;" class="form-check-label">
                                                Active la casilla en caso que el solicitante corresponda al Director del C.T.
                                            </label>
                                        </div>                                    
                                    </div>
                                    <div class="col-4">
                                        <label style="font-size:0.90em;" >
                                            Favor de ingresar teléfono celular. Nos pondremos en contacto a este número.
                                        </label>
                                    </div>
                                </div>
                                
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label style="font-size:0.90em;">DESCRIPCIÓN DEL REPORTE</label>
                                        <textarea class="form-control" maxlength="450" id="vDescripcion_Reporte" rows="3"></textarea>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="check_seguimiento">
                                            <label style="font-size:0.90em;" class="form-check-label">
                                            Deseo recibir notificaciones sobre el seguimiento de mi solicitud en la dirección de correo que he proporcionado.
                                            </label>
                                        </div>                                    
                                    </div>
                                </div>
                                <br>
                                <div style="text-align:right;">
                                    <button class="btn btn-secondary float-right" style="font-size:0.80em;" id="btn_regresar1">Regresar</button>
                                    <button class="ms-3 btn btn-primary float-right" style="font-size:0.80em;" id="btn_registrar2">Registrar</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="messages">
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <span style="font-size:0.90em;">4.- DESCRIBA LOS DETALLES DE SERVICIO POR CADA EQUIPO SOLICITADO</span>

                                    </div>
                                    <div id="hidden_centro_trabajo3" class="col-3" style="text-align: right;"></div>
                                    <br>
                                    <br>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-3" id="select_tipo_equipo">
                                        
                                    </div>
                                    <div class="col-3" id="select_tipo_servicio">
                                            
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_servicio">+</button>
                                    </div>
                                    <div class="col-5">
                                        <label style="font-size:0.90em;">DESCRIPCIÓN DEL PROBLEMA O SOPORTE A REALIZAR</label>
                                        <textarea class="form-control" id="vDescripcion_Problema" ></textarea>
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                    </div>
                                    <div class="col-3">
                                        <table id="table_tipo_servicio">

                                        </table>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-5"></div>
                                    <!-- </div> -->
                                </div>
                                <br>
                                <div style="text-align: right;">
                                    <input id="btn_replicar" type="checkbox">&nbsp;&nbsp;<label style="font-size:0.65em;">Replicar Datos en el Siguiente Equipo</label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_equipo">Agregar</button>
                                </div>
                                <br>
                                <div >
                                    <table class="table" id="listado_equipos" hidden style="font-size:0.80em;">
                                        <tr>
                                            <th>TIPO DE EQUIPO</th>
                                            <th>TIPO DE SERVICIO</th>
                                            <th>DESCRIPCIÓN DEL SERVICIO</th>
                                            <th></th>
                                        </tr>
                                        
                                    </table>
                                </div>


                                



                                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_regresar2">Regresar</button>
                                    </div>
                                    <div style="text-align:center;" hidden id="div_btn_registrar">
                                        <button class="btn btn-primary" style="font-size:0.80em;" id="btn_registrar">Registrar Solicitud</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
    var contador_total = 0;
    var posicion_arreglo_servicios = 0;
    var contador_id_tabla = 0;
    var contador_total_servicio = 0;
    var contador_servicio = 0;
    var bandera_tab1 = 0;
    var arreglo_servicios = [];
    var arreglo_tabla = [];
    var arreglo_inf = [];
    var bandera_arreglo = 0;
    var arreglo_centrotrabajo = [];
 
    var bandera_servicio = 0;
    var eliminar_especifico = 0;

    var vCentro_Trabajo = '';

    var vNombre_check = '';
    var vSeguimiento_check = false;

    // console.log(arreglo_serv);

    $('#encabezado_layout').append('Registro de solicitud de servicio');

    $("#tags").keyup(function(e){
        var txt1 = $(this).val();
        // txt.toUpperCase();
        var txt2 = txt1.toUpperCase();
        if (e.which >= 46 && e.which <= 90 || e.which >= 96 && e.which <= 105 ){
            console.log('entro');
            if (txt2.length > 0) {
                $.ajax({
                url: '{{route("pruebaJC2")}}',
                type: 'GET',
                data: {
                    txt : txt2
                }
                }).always(function(r) {
                    array2=[];
                    console.log(r.arreglo);

                    for (let i = 0; i < r.arreglo.length; i++) {
                        array2.push(r.arreglo[i]['clavenombremun']);
                    }
                    // console.log(array2);
                    $( "#tags" ).autocomplete({
                        // maxShowItems: 5,
                        // minLength: 2,
                        source: array2,
                    
                    });
                    $( "#tags" ).autocomplete("widget").addClass("fixedHeight");
                    $('#btn_consultar').prop('disabled', false);
                    $('#div_btn_siguiente').prop('hidden', false);
                    // $( "#tags" ).autocomplete("widget").show();
                });
            }
            else{
                $('#btn_consultar').prop('disabled', true);
            }
        }
    });

    $("#vCentro_Trabajo").keyup(function(){
        if($('#vCentro_Trabajo').val().length > 0){
            $('#btn_consultar').prop('disabled', false);
            this.value = this.value.toUpperCase();
            $('#div_btn_siguiente').prop('hidden', false);
        }
        else{
            bandera_tab1=0;
            $('#btn_consultar').prop('disabled', true);
            // $('#div_btn_siguiente').prop('hidden', true);
            // $('#btn_siguiente1').prop('disabled', true);

        }
    });


    $('#vTelefono_Solicitante').keypress(function (e) {    
        var charCode = (e.which) ? e.which : event.keyCode    
        if (String.fromCharCode(charCode).match(/[^0-9]/g))    
            return false;                        
    }); 

    $("#vNombre_Solicitante").keyup(function(){
        var txt = $(this).val();
        $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
    });

    $('#btn_consultar').click(function(){
        $("#hidden_centro_trabajo").html('');
        $("#hidden_centro_trabajo2").html('');
        $("#hidden_centro_trabajo3").html('');
        // vCentro_Trabajo = $('#vCentro_Trabajo').val();
        vCentro_Trabajo = $('#tags').val();
        // if (vCentro_Trabajo == ''){
        //     Swal.fire({
        //         position: 'bottom-right',
        //         icon: 'warning',
        //         title: 'Favor de Ingresar un Centro de Trabajo..',
        //         showConfirmButton: false,
        //         customClass: 'msj_aviso',
        //         timer: 2000
        //     })
        // }
        $.ajax({
            url: '{{route("formulario_consulta")}}',
            type: 'GET',
            data: {'vCentro_Trabajo' : vCentro_Trabajo}
           }).always(function(r) {
                if (r.exito == false) {
                    tab2 = 0;
                    Swal.fire({
                        // position: 'bottom-right',
                        icon: 'warning',
                        html: '<p style="font-size:1rem !important;">No existe la Clave de Centro de Trabajo que esta Ingresando..</p>',
                        showConfirmButton: false,
                        customClass: 'msj_aviso',
                        timer: 2000
                    })
                    $("#span_centro_trabajo").remove();
                    $("#span_centro_trabajo2").remove();
                    $("#span_centro_trabajo3").remove();
                    $('#btn_siguiente1').prop('disabled', true);
                    $("#tab2").attr('class', 'nav-link disabled');
                    $("#tab3").attr('class', 'nav-link disabled');
                    $('#vNombre').val('');
                    $('#vClave').val('');
                    $('#vMunicipio').val('');
                    $('#vDirector').val('');
                    $('#vDireccion').val('');
                    $('#vTelefono').val('');
                    $('#vTurno').val('');
                    $('#vNivelEducativo').val('');
                }
                else{
                    $("#span_centro_trabajo").remove();
                    $("#span_centro_trabajo2").remove();
                    $("#span_centro_trabajo3").remove();
                    html='';
                    html2='';
                    html+= '<div class="row">';
                        html+= '<div class="col">';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO&nbsp;: '+r.data[0]['clavecct']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NOMBRE DEL C.T.&nbsp;: '+r.data[0]['nombrect']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NIVEL DEL C.T.&nbsp;: '+r.data[0]['nivel']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">MUNICIPIO DEL C.T.&nbsp;: '+r.data[0]['municipio']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        html+= '<div>';
                    html+= '</div>';
                    html2+= '<div class="row">';
                        html2+= '<div class="col">';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO&nbsp;: '+r.data[0]['clavecct']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NOMBRE DEL C.T.&nbsp;: '+r.data[0]['nombrect']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NIVEL DEL C.T.&nbsp;: '+r.data[0]['nivel']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">MUNICIPIO DEL C.T.&nbsp;: '+r.data[0]['municipio']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        html2+= '<div>';
                    html2+= '</div>';
                    // html = '<b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO : '+vCentro_Trabajo+'</span></b>';
                    // html2 = '<b><span id="span_centro_trabajo2" style="font-size:0.75em;">CENTRO DE TRABAJO : '+vCentro_Trabajo+'</span></b>';
                    html3 = '<b><span id="span_centro_trabajo3" style="font-size:0.75em;">CENTRO DE TRABAJO : '+r.data[0]['nombrect']+'</span></b>';
                    $("#hidden_centro_trabajo").append(html);
                    $("#hidden_centro_trabajo2").append(html2);
                    $("#hidden_centro_trabajo3").append(html3);
                    // console.log(r.data[0]);
                    $('#vNombre').val(r.data[0]['nombrect']);
                    $('#vClave').val(r.data[0]['clavecct']);
                    $('#vMunicipio').val(r.data[0]['municipio']);
                    $('#vDirector').val(r.data[0]['director']);
                    $('#vDireccion').val(r.data[0]['domicilio']);
                    $('#vTelefono').val(r.data[0]['telefono']);
                    $('#vTurno').val(r.data[0]['turno']);
                    $('#vNivelEducativo').val(r.data[0]['nivel']);
                    $('#btn_siguiente1').prop('disabled', false);
                    arreglo_centrotrabajo = r.data;
                }
           });
    });

    if($("#btn_siguiente1").is(":disabled")){
        $('#btn_siguiente1').click(function(){
            vNombre_check = $('#vNombre_Solicitante').val();
            $("#tab2").attr('class', 'nav-link colorTabPrincipal');
            $("#tab2").tab('show');
            $("#tab1").attr('class', 'nav-link colorTabSecondary');
        });
    }

    $('#check_vNombre_Solicitante').click(function(){
        if ($('#check_vNombre_Solicitante').is(':checked')) {
            director_nombre = $('#vDirector').val();
            
            $('#vNombre_Solicitante').val(director_nombre);
            $('#vNombre_Solicitante').prop('disabled', true);
        }
        else{
            $('#vNombre_Solicitante').val(vNombre_check);
            $('#vNombre_Solicitante').prop('disabled', false);
        }
    });

    $('#check_seguimiento').click(function(){
        if ($('#check_seguimiento').is(':checked')) {
            vSeguimiento_check = true;
        }
        else{
            vSeguimiento_check = false;
        }
    });
    

    $('#btn_regresar1').click(function(){
        $("#tab1").attr('class', 'nav-link colorTabPrincipal');
        $("#tab1").tab('show');
        $("#tab2").attr('class', 'nav-link colorTabSecondary');
    });

    $('#btn_regresar2').click(function(){
        $("#tab2").tab('show');
    });

    $('#tab1').click(function(){
        $("#tab1").attr('class', 'nav-link colorTabPrincipal');
        $("#tab1").tab('show');
        $("#tab2").attr('class', 'nav-link colorTabSecondary');
    });
    // if($("#tab2").is(":disabled")){
    $('#tab2').click(function(){
        $("#tab2").attr('class', 'nav-link colorTabPrincipal');
        $("#tab2").tab('show');
        $("#tab1").attr('class', 'nav-link colorTabSecondary');
    });  
    // }
    
    

    $('#btn_siguiente2').click(function(){

        var vNombre_Solicitante = $('#vNombre_Solicitante').val();
        var vTelefono_Solicitante = $('#vTelefono_Solicitante').val();
        var vCorreo_Solicitante = $('#vCorreo_Solicitante').val();
        var vDescripcion_Reporte = $('#vDescripcion_Reporte').val();


        if(vNombre_Solicitante !='' && vTelefono_Solicitante !='' && vCorreo_Solicitante != '' && vDescripcion_Reporte != ''){
            
            
            var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/);

            if (caract.test(vCorreo_Solicitante) == false){
                Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Ingresar un Correo Electrónico Correcto.</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
            }else{
                $("#tab3").attr('class', 'nav-link');
                $("#tab3").tab('show');
            }
        }
        else{
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Llenar todos los Campos de la Solicitud de Servicio</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
    });

    $('#btn_agregar_servicio').click(function(){
        // console.log('se agrego servicio');
        // if (contador_servicio == 0) {
        //     console.log('entrooo');
        // }
        
        tipo_equipo = $('#tipo_equipo').val();
        tipo_servicio = $('#tipo_servicio').val();
        // console.log(tipo_servicio);
        $.each(arreglo_servicios, function(j, val){
            if (!jQuery.isEmptyObject(arreglo_servicios[j])) { 
                // console.log('aqui entroooo '+j);

            }
        });
        if(tipo_equipo != 0){
            if (tipo_servicio !=0) {   
                if (arreglo_servicios != '') {
                    for (var i = 0; i < arreglo_servicios.length; i++) {
                        if (arreglo_servicios[i]['vTipo_servicio'] == tipo_servicio) {
                            console.log('es el miso servicio');
                            Swal.fire({
                                // position: 'bottom-right',
                                icon: 'warning',
                                html: '<p style="font-size:1rem !important;">El tipo de Servicio Seleccionado ya se Agrego Anteriormente..</p>',
                                showConfirmButton: false,
                                customClass: 'msj_aviso',
                                timer: 2000
                            })
                            return;
                        }
                    }
                }           
                console.log(posicion_arreglo_servicios);
                contador_servicio = contador_servicio + 1;
                text_tipo_servicio = $("#tipo_servicio option:selected").text();;
                var html='';
                    // html+='<table>';
                        html+='<tr id="tr_'+contador_servicio+'">';
                            html+='<td>'
                                html+='<label style="font-size:0.75em;">'+text_tipo_servicio+'&nbsp;&nbsp;';
                                    html+='<i onclick="Eliminar_Servicio('+contador_servicio+')" style="color:red;" class="fa fa-trash" aria-hidden="true"></i>';
                                html+='</label>';
                            html+='</td>'
                        html+='</tr>';
                    // html+='</table>';
                $("#table_tipo_servicio").append(html);
                arreglo_servicios.push({id: contador_servicio, vTipo_servicio: tipo_servicio, vtext_tipo_servicio: text_tipo_servicio, posicion: posicion_arreglo_servicios});
                posicion_arreglo_servicios = posicion_arreglo_servicios + 1;
                // console.log(arreglo_servicios.indexOf(0));
                // contador_total_servicio = contador_total_servicio + 1
                // bandera_servicio = 1;
                
                console.log(arreglo_servicios);
                console.log('se agrego...');
                // console.log('se agrega contador ' + contador_servicio);
                
                
            }
            else{
                Swal.fire({
                    // position: 'bottom-right',
                    icon: 'warning',
                    html: '<p style="font-size:1rem !important;">Favor de Seleccionar un Tipo de Servicio.</p>',
                    showConfirmButton: false,
                    customClass: 'msj_aviso',
                    timer: 2000
                })
            }
        }
        else{
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Seleccionar un Tipo de Equipo.</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
    });

    function Eliminar_Servicio(contador_servicio){
            var posicion = arreglo_servicios.length
            console.log($('tr').index(this));
            for (var i = 0; i < arreglo_servicios.length; i++) {
                // console.log('asdasd  '+arreglo_servicios.length);
                if (arreglo_servicios[i]['id'] == contador_servicio) {
                    console.log('esta en la posicion '+ i+ 'el tipo servicio :' +arreglo_servicios[i]['vtext_tipo_servicio']);
                    $('#tr_'+contador_servicio+'').remove();
                    arreglo_servicios.splice(i, 1);
                    
                }
                // console.log('asdasd  '+arreglo_servicios.length);
            //     if (arreglo_servicios[i]['id'] == contador_servicio) {
            //         console.log(arreglo_servicios[i]);
            //         console.log(arreglo_servicios[i].length);
                    // arreglo_servicios.splice(arreglo_servicios[i]['posicion'], 1);
            //     }
            }
            $('#tr_'+contador_servicio+'').remove();
            console.log(arreglo_servicios);
        
    }

    $('#btn_agregar_equipo').click(function(){
        
        vTipo_equipo = $("#tipo_equipo option:selected").val();
        vTipo_servicio = $("#tipo_servicio option:selected").val();
        vDescripcion_Problema = $('#vDescripcion_Problema').val();

        if(vDescripcion_Problema !='' && vTipo_equipo!=0 && vTipo_servicio!=0){
        // if(vDescripcion_Problema !='' && vTipo_equipo!=0 && vTipo_equipo!='' && vTipo_servicio!=0 && vTipo_servicio!=''){
            
            $('#listado_equipos').prop('hidden', false);
            $('#div_btn_registrar').prop('hidden', false);
            // console.log(contador_total);
            // if(contador_total == 0){
            //     contador_total = 0;
            // }
            contador_total=contador_total+1;
            contador_id_tabla=contador_id_tabla+1;
            if(contador_total=>1){
                $("#listado_equipos").show();
            }
            // console.log($("#tipo_equipo option:selected").text());
            // console.log($("#tipo_servicio option:selected").text());
            // console.log($('#vDescripcion_Problema').val());
            console.log(contador_total);

            var html='';
            html+='<tr id="tr_'+contador_id_tabla+'">';
                html+='<td>'+$("#tipo_equipo option:selected").text()+'</td>';
                html+='<td>';
                for (var i = 0; i < arreglo_servicios.length; i++) {
                    html+='- '+arreglo_servicios[i]['vtext_tipo_servicio']+'<br>';
                }
                html+='</td>';
                // html+='<td>'+$("#tipo_servicio option:selected").text()+'<br>'+$("#tipo_servicio option:selected").text()+'<br>'+$("#tipo_servicio option:selected").text()+'<br>'+$("#tipo_servicio option:selected").text()+'</td>';
                html+='<td>'+$('#vDescripcion_Problema').val()+'</td>';
                // html+='<td><button class="btn btn-danger" style="font-size:0.80em;" onclick="Eliminar('+contador_id_tabla+')">Eliminar</button></td>';
                html+='<td><div class="dropdown btn-group dropstart">';
                    html+='<button class="btn btn-link text-secondary mb-0 "data-bs-toggle="dropdown"<i class="fa fa-ellipsis-v text-xs"></i></button>';
                        html+='<div class="dropdown btn-group dropstart">';
                            html+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
                                html+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                                    html+='<li><a onclick="Eliminar('+contador_id_tabla+')" class="dropdown-item" ><i class="fas fa-trash">Elimninar</i></a></li>';
                                html+='</ul>';
                html+='</div></td>';
            html+='</tr>';
            console.log('entro');
            $("#listado_equipos").append(html);
            
            arreglo_tabla.push({id: contador_id_tabla, vTipo_equipo: vTipo_equipo, vTipos_servicios: arreglo_servicios, vDescripcion_Problema : vDescripcion_Problema});
            console.log(arreglo_tabla);

            if($('#btn_replicar').is(":checked")==false){
            arreglo_servicios = [];
            contador_servicio = 0;
            $('#table_tipo_servicio tr').empty();
            // console.log('entra');
            $('#tipo_servicio').prop('selectedIndex',0);
            $('#tipo_equipo').prop('selectedIndex',0);
            $('#vDescripcion_Problema').val('');
        }
        }
        else{
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Llenar los Campos del Equipo</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }

        

        
        
    });

    function Eliminar(contador_id_tabla){
        // console.log(contador_id_tabla);
        contador_eliminar = contador_id_tabla - 1;
        delete arreglo_tabla[contador_eliminar];
        console.log(arreglo_tabla);        

        $('#tr_'+contador_id_tabla+'').remove();
        contador_total=contador_total-1;
        // console.log(contador_total);
        if(contador_total == 0){
            console.log(contador_total);
            contador_total = 0;
            contador_id_tabla = 0;
            arreglo_tabla = [];
            $("#listado_equipos").hide();
            $('#div_btn_registrar').prop('hidden', true);
            
        }

    }

    $('#btn_registrar2').click(function(){

        // var vCentro_Trabajo = $('#vCentro_Trabajo').val();
        // var vNombre = $('#vNombre').val();
        var vClave = $('#vClave').val();
        var vMunicipio = $('#vMunicipio').val();
        
        var vDireccion = $('#vDireccion').val();
        var vTelefono = $('#vTelefono').val();
        var vTurno = $('#vTurno').val();
        var vNivelEducativo = $('#vNivelEducativo').val();
        // var vNombre_Solicitante = $('#vNombre_Solicitante').val();
        var vTelefono_Solicitante = $('#vTelefono_Solicitante').val();
        var vCorreo_Solicitante = $('#vCorreo_Solicitante').val();
        var vDescripcion_Reporte = $('#vDescripcion_Reporte').val();

        if ($('#check_vNombre_Solicitante').is(':checked')) {
            var vNombre_Solicitante = $('#vDirector').val();
            var vBandera_director = true;
        }
        else{
            var vNombre_Solicitante = $('#vNombre_Solicitante').val();
            var vBandera_director = false;
        }

        // console.log(vNombre_Solicitante);
        if (vCentro_Trabajo != '' && vNombre != '' && vClave != '' && vMunicipio != '' &&
            vDireccion != '' && vTelefono != '' && vTurno != '' && vNivelEducativo != '' && vNombre_Solicitante != '' && 
            vTelefono_Solicitante != '' && vCorreo_Solicitante != '' && vDescripcion_Reporte != '') {
                // $('#vTelefono_Solicitante').val().length;
            if ($('#vTelefono_Solicitante').val().length != 10) {
                Swal.fire({
                    // position: 'bottom-right',
                    icon: 'warning',
                    html: '<p style="font-size:1rem !important;">Favor de agregar un teléfono de 10 digitos.</p>',
                    showConfirmButton: false,
                    customClass: 'msj_aviso',
                    timer: 2000
                })
            }
            else{
                arreglo_inf.push({
                arreglo_centrotrabajo: arreglo_centrotrabajo, vNombre_Solicitante: vNombre_Solicitante, vTelefono_Solicitante: vTelefono_Solicitante,
                vCorreo_Solicitante : vCorreo_Solicitante, vDescripcion_Reporte : vDescripcion_Reporte, vBandera_director : vBandera_director
                });
                var seguimiento = true;
                // console.log(arreglo_inf);
                Swal.fire({
                    html: '<p style="font-size:1rem !important;">¿Está seguro de registrar la solicitud?</p>',
                    icon: 'warning',
                    showCancelButton: true,
                    customClass: 'msj_solicitud',
                    confirmButtonColor: '#b50915',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    width: 600,
                    // height: 600,
                    // reverseButtons: true,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            // position: 'bottom-right',
                            // icon: 'warning',
                            // width: 600,
                            html: '<div class="fa-3x" >'+
                                        // '<div class="fa-3x">'+
                                    '<span class="input-group" style="display:flex; justify-content:center; padding-left: 0%; padding-top: 15%; font-size: 5rem;" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'+
                                    '<p></p>'+
                                    '<p>Espere por favor</p>'+
                                        
                                    '</div>',
                                    // '</div>',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            customClass: 'msj_aviso'
                            // timer: 2000
                        })

                        
                        $("#btn_registrar2").prop('disabled',true);
                        $.ajax({
                            url: '{{route("formulario_registro")}}',
                            type: 'GET',
                            data: {'arreglo_inf' : arreglo_inf, 'seguimiento' : vSeguimiento_check}
                            }).always(function(r) {
                                console.log(r);
                                Swal.fire({
                                    // title: 'Registrado',
                                    html:'<p style="font-size:1rem !important;">Se ha registrado con éxito la solicitud con el folio: <strong>'+r.data+'</strong>.</p>'+
                                            '<p style="font-size:1rem !important;">Nos pondremos en contacto al teléfono proporcionado para seguimiento.</p>',
                                    // text: 'Se ha Registrado con Exito la Solicitud #5884',
                                    customClass: 'msj_solicitud',
                                    icon: 'success',
                                    width: 600,
                                    confirmButtonColor: '#b50915',
                                    allowOutsideClick: false,
                                    confirmButtonText: 'Aceptar',
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    // alert('Se redireccciona al index');
                                    window.location.href = "indexVentanilla";
                                }
                            })
                        });
                        
                    }


                })
            }

        }
        else{
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Llenar todos los Datos del Reporte..</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }

        

        

        
        
    });

    $('#div_btn_regresar').click(function(){
        window.location.href = "indexVentanilla";
    });

</script>
@endsection