@extends('layouts.layout_educacion')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>


    #map {
        /* width: 100%;
        height: 400px; */
        background-color: grey;
    }
</style>
@section('content')
<div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Nueva Solicitud </h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container">
                <div class="m-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home" id="tab1" class="nav-link active" data-bs-toggle="tab">DATOS DEL CENTRO DE TRABAJO</a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" id="tab2" class="nav-link disabled" data-bs-toggle="tab">DATOS DEL REPORTE</a>
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
                                <div class="col-6">
                                    <span style="font-size:0.65em;">1.- INGRESA LA CALVE DE CENTRO DE TRABAJO DEL PLANTEL EDUCATIVO QUE REQUIERE EL SERVICIO</span>

                                </div>
                                
                                <!-- <div id="hidden_centro_trabajo" class="col-3" style="text-align: right;"></div> -->
                                
                                <!-- <br> -->
                                <br>
                                <label style="font-size:0.75em;">CENTRO DE TRABAJO</label>
                                <div class="col-3">
                                    <input type="text" class="form-control" id="vCentro_Trabajo">
                                    <!-- <button disabled id="btn_consultar" class="btn btn-secondary">Consultar</button> -->
                                    <!-- <span class="input-group-text" id="consultar_cdt">Consultar</i></span> -->
                                </div>
                                <div class="col-3">
                                    <!-- <input type="text" class="form-control" id="vCentro_Trabajo"> -->
                                    <button disabled id="btn_consultar" class="btn btn-secondary">Consultar</button>
                                    <!-- <span class="input-group-text" id="consultar_cdt">Consultar</i></span> -->
                                </div>
                            </div>
                            <div class="row">
                                <span style="font-size:0.65em;">2.- VALIDA LOS DATOS DEL CENTRO DE TRABAJO</span>
                                <br>
                                <div class="col-6">
                                    <label style="font-size:0.75em;">NOMBRE</label>
                                    <input type="text" disabled class="form-control" id="vNombre">
                                </div>
                                <div class="col-3">
                                    <label style="font-size:0.75em;">CLAVE</label>
                                    <input type="text" disabled class="form-control" id="vClave">
                                </div>
                                <div class="col-3">
                                    <label style="font-size:0.75em;">MUNICIPIO DEL C.T.</label>
                                    <input type="text" disabled class="form-control" id="vMunicipio">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label style="font-size:0.75em;">DIRECTOR</label>
                                    <input type="text" disabled class="form-control" id="vDirector">
                                </div>
                                <div class="col-6">
                                    <label style="font-size:0.75em;">DIRECCION</label>
                                    <input type="text" disabled class="form-control" id="vDireccion">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label style="font-size:0.75em;">TELEFONO DEL CENTRO DE TRABAJO</label>
                                    <input type="text" disabled class="form-control" id="vTelefono">
                                </div>
                                <div class="col-3">
                                    <label style="font-size:0.75em;">TURNO</label>
                                    <input type="text" disabled class="form-control" id="vTurno">
                                </div>
                                <div class="col-3">
                                    <label style="font-size:0.75em;">NIVEL EDUCATIVO</label>
                                    <input type="text" disabled class="form-control" id="vNivelEducativo">
                                </div>
                            </div>
                            <br>
                            <div style="text-align:right;" hidden id="div_btn_siguiente">
                                <button class="btn btn-primary" disabled style="font-size:0.80em;" id="btn_siguiente1">Siguiente</button>
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
                                    <span style="font-size:0.65em;">3.- REGISTRA LOS DATOS DE LA SOLICITUD DE SERVICIO</span>
                                </div>
                                

                                <!-- <br> -->
                                <!-- <br> -->
                                <div class="col-4">
                                    <label style="font-size:0.75em;">NOMBRE DEL SOLICITANTE</label>
                                    <input type="text" class="form-control" id="vNombre_Solicitante">
                                </div>
                                <div class="col-4">
                                    <label style="font-size:0.75em;">TELEFONO DEL SOLICITANTE</label>
                                    <input type="number" class="form-control" id="vTelefono_Solicitante">
                                </div>
                                <div class="col-4">
                                    <label style="font-size:0.75em;">CORREO INSTITUCIONAL DEL SOLICITANTE</label>
                                    <input type="text" class="form-control" disabled id="vCorreo_Solicitante" value="{{ session('vCorreoVerifica') }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="check_vNombre_Solicitante">
                                        <label style="font-size:0.75em;" class="form-check-label">
                                        Active la casilla en caso que el solicitante corresponda al Director del C.T.
                                        </label>
                                    </div>                                    
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <label style="font-size:0.75em;">DESCRIPCION DEL REPORTE</label>
                                    <textarea class="form-control" id="vDescripcion_Reporte" rows="3"></textarea>

                                </div>
                            </div>
                            <br>
                            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="btn-group" role="group" aria-label="First group">
                                    <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_regresar1">Regresar</button>
                                </div>
                                <div class="input-group">
                                    <!-- <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_siguiente2">Siguiente</button> -->
                                    <button class="btn btn-primary" style="font-size:0.80em;" id="btn_registrar2">Registrar</button>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <span style="font-size:0.65em;">4.- DESCRIBA LOS DETALLES DE SERVICIO POR CADA EQUIPO SOLICITADO</span>

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
                                    <label style="font-size:0.75em;">DESCRIPCION DEL PROBLEMA O SOPORTE A REALIZAR</label>
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
                                        <th>DESCRIPCION DEL SERVICIO</th>
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
@endsection

@section('page-scripts')

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
    // console.log(arreglo_serv);



    $("#vCentro_Trabajo").keyup(function(){
        if($('#vCentro_Trabajo').val().length > 0){
            $('#btn_consultar').prop('disabled', false);
            $('#div_btn_siguiente').prop('hidden', false);
        }
        else{
            bandera_tab1=0;
            $('#btn_consultar').prop('disabled', true);
            // $('#div_btn_siguiente').prop('hidden', true);
            // $('#btn_siguiente1').prop('disabled', true);

        }
    });

    $("#vNombre_Solicitante").keyup(function(){
        var txt = $(this).val();
        $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
    });

    $('#btn_consultar').click(function(){
        $("#hidden_centro_trabajo").html('');
        $("#hidden_centro_trabajo2").html('');
        $("#hidden_centro_trabajo3").html('');
        vCentro_Trabajo = $('#vCentro_Trabajo').val();
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
            url: '/ventanilla/formulario_consulta/',
            type: 'GET',
            data: {'vCentro_Trabajo' : vCentro_Trabajo}
           }).always(function(r) {
                if (r.exito == false) {
                    Swal.fire({
                        position: 'bottom-right',
                        icon: 'warning',
                        title: 'No existe la Clave de Centro de Trabajo que esta Ingresando..',
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
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO&nbsp;: '+vCentro_Trabajo+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NOMBRE C.T.&nbsp;: '+r.data[0]['nombrect']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NIVEL C.T.&nbsp;: '+r.data[0]['nivel']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">MUNICIPIO C.T.&nbsp;: '+r.data[0]['municipio']+'</span></b>';
                            html+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        html+= '<div>';
                    html+= '</div>';
                    html2+= '<div class="row">';
                        html2+= '<div class="col">';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO&nbsp;: '+vCentro_Trabajo+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NOMBRE C.T.&nbsp;: '+r.data[0]['nombrect']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">NIVEL C.T.&nbsp;: '+r.data[0]['nivel']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            html2+= '<b><span id="span_centro_trabajo" style="font-size:0.75em;">MUNICIPIO C.T.&nbsp;: '+r.data[0]['municipio']+'</span></b>';
                            html2+= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        html2+= '<div>';
                    html2+= '</div>';
                    // html = '<b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO : '+vCentro_Trabajo+'</span></b>';
                    // html2 = '<b><span id="span_centro_trabajo2" style="font-size:0.75em;">CENTRO DE TRABAJO : '+vCentro_Trabajo+'</span></b>';
                    html3 = '<b><span id="span_centro_trabajo3" style="font-size:0.75em;">CENTRO DE TRABAJO : '+vCentro_Trabajo+'</span></b>';
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
            $("#tab2").attr('class', 'nav-link');
            $("#tab2").tab('show');
        });
    }

    $('#check_vNombre_Solicitante').click(function(){
        if ($('#check_vNombre_Solicitante').is(':checked')) {
            director_nombre = $('#vDirector').val();
            $('#vNombre_Solicitante').val(director_nombre);
            $('#vNombre_Solicitante').prop('disabled', true);
        }
        else{
            $('#vNombre_Solicitante').val('');
            $('#vNombre_Solicitante').prop('disabled', false);
        }
    });

    $('#btn_regresar1').click(function(){
        $("#tab1").tab('show');
    });

    $('#btn_regresar2').click(function(){
        $("#tab2").tab('show');
    });
    

    $('#btn_siguiente2').click(function(){

        

        var vNombre_Solicitante = $('#vNombre_Solicitante').val();
        var vTelefono_Solicitante = $('#vTelefono_Solicitante').val();
        var vCorreo_Solicitante = $('#vCorreo_Solicitante').val();
        var vDescripcion_Reporte = $('#vDescripcion_Reporte').val();


       


        if(vNombre_Solicitante !='' && vTelefono_Solicitante !='' && vCorreo_Solicitante != '' && vDescripcion_Reporte != ''){
            
            
            var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/);

            if (caract.test(vCorreo_Solicitante) == false){
                Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar un Correo Electronico Correcto.',
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
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Llenar todos los Campos de la Solicitud de Servicio',
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
                                position: 'bottom-right',
                                icon: 'warning',
                                title: 'El tipo de Servicio Seleccionado ya se Agrego Anteriormente..',
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
                    position: 'bottom-right',
                    icon: 'warning',
                    title: 'Favor de Seleccionar un Tipo de Servicio.',
                    showConfirmButton: false,
                    customClass: 'msj_aviso',
                    timer: 2000
                })
            }
        }
        else{
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Seleccionar un Tipo de Equipo.',
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
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Llenar los Campos del Equipo',
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

    $('#btn_registrar2').click(function(){//28ADG0180W

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
                    position: 'bottom-right',
                    icon: 'warning',
                    title: 'Favor de Agregar un Telefono de 10 Digitos',
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

                // console.log(arreglo_inf);
                Swal.fire({
                    title: 'Esta seguro de Registrar la Solicitud?',
                    icon: 'warning',
                    showCancelButton: true,
                    customClass: 'msj_solicitud',
                    confirmButtonColor: '#b50915',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si',
                    allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $("#btn_registrar2").prop('disabled',true);
                        $.ajax({
                            url: '/ventanilla/formulario_registro/',
                            type: 'GET',
                            data: {'arreglo_inf' : arreglo_inf}
                            }).always(function(r) {
                                console.log(r);
                                Swal.fire({
                                    title: 'Registrado',
                                    // text: 'Se ha Registrado con Exito la Solicitud #5884',
                                    text: 'Se ha Registrado con Exito la Solicitud #'+r.data+'',
                                    customClass: 'msj_solicitud',
                                    icon: 'success',
                                    confirmButtonColor: '#b50915',
                                    allowOutsideClick: false
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    // alert('Se redireccciona al index');
                                    // window.location.href = "indexVentanilla";
                                }
                            })
                        });
                    }
                })
            }

        }
        else{
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Llenar todos los Datos del Reporte..',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }

        

        

        
        
    });

</script>
@endsection