@extends('layouts.layout_educacion')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<style>
        .colorBtnEnviar{ 
        background-color: #bc955c!important;
        color:#FFFFFF !important;
    }
.table-wrapper {
  width: 100%;
  height: 200px; /* Altura de ejemplo */
  overflow: auto;
}

.table-wrapper table {
  border-collapse: separate;
  border-spacing: 0;
}

.table-wrapper table thead {
  position: -webkit-sticky; /* Safari... */
  position: sticky;
  top: 0;
  left: 0;
}

.table-wrapper table thead th,
.table-wrapper table tbody td {
  /* border: 1px solid #000; */
  background-color: #FFF;
}
.swal2-confirm {
  font-size: 2em !important;
}
</style>
<div style="height: 10%;"></div>
<div class="card mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 100%;">
  <div class="row g-0">
    <div class="col-md-4">
        <div style="height: 20%;"></div>
            <center>
            <img src="{{ asset('images/img/ventanilla/VENTUNICALOGO.png') }}" class="img-fluid rounded-start" style="width: 50%;">

            </center>
            <br>
        <center>
        <img src="{{ asset('images/img/ventanilla/CETELOGO.png') }}" class="img-fluid rounded-start" style="width: 30%;">

        </center>
        </div>
        <div class="col-md-8">
            <div class="card-body" style="border-left: 1px solid #8080803d;">
                <!-- <h5 class="card-title">Card title</h5> -->
                <p></p>
                <center>
                <strong style="font-size:30px; color:#bc955c!important;">Consultar folio</strong>
                </center>
                <div class="container-fluid py-4 mt-3">
                    <div class="row mt-4">
                        <div class="col-lg-12 mb-lg-0 mb-4">
                            <div class="container " style="text-align: center;">
                                <div class="row">
                                    <div class="col-3"></div>
                                    <div class="col-3">
                                            <input class="form-check-input" checked type="radio" name="flexRadioDefault" id="radio_folio">
                                            <b><label class="form-check-label" for="flexRadioDefault1">
                                            &nbsp; Búsqueda por Folio
                                            </label></b>
                                    </div>
                                    <div class="col-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio_correo">
                                            <b><label class="form-check-label" for="flexRadioDefault1">
                                            &nbsp; Búsqueda por Email
                                            </label></b>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="row" id="div_folio">
                            <div class="col-3" style="text-align:right;">
                                <label for="">INGRESAR FOLIO : </label>
                            </div>
                            <div class="col-5">
                            <input type="text" id="vFolio" style="text-transform: uppercase;" placeholder="Ingrese el folio de su solicitud" class="form-control">
                            </div>
                            <div class="col-2"></div>
                            <div class="col-2">
                                <button class="btn btn-primary" id="btn_buscar">Buscar</button>
                            </div>
                        </div>
                    </center>
                    
                        <div class="row" id="div_correo" hidden>
                            <!-- <div class="col-4" style="text-align:right;">
                                <label for="">Ingresar Correo Institucional : </label>
                            </div> -->
                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" id="vCorreo" placeholder="Ingrese su correo institucional" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <!-- <button class="btn btn-primary" id="btn_buscar">Buscar</button> -->
                                <!-- <input type="text" id="vCorreo" class="form-control"> -->
                            </div>
                            <div class="col-1"><button class="btn btn-primary" id="btn_enviar">Buscar</button></div>
                            <p></p>
                            <p class="card-text">Ingresa el token de seguridad enviado al correo electrónico proporcionado.</p>
                            <p class="card-text">No olvides revisar tu bandeja de correo no deseado.</p>

                            <div class="col-9">
                                <div class="input-group mb-3">
                                    <span><b>TOKEN :</b></span>&nbsp;&nbsp;&nbsp;
                                    <input type="text" id="vToken" placeholder="Ingrese token de seguridad" disabled class="form-control">
                                </div>
                                <!-- <button class="btn btn-primary" id="btn_buscar">Buscar</button> -->
                                <!-- <input type="text" id="vCorreo" class="form-control"> -->
                            </div>
                            
                            <div class="col-1"><button class="btn colorBtnEnviar"   id="btn_enviar2">Enviar</button></div>
                            <!-- <div class="col-1" style="text-align:right;">
                                <label for="">Token : </label>
                            </div>
                            <div class="col-2">
                            <input type="text" id="vToken" disabled class="form-control">
                            </div>
                            <div class="col-1">
                                <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_enviar">Enviar</button>
                                <button class="btn btn-secondary"  style="font-size:0.80em;" id="btn_enviar2">Consultar</button>
                                <button class="btn btn-secondary" hidden style="font-size:0.80em;" id="btn_nueva_busqueda">Nueva Busqueda</button>
                            </div> -->
                        </div>
                        <br><br>
                        <!-- <div class="col-9">
                            <table class="table" id ="tabla_folio" hidden></table>
                        </div> -->
                        <!-- <div><button class="btn btn-secondary"  style="font-size:0.80em;" id="btn_regresar">Regresar</button></div> -->
                </div>



                <center>
                <br><br>
                </center>
            </div>
        </div>
        <div class="col-12"><table class="table" id ="tabla_folio" style="width:100%" hidden></table></div>
        <div class="container" id="datatable_solicitudes" hidden > 
            <div>
                <table class="table " id="tabla_solicitudes" width="100%">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOLIO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">C.C.T</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="100px">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="container" id="datatable_solicitudes2" hidden > 
            <div>
                <table class="table " id="tabla_solicitudes2" width="100%">
                    <thead>
                        <tr>
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOLIO</th>
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS</th>
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA</th>
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">C.C.T</th>
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="100px">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div style="padding-right: 25px;"><button  class="btn btn-secondary pull-right"   id="btn_regresar">Regresar</button></div>
    </div>
</div>
<!-- <div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="container " style="text-align: center;">
                <p>CONSULTA FOLIOS</p>
                <br>
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
                            &nbsp; Busqueda Por Email
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
                <button class="btn btn-secondary" hidden style="font-size:0.80em;" id="btn_enviar2">Consultar</button>
                <button class="btn btn-secondary" hidden style="font-size:0.80em;" id="btn_nueva_busqueda">Nueva Busqueda</button>
            </div>
        </div>
        <br><br>
        <div class="col-9">
            <table class="table" id ="tabla_folio" hidden>
                
             </table>
        </div>
        <div>
            <button class="btn btn-secondary"  style="font-size:0.80em;" id="btn_regresar">Regresar</button>
        </div>
    </center>
</div> -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                <div class="container ">
                    <div class="row ">
                        <div class="col-4 " style="color:#ab0033;" id="span_solicitud">
                            <!-- col-sm-7 -->
                        </div>
                        <div class="col-4 " style="color:#ab0033;" id="span_estatus">
                            <!-- col-sm-5 -->
                        </div>
                        <div class="col-4 " style="color:#ab0033;" id="span_orden">
                            <!-- col-sm-5 -->
                        </div>
                    </div>
                </div>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body" id="modal_body">
                    <div class="row">
                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label style="color:white;">DATOS DEL CENTRO DE TRABAJO</label>
                        </div>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                  <!-- <div style="text-align:center;  background-color:#ab0033;">
                    <label style="color:white;">DATOS DEL CENTRO DE TRABAJO</label>
                  </div> -->
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf">
                    </div>
                  </div>
                    <div class="row">
                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label style="color:white;">DATOS DEL SOLICITANTE</label>
                        </div>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                  <!-- <div style="text-align:center;  background-color:#ab0033;">
                    <label style="color:white;">DATOS DEL SOLICITANTE</label>
                  </div>                 -->
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf2">
                    </div>
                  </div>
                  <br>
                  <div id="div_inf_rechazada" hidden>
                        <div class="row">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                <label  style="color:white;">DATOS DE LA SOLICITUD RECHAZADA</label>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div id="modal_solicitud_inf6"></div>
                        </div>
                  </div>
                  <div id="div_inf_cancelada" hidden>
                        <div class="row">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                <label  style="color:white;">DATOS DE LA SOLICITUD CANCELADA</label>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div id="modal_solicitud_inf7"></div>
                        </div>
                  </div>
                  <div id="div_inf_cancelada2" hidden>
                        <div class="row">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                <label  style="color:white;">DATOS DE LA ORDEN CANCELADA</label>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div id="modal_solicitud_inf9"></div>
                        </div>
                  </div>
                <div id="div_inf_orden" hidden >
                    <!-- <div style="text-align:center;  background-color:#ab0033;"> -->
                        <div class="row" id="label_orden">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label  style="color:white;">DATOS DE LA ORDEN</label>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                        </div>
                        <div class="row" hidden id="label_equipos">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                <label style="color:white;">DATOS DE LOS EQUIPOS</label>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                        </div>
                        <!-- <label id="label_orden" style="color:white;">DATOS DE LA ORDEN</label>
                        <label id="label_equipos" hidden style="color:white;">DATOS DE LOS EQUIPOS</label> -->
                    <!-- </div> -->
                    <br>
                    <div class="row">
                      <div id="modal_solicitud_inf5">
                      </div>
                      <div id="modal_solicitud_inf8">
                      </div>
                      <div class="col-12 table-wrapper" id="tabla_equipos">
                        <table class="table" >
                          <thead>
                            <th>#</th>
                            <th>EQUIPO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>SERVICIO</th>
                            <th>TAREA</th>
                          </thead>
                          <!-- <tbody id="tbody_orden_equipos" style="max-height: 150px;overflow: auto;display:inline-block;"> -->
                          <tbody id="tbody_orden_equipos" >
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>  

                  
                    
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
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
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
        $('#btn_nueva_busqueda').prop('hidden',true);
        $('#tabla_solicitudes').DataTable().clear();
        $('#tabla_solicitudes').DataTable().destroy();     
        $('#datatable_solicitudes').prop('hidden',true);
        $('#tabla_solicitudes2').DataTable().clear();
        $('#tabla_solicitudes2').DataTable().destroy();     
        $('#datatable_solicitudes2').prop('hidden',true);
        $('#btn_enviar').prop('disabled',false);
        
       
        
        
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
        $('#tabla_solicitudes').DataTable().clear();
        $('#tabla_solicitudes').DataTable().destroy();     
        $('#datatable_solicitudes').prop('hidden',true);
        $('#tabla_solicitudes2').DataTable().clear();
        $('#tabla_solicitudes2').DataTable().destroy();     
        $('#datatable_solicitudes2').prop('hidden',true);
        $('#btn_enviar').prop('disabled',false);

    });

    $('#btn_enviar').click(function(){
        $('#tabla_solicitudes').DataTable().clear();
        $('#tabla_solicitudes').DataTable().destroy();     
        $('#datatable_solicitudes').prop('hidden',true);
        var vCorreo = $('#vCorreo').val();
        var vToken = $('#vToken').val();
        if (vCorreo == '') {
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Ingresar el Correo</p>',
                // title: 'Favor de Ingresar el Correo.',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }
        else{ 
            Swal.fire({
                // position: 'bottom-right',
                // icon: 'warning',
                // width: 600,
                html: '<div class="fa-3x">'+
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
            $.ajax({
                url: '{{route("sendEmail2")}}',
                type: 'GET',
                data: {'vCorreoVerifica' : vCorreo}
            }).always(function(r) {
                console.log(r);
                if (r.exito==false) {
                    Swal.fire({
                        // position: 'bottom-right',
                        icon: 'warning',
                        html:'<p style="font-size:1rem !important;">El correo electrónico que ingresaste es inválido. Favor de verificarlo.'+
                            ' En caso de no contar con correo electrónico institucional @set.edu.mx, favor de realizar una solicitud para'+
                            ' generación de cuenta en el sitio: </p>'+
                            "<a style='font-size:1.5em;' href='https://correosset.tamaulipas.gob.mx' target='_blank'>https://correosset.tamaulipas.gob.mx</a>",
                        showConfirmButton: true,
                        confirmButtonColor: '#b50915',
                        allowOutsideClick: false,
                        confirmButtonText: 'Aceptar',
                        customClass: 'msj_aviso',
                        width: 600,
                        // Height: 600,
                        // timer: 5000
                    }) 
                }
                else{
                    Swal.fire({
                        // position: 'bottom-right',
                        icon: 'warning',
                        html:'<p style="font-size:1rem !important;">Favor de ingresar el token de autenticación que ha sido enviado al correo electrónico registrado.</p>',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonColor: '#b50915',
                        confirmButtonText: 'Aceptar',
                        width: 300,
                        customClass: 'msj_aviso'
                        // timer: 7000  //
                    }) 
                    $('#datatable_solicitudes').prop('hidden',true);
                    $('#vCorreo').prop('disabled',true);
                    $('#btn_enviar').prop('disabled',true);
                    gvToken = r.TOKEN;
                    $('#vToken').prop('disabled',false);
                    $('#btn_enviar2').prop('disabled',false);
                    // $('#btn_enviar').prop('hidden',true);
                    $('#btn_enviar2').prop('hidden',false);
                    $('#tabla_folio').prop('hidden',true);
                }

            });
        }
        
    });

    $('#btn_enviar2').click(function(){
        
        var vCorreo = $('#vCorreo').val();
        var vToken = $('#vToken').val();
        if (vToken == '') {
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar el Token',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }
        else if(vToken == gvToken){
            // $.ajax({
            //     url: '/ventanilla/consulta_folio_correo/',
            //     type: 'GET',
            //     data: {'vCorreo' : vCorreo}
            // }).always(function(r) {
                // $('#tabla_solicitudes').destroy();
                $('#tabla_solicitudes').DataTable().clear();
                $('#tabla_solicitudes').DataTable().destroy();     
                $('#datatable_solicitudes').prop('hidden',false);
                $(function () {
                    // $('#exampleModal').modal({backdrop: 'static', keyboard: false})
                    var dias = 2;
                    var table = $('#tabla_solicitudes').DataTable({
                    // dom: 'Bfrtip',
                        rowReorder: {
                            selector: 'td:nth-child(2)'
                        },
                        // buttons: [
                        //     {
                        //         extend: 'excelHtml5',
                        //         text: '<button class="btn btn-primary">Excel</button>',
                        //         exportOptions: {
                        //           columns: [ 0, 1, 2, 3 ]
                        //         }
                        //     },
                        //     {
                        //         extend: 'pdfHtml5',
                        //         text: '<button class="btn btn-primary">PDF</button>',
                        //         exportOptions: {
                        //             columns: [ 0, 1, 2, 3 ]
                        //         }
                        //     }
                        // ],
                        order: [4, 'desc'],
                        responsive: true,
                        processing: true,
                        // serverSide: true,
                        
                        ajax: {
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                        url: '{{route("consulta_folio_correo")}}',
                        data: {'vCorreo' : vCorreo}
                        },
                        columns: [
                            { data: null, render:function(data){
                                
                                if (data.folio_solicitud != null && data.folio_solicitud != data.folio_orden ) {
                                    return '<h6 class="mb-0 text-sm">'+data.folio_solicitud+'</h6><p class="text-xs text-secondary mb-0">'+data.folio_orden+'</p>';
                                
                                }
                                else if(data.folio_solicitud == '' || data.folio_solicitud == null){
                                    return '<h6 class="mb-0 text-sm">'+data.folio_orden+'</h6>';
                                    
                                }
                                else{
                                    return '<h6 class="mb-0 text-sm">'+data.folio_solicitud+'</h6>';

                                }
                            }
                            },
                            { data: null, render:function(data){
                                if (data.folio_solicitud != null && data.folio_solicitud != data.folio_orden ) {
                                return '<h6 class="mb-0 text-sm">'+data.estatus_solicitud+'</h6><p class="text-xs text-secondary mb-0">'+data.estatus+'</p>';
                                
                                }
                                else if(data.folio_solicitud == '' || data.folio_solicitud == null){
                                    return '<h6 class="mb-0 text-sm">'+data.estatus+'</h6>';
                                }
                                else{
                                return '<h6 class="mb-0 text-sm">'+data.estatus_solicitud+'</h6>';

                                }
                            }
                            },
                            // {data: 'folio', name: 'folio', className: "text-center"},
                            // {data: 'nombre_solicitante', name: 'nombre_solicitante'},
                            // {data: 'estatus_solicitud', name: 'estatus_solicitud', className: "text-center"},
                            
                            // { data: null, render:function(data){
                            //     return '<h6 class="mb-0 text-sm">'+data.nombrect+'</h6><p class="text-xs text-secondary mb-0">'+data.clave_ct+' ,  '+data.municipio+'</p>';
                            // }
                            // },
                            // {data: 'municipio', name: 'municipio', className: "text-center"},
                            {data: 'fecha_captacion', name: 'fecha_captacion', className: "text-center"},
                            {data: 'nombrect', name: 'nombrect', className: "text-center"},
                            
                            // {data: 'captacion', name: 'captacion', className: "text-center"},
                            // {data: 'fecha_apertura', name: 'fecha_apertura', className: "text-center"},
                            
                            // {data: 'desc_estatus_solicitud', name: 'desc_estatus_solicitud'},
                            // { data: null, render:function(data){
                            //     if(data.estatus>1){
                            //       if (data.estatus == 'RECHAZADA') {
                            //         return '<span style ="padding: 7px;  border-radius: 4px; background-color: #ff1a1a; color: white; text-align : center;">'+data.estatus+'</span>';
                            //       }
                            //       else if (data.estatus == 'APROBADA') {
                            //           return '<span style ="background-color: gray; padding: 7px;  border-radius: 4px; color: white; text-align : center;">'+data.estatus+'</span>';
                            //       }
                            //     }else{
                            //       if (data.estatus == 'RECHAZADA') {
                            //         return '<span style ="padding: 7px;  border-radius: 4px; background-color: #ff1a1a; color: white; text-align : center;">'+data.estatus+'</span>';
                            //       }
                            //       else if (data.estatus == 'APROBADA') {
                            //           return '<span style ="background-color: gray; padding: 7px;  border-radius: 4px; color: white; text-align : center;">'+data.estatus+'</span>';
                            //       }                
                            //     }
                            //   }
                            // },
                            {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
                        ],
                        "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total registros)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": ">",
                            "previous": "<"
                        }
                        },
                        columnDefs: [
                                    {
                                        // "targets": [ hideColumn ],
                                        "visible": false,
                                        // sortable: false
                                        // "searchable": true
                                    },
                        ]
                    });
                    
                });
                // $('#btn_enviar2').prop('disabled',true);

                // // $('#tabla_folio').DataTable();
                // $("#tabla_folio").append(html);
                $("#vCorreo").prop('disabled',false);
                $("#vCorreo").val('');
                $("#vToken").val('');
                $('#btn_enviar2').prop('disabled',true);
                $('#btn_enviar').prop('disabled',false);
                // $('#btn_nueva_busqueda').prop('hidden',false);
                // $('#vToken').prop('disabled',true);
                // $('#tabla_folio').prop('hidden',false);
                ////////////////////////////////////////////////

            // });
        }
        else{
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">El código registrado es incorrecto. Favor de verificarlo.</p>',
                showConfirmButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#b50915',
                confirmButtonText: 'Aceptar',
                customClass: 'msj_aviso'
            })
        }
        
    });

    $('#btn_buscar').click(function(){
        console.log('entro el folio');
        var vFolio = $('#vFolio').val();
        if (vFolio == '') {
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Ingresar el Folio</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            }) 
        }
        else{

            console.log(vFolio);
            $('#tabla_solicitudes2').DataTable().clear();
            $('#tabla_solicitudes2').DataTable().destroy();     
            $('#datatable_solicitudes2').prop('hidden',false);
            $(function () {
                // $('#exampleModal').modal({backdrop: 'static', keyboard: false})
                var dias = 2;
                var table = $('#tabla_solicitudes2').DataTable({
                // dom: 'Bfrtip',
                    // rowReorder: {
                    //     selector: 'td:nth-child(2)'
                    // },
                    // buttons: [
                    //     {
                    //         extend: 'excelHtml5',
                    //         text: '<button class="btn btn-primary">Excel</button>',
                    //         exportOptions: {
                    //           columns: [ 0, 1, 2, 3 ]
                    //         }
                    //     },
                    //     {
                    //         extend: 'pdfHtml5',
                    //         text: '<button class="btn btn-primary">PDF</button>',
                    //         exportOptions: {
                    //             columns: [ 0, 1, 2, 3 ]
                    //         }
                    //     }
                    // ],
                    order: [4, 'desc'],
                    responsive: true,
                    processing: true,
                    // ordering: false, Targets: [ 0, 1, 2, 3 ],
                    // ordering: false,
                    sortable: false,
                    // serverSide: true,
                    
                    ajax: {
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
                    url: '{{route("consulta_folio_solicitud")}}',
                    data: {'vFolio' : vFolio}
                    },
                    columns: [
                        { data: null, render:function(data){
                            if (data.folio != data.folio_orden) {
                            return '<h6 class="mb-0 text-sm">'+data.folio+'</h6><p class="text-xs text-secondary mb-0">'+data.folio_orden+'</p>';
                            
                            }
                            else{
                            return '<h6 class="mb-0 text-sm">'+data.folio+'</h6>';

                            }
                        }
                        },
                        // {data: 'folio', name: 'folio', className: "text-center"},
                        // {data: 'nombre_solicitante', name: 'nombre_solicitante'},
                        { data: null, render:function(data){
                            if (data.folio != data.folio_orden) {
                            return '<h6 class="mb-0 text-sm">'+data.estatus_solicitud+'</h6><p class="text-xs text-secondary mb-0">'+data.estatus+'</p>';
                            
                            }
                            else{
                            return '<h6 class="mb-0 text-sm">'+data.estatus_solicitud+'</h6>';

                            }
                        }
                        },
                        // {data: 'estatus_solicitud', name: 'estatus_solicitud', className: "text-center"},
                        
                        // { data: null, render:function(data){
                        //     return '<h6 class="mb-0 text-sm">'+data.nombrect+'</h6><p class="text-xs text-secondary mb-0">'+data.clave_ct+' ,  '+data.municipio+'</p>';
                        // }
                        // },
                        // {data: 'municipio', name: 'municipio', className: "text-center"},
                        {data: 'fecha_captacion', name: 'fecha_captacion', className: "text-center"},
                        {data: 'nombrect', name: 'nombrect', className: "text-center"},
                        
                        // {data: 'captacion', name: 'captacion', className: "text-center"},
                        // {data: 'fecha_apertura', name: 'fecha_apertura', className: "text-center"},
                        
                        // {data: 'desc_estatus_solicitud', name: 'desc_estatus_solicitud'},
                        // { data: null, render:function(data){
                        //     if(data.estatus>1){
                        //       if (data.estatus == 'RECHAZADA') {
                        //         return '<span style ="padding: 7px;  border-radius: 4px; background-color: #ff1a1a; color: white; text-align : center;">'+data.estatus+'</span>';
                        //       }
                        //       else if (data.estatus == 'APROBADA') {
                        //           return '<span style ="background-color: gray; padding: 7px;  border-radius: 4px; color: white; text-align : center;">'+data.estatus+'</span>';
                        //       }
                        //     }else{
                        //       if (data.estatus == 'RECHAZADA') {
                        //         return '<span style ="padding: 7px;  border-radius: 4px; background-color: #ff1a1a; color: white; text-align : center;">'+data.estatus+'</span>';
                        //       }
                        //       else if (data.estatus == 'APROBADA') {
                        //           return '<span style ="background-color: gray; padding: 7px;  border-radius: 4px; color: white; text-align : center;">'+data.estatus+'</span>';
                        //       }                
                        //     }
                        //   }
                        // },
                        {data: 'action', name: 'action', className: "text-center"},
                    ],
                    "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": ">",
                        "previous": "<"
                    }
                    },
                    "bFilter": false,
                    "bInfo": false,
                    "bPaginate": false,
                    columnDefs: [
                                {
                                    // "targets": [ hideColumn ],
                                    "visible": false,
                                    // "searchable": true
                                    
                                },
                    ]
                });
                
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

    // $("#vFolio").keyup(function(){
    //     var txt = $(this).val(toUpperCase);
    //     $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
    // });

    $('#btn_regresar').click(function(){
        window.location.href = "indexVentanilla";
    });

    function Mostrar_Solicitud(id){
        contador_detalle_equipo = 1;
        console.log(id);
        html1='';
        html2='';
        html3='';
        html4='';
        html5='';
        html6='';
        html7='';
        html8='';
        html9='';
        html10='';
        html11='';
        $('#div_inf_orden').prop('hidden',true);
        $('#div_inf_rechazada').prop('hidden',true);
        $('#div_inf_cancelada').prop('hidden',true);
        $('#div_inf_cancelada2').prop('hidden',true);
        
        
        $('#modal_solicitud_inf').html(html1);
        $('#modal_solicitud_inf2').html(html2);
        $('#modal_solicitud_inf5').html(html3);
        $('#modal_solicitud_inf6').html(html8);
        $('#modal_solicitud_inf7').html(html9);
        $('#modal_solicitud_inf8').html(html10);
        $('#modal_solicitud_inf9').html(html11);
        
        // $('#modal_solicitud_inf5').append(html3);
        // $('#modal_solicitud_inf4').html(html4);
        $('#tbody_orden_equipos').html(html4);
        $('#span_solicitud').html(html5);
        $('#span_estatus').html(html6);
        $('#span_orden').html(html7);
        // $('#table_tipo_servicio').html(html4);
        
        
        $('#numero_solicitud').html('');

        
        $.ajax({
            url: '{{route("buscar_folio_ventanilla")}}',
            type: 'GET',
            data: {'id' : id}
            }).always(function(r) {
                // console.log(r.data[0]['folio'].substr(1, 1));
                console.log(r);
                if (r.data[0]['bandera'] == 0){
                    // if (r.id_estatus_orden == 5) {
                    //     $('#div_inf_orden').prop('hidden',false);
                    //     $('#tabla_equipos').prop('hidden',true);
                    //     // console.log('entro');
                    //     html10+='<div class="row">';                       
                    //         html10+='<div class="col-4">';
                    //             html10+='<label>Comentarios: &nbsp;</label>';
                    //             if (r.inf_atendida[0]['observaciones'] !='' || r.inf_atendida[0]['observaciones'] != undefined) {
                    //                 html10+='<span>Sin comentarios</span>';
                    //             }
                    //             else{
                    //                 html10+='<span>'+r.inf_atendida[0]['observaciones']+'</span>';
                    //             }
                    //         html10+='</div>';
                    //         html10+='<div class="col-4">';
                    //             html10+='<label>Archivo: &nbsp;</label>';
                    //             html10+='<a href="'+r.inf_atendida[0]['ruta_archivo']+'" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                    //         html10+='</div>';
                    //     html10+='</div>'; 
                    // }
                    
                    // else{
                        console.log('entro la otra');
                        html5+='No. de Solicitud: '+r.data[0]['folio']+'';
                        
                        if (r.folio_orden!= null) {
                            html6+='Estatus Orden: '+r.estatus+'';
                            html7+='No. de Orden : '+r.folio_orden+'';
                        }
                        else{
                            html6+='Estatus Solicitud: '+r.data[0]['estatus']+'';
                        }
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
                            html1+='<div class="col-5">';
                                html1+='<label>Nombre del Director : &nbsp;</label>';
                                html1+='<span>'+r.data[0]['director']+'</span>';
                            html1+='</div>';
                            html1+='<div class="col-4">';
                                html1+='<label>Turno : &nbsp;</label>';
                                html1+='<span>'+r.data[0]['desc_turno']+'</span>';
                            html1+='</div>';
                            html1+='<div class="col-3">';
                                html1+='<label>Nivel Educativo : &nbsp;</label>';
                                html1+='<span>'+r.data[0]['subnivel']+'</span>';
                            html1+='</div>';
                        html1+='</div>';
                        html1+='<div class="row">';
                            html1+='<div class="col-5">';
                                html1+='<label>Dirección : &nbsp;</label>';
                                html1+='<span>'+r.data[0]['domicilio']+'</span>';
                            html1+='</div>';
                        html1+='</div>';
                        html1+='<div class="row">';
                            if (r.folio_orden!= null) {
                                html1+='<div class="col-3">';
                                    html1+='<label>Estatus Solicitud: &nbsp;</label>';
                                    html1+='<span>'+r.data[0]['estatus']+'</span>';
                                html1+='</div>';
                                html1+='<div class="col-3">';
                                    html1+='<label>Fecha Solicitud: &nbsp;</label>';
                                    html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
                                html1+='</div>';
                                html1+='<div class="col-3">';
                                    html1+='<label>Estatus Orden: &nbsp;</label>';
                                    html1+='<span>'+r.estatus+'</span>';
                                html1+='</div>';
                                html1+='<div class="col-3">';
                                    html1+='<label>Fecha Orden: &nbsp;</label>';
                                    html1+='<span>'+r.data[0]['fecha_inicial']+'</span>';
                                html1+='</div>';
                            }
                            else{
                                html1+='<div class="col-5">';
                                    html1+='<label>Estatus Solicitud: &nbsp;</label>';
                                    html1+='<span>'+r.data[0]['estatus']+'</span>';
                                html1+='</div>';
                                html1+='<div class="col-4">';
                                    html1+='<label>Fecha Solicitud: &nbsp;</label>';
                                    html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
                                html1+='</div>';
                            }
                            
                        html1+='</div>';
                        
                        
                        
                        html2+='<div class="row">';
                        html2+='<div class="col-5">';
                            html2+='<label>Nombre : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['solicitante']+'</span>';
                        html2+='</div>';
                        html2+='<div class="col-5">';
                            html2+='<label>Teléfono : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['telef_solicitante']+'</span>';
                        html2+='</div>';
                        html2+='</div>';
                        html2+='<div class="row">';
                        html2+='<div class="col-12">';
                            html2+='<label>Correo Electrónico : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['correo_solic']+'</span>';
                        html2+='</div>';
                        html2+='</div>';
                        html2+='<div class="row">';
                        html2+='<div class="col-6">';
                            html2+='<label>Descripción del Reporte : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['descrip_reporte']+'</span>';
                        html2+='</div>';
                        html2+='</div>';
                        if (r.inf_atendida!='') {
                            $('#div_inf_orden').prop('hidden',false);
                            $('#tabla_equipos').prop('hidden',true);
                            // console.log('entro');
                            html10+='<div class="row">';                       
                                html10+='<div class="col-4">';
                                    html10+='<label>Comentarios: &nbsp;</label>';
                                    if (r.inf_atendida[0]['observaciones'] !='' || r.inf_atendida[0]['observaciones'] != undefined) {
                                        html10+='<span>Sin comentarios</span>';
                                    }
                                    else{
                                        html10+='<span>'+r.inf_atendida[0]['observaciones']+'</span>';
                                    }
                                html10+='</div>';
                                var nombre= r.inf_atendida[0]['nombre_archivo'];
                                let urlArchivo = '{{ asset("public/cierreOrden/:id") }}'; //////31/08/2023 
                                urlArchivo = urlArchivo.replace(':id', nombre);
                                // $(location).attr('href',urlArchivo);
                                html10+='<div class="col-4">';
                                    html10+='<label>Archivo: &nbsp;</label>';
                                    html10+='<a href="'+urlArchivo+'" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                                html10+='</div>';
                            html10+='</div>';
                        }
                        else if (r.datos_equipos != '' && r.datos_equipos != undefined && r.inf_atendida=='') {
                            console.log(r.datos_equipos);
                            $('#div_inf_orden').prop('hidden',false);
                            $('#tabla_equipos').prop('hidden',false);
                            if (r.tecnicos_auxiliares !='' && r.tecnicos_auxiliares != undefined) {
                                $('#label_orden').prop('hidden', false);
                                $('#label_equipos').prop('hidden', true);
                                html3+='<div class="row">';
                                html3+='<div class="col-5">';
                                    html3+='<label>Técnico Encargado: &nbsp;</label>';
                                    for (let i = 0; i < r.tecnicos_auxiliares.length; i++) {
                                    if (r.tecnicos_auxiliares[i]['es_responsable'] == 1) {
                                        html3+='<span><br>'+r.tecnicos_auxiliares[i]['nombre_completo']+'</span>';
                                    }
                                    else{
                                        html3+='';
                                    }
                                    }
                                html3+='</div><br>';
                                html3+='<div class="col-5">';
                                    html3+='<label>Técnicos Auxiliares : &nbsp;</label><br>';
                                    for (let i = 0; i < r.tecnicos_auxiliares.length; i++) {
                                    if (r.tecnicos_auxiliares[i]['es_responsable'] == 0) {
                                        html3+='<span>'+r.tecnicos_auxiliares[i]['nombre_completo']+'<br></span>';
                                    }
                                    else{
                                        html3+='';
                                    }
                                    }
                                html3+='</div>';
                                html3+='</div>';                
                            }
                            else{
                                $('#label_orden').prop('hidden', true);
                                $('#label_equipos').prop('hidden', false);
                            }

                            var id_equipo_detalle = '';
                            var desc_problema = '';
                            var tipo_equipo = '';
                            var servicio = '';
                            // var tarea = '';
                            console.log(r.datos_equipos);
                            for (let i = 0; i < r.datos_equipos.length; i++) {
                                html4+='<tr>';
                                // if (id_equipo_detalle+r.datos_equipos[i]['tipo_equipo'] == id_equipo_detalle+tipo_equipo) {
                                // html4+='<td></td>';
                                // }
                                // else{ https://sistemaset.tamaulipas.gob.mx/CasCete
                                
                                if (r.datos_equipos[i]['id_equipo_detalle'] == r.datos_equipos[i]['id_principal']) {
                                    html4+='<td>'+contador_detalle_equipo+'</td>';
                                    contador_detalle_equipo = contador_detalle_equipo + 1; 
                                }
                                else{
                                    html4+='<td></td>';
                                }
                                html4+='<td>- '+r.datos_equipos[i]['tipo_equipo']+'</td>';
                                // }
                                // if (r.datos_equipos[i]['desc_problema'] == desc_problema) {
                                // html4+='<td></td>';
                                // }
                                // else{
                                html4+='<td style="white-space: pre-line; word-break: break-word;">- '+r.datos_equipos[i]['desc_problema']+'</td>';
                                // }
                                // if (r.datos_equipos[i]['servicio'] == servicio) {
                                // html4+='<td></td>';
                                // }
                                // else{
                                html4+='<td>- '+r.datos_equipos[i]['servicio']+'</td>';
                                // }
                                html4+='<td>- '+r.datos_equipos[i]['tarea']+'</td>';
                                html4+='</tr>'; 

                                id_equipo_detalle = r.datos_equipos[i]['id_equipo_detalle'];
                                desc_problema = r.datos_equipos[i]['desc_problema'];
                                tipo_equipo = r.datos_equipos[i]['tipo_equipo'];
                                servicio = r.datos_equipos[i]['servicio'];
                                
                            }
                            
                                        
                        }

                            

                    // }
                    if (r.id_estatus == 6) {
                        $('#div_inf_rechazada').prop('hidden',false);

                        console.log('entro la rechazada');
                        // html5+='No. de Solicitud: '+r.data[0]['folio']+'';
                        // html6+='Estatus Solicitud: '+r.data[0]['estatus']+'';
                        html8+='<div class="row">';
                        html8+='<div class="col-5">';
                            html8+='<label>Motivo : &nbsp;</label>';
                            html8+='<span>'+r.motivo_rechazo[0]['motivo']+'</span>';
                        html8+='</div>';
                        html8+='<div class="col-5">';
                            html8+='<label>Comentarios : &nbsp;</label>';
                            html8+='<span>'+r.motivo_rechazo[0]['comentario']+'</span>';
                        html8+='</div>';
                        html8+='</div>';
                        // $('#tbody_orden_equipos').append(html4);
                        // $('#span_solicitud').append(html5);
                        // $('#span_estatus').append(html6);
                        // $('#span_orden').append(html7);
                        
                        // $('#modal_solicitud_inf').append(html1);
                        // $('#modal_solicitud_inf2').append(html2);
                        // $('#modal_solicitud_inf5').append(html3);
                        // $('#modal_solicitud_inf6').append(html8);
                    }
                    else if(r.id_estatus == 7){
                        $('#div_inf_cancelada').prop('hidden',false);

                        console.log('entro la cancelada');
                        html9+='<div class="row">';
                        html9+='<div class="col-5">';
                            html9+='<label>Motivo : &nbsp;</label>';
                            html9+='<span>'+r.motivo_cancelada[0]['motivo']+'</span>';
                        html9+='</div>';
                        html9+='<div class="col-5">';
                            html9+='<label>Comentarios : &nbsp;</label>';
                            if (r.motivo_cancelada[0]['comentarios'] == null || r.motivo_cancelada[0]['comentarios'] == '') {
                                html9+='<span>No tiene comentarios</span>';
                            }
                            else{
                                html9+='<span>'+r.motivo_cancelada[0]['comentarios']+'</span>';
                            }
                            
                        html9+='</div>';
                        html9+='</div>';
                        // $('#tbody_orden_equipos').append(html4);
                        // $('#span_solicitud').append(html5);
                        // $('#span_estatus').append(html6);
                        // $('#span_orden').append(html7);
                        
                        // $('#modal_solicitud_inf').append(html1);
                        // $('#modal_solicitud_inf2').append(html2);
                        // $('#modal_solicitud_inf5').append(html3);
                        // $('#modal_solicitud_inf7').append(html8);
                    }
                    $('#modal_solicitud_inf').append(html1);
                        $('#modal_solicitud_inf2').append(html2);
                        $('#modal_solicitud_inf5').append(html3);
                        $('#span_solicitud').append(html5);
                        $('#tbody_orden_equipos').append(html4);
                        $('#span_estatus').append(html6);
                        $('#span_orden').append(html7);
                        $('#modal_solicitud_inf6').append(html8);
                        $('#modal_solicitud_inf7').html(html9);
                        $('#modal_solicitud_inf8').html(html10);
                        $('#modal_solicitud_inf9').html(html11);
                }
                else{
                    //    console.log(r); 
                    console.log('entro la orden');
                    html5+='No. de Orden: '+r.data[0]['folio']+'';
                        
                    html6+='Estatus Orden: '+r.estatus+'';

                    // console.log(r);
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
                        html1+='<div class="col-5">';
                            html1+='<label>Nombre del Director : &nbsp;</label>';
                            html1+='<span>'+r.data[0]['director']+'</span>';
                        html1+='</div>';
                        html1+='<div class="col-4">';
                            html1+='<label>Turno : &nbsp;</label>';
                            html1+='<span>'+r.data[0]['desc_turno']+'</span>';
                        html1+='</div>';
                        html1+='<div class="col-3">';
                            html1+='<label>Nivel Educativo : &nbsp;</label>';
                            html1+='<span>'+r.data[0]['subnivel']+'</span>';
                        html1+='</div>';
                    html1+='</div>';
                    html1+='<div class="row">';
                        html1+='<div class="col-5">';
                            html1+='<label>Dirección : &nbsp;</label>';
                            html1+='<span>'+r.data[0]['domicilio']+'</span>';
                        html1+='</div>';
                        // html1+='<div class="col-3">';
                        //     html1+='<label>Turno : &nbsp;</label>';
                        //     html1+='<span>'+r.data[0]['desc_turno']+'</span>';
                        // html1+='</div>';
                    html1+='</div>';
                    html1+='<div class="row">';
                        html1+='<div class="col-5">';
                            html1+='<label>Estatus Orden: &nbsp;</label>';
                            html1+='<span>'+r.estatus+'</span>';
                        html1+='</div>';
                        html1+='<div class="col-4">';
                            html1+='<label>Fecha Orden: &nbsp;</label>';
                            html1+='<span>'+r.data[0]['fecha_inicial']+'</span>';
                        html1+='</div>';
                    html1+='</div>';
                    
                    
                    
                    html2+='<div class="row">';
                        html2+='<div class="col-5">';
                            html2+='<label>Nombre : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['solicitante']+'</span>';
                        html2+='</div>';
                        html2+='<div class="col-5">';
                            html2+='<label>Teléfono : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['telef_solicitante']+'</span>';
                        html2+='</div>';
                    html2+='</div>';
                    html2+='<div class="row">';
                        html2+='<div class="col-12">';
                            html2+='<label>Correo Electrónico : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['correo_solic']+'</span>';
                        html2+='</div>';
                    html2+='</div>';
                    html2+='<div class="row">';
                        html2+='<div class="col-6">';
                            html2+='<label>Descripción del Reporte : &nbsp;</label>';
                            html2+='<span>'+r.data[0]['descrip_reporte']+'</span>';
                        html2+='</div>';
                    html2+='</div>';
                    // console.log(r.id_estatus);
                    if (r.id_estatus == 5) {
                        $('#div_inf_orden').prop('hidden',false);
                        $('#tabla_equipos').prop('hidden',true);
                        // console.log('entro');
                        html10+='<div class="row">';                       
                            html10+='<div class="col-4">';
                                html10+='<label>Comentarios: &nbsp;</label>';
                                if (r.inf_atendida[0]['observaciones'] !='' || r.inf_atendida[0]['observaciones'] != undefined) {
                                    html10+='<span>Sin comentarios</span>';
                                }
                                else{
                                    html10+='<span>'+r.inf_atendida[0]['observaciones']+'</span>';
                                }
                            html10+='</div>';
                            var nombre= r.inf_atendida[0]['nombre_archivo'];
                                let urlArchivo = '{{ asset("public/cierreOrden/:id") }}'; //////31/08/2023 
                                urlArchivo = urlArchivo.replace(':id', nombre);
                                // $(location).attr('href',urlArchivo);
                                html10+='<div class="col-4">';
                                    html10+='<label>Archivo: &nbsp;</label>';
                                    html10+='<a href="'+urlArchivo+'" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                                html10+='</div>';
                        html10+='</div>';
                    }
                    else if (r.id_estatus == 7) {
                        // $('#div_inf_orden').prop('hidden',false);
                        $('#tabla_equipos').prop('hidden',true);
                        $('#div_inf_cancelada2').prop('hidden',false);
                        
                        // console.log('entro');
                        html11+='<div class="row">';
                            html11+='<div class="col-5">';
                                html11+='<label>Motivo : &nbsp;</label>';
                                html11+='<span>'+r.motivo_cancelada[0]['motivo']+'</span>';
                            html11+='</div>';
                            html11+='<div class="col-5">';
                                html11+='<label>Comentarios : &nbsp;</label>';
                                if (r.motivo_cancelada[0]['comentarios'] == null || r.motivo_cancelada[0]['comentarios'] == '') {
                                    html11+='<span>No tiene comentarios</span>';
                                }
                                else{
                                    html11+='<span>'+r.motivo_cancelada[0]['comentarios']+'</span>';
                                }
                                
                            html11+='</div>';
                        html11+='</div>';
                    }
                    else{
                        if (r.datos_equipos != '' && r.datos_equipos != undefined) {
                            console.log(r.datos_equipos);
                            $('#div_inf_orden').prop('hidden',false);
                            $('#tabla_equipos').prop('hidden',false);
                            if (r.tecnicos_auxiliares !='' && r.tecnicos_auxiliares != undefined) {
                                $('#label_orden').prop('hidden', false);
                                $('#label_equipos').prop('hidden', true);
                                
                                html3+='<div class="row">';
                                html3+='<div class="col-5">';
                                    html3+='<label>Técnico Encargado: &nbsp;</label>';
                                    for (let i = 0; i < r.tecnicos_auxiliares.length; i++) {
                                    if (r.tecnicos_auxiliares[i]['es_responsable'] == 1) {
                                        html3+='<span><br>'+r.tecnicos_auxiliares[i]['nombre_completo']+'</span>';
                                    }
                                    else{
                                        html3+='';
                                    }
                                    }
                                html3+='</div><br>';
                                html3+='<div class="col-5">';
                                    html3+='<label>Técnicos Auxiliares : &nbsp;</label><br>';
                                    for (let i = 0; i < r.tecnicos_auxiliares.length; i++) {
                                    if (r.tecnicos_auxiliares[i]['es_responsable'] == 0) {
                                        html3+='<span>'+r.tecnicos_auxiliares[i]['nombre_completo']+'<br></span>';
                                    }
                                    else{
                                        html3+='';
                                    }
                                    }
                                html3+='</div>';
                                html3+='</div>';                
                            }
                            else{
                                $('#label_orden').prop('hidden', true);
                                $('#label_equipos').prop('hidden', false);
                            }

                            var id_equipo_detalle = '';
                            var desc_problema = '';
                            var tipo_equipo = '';
                            var servicio = '';
                            // var tarea = '';
                            console.log(r.datos_equipos);
                            for (let i = 0; i < r.datos_equipos.length; i++) {
                                html4+='<tr>';
                                
                                    if (r.datos_equipos[i]['id_equipo_detalle'] == r.datos_equipos[i]['id_principal']) {
                                        html4+='<td>'+contador_detalle_equipo+'</td>';
                                        contador_detalle_equipo = contador_detalle_equipo + 1; 
                                    }
                                    else{
                                        html4+='<td></td>';
                                    }
                                    html4+='<td>- '+r.datos_equipos[i]['tipo_equipo']+'</td>';
                                    html4+='<td style="white-space: pre-line; word-break: break-word;">- '+r.datos_equipos[i]['desc_problema']+'</td>';
                                    html4+='<td>- '+r.datos_equipos[i]['servicio']+'</td>';
                                    html4+='<td>- '+r.datos_equipos[i]['tarea']+'</td>';
                                html4+='</tr>'; 

                                id_equipo_detalle = r.datos_equipos[i]['id_equipo_detalle'];
                                desc_problema = r.datos_equipos[i]['desc_problema'];
                                tipo_equipo = r.datos_equipos[i]['tipo_equipo'];
                                servicio = r.datos_equipos[i]['servicio'];
                                
                            }
                        
                                    
                        }
                    }

                    
                    $('#modal_solicitud_inf').append(html1);
                    $('#modal_solicitud_inf2').append(html2);
                    $('#modal_solicitud_inf5').append(html3);
                    $('#modal_solicitud_inf8').append(html10);
                    $('#span_solicitud').append(html5);
                    $('#tbody_orden_equipos').append(html4);
                    $('#span_estatus').append(html6);
                    $('#span_orden').append(html7);
                    $('#modal_solicitud_inf9').append(html11);
                }
                

                $('#exampleModal').modal('show');

        });
    }
</script>
@endsection