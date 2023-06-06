@extends('layouts.layout_educacion')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<div class="container-fluid py-4 mt-3">
    <!-- <div class="row mt-4">
    </div> -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="container " style="text-align: center;">
                    <p>CONSULTA FOLIOS</p>
                    <br>
                    <!-- <p>VENTANILLA UNICA PARA RECEPCION DE SOLICITUDES DE SOPORTE TECNICO Y MANTENIMIENTO</p> -->
                    <br>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-2">
                                <input class="form-check-input" checked type="radio" name="flexRadioDefault" id="radio_folio">
                                <label class="form-check-label" for="flexRadioDefault1">
                                &nbsp; Busqueda por Folio
                                </label>
                        </div>
                        <div class="col-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio_correo">
                                <label class="form-check-label" for="flexRadioDefault1">
                                &nbsp; Busqueda Por Fecha
                                </label>
                        </div>
                    </div>
                    <br><br>
                </div>
        </div>
    </div>
    <center>
        <div class="row" id="div_folio">
            <div class="col-5" style="text-align:right;">
                <label for="">Ingresar Folio : </label>
            <!-- <input type="text" class="form-control" placeholder="Enter email" name="email"> -->
            </div>
            <div class="col-2">
            <input type="text" id="vFolio" class="form-control">
            </div>
            <div class="col-1">
                <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_buscar">Buscar</button>
            </div>
        </div>
    </center>
    <center>
        <div class="row" id="div_correo" hidden>
            <div class="col-4" style="text-align:right;">
                <label for="">Ingresar Correo Institucional : </label>
            <!-- <input type="text" class="form-control" placeholder="Enter email" name="email"> -->
            </div>
            <div class="col-2">
            <input type="text" id="vCorreo" class="form-control">
            </div>
            <div class="col-1" style="text-align:right;">
                <label for="">Token : </label>
            </div>
            <div class="col-2">
            <input type="text" id="vToken" disabled class="form-control">
            </div>
            <div class="col-1">
                <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_enviar">Enviar</button>
                <button class="btn btn-secondary" hidden style="font-size:0.80em;" id="btn_enviar2">Enviar</button>
                <button class="btn btn-secondary" hidden style="font-size:0.80em;" id="btn_nueva_busqueda">Nueva Busqueda</button>
            </div>
        </div>
        <br><br>
        <div class="col-5">
            <table class="table" id ="tabla_folio" hidden>
                
             </table>
        </div>
        <div>
            <button class="btn btn-secondary"  style="font-size:0.80em;" id="btn_regresar">Regresar</button>
        </div>
        
    </center>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="numero_solicitud"></h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body" id="modal_body">
                  <div style="text-align:center;  background-color:#ab0033;">
                    <label style="color:white;">DATOS DEL CENTRO DE TRABAJO</label>
                  </div>
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf">
                    </div>
                  </div>
                  <div style="text-align:center;  background-color:#ab0033;">
                    <label style="color:white;">DATOS DE REPORTE</label>
                  </div>
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf2">
                    </div>
                  </div>
                  <div style="text-align:center;  background-color:#ab0033;" id="titulo_equipos" hidden>
                    <label style="color:white;">DESCRIBA LOS DETALLES DE SERVICIO POR CADA EQUIPO SOLICITADO</label>
                  </div>
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf3">
                      <div class="row">
                        <div class="col-3" id="select_tipo_equipo"></div>
                        <div class="col-3" id="select_tipo_servicio"></div>
                        <div class="col-1">
                          <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_servicio">+</button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-3"></div>
                        <div class="col-3"><table id="table_tipo_servicio"></table></div>
                        <div class="col-1"></div>
                        <div class="col-1"></div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-7">
                          <label style="font-size:0.75em;">DESCRIPCION DEL PROBLEMA O SOPORTE A REALIZAR</label>
                          <textarea class="form-control" id="vDescripcion_Problema" ></textarea>
                        </div>
                        <div class="col-3"></div>
                        <div class="col-1"></div>
                        <div class="col-1"></div>
                      </div>
                      <div style="text-align: right;">
                          <input id="btn_replicar" type="checkbox">&nbsp;&nbsp;<label style="font-size:0.65em;">Replicar Datos en el Siguiente Equipo</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_equipo">Agregar</button>
                      </div>
                      <br>
                      <div >
                        <table class="table" id="listado_equipos"  hidden style="font-size:0.80em;">
                            <tr >
                                <th>TIPO DE EQUIPO</th>
                                <th>TIPO DE SERVICIO</th>
                                <th>DESCRIPCION DEL SERVICIO</th>
                                <th></th>
                            </tr>
                            
                        </table>
                    </div>
                    </div>
                  </div>
                  <!-- <div style="text-align:center;  background-color:#ab0033;">
                    <label style="color:white;">TECNICOS DE SOPORTE ASIGNADOS</label>
                  </div>
                  <div class="row">
                    <div id="modal_solicitud_inf4">
                    </div>
                  </div> -->
                  
                    
                  <!-- </div> -->

                  
                    
                </div>
                <div class="modal-footer">
                    <!-- <button type="button"  class="btn btn-primary " id="btn_aprobar_solicitud">Aprobar Solicitud</button>
                    <button type="button"  class="btn btn-danger" id="btn_rechazar_solicitud">Rechazar Solicitud</button> -->
                    <button type="button"  class="btn btn-secondary " id="btn_cerrar" data-bs-dismiss="modal">Cerrar</button>
                    
                </div>
            </div>
        </div>
  </div>
<div style="height: 10%;"></div>
@endsection

@section('page-scripts')

<script>
bandera = 0;
gvCorreo = '';
gvToken = '';

    $('#radio_folio').click(function(){
        console.log('este es por folio');
        $('#radio_folio').prop('checked',true);
        $('#radio_correo').prop('checked',false);
        $('#div_folio').prop('hidden',false);
        $('#div_correo').prop('hidden',true);
        $('#vCorreo').val('');
        $('#vCorreo').prop('disabled',false);
        $('#btn_enviar').prop('hidden',false);
        $('#vToken').val('');
        $('#tabla_folio').prop('hidden',true);
        // $('#vFolio').val('');
        
        // if (bandera == 1) {
            // $('#tabla_folio').prop('hidden',false);
        // }
        
        // $('#tabla_folio').html();
        
        
    });

    $('#radio_correo').click(function(){
        console.log('este es por fecha');
        $('#radio_folio').prop('checked',false);
        $('#radio_correo').prop('checked',true);
        $('#div_folio').prop('hidden',true);
        $('#div_correo').prop('hidden',false);
        $('#tabla_folio').prop('hidden',true);
        $('#vFolio').val('');
        $('#tabla_folio').prop('hidden',true);

    });

    $('#btn_enviar').click(function(){
        var vCorreo = $('#vCorreo').val();
        var vToken = $('#vToken').val();
        if (vCorreo == '') {
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar el Correo',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }
        else{
            
            $('#vCorreo').prop('disabled',true);
            $('#btn_enviar').prop('disabled',true);
            $.ajax({
                url: '/ventanilla/sendEmail/',
                type: 'GET',
                data: {'vCorreoVerifica' : vCorreo}
            }).always(function(r) {
                console.log(r);
                gvToken = r.TOKEN;
                $('#vToken').prop('disabled',false);
                $('#btn_enviar').prop('hidden',true);
                $('#btn_enviar2').prop('hidden',false);
            });
        }
        
    });

    $('#btn_enviar2').click(function(){
        var vCorreo = $('#vCorreo').val();
        var vToken = $('#vToken').val();
        if (vToken == '') {
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar el Token',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }
        else if(vToken == gvToken){
            $.ajax({
                url: '/ventanilla/consulta_folio_correo/',
                type: 'GET',
                data: {'vCorreo' : vCorreo}
            }).always(function(r) {
                // bandera = 1;
                // $('#tabla_folio').prop('hidden',true);
                console.log(r);
                html='';
                $("#tabla_folio").html(html);
                // bandera = 1;
                $('#tabla_folio').prop('hidden',false);
                console.log(r);
                html+='<tr>';
                    html+='<th>FOLIO</th>';
                    html+='<th>FECHA CAPTACION</th>';
                    html+='<th>DETALLES</th>';
                html+='</tr>';
                for (var i = 0; i < r.data.length; i++) {
                    html+='<tr>';
                        html+='<td>'+r.data[i]['folio']+'</td>';
                        html+='<td>'+r.data[i]['fecha_captacion']+'</td>';
                        html+='<td>';
                        html+='<div class="dropdown btn-group dropstart">';
                        html+='<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >';
                        html+='<i class="fa fa-ellipsis-v text-xs"></i>';
                        html+='</button>';
                        html+='<ul class="dropdown-menu">';
                        html+='<li>';
                        html+='<a onclick="Mostrar_Servicio('+r.data[i]['id']+')" class="dropdown-item"> ';
                        html+='Ver Detalles Solicitud...';
                        html+='</a>';
                        html+='</li>';
                        html+='</ul>';
                        html+='</div>';
                        html+='</td>';
                    html+='</tr>';
                }
                
                $("#tabla_folio").append(html);
                $('#btn_enviar2').prop('hidden',true);
                $('#btn_nueva_busqueda').prop('hidden',false);
                $('#vToken').prop('disabled',true);
                $('#tabla_folio').prop('hidden',false);
            });
        }
        else{
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'El Token Ingresado no es Correcto',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
        
    });

    $('#btn_buscar').click(function(){
        var vFolio = $('#vFolio').val();
        if (vFolio == '') {
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar el Folio',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }
        else{
            html='';
            console.log(vFolio);
            $.ajax({
                url: '/ventanilla/consulta_folio/',
                type: 'GET',
                data: {'vFolio' : vFolio}
            }).always(function(r) {
                
                if (r.exito==false) {
                    html='';
                    $("#tabla_folio").html(html);
                    Swal.fire({
                        position: 'bottom-right',
                        icon: 'warning',
                        title: 'El Folio ingresado no Existe..',
                        showConfirmButton: false,
                        customClass: 'msj_aviso',
                        timer: 2000
                    })
                }
                else{
                    html='';
                    $("#tabla_folio").html(html);
                    bandera = 1;
                    $('#tabla_folio').prop('hidden',false);
                    console.log(r);
                    html+='<tr>';
                        html+='<th>FOLIO</th>';
                        html+='<th>FECHA CAPTACION</th>';
                        html+='<th>DETALLES</th>';
                    html+='</tr>';
                    html+='<tr>';
                        html+='<td>'+r.data[0]['folio']+'</td>';
                        html+='<td>'+r.data[0]['fecha_captacion']+'</td>';
                        html+='<td>';
                        html+='<div class="dropdown btn-group dropstart">';
                        html+='<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >';
                        html+='<i class="fa fa-ellipsis-v text-xs"></i>';
                        html+='</button>';
                        html+='<ul class="dropdown-menu">';
                        html+='<li>';
                        html+='<a onclick="Mostrar_Servicio('+r.data[0]['id']+')" class="dropdown-item"> ';
                        html+='Ver Detalles Solicitud...';
                        html+='</a>';
                        html+='</li>';
                        html+='</ul>';
                        html+='</div>';
                        html+='</td>';
                    html+='</tr>';
                    $("#tabla_folio").append(html);
                    $('#tabla_folio').prop('hidden',false);
                }

                
            });
        }
    });

    $('#btn_nueva_busqueda').click(function(){
        html='';
        $("#tabla_folio").html(html);
        $('#vCorreo').val('');
        $('#vToken').val('');
        $('#vCorreo').prop('disabled',false);
        $('#vToken').prop('hidden',false);
        $('#btn_nueva_busqueda').prop('hidden',true);
        $('#btn_enviar').prop('disabled',false);
        $('#btn_enviar').prop('hidden',false);


    });

    $('#btn_regresar').click(function(){
        window.location.href = "indexVentanilla";
    });

    function Mostrar_Servicio(id){
        console.log(id);
        html1='';
        html2='';
        html3='';
        html4='';

        $('#modal_solicitud_inf').html(html1);
        $('#modal_solicitud_inf2').html(html2);
        $('#modal_solicitud_inf3').html(html3);
        $('#modal_solicitud_inf4').html(html4);
        // $('#table_tipo_servicio').html(html4);
        
        
        $('#numero_solicitud').html('');

        
        $.ajax({
            url: '/solicitudes/buscar_folio/',
            type: 'GET',
            data: {'folio_solicitud' : id}
            }).always(function(r) {
                $('#numero_solicitud').append('No. de Solicitud: '+r.data[0]['folio']+'');
                console.log(r);
                html1+='<div class="row">';
                html1+='<div class="col-5">';
                    html1+='<label>Nombre del C.T. : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['nombrect']+'</span>';
                html1+='</div>';
                html1+='<div class="col-4">';
                    html1+='<label>Clave del C.T. : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['clave_ct']+'</span>';
                html1+='</div>';
                html1+='<div class="col-3">';
                    html1+='<label>Municipio : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['municipio']+'</span>';
                html1+='</div>';
                html1+='</div>';
                html1+='<div class="row">';
                html1+='<div class="col-6">';
                    html1+='<label>Nombre del Director : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['director']+'</span>';
                html1+='</div>';
                html1+='</div>';
                html1+='<div class="row">';
                html1+='<div class="col-5">';
                    html1+='<label>Direccion : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['domicilio']+'</span>';
                html1+='</div>';
                html1+='<div class="col-3">';
                    html1+='<label>Turno : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['desc_turno']+'</span>';
                html1+='</div>';
                html1+='</div>';
                html1+='<div class="row">';
                html1+='<div class="col-5">';
                    html1+='<label>Nivel Educativo : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['subnivel']+'</span>';
                html1+='</div>';
                html1+='</div>';
                
                html2+='<div class="row">';
                html2+='<div class="col-6">';
                    html2+='<label>Tipo de Orden : &nbsp;</label>';
                    html2+='<span>Ordinaria</span>';
                html2+='</div>';
                html2+='</div>';
                html2+='<div class="row">';
                html2+='<div class="col-12">';
                    html2+='<label>Dependencia que Atiende en el Servicio : &nbsp;</label>';
                    html2+='<span>Centro Estatal de Tecnologia Educativa</span>';
                html2+='</div>';
                html2+='</div>';
                html2+='<div class="row">';
                html2+='<div class="col-5">';
                    html2+='<label>Nombre del Solicitante : &nbsp;</label>';
                    html2+='<span>'+r.data[0]['solicitante']+'</span>';
                html2+='</div>';
                html2+='<div class="col-5">';
                    html2+='<label>Telefono del Solicitante : &nbsp;</label>';
                    html2+='<span>'+r.data[0]['telef_solicitante']+'</span>';
                html2+='</div>';
                html2+='</div>';
                html2+='<div class="row">';
                html2+='<div class="col-12">';
                    html2+='<label>Correo Electronico del Solicitante : &nbsp;</label>';
                    html2+='<span>'+r.data[0]['correo_solic']+'</span>';
                html2+='</div>';
                html2+='</div>';
                html2+='<div class="row">';
                html2+='<div class="col-6">';
                    html2+='<label>Descripcion del Reporte : &nbsp;</label>';
                    html2+='<span>'+r.data[0]['descrip_reporte']+'</span>';
                html2+='</div>';
                html2+='</div>';

            $('#modal_solicitud_inf').append(html1);
            $('#modal_solicitud_inf2').append(html2);
        $('#exampleModal').modal('show');

        });
    }
</script>
@endsection