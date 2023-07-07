@extends('layouts.contentIncludes')
@section('title','CAS CETE')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')

<div class="container-fluid py-4 mt-3">
  <!-- <input type="hidden" id="hiddenIdUser" name="hiddenIdUser" class="form-control"  value="{{auth()->id()}}" > -->  

    <div class="row mt-4">
      
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Administración de Solicitudes de Servicio</h1>
        </div>
    </div>
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card ">

        <div class="card-header pb- p-3">
          <div class="d-flex justify-content-between">
            <h6 class="mb-2">Solicitudes</h6>
          </div>
        </div>

        <div class="container">
          <!-- <div class="row"> -->
              <div class="table-responsive">
                  <table class="table " id="tabla_solicitudes" width="100%">
                    


                      <thead>
                          <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Folio de Solicitud</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Municipio</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha Solicitud</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Medio de Captacion</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tiempo de Apertura</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estatus</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="100px">Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              </div>
          <!-- </div> -->
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                  <!-- <div class="row" id="numero_solicitud"> -->
                  <!-- <div>
                    <div class="row">
                      <div class="col-5" >
                        <span id="span_solicitud"></span>
                      </div>
                      <div class="col-4" >
                        <span id="span_estatus"></span>
                      </div>
                      <div class="col-3" id="span_orden">
                      </div>
                   </div>
                  </div> -->
                  <div class="container ">
                    <div class="row ">
                        <div class="col-4 " id="span_solicitud">
                            <!-- col-sm-7 -->
                        </div>
                        <div class="col-4 " id="span_estatus">
                            <!-- col-sm-5 -->
                        </div>
                        <div class="col-4 " id="span_orden">
                            <!-- col-sm-5 -->
                        </div>
                    </div>
                  </div>
                    <!-- <h5 class="modal-title" id="numero_solicitud"></h5> -->
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
                    <label style="color:white;">DATOS DEL SOLICITANTE</label>
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
                          <!-- <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_servicio">+</button> -->
                        </div>
                        <div class="col-3" id="select_tipo_tarea"></div>
                        <div class="col-1">
                          <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTarea"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>

                          <!-- <button class="btn btn-secondary" disabled style="font-size:0.80em;" id="btn_arreglo_registro">+</button> -->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-3"></div>
                        <!-- <div class="col-3"><table id="table_tipo_servicio"></table></div> -->
                        <div class="col-3"><table id="table_servicio"></table></div>
                        <div class="col-1"></div>
                        <div class="col-5"><table id="table_tarea"></table></div>
                        <div class="col-1"></div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-7">
                          <label style="font-size:0.75em;">DESCRIPCION DEL PROBLEMA O SOPORTE A REALIZAR</label>
                          <textarea class="form-control" id="txtDescripcionSoporte" ></textarea>
                          <!-- <textarea class="form-control" id="vDescripcion_Problema" ></textarea> -->
                        </div>
                        <div class="col-3"></div>
                        <div class="col-1"></div>
                        <div class="col-1"></div>
                      </div>
                      <!-- <div style="text-align: right;">
                          <input id="btn_replicar" type="checkbox">&nbsp;&nbsp;<label style="font-size:0.65em;">Replicar Datos en el Siguiente Equipo</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_equipo">Agregar</button>
                      </div> -->
                      
                      <br>
                      <!-- <div >
                        <table class="table" id="listado_equipos"  style="font-size:0.80em;">
                            <tr >
                                <th>TIPO DE EQUIPO</th>
                                <th>TIPO DE SERVICIO</th>
                                <th>TIPO DE TAREA</th>
                                <th>DESCRIPCION DEL SERVICIO</th>
                                <th></th>
                            </tr>
                            
                        </table>
                    </div> -->
                    <div class="col-8">
                                            <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                                <span>LISTADO DE TAREAS</span>
                                                <ul id="ulTarea" style="font-size:0.75rem;">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                    </div>
                    <div style="text-align: right;" id="div_añadir_equipo" hidden>
                          <input id="btn_replicar" type="checkbox">&nbsp;&nbsp;<label style="font-size:0.65em;">Replicar Datos en el Siguiente Equipo</label>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="button" class="btn colorBtnPrincipal" id="btnAgregarEquipo" >AÑADIR EQUIPO</button>

                          <!-- <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_registro">Agregar</button> -->
                      </div>
                    <div class="col-12" id="divTablaEquipos">
                      <table class="table">
                          <thead>
                              <th>EQUIPO</th>
                              <th>DESCRIPCION</th>
                              <th>SERVICIO</th>
                              <th>TAREA</th>
                              <th>OPCIONES</th>
                          </thead>
                          <tbody id="tbEquipos">

                          </tbody>
                      </table>
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
                    <!-- <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" onclick="fnGuardar()"> GUARDAR</button> -->
                    <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" > GUARDAR</button>

                    <button type="button"  class="btn btn-secondary " id="btn_cerrar" data-bs-dismiss="modal">Cerrar</button>
                    
                </div>
            </div>
        </div>
  </div>
  

  
</div>




@endsection

@section('page-scripts')
<script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<!-- <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.css"> -->
<!-- <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.js"> -->

<script>
var prueba_arreglo1 = [];
var prueba_arreglo2 = [];
var ias = 0;

var arreglo_tipo_equipo = [];
var arreglo_tipo_servicio = [];
var arreglo_tipo_tarea = [];
var arreglo_tipo_equipo_tarea = [];
var arreglo_tipo_servicio_tarea = [];
var arreglo_servicios = [];
var arreglo_tabla = [];




var posicion_arreglo_servicios = 0;
var contador_servicio = 0;
var contador_id_tabla = 0;
var contador_total = 0;


var arreglo_equipos_servicios = [];
var arreglo_servicios_tareas = [];
var arreglo_registro = [];
var arreglo_registro2 = [];
var contador_registro = 0;
var contador_registro2 = 0;
var bandera_servicio = 0;
var contador_id_tabla_registro = 0;
var contador_total_registro = 0;
var folio_solicitud_global = 0;
var identificador_arreglo = 0;
var contador_total_registro2 = 0;
var contador_arreglo_tabla = 0;

// var variable_eliminar = 0;
let arrTareas = [];
let arrServicios = [];
var arrEquipos = [];
let arrEscuelaTurno = [];
var id_solicitud_global
var cond_show_edit = 0;


  $(function () {
    $('#exampleModal').modal({backdrop: 'static', keyboard: false})
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
        order: [3, 'desc'],
        responsive: true,
        processing: true,
        serverSide: true,
        
        ajax: {
        type: 'GET',
        headers: {'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')},
        url: "/solicitudes/solicitudes_registros/"
        },
        columns: [
            {data: 'folio', name: 'folio', className: "text-center"},
            // {data: 'nombre_solicitante', name: 'nombre_solicitante'},
            { data: null, render:function(data){
                return '<h6 class="mb-0 text-sm">'+data.solicitante+'</h6><p class="text-xs text-secondary mb-0">'+data.clave_ct+' ,  '+data.municipio+'</p>';
              }
            },
            {data: 'municipio', name: 'municipio', className: "text-center"},
            {data: 'fecha_captacion', name: 'fecha_captacion', className: "text-center"},
            {data: 'captacion', name: 'captacion', className: "text-center"},
            {data: 'fecha_apertura', name: 'fecha_apertura', className: "text-center"},
            {data: 'estatus', name: 'estatus', className: "text-center"},
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
            {data: 'action', name: 'action', orderable: false, searchable: false},
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
        }
    });

    $.ajax({
        url: '/solicitudes/selects_equipo_servicio/',
        type: 'GET'
        // data: {'arreglo_inf' : arreglo_inf}
        }).always(function(r) {
            // console.log(r);
            arreglo_tipo_equipo = r.data['tipo_equipo'];
            arreglo_tipo_servicio = r.data['tipo_servicio'];
            arreglo_tipo_tarea = r.data['tipo_tarea'];
            arreglo_tipo_equipo_tarea = r.data['tipo_equipo_tarea'];
            arreglo_tipo_servicio_tarea = r.data['tipo_servicio_tarea'];
            // console.log(arreglo_tipo_equipo);
            // console.log(arreglo_tipo_servicio);
            
    });
    
  });

  function fnMostrarInfo(id){
    $('#titulo_equipos').prop('hidden',true);
    $('#div_añadir_equipo').prop('hidden',true);
    // $('#btn_replicar').prop('hidden',true);
    // $('#btnAgregarEquipo').prop('hidden',true);
    console.log('entro al detalle');
    var bandera_orden = 0;
    $("#divTablaEquipos").prop('hidden',true);
    $("#btnGuardar").prop('hidden',true);

    html1='';
    html2='';
    html3='';
    html4='';
    html5='';
    html6='';
    html7='';

    $('#modal_solicitud_inf').html(html1);
    $('#modal_solicitud_inf2').html(html2);
    $('#span_solicitud').html(html5);
    $('#span_estatus').html(html6);
    $('#span_orden').html(html7);
    $('#modal_solicitud_inf3').prop('hidden',true);
    $('#modal_solicitud_inf4').prop('hidden',true);
    // $('#table_tipo_servicio').html(html4);
    
    
    $('#numero_solicitud').html('');

    
    $.ajax({
        url: '/solicitudes/buscar_folio/',
        type: 'GET',
        data: {'id' : id, 'bandera_orden' : bandera_orden}
        }).always(function(r) {
          console.log(r);

          if (r.data[0]['id_estatus'] != 1 || r.data[0]['id_estatus'] != 6 || r.data[0]['id_estatus'] != 7) {
            console.log('tiene equipos o tecnicos');
          }

            html5+='No. de Solicitud: '+r.data[0]['folio']+'';
            html6+='Estatus : '+r.estatus+'';
            if (r.folio_orden!= null) {
              html7+='No. de Orden : '+r.folio_orden+'';
            }

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
                html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                  html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
              html1+='</div>';
              html1+='<div class="col-2">';
                html1+='<label>Estatus : &nbsp;</label>';
                  html1+='<span>'+r.data[0]['estatus']+'</span>';
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
            
            // html2+='<div class="row">';
            //   html2+='<div class="col-6">';
            //     html2+='<label>Tipo de Orden : &nbsp;</label>';
            //       html2+='<span>Ordinaria</span>';
            //   html2+='</div>';
            // html2+='</div>';
            // html2+='<div class="row">';
            //   html2+='<div class="col-12">';
            //     html2+='<label>Dependencia que Atiende en el Servicio : &nbsp;</label>';
            //       html2+='<span>Centro Estatal de Tecnologia Educativa</span>';
            //   html2+='</div>';
            // html2+='</div>';
            html2+='<div class="row">';
              html2+='<div class="col-5">';
                html2+='<label>Nombre : &nbsp;</label>';
                  html2+='<span>'+r.data[0]['solicitante']+'</span>';
              html2+='</div>';
              html2+='<div class="col-5">';
                html2+='<label>Telefono : &nbsp;</label>';
                  html2+='<span>'+r.data[0]['telef_solicitante']+'</span>';
              html2+='</div>';
            html2+='</div>';
            html2+='<div class="row">';
              html2+='<div class="col-12">';
                html2+='<label>Correo Electronico : &nbsp;</label>';
                  html2+='<span>'+r.data[0]['correo_solic']+'</span>';
              html2+='</div>';
            html2+='</div>';
            html2+='<div class="row">';
              html2+='<div class="col-6">';
                html2+='<label>Descripcion del Reporte : &nbsp;</label>';
                  html2+='<span>'+r.data[0]['descrip_reporte']+'</span>';
              html2+='</div>';
            html2+='</div>';

        $('#span_solicitud').append(html5);
        $('#span_estatus').append(html6);
        $('#span_orden').append(html7);
        
        $('#modal_solicitud_inf').append(html1);
        $('#modal_solicitud_inf2').append(html2);

    });

    $('#exampleModal').modal('show');
    // $('#modal_body')

    $('#btn_aprobar_solicitud').click(function(){
      Swal.fire({
        title: 'Esta seguro de Aprobar la Solicitud #'+folio_solicitud+' ?',
        icon: 'warning',
        showCancelButton: true,
        customClass: 'msj_solicitud',
        confirmButtonColor: '#b50915',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si'
        }).then((result) => {
        if (result.isConfirmed) {

          Swal.fire({
              title: 'Aprobada',
              text: 'Se ha Aprobado con Exito la Solicitud, su # de Orden es :',
              customClass: 'msj_solicitud',
              icon: 'success',
              confirmButtonColor: '#b50915'
            }).then((result) => {
            // if (result.isConfirmed) {
                
                // window.location.href = "indexVentanilla";
            // }
          })
        }
      })
    });

    $('#btn_rechazar_solicitud').click(function(){
      Swal.fire({
        title: 'Esta seguro de Rechazar la Solicitud #'+folio_solicitud+' ?',
        icon: 'warning',
        showCancelButton: true,
        customClass: 'msj_solicitud',
        confirmButtonColor: '#b50915',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Si'
        }).then((result) => {
        if (result.isConfirmed) {

          Swal.fire({
              title: 'Rechazada',
              text: 'Se ha Rechazado con Exito la Solicitud #'+folio_solicitud+'',
              customClass: 'msj_solicitud',
              icon: 'success',
              confirmButtonColor: '#b50915'
            }).then((result) => {
            // if (result.isConfirmed) {
                
                // window.location.href = "indexVentanilla";
            // }
          })
        }
      })
    });

  } 

  function fnActualizarSolicitud(id){
    $('#div_añadir_equipo').prop('hidden',false);
    console.log(arrEquipos);
    console.log(arrTareas);


    bandera_orden = 1;
    $("#divListaTarea").prop('hidden', true);
    $("#btnGuardar").prop('hidden',false);
    id_solicitud_global = id;
    // console.log(folio_solicitud_global);
    // console.log('entro a la actualizacion');
    editar_nombre_solicitante = '';
    editar_telefono_solicitante = '';
    editar_descripcion_solicitante = '';

    html1='';
    html2='';
    html3='';
    html4='';
    html5='';
    html6='';
    html7='';
    htmlselect1='';
    htmlselect2='';
    htmlselect3='';

    $('#modal_solicitud_inf').html(html1);
    $('#modal_solicitud_inf2').html(html2);
    $('#select_tipo_equipo').html(htmlselect1);
    $('#select_tipo_servicio').html(htmlselect2);
    $('#select_tipo_tarea').html(htmlselect3);
    $('#modal_solicitud_inf4').html(html4);
    $('#span_solicitud').html(html5);
    $('#span_estatus').html(html6);
    $('#span_orden').html(html7);
    $('#numero_solicitud').html('');

    
    $.ajax({
        url: '/solicitudes/buscar_folio/',
        type: 'GET',
        data: {'id' : id, 'bandera_orden' : bandera_orden}
        }).always(function(r) {
          console.log(r);
          folio_solicitud_global = r.data[0]['folio'];
          $('#numero_solicitud').append('No. de Solicitud: '+r.data[0]['folio']+'');

              var g2=0;    
              var i2=0;    
              var id_tipo_equipo2 = '';
              var banderapp = 0;
              // for (var i = 0; i < r.data2.length; i++) {
              //   arrTareas.push({
              //     cont:g2, idTarea:r.data2[i]['id_tarea'],
              //     desc_Tarea:r.data2[i]['tarea'],
              //     idServicio:r.data2[i]['id_servicio'],
              //     desc_Servicio:r.data2[i]['servicio']
              //   });
              //   g2=g2+1;
              // }
              // console.log(arrEquipos);
              html5+='No. de Solicitud: '+r.data[0]['folio']+'';
              html6+='Estatus : '+r.data[0]['estatus']+'';
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
              html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
            html1+='</div>';
            html1+='<div class="col-2">';
              html1+='<label>Estatus : &nbsp;</label>';
                html1+='<span>'+r.data[0]['estatus']+'</span>';
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
          
          // html2+='<div class="row">';
          //   html2+='<div class="col-6">';
          //     html2+='<label>Tipo de Orden : &nbsp;</label>';
          //       html2+='<span>Ordinaria</span>';
          //   html2+='</div>';
          // html2+='</div>';
          // html2+='<div class="row">';
          //   html2+='<div class="col-12">';
          //     html2+='<label>Dependencia que Atiende en el Servicio : &nbsp;</label>';
          //       html2+='<span>Centro Estatal de Tecnologia Educativa</span>';
          //   html2+='</div>';
          // html2+='</div>';
          html2+='<div class="row">';
            html2+='<div class="col-4">';
              html2+='<label>Nombre : &nbsp;</label>';
                html2+='<input class="form-control" type="text" id="editar_nombre_solicitante" value="'+r.data[0]['solicitante']+'">';
            html2+='</div>';
            html2+='<div class="col-4">';
              html2+='<label>Telefono : &nbsp;</label>';
                html2+='<input class="form-control" type="number" id="editar_telefono_solicitante" value="'+r.data[0]['telef_solicitante']+'">';
                // html2+='<span>'+r.data[0]['telef_solicitante']+'</span>';
            html2+='</div>';
            html2+='<div class="col-4">';
              html2+='<label>Correo Electronico : &nbsp;</label>';
              html2+='<br>'
              // html2+='<input class="form-control" id="editar_correo_solicitante" value="'+r.data[0]['correo_solic']+'">';
                html2+='<span>'+r.data[0]['correo_solic']+'</span>';
            html2+='</div>';
          html2+='</div>';
          // html2+='<div class="row">';
          //   html2+='<div class="col-12">';
          //     html2+='<label>Correo Electronico : &nbsp;</label>';
          //     html2+='<input class="form-control" id="editar_correo_solicitante" value="'+r.data[0]['correo_solic']+'">';
          //       // html2+='<span>'+r.data[0]['correo_solic']+'</span>';
          //   html2+='</div>';
          // html2+='</div>';
          html2+='<br>'
          html2+='<div class="row">';
            html2+='<div class="col-6">';
              html2+='<label>Descripcion del Reporte : &nbsp;</label>';
                html2+='<textarea class="form-control" id="editar_descripcion_solicitante">'+r.data[0]['descrip_reporte']+'</textarea class="form-control">';
            html2+='</div>';
          html2+='</div>';
          html2+='<br>'
          htmlselect1+='<label for="selTipoEquipo">TIPO DE EQUIPO A REVISAR</label>';
          htmlselect1+='<select class="form-select" aria-label="Default select example" id="selTipoEquipo" name="selTipoEquipo" >';
            htmlselect1+='<option selected value="0">SELECCIONAR EQUIPO</option>';
            for (var i = 0; i < arreglo_tipo_equipo.length; i++) {
                htmlselect1+='<option value="'+arreglo_tipo_equipo[i]['id']+'">'+arreglo_tipo_equipo[i]['tipo_equipo']+'</option>';
            }
          htmlselect1+='</select>';

          // htmlselect1+='<label style="font-size:0.75em;">TIPO DE EQUIPO</label>';
          //   htmlselect1+='<select class="form-select" aria-label="Default select example" id="id_tipo_equipo">';
          //     htmlselect1+='<option selected value="0">SELECCIONAR EQUIPO</option>';
          //     for (var i = 0; i < arreglo_tipo_equipo.length; i++) {
          //         htmlselect1+='<option value="'+arreglo_tipo_equipo[i]['id']+'">'+arreglo_tipo_equipo[i]['tipo_equipo']+'</option>';
          //     }
          //   htmlselect1+='</select>';
          $('#select_tipo_equipo').append(htmlselect1);

          htmlselect2+='<label for="selTipoServicio">TIPO DE SERVICIO</label>';
            htmlselect2+='<select class="form-select" id="selTipoServicio" name="selTipoServicio" aria-label="Example select with button addon">';
              htmlselect2+='<option value="0" selected>SELECCIONAR SERVICIO</option>';
                                                      
            // htmlselect2+='</select>';
            // htmlselect2+='<select disabled class="form-select" aria-label="Default select example" id="id_tipo_servicio">';
            //   htmlselect2+='<option  selected value="0">SELECCIONAR SERVICIO</option>';
              // for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
              //     htmlselect2+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
              // }
          // htmlselect2+='</select>';
          $('#select_tipo_servicio').append(htmlselect2);

          htmlselect3+='<label for="selTarea">TIPO DE TAREA</label>';
            htmlselect3+='<select class="form-select" id="selTarea" name="selTarea" aria-label="Example select with button addon">';
              htmlselect3+='<option value="0" selected>SELECCIONAR TAREA</option>';
            htmlselect3+='</select>';

          //   htmlselect3+='<select disabled class="form-select" aria-label="Default select example" id="id_tipo_tarea">';
          //     htmlselect3+='<option  selected value="0">SELECCIONAR TAREA</option>';
          //     // for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
          //     //     htmlselect3+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
          //     // }
          // htmlselect3+='</select>';
          $('#select_tipo_tarea').append(htmlselect3);

          $('#modal_solicitud_inf').append(html1);
          $('#modal_solicitud_inf2').append(html2);
          $('#span_solicitud').append(html5);
          $('#span_estatus').append(html6);
          // $('#modal_solicitud_inf3').append(html3);
          $('#titulo_equipos').prop('hidden', false);
          $('#modal_solicitud_inf3').prop('hidden', false);

          $("#id_tipo_equipo").change(function(){
            // console.log($('#id_tipo_equipo').val());
            
            var pId_equipo = $('#id_tipo_equipo').val();
            $.ajax({
                url: '/solicitudes/select_servicio',
                type: 'GET',
                data: {'pId_equipo' : pId_equipo}
              }).always(function(r) {
                
              htmlselect2='';
              $('#select_tipo_servicio').html(htmlselect2);
              htmlselect3='';
              $('#select_tipo_tarea').html(htmlselect3);
              arreglo_equipos_servicios = r.data['tipo_servicios'];

              // console.log(r.data);
              htmlselect2+='<label style="font-size:0.75em;">TIPO DE SERVICIO</label>';
                htmlselect2+='<select class="form-select" aria-label="Default select example" id="id_tipo_servicio">';
                  htmlselect2+='<option  selected value="0">SELECCIONAR SERVICIO</option>';
                  for (var i = 0; i < arreglo_equipos_servicios.length; i++) {
                      htmlselect2+='<option value="'+arreglo_equipos_servicios[i]['id']+'">'+arreglo_equipos_servicios[i]['servicio']+'</option>';
                  }
              htmlselect2+='</select>';
              $('#select_tipo_servicio').append(htmlselect2);

              htmlselect3+='<label style="font-size:0.75em;">TIPO DE TAREA</label>';
                htmlselect3+='<select disabled class="form-select" aria-label="Default select example" id="id_tipo_tarea">';
                  htmlselect3+='<option  selected value="0">SELECCIONAR TAREA</option>';
                  // for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
                  //     htmlselect3+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
                  // }
              htmlselect3+='</select>';
              $('#select_tipo_tarea').append(htmlselect3);
              $('#btn_arreglo_registro').prop('disabled',true);
              
              $("#id_tipo_servicio").change(function(){
                // console.log($('#id_tipo_equipo').val());
                bandera_servicio = 0;
                var pId_servicio = $('#id_tipo_servicio').val();
                $.ajax({
                    url: '/solicitudes/select_tarea',
                    type: 'GET',
                    data: {'pId_equipo' : pId_equipo,'pId_servicio' : pId_servicio}
                  }).always(function(r) {
                    
                    htmlselect3='';
                    $('#select_tipo_tarea').html(htmlselect3);
                    arreglo_servicios_tareas = r.data['tipo_tareas'];

                    // console.log(r.data);
                    htmlselect3+='<label style="font-size:0.75em;">TIPO DE TAREA</label>';
                      htmlselect3+='<select class="form-select" aria-label="Default select example" id="id_tipo_tarea">';
                        htmlselect3+='<option  selected value="0">SELECCIONAR TAREA</option>';
                        for (var i = 0; i < arreglo_servicios_tareas.length; i++) {
                            htmlselect3+='<option value="'+arreglo_servicios_tareas[i]['id']+'">'+arreglo_servicios_tareas[i]['tarea']+'</option>';
                        }
                    htmlselect3+='</select>';
                    $('#select_tipo_tarea').append(htmlselect3);
                    if (pId_servicio == 0)  {
                      $('#btn_arreglo_registro').prop('disabled',true);
                    }
                    else{
                      $('#btn_arreglo_registro').prop('disabled',false);
                    }
                      
                });

                
              });

            });

          });
          
          $('#selTipoServicio').prop('disabled',true);
          $('#selTarea').prop('disabled',true);
          $('#btnAgregarTarea').prop('disabled',true);
          $('#btnAgregarEquipo').prop('hidden',true);


          $(document).ready(function () {
              //load();
              $("#divTablaEquipos").hide()

              // $("#btnSiguiente").hide()
              // $("#btnSiguiente").prop('disabled', true);
              // $("#divCantidad").hide()

              $("#btnSiguiente").click(function(){
                  $("#tab2").attr('class', 'nav-link');
                  $("#tab2").tab('show');
              });

              $("#btnSiguiente2").click(function(){

                  var vId_TipoOrden= $("#selTipoOrden").val();
                  var vTipoOrden= $('select[id="selTipoOrden"] option:selected').text();

                  var vId_DepAtiende= $("#selDepAtiende").val();
                  var vDepAtiende= $('select[id="selDepAtiende"] option:selected').text();

                  var vNombreSolicitante= $("#txtNombreSolicitante").val();
                  var vTelefonoSolicitante= $("#txtTelefonoSolicitante").val();
                  var vCorreoSolicitante= $("#txtCorreoSolicitante").val();
                  var vDescripcionReporte= $("#txtDescripcionReporte").val();

                  if(vId_TipoOrden==0){
                      msjeAlerta('', 'Debe seleccionar el tipo de orden', 'error');
                  }
                  
                  if(vId_DepAtiende==0){
                      msjeAlerta('', 'Debe seleccionar la dependencia que atiende', 'error');
                  }

                  if(vNombreSolicitante==''){
                      msjeAlerta('', 'Debe ingresar elnombre del solicitante', 'error');
                  }

                  if(vTelefonoSolicitante==''){
                      msjeAlerta('', 'Debe ingresar el teléfono del solicitante', 'error');
                  }

                  if(vCorreoSolicitante==''){
                      msjeAlerta('', 'Debe ingresar el correo del solicitante', 'error');
                  }else{
                      var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                      var bandC=0;
                      if (! regex.test($('#txtCorreoSolicitante').val().trim())) {
                          // alert('Correo validado');
                          msjeAlerta('', 'El correo no es valido', 'error');
                          bandC=1;
                      } else{
                          bandC=0;
                      }
                  }

                  if(vDescripcionReporte==''){
                      msjeAlerta('', 'Debe ingresar la descripción del reporte', 'error');
                  }


                  if(vId_TipoOrden!=0 && vId_DepAtiende!=0 && vNombreSolicitante!='' && vTelefonoSolicitante!=''&& vCorreoSolicitante!=''&& bandC==0 
                  && vDescripcionReporte!='' ){
                      $("#tab3").attr('class', 'nav-link');
                      $("#tab3").tab('show');
                  }
                  
              });


              $("#btnAnterior2").click(function(){
                  $("#tab1").attr('class', 'nav-link');
                  $("#tab1").tab('show');
              });

              $("#btnAnterior3").click(function(){
                  $("#tab2").attr('class', 'nav-link');
                  $("#tab2").tab('show');
              });

              $("#checkReplicar").change(function() {  
                  if($("#checkReplicar").is(':checked')) {  
                      // $("#divCantidad").show();
                  } else {  
                      // $("#divCantidad").hide();
                      // $("#divCantidad").val("1");
                  }  
              });  

              $("#checkSolicitante").change(function() {  
                  if($("#checkSolicitante").is(':checked')) {  
                      var vDirector = $("#txtDirectorCCT").val();
                      $("#txtNombreSolicitante").val(vDirector);
                  } else {  
                      $("#txtNombreSolicitante").val('');
                  }  
              });  

              $("#txtCantidadEquipos").change(function() {  
                  cant=$("#txtCantidadEquipos").val();
                  if(cant > 1) {  
                      $(".divEtiqueta").hide();
                      $("#checkVer").hide();
                  } else {  
                      $(".divEtiqueta").show();
                      $("#checkVer").show();
                  }  
              });  
          
              var tablaEquipo='';
              var i=0;
              // var arrEquipos = [];
              $("#btnAgregarEquipo").click(function(){
                $("#divListaTarea").prop('hidden', true);
                $("#divTablaEquipos").prop('hidden',false);
                  var bandCheck='';
                  // $("#btn_replicar").click(function() {  
                      if($("#btn_replicar").is(':checked')) {  
                        // console.log('entro');
                          bandCheck=1;
                      } else {  
                          bandCheck=0;
                      }  
                  // }); 

                  var etiquetaServicio = $("#txtEtiquetaServicio").val();
                  var marca = $("#txtMarca").val();
                  var modelo = $("#txtModelo").val(); 
                  var numeroSerie = $("#txtNumeroSerie").val(); 
                  var descripcionSoporte = $("#txtDescripcionSoporte").val();
                  var ubicacionEquipo = $("#txtUbicacionEquipo").val(); 
                  
                  $("#divTablaEquipos").show();
                  var vId_TipoEquipo= $("#selTipoEquipo").val();
                  var vTipoEquipo= $('select[id="selTipoEquipo"] option:selected').text();
                  var vCantidad=$("#txtCantidadEquipos").val(); 

                  // tablaEquipo+='<tr id="tr_'+i+'"><td>'+vTipoEquipo+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+i+')">Ver</button></td><td>En Proceso</td>';
                  // // tablaEquipo+='<tr id="tr_'+i+'"><td>PC</td><td>Mantemiento</td><td>Limpieza</td><td>En Proceso</td>';
                  // tablaEquipo+='<td><button type="button" class="btn colorBtnPrincipal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                  // tablaEquipo+='</tr>';
                  // $("#tbEquipos").html(tablaEquipo);
                  // i=i+1;
                  // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareas});
                  console.log(arrTareas);

                  if(vId_TipoEquipo==0){
                      msjeAlerta('', 'Favor de seleccionar Tipo de Equipo', 'error')
                  }else if(arrTareas==null || arrTareas==[]){
                      msjeAlerta('', 'Favor de seleccionar Servicios y Tares', 'error')
                  }else if(descripcionSoporte==null || descripcionSoporte=='' ){
                      msjeAlerta('', 'Favor de ingresar Descripción de Soporte o Problema', 'error')
                  }else{

                // if(vId_TipoEquipo!=0 && descripcionSoporte!='' && (arrTareas!=null || arrTareas!=[])){
                      arrEquipos.push({
                          con : i,
                          id_tipo_equipo : vId_TipoEquipo, 
                          desc_tipo_equipo : vTipoEquipo, 
                          etiquetaServicio : etiquetaServicio,
                          marca : marca,
                          modelo : modelo, 
                          numeroSerie : numeroSerie,
                          descripcionSoporte : descripcionSoporte,
                          ubicacionEquipo : ubicacionEquipo,
                          cantidad : vCantidad,
                          estatus_equipo : 1, 
                          nuevo : 1, 
                          aTarea : arrTareas, ///arreglo tareas
                          // aServicio : arrServicios /// arreglo servicios
                      });
                  
                      //  arrTareas=[];
                      drawRowEquipo();
                      i=i+1;
                      
                      if (bandCheck==1) {
                        $('#selTarea').prop('disabled',false);
                        $('#selTipoServicio').prop('disabled',false);
                      }
                      else{
                        $('#selTarea').prop('disabled',true);
                        $('#selTipoServicio').prop('disabled',true);
                      }
                      
                      $('#btnAgregarTarea').prop('disabled',true);
                      $('#btnAgregarEquipo').prop('hidden',true);

                      if(bandCheck==0){
                          arrTareas=[];
                          $("#tbTarea").remove();
                          $("#selTipoEquipo").val("0").attr("selected",true);
                          $("#selTipoServicio").val("0").attr("selected",true);
                          $("#selTarea").val("0").attr("selected",true);
                          $("#txtEtiquetaServicio").val("");
                          $("#txtMarca").val("");
                          $("#txtModelo").val(""); 
                          $("#txtNumeroSerie").val(""); 
                          $("#txtDescripcionSoporte").val(""); 
                          $("#txtUbicacionEquipo").val(""); 
                      }
                  }

                  // if(bandCheck==0){
                  //     arrTareas=[];
                  //     $("#tbTarea").remove();
                  //     $("#selTipoEquipo").val("0").attr("selected",true);
                  //     $("#selTipoServicio").val("0").attr("selected",true);
                  //     $("#selTarea").val("0").attr("selected",true);
                  //     $("#txtEtiquetaServicio").val("");
                  //     $("#txtMarca").val("");
                  //     $("#txtModelo").val(""); 
                  //     $("#txtNumeroSerie").val(""); 
                  //     $("#txtDescripcionSoporte").val(""); 
                  //     $("#txtUbicacionEquipo").val(""); 
                  // }
                  
                  // $("#txtCantidadEquipos").val(1);
                  // $(".divEtiqueta").show();
                  // $("#checkVer").hide();

                  console.log(arrEquipos);
              });

              var equipoServicio='';
              var f=0;
              var vTipoServicio = 0;
              var vTipoServicioText = ''; 
              $("#btnAgregarServicio").click(function(){
                  vTipoServicio = $("#selTipoServicio").val();
                  vTipoServicioText = $('select[id="selTipoServicio"] option:selected').text();

                  if(vTipoServicio != 0){
                      var index = arrServicios.findIndex(e => e.idServicio === vTipoServicio);

                      if(index == -1){
                          // arrServicios.push({cont:f, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});
                          drawRowServicio();
                          f=f+1;
                      }else{
                          $("#selTipoServicio").val("0").attr("selected",true);
                          msjeAlerta('', 'Ya fue seleccionado el Servicio '+vTipoServicioText, 'error')
                      }
                  }
              });

              var listaTarea='';
              var g=0;
              var vTarea = 0;
              var vTareaText = '';
              $("#btnAgregarTarea").click(function(){
                  // if(arrTareas.length==0){
                  //     g=0;
                  //     listaTarea='';
                  //     $("#ulTarea").html('');
                  // }
                  vTarea = $("#selTarea").val();
                  vTareaText = $('select[id="selTarea"] option:selected').text();


                  vTipoServicio = $("#selTipoServicio").val();
                  vTipoServicioText = $('select[id="selTipoServicio"] option:selected').text();


                  if(vTarea != 0){
                      var index = arrTareas.findIndex(e => e.idTarea === vTarea);

                      if(index == -1){
                          arrTareas.push({cont:g, idTarea:vTarea, desc_Tarea:vTareaText, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});
                          drawRowTarea();
                          // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareas});
                          g=g+1;
                          $("#divListaTarea").prop('hidden',false);
                          $('#btnAgregarEquipo').prop('hidden',false);
                          $('#btnAgregarTarea').prop('disabled',true);
                          
                      }else{
                          $("#selTarea").val("0").attr("selected",true);
                          $('#btnAgregarTarea').prop('disabled',true);
                          msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')
                      }
                  }
                  // $("#selTipoServicio").val("0").attr("selected",true);  //resetear servicio cada que agrega una tarea
              });

              $('#selTipoEquipo').on('change', function() { /// Cargar select Tarea en base a Servicio
                  let urlEditar = '{{ route("consServicio", ":idEquipo") }}';
                  urlEditar = urlEditar.replace(':idEquipo', this.value); 
                  
                  $("#selTipoServicio").val("0").attr("selected",true);
                  $('#selTarea').prop('disabled',true);
                  $("#selTarea").val("0").attr("selected",true);
                  $('#btnAgregarTarea').prop('disabled',true);
                  let element = document.getElementById("selTipoServicio");
                  element.value = '0';
                  if ($("#selTipoEquipo").val() == 0) {
                    console.log('entor');
                    $('#selTarea').prop('disabled',true);
                    $('#selTipoServicio').prop('disabled',true);
                    $('#btnAgregarTarea').prop('disabled',true);
                  }
                  else{
                    $.ajax({
                      url: urlEditar,
                      type: 'GET',
                      dataType: 'json', 
                      success: function(data) {
                          //  console.log(data[0][0]);
                          var htmlSel='<option value="0" selected>SELECCIONAR SERVICIO</option>';
                          for (var i = 0; i < data[0].length; i++) {
                              htmlSel+='<option value="'+data[0][i].id+'">'+data[0][i].servicio+'</option>'; 
                          }

                          $("#selTipoServicio").html(htmlSel);
                          $('#selTipoServicio').prop('disabled',false);
                      }
                  });
                  }
                  
                  
              });

              $('#selTipoServicio').on('change', function() { /// Cargar select Tarea en base a Servicio
                  var vtipEquipo=  $('#selTipoEquipo').val();
                  var serv= this.value;

                  let urlEditar = '{{ route("consTarea") }}';
                  // urlEditar = urlEditar.replace(':idserv', this.value);
                  $('#btnAgregarTarea').prop('disabled',true);
                  $("#selTarea").val("0").attr("selected",true);
                  let element = document.getElementById("selTarea");
                  element.value = '0';

                  if ($("#selTipoServicio").val() == 0) {
                    $('#selTarea').prop('disabled',true);
                    $('#btnAgregarTarea').prop('disabled',true);
                  }
                  else{
                    $.ajax({
                      url: urlEditar,
                      type: 'POST',
                      data:{idequi:vtipEquipo , idserv:serv},
                      dataType: 'json', 
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      success: function(data) {
                          //  console.log(data[0][0]);
                          var htmlSel='<option value="0" selected>SELECCIONAR TAREA</option>';
                          for (var i = 0; i < data[0].length; i++) {
                              htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                          }

                          $("#selTarea").html(htmlSel);
                          $('#selTarea').prop('disabled',false);

                      }
                    });
                  }

                  
                  
              });
              $('#selTarea').on('change', function() { /// Cargar select Tarea en base a Servicio
                  var vselTarea=  $('#selTarea').val();
                  if (vselTarea == 0) {
                    $('#btnAgregarTarea').prop('disabled',true);
                  }
                  else{
                    $('#btnAgregarTarea').prop('disabled',false);
                  }
              });


              

              $("#txtEtiquetaServicio").keyup(function(){
                  var vEtiqueta = $("#txtEtiquetaServicio").val();
                  if(vEtiqueta!=''){
                      $("#txtMarca").val("DELL");
                      $("#txtModelo").val("12345");
                      $("#txtSerie").val("02325652");
                  }
              });

          });

          $("#editar_nombre_solicitante").keyup(function(){
              var txt = $(this).val();
              $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
          });
        // function removeEquipo( item ) {
        //     if(arrEquipos.includes(item) ==false){ 
        //         if ( item !== -1 ) {
        //             arrEquipos.splice( item, 1 );
        //             $("#tr_"+item).remove();
        //             drawRowEquipo();
        //         }   else{
        //             arrEquipos = [];
        //             g=0;
        //             tablaEquipo='';
        //             $("#tbEquipos").html('');
        //             $("#tbEquipos").empty();
        //         }
        //     }else{
        //         console.log('No existe en el arreglo');
        //         g=0;
        //         tablaEquipo='';
        //         $("#tbEquipos").html('');
        //         $("#tbEquipos").empty();
        //     }
        // }

        // function drawRowEquipo(){
        //     var tablaEquipo2 = '';
            
        //     $.each(arrEquipos, function(j, val){
        //         if (!jQuery.isEmptyObject(arrEquipos[j])) { 
            
        //         // tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+j+')">Ver</button></td><td>En Proceso</td>';
        //             tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td>';
        //             tablaEquipo2+='<td>';
        //             for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
        //               tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Servicio']+'<br>';
        //             }
        //             tablaEquipo2+='</td>';
        //             tablaEquipo2+='<td>';
        //             for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
        //               tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Tarea']+'<br>';
        //             }
        //             tablaEquipo2+='</td>';
        //             // tablaEquipo2+='<td>'+arrEquipos[j]['cantidad']+'</td>';
        //             // tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
        //             // tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "';
        //             // tablaEquipo2+='                      data-bs-toggle="dropdown" id="opciones"';
        //             // tablaEquipo2+='                       aria-haspopup="true" aria-expanded="false" >';
        //             // tablaEquipo2+='                      <i class="fa fa-ellipsis-v text-xs"></i>';
        //             // tablaEquipo2+='                  </button>';
        //             // tablaEquipo2+='                  <ul class="dropdown-menu" aria-labelledby="opciones1">';
        //             // tablaEquipo2+='                      <li>';
        //             // tablaEquipo2+='                          <a  ';
        //             // // tablaEquipo2+='                          onclick="removeEquipo('+j+');" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal">';
        //             // tablaEquipo2+='                          onclick="removeEquipo('+j+');" >';
        //             // tablaEquipo2+='                              <i class="fas fa-eye"></i> Eliminar';
        //             // tablaEquipo2+='                          </a>';
        //             // tablaEquipo2+='                      </li>';
        //             // tablaEquipo2+='                          <li>';
        //             // tablaEquipo2+='                              <a onclick="verServicioEquipo('+j+')"> ';
        //             // // tablaEquipo2+='                              class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">';
        //             // tablaEquipo2+='                                  <i class="fas fa-download"></i> Ver Servicios/Tareas';
        //             // tablaEquipo2+='                              </a>';
        //             // tablaEquipo2+='                          </li>';
        //             // tablaEquipo2+='                  </ul>';
        //             // tablaEquipo2+='              </div></td>';
        //             tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
        //             tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "data-bs-toggle="dropdown"<i class="fa fa-ellipsis-v text-xs"></i></button>';
        //                 tablaEquipo2+='<div class="dropdown btn-group dropstart">';
        //                     tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
        //                         tablaEquipo2+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
        //                             tablaEquipo2+='<li><a onclick="removeEquipo('+j+')" class="dropdown-item" ><i class="fas fa-trash">Elimninar</i></a></li>';
        //                         tablaEquipo2+='</ul>';
        //         tablaEquipo2+='</div></td>';
        //             // tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal" onclick="removeEquipo('+j+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
        //             tablaEquipo2+='</tr>';
        //         }
        //     });

        //     $("#tbEquipos").empty();
        //     $("#tbEquipos").html(tablaEquipo2);
            


        // }

        
        // function removeTarea( item ) {
        //     if(arrTareas.includes(item) ==false){ 
        //         if ( item !== -1 ) {
        //             arrTareas.splice( item, 1 );
        //             console.log(arrTareas);
        //             $("#liT_"+item).remove();
        //             drawRowTarea();
        //         }   else{
        //             arrTareas = [];
        //             g=0;
        //             listaTarea='';
        //             $("#ulTarea").html('');
        //             $("#ulTarea").empty();
        //         }
        //     }else{
        //         console.log('No existe en el arreglo');
        //         g=0;
        //         listaTarea='';
        //         $("#ulTarea").html('');
        //         $("#ulTarea").empty();
        //     }
        // }
        

        // function drawRowTarea(){
        //     var listaTarea2 = '';

        //     listaTarea2+='<table style="font-size:0.75rem;" id="tbTarea">';
        //     listaTarea2+='<thead>';
        //     listaTarea2+='<th>Servicio</th>';
        //     listaTarea2+='<th>Tarea</th>';
        //     listaTarea2+='<th></th>';
        //     listaTarea2+='</thead>';
        //     listaTarea2+='<tbody>';

        //     // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
        //     var aux='';
        //     $.each(arrTareas, function(j, val){
        //         if (!jQuery.isEmptyObject(arrTareas[j])) {
                
        //             listaTarea2+='<tr>';
        //             if(aux==arrTareas[j]['desc_Servicio']){ 
        //                 listaTarea2+='<td>&nbsp;</td>';
        //                 aux='';
        //             }else{
        //                 aux=arrTareas[j]['desc_Servicio'];
        //                 listaTarea2+='<td>'+arrTareas[j]['desc_Servicio']+'&nbsp;</td>';
        //             }
                    
        //             listaTarea2+='<td> - '+arrTareas[j]['desc_Tarea']+'</td>';
                    
        //             // listaTarea2+='<td><button type="button" class="btn btn-secondary " id="prueba"  >fdsfdsf</button>';
        //             listaTarea2+='<td><button type="button" id="btn_prueba" onclick="removeTarea('+j+')" class="btn colorBtnPrincipal" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
        //             listaTarea2+='<tr>';
                    
        //         }
        //     });

        //     listaTarea2+='</tbody>';
        //     listaTarea2+='</table>';

        //     $("#ulTarea").empty();
        //     $("#ulTarea").html(listaTarea2);
        //     $("#selTarea").val("0").attr("selected",true);
        //     // console.log(arrTareas);


            
            
        // }

        
        function removeServicio( item ) {
            if(arrServicios.includes(item) ==false){ 
                if ( item !== -1 ) {
                    arrServicios.splice( item, 1 );
                    $("#liS_"+item).remove();
                    drawRowServicio();
                }   else{
                    arrServicios = [];
                    f=0;
                    listaServicio='';
                    $("#ulServicio").html('');
                    $("#ulServicio").empty();
                }
            }else{
                console.log('No existe en el arreglo');
                f=0;
                listaServicio='';
                $("#ulServicio").html('');
                $("#ulServicio").empty();
            }
        }

        function drawRowServicio(){
          var listaServicio2 = '';

          $.each(arrServicios, function(i, val){
            if (!jQuery.isEmptyObject(arrServicios[i])) {
                // console.log(arrServicios[i]);
                listaServicio2+='<li id="liS_'+i+'">'+arrServicios[i]['desc_Servicio']; 
                listaServicio2+='&nbsp;<button type="button" style="font-size:0.75rem;" onclick="removeServicio('+i+');" class="btn colorBtnPrincipal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button>';
            }
          });

          $("#ulServicio").empty();
          $("#ulServicio").html(listaServicio2);
          $("#selTipoServicio").val("0").attr("selected",true);
        }

        function msjeAlerta(titulo, contenido, icono){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icono,
                title: contenido
            })
        }

        function msjeAlerta2(titulo, contenido, icono){
            let urlEditar = '{{ route("download-pdf", ":id") }}';
            urlEditar = urlEditar.replace(':id', 1);

            Swal.fire({
                title: titulo,
                text: contenido,
                icon: icono,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'DESCARGAR ORDEN',
                cancelButtonText: 'ACEPTAR',
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlEditar;
                }
            });
        }

        function fnBuscarCCT(){
        
            var claveCCT= $("#txtCentroTrabajo").val();
            let urlEditar = '{{ route("consCCT", ":claveCCT") }}';
            urlEditar = urlEditar.replace(':claveCCT', claveCCT);
            arrEscuelaTurno=[];
            // $("#selTarea").val("0").attr("selected",true);
            // let element = document.getElementById("selTarea");
            // element.value = '0';

            if(claveCCT==''){
                msjeAlerta('', 'Debe introducir la Clave de Centro de Trabajo ', 'error')
            }else{
                $.ajax({
                    url: urlEditar,
                    type: 'GET',
                    dataType: 'json', 
                    success: function(data) {
                        // console.log(data);   //data[0][i].id_tarea
                        console.log(data[0].length);
                        if(data[0] !='' || data[0] !=null || data[0].length!=0){
                            if(data[0].length>1){
                                var html='';
                                var i=0;
                                data[0].forEach(element => {
                                    i=i+1;
                                    arrEscuelaTurno.push(element);
                                    html+='<option value="'+i+'" selected>'+element['turno']+'</option>';
                                    //  console.log(element['turno']);
                                    
                                });
                                // console.log(arrEscuelaTurno);
                                $("#selTurno").html(html);
                                $("#centroTrabajoModal").modal("show");
                            }else if(data[0].length==1){
                                $("#txtIdCCT").val(data[0][0].id);
                                $("#txtNombreCCT").val(data[0][0].nombrect);
                                $("#txtClaveCCT").val(data[0][0].clavecct);
                                $("#txtMunicipioCCT").val(data[0][0].municipio)
                                $("#txtDirectorCCT").val(data[0][0].director);
                                $("#txtDireccionCCT").val(data[0][0].domicilio);
                                $("#txtCoordinacion").val(data[0][0].coordinacion);
                                $("#txtTelefono").val(data[0][0].telefono);
                                $("#txtTurno").val(data[0][0].turno);
                                $("#txtNivelEducativo").val(data[0][0].nivel);
                                $("#txtLatitud").val(data[0][0].latitud);
                                $("#txtLongitud").val(data[0][0].longitud);

                                $("#btnSiguiente").prop('disabled', false);
                                // $("#btnHistorialCCT").show();
                                // $("#btnUbicacionCCT").show();
                                
                                var divH='<button class="btn btn-secondary" type="button" id="btnHistorialCCT"  onclick="fnHistorial()">Ver Historial</button>';
                                var divU='<button class="btn btn-secondary" type="button" id="btnUbicacionCCT"  onclick="fnMapa()">Ubicación</button>';
                                $("#divHistorial").html(divH);
                                $("#divUbicacion").html(divU);

                                if(data[1] !='' || data[1] !=null ){
                                    // $("#divHistorial").html(divH);
                                    var htmlHist='<table class="table"><thead><th>FOLIO</th><th>Fecha</th><th>Detalles</th></thead><tbody>';
                                    var j=0;
                                    $.each(data[1], function(j, val){
                                        if (!jQuery.isEmptyObject(data[1])) {
                                            htmlHist+='<tr><td>'+data[1][j].folio+'</td><td>'+data[1][j].fecha_orden+'</td>';
                                            htmlHist+='<td><div class="dropdown btn-group dropstart">';
                                            htmlHist+='<button class="btn btn-link text-secondary mb-0 "';
                                            htmlHist+='data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >';
                                            htmlHist+='<i class="fa fa-ellipsis-v text-xs"></i></button>';
                                            htmlHist+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                                            htmlHist+='<li>';
                                            htmlHist+='<a onclick="fnVerOrdenCentro('+data[1][j].id_orden+')"> ';
                                            htmlHist+='<i class="fas fa-download"></i> Ver Orden...';
                                            htmlHist+='</a>';
                                            htmlHist+='</li>';
                                            htmlHist+='</ul>';
                                            htmlHist+='</div></td></tr>';
                                            //  console.log(element['turno']);
                                            j=j+1;
                                        }
                                    });


                                    htmlHist+='</tbody></table>';
                                    // console.log(arrEscuelaTurno);
                                    
                                    $("#hist").html(htmlHist);
                                }else{
                                    $("#hist").html('<span>No hay historial de este centro de trabajo</span>');
                                }
                            }else{
                                msjeAlerta('', 'No existe el Centro de Trabajo '+claveCCT, 'error')
                                $("#btnSiguiente").prop('disabled', true);

                                $("#divHistorial").html('');
                                $("#divUbicacion").html('');
                                $("#hist").html('');

                                fnLimpiar();
                                }
                        }else{
                            msjeAlerta('', 'No existe el Centro de Trabajo '+claveCCT, 'error')
                            $("#btnSiguiente").prop('disabled', true);

                            $("#divHistorial").html('');
                            $("#divUbicacion").html('');
                            $("#hist").html('');

                            fnLimpiar();
                            
                        }
                    }
                });
            }
        }

        function fnMapa(){
            $("#ubicacionCCTModal").modal("show");
            // initMap(42.1382114, -71.5212585);
            // initMap();
            var latitud=$("#txtLatitud").val();
            var longitud=$("#txtLongitud").val();

            latitud=parseFloat(latitud);
            longitud=parseFloat(longitud);

            var macc = {lat: latitud, lng: longitud};
            // var macc = {lat: latitud, lng: longitud};

            var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: macc});

            var marker = new google.maps.Marker({position: macc, map: map});

        }

        function fnHistorial(){
            var clave = $("#txtClaveCCT").val()
            $("#historialCCTModal").modal("show");
        }

        function fnElegirTurno(){
            var vTurno = $("#selTurno").val();
            console.log(vTurno);
            if(vTurno==1){
                var textTurno='Vespertino';
            }else{
                var textTurno='Matutino';
            }

            
            arrEscuelaTurno.forEach(element => {
                if(element['turno']==textTurno){
                    console.log(element['turno'] +'--'+textTurno);
                    console.log('entro'+'--'+element['turno']);
                    $("#txtNombreCCT").val(element['nombre']);
                    $("#txtClaveCCT").val(element['clave']);
                    $("#txtMunicipioCCT").val(element['municipio'])
                    $("#txtDirectorCCT").val(element['director']);
                    $("#txtDireccionCCT").val(element['direccion']);
                    $("#txtCoordinacion").val(element['coordinacion']);
                    $("#txtTelefono").val(element['telefono']);
                    $("#txtTurno").val(element['turno']);
                    $("#txtNivelEducativo").val(element['nivel_educativo']);

                    $("#btnSiguiente").prop('disabled', false);

                    $("#centroTrabajoModal").modal("hide");
                    
                }
            });
        }

        function fnGuardar(){
            var claveCCT= $("#txtClaveCCT").val();
            let urlEditar = '{{ route("guardarOrden") }}';
            // urlEditar = urlEditar.replace(':claveCCT', claveCCT);
            var form = $('#formOrden')[0];
            var checkDirector='';
            if($("#checkSolicitante").is(':checked')) {  
                checkDirector= true;
            } else {  
                checkDirector= false;
            }  
            
            // FormData object 
            var data2 = new FormData(form);
            //  data2.append('arrEquipos',arrEquipos);
            data2.append('arrEquipos', JSON.stringify(arrEquipos));
            data2.append('checkDirector', JSON.stringify(checkDirector));
            // data2.append('equipo_servicio',equipo_servicio);

            console.log(data2);

            $.ajax({
                url: urlEditar,
                type: 'POST',
                data:data2,
                dataType: 'json', 
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    //   console.log(data[0][0]);   //data[0][i].id_tarea
                    // console.log('hola');
                    msjeAlerta2('REGISTRO EXITOSO DE ORDEN DE SERVICIO','EL FOLIO DE SERVICIO DE TU ORDEN ES: O2023-00002 ','success')
                }
            });
        }

        function fnLimpiar(){
            $("#formOrden")[0].reset();
        }

        function fnNumero(){
            var tecla = event.key;
            if (['.','e'].includes(tecla))
            event.preventDefault()
        }

        function fnVerOrdenCentro(idOrden){
            console.log(idOrden);
        }

        function verServicioEquipo(i){
          var html='';

          html+='<table>';
          html+='<thead>';
          html+='<th>Servicio</th>';
          html+='<th>Tarea</th>';
          html+='</thead>';
          html+='<tbody>';
              
          var aTarea=arrEquipos[i]['aTarea'];
          var aux='';
          $.each(aTarea, function(j, val){
              if (!jQuery.isEmptyObject(aTarea[j])) {

                  html+='<tr>';
                  if(aux==aTarea[j]['desc_Servicio']){ 
                      html+='<td >&nbsp;</td>';
                      // console.log(aux+'---1');
                      aux='';
                  }else{
                      aux=aTarea[j]['desc_Servicio'];
                      // console.log(aux+'---2');
                      html+='<td >'+aTarea[j]['desc_Servicio']+'&nbsp;</td>';
                      
                  }
                  
                  html+='<td> - '+aTarea[j]['desc_Tarea']+'</td>';
                  html+='<tr>';
                  
              }
          });
          
          html+='</tbody>';
          html+='</table>';

          Swal.fire({
              title: 'Tareas',
              html: html,
              icon: '',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK',
              }).then((result) => {
              if (result.isConfirmed) {
              // window.location.href = urlEditar;
              }
          });
        }
      
        function initMap() {
            // function initMap(latitud,longitud) {

            var macc = {lat: 42.1382114, lng: -71.5212585};
            // var macc = {lat: latitud, lng: longitud};

            var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 15, center: macc});

            var marker = new google.maps.Marker({position: macc, map: map});

        }

      
        $("#btnGuardar").click(function(){
          // var bandera_guardar = 0;
          var editar_nombre_solicitante = $('#editar_nombre_solicitante').val();
          var editar_telefono_solicitante = $('#editar_telefono_solicitante').val();
          var editar_descripcion_solicitante = $('#editar_descripcion_solicitante').val();
          // console.log(r.data[0]['solicitante']);
          // console.log($('#editar_nombre_solicitante').val());
          // console.log(r.data[0]['telef_solicitante']);
          // console.log($('#editar_telefono_solicitante').val());
          // console.log(r.data[0]['descrip_reporte']);
          // console.log($('#editar_descripcion_solicitante').val());

          if (r.data[0]['solicitante'] != editar_nombre_solicitante ||
              r.data[0]['telef_solicitante'] != editar_telefono_solicitante ||
              r.data[0]['descrip_reporte'] != editar_descripcion_solicitante ||
              arrEquipos != '') {
                if (editar_nombre_solicitante == '' || editar_telefono_solicitante == '' || editar_descripcion_solicitante =='') {
                  Swal.fire({
                    position: 'bottom-right',
                    icon: 'warning',
                    title: 'Revisar que ningun campo del Solicitante vaya vacio..',
                    showConfirmButton: false,
                    customClass: 'msj_aviso',
                    timer: 2000
                  })
                }
                else{
                  if (editar_telefono_solicitante.length != 10) {
                    Swal.fire({
                      position: 'bottom-right',
                      icon: 'warning',
                      title: 'El Telefono del Solicitante debe ser de 10 digitos..',
                      showConfirmButton: false,
                      customClass: 'msj_aviso',
                      timer: 2000
                    })
                  }
                  else{
                    $.ajax({
                    url: '/solicitudes/actualizar_solicitud/',
                    type: 'GET',
                    data: {
                      'folio_solicitud_global' : folio_solicitud_global,
                      'arrEquipos' : arrEquipos,
                      'id_solicitud_global' : id_solicitud_global,
                      'editar_nombre_solicitante' : editar_nombre_solicitante,
                      'editar_telefono_solicitante' : editar_telefono_solicitante,
                      'editar_descripcion_solicitante' : editar_descripcion_solicitante
                      // 'bandera_guardar' : bandera_guardar
                    }
                    }).always(function(r) {
                      Swal.fire({
                            title: 'Editado',
                            // text: 'Se ha Registrado con Exito la Solicitud #5884',
                            text: 'Se ha Editado Correctamente la Solicitud #'+folio_solicitud_global+'',
                            customClass: 'msj_solicitud',
                            icon: 'success',
                            confirmButtonColor: '#b50915',
                            allowOutsideClick: false
                          }).then((result) => {
                          if (result.isConfirmed) {
                            // alert('Se redireccciona al index');
                            window.location.href = "solicitudes_registros";
                        }
                      })
                    });
                  }
                }
              }
              else{
                Swal.fire({
                    position: 'bottom-right',
                    icon: 'warning',
                    title: 'Debe editar o agregar algun dato para poder Guardar la Solicitud..',
                    showConfirmButton: false,
                    customClass: 'msj_aviso',
                    timer: 2000
                })
              }

          // if(arrEquipos == ''){
          //   Swal.fire({
          //       position: 'bottom-right',
          //       icon: 'warning',
          //       title: 'Favor de Agregar un Equipo',
          //       showConfirmButton: false,
          //       customClass: 'msj_aviso',
          //       timer: 2000
          //   })
          // }
          // else{
          //   console.log('va lleno');
          //   $('#btnGuardar').prop('disabled',true);

          //   console.log('esta lleno');
          //   $.ajax({
          //     url: '/solicitudes/actualizar_solicitud/',
          //     type: 'GET',
          //     data: {
          //       'folio_solicitud_global' : folio_solicitud_global,
          //       'arrEquipos' : arrEquipos,
          //       'id_solicitud_global' : id_solicitud_global
                
          //     }
          //     }).always(function(r) {
          //       if (r.exito == true) {
          //           Swal.fire({
          //             title: 'Editado',
          //             // text: 'Se ha Registrado con Exito la Solicitud #5884',
          //             text: 'Se ha Guardado Correctamente la Solicitud #'+folio_solicitud_global+'',
          //             customClass: 'msj_solicitud',
          //             icon: 'success',
          //             confirmButtonColor: '#b50915',
          //             allowOutsideClick: false
          //           }).then((result) => {
          //           if (result.isConfirmed) {
          //             // alert('Se redireccciona al index');
          //             window.location.href = "solicitudes_registros";
          //         }
          //     })
          //       }
          //       else{
          //         Swal.fire({
          //             position: 'bottom-right',
          //             icon: 'warning',
          //             title: 'Hubo un detalle al momento de guardar',
          //             showConfirmButton: false,
          //             customClass: 'msj_aviso',
          //             timer: 2000
          //         })
          //       }
          //         // console.log(r.data);
          //     //     Swal.fire({
          //     //         title: 'Registrado',
          //     //         // text: 'Se ha Registrado con Exito la Solicitud #5884',
          //     //         text: 'Se ha Registrado con Exito la Solicitud #'+r.data+'',
          //     //         customClass: 'msj_solicitud',
          //     //         icon: 'success',
          //     //         confirmButtonColor: '#b50915',
          //     //         allowOutsideClick: false
          //     //     }).then((result) => {
          //     //     if (result.isConfirmed) {
          //     //         // alert('Se redireccciona al index');
          //     //         // window.location.href = "indexVentanilla";
          //     //     }
          //     // })
          //   });
          // }
          // console.log(arrEquipos);
          // console.log(folio_solicitud_global);





        });
    

      });

    $('#exampleModal').modal('show');
    
  } 

  function drawRowTarea(){
    var listaTarea2 = '';

    listaTarea2+='<table style="font-size:0.75rem;" id="tbTarea">';
    listaTarea2+='<thead>';
    listaTarea2+='<th>Servicio</th>';
    listaTarea2+='<th>Tarea</th>';
    listaTarea2+='<th></th>';
    listaTarea2+='</thead>';
    listaTarea2+='<tbody>';

    // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
    var aux='';
    $.each(arrTareas, function(j, val){
        if (!jQuery.isEmptyObject(arrTareas[j])) {
        
            listaTarea2+='<tr>';
            if(aux==arrTareas[j]['desc_Servicio']){ 
                listaTarea2+='<td>&nbsp;</td>';
                aux='';
            }else{
                aux=arrTareas[j]['desc_Servicio'];
                listaTarea2+='<td>'+arrTareas[j]['desc_Servicio']+'&nbsp;</td>';
            }
            
            listaTarea2+='<td> - '+arrTareas[j]['desc_Tarea']+'</td>';
            
            // listaTarea2+='<td><button type="button" class="btn btn-secondary " id="prueba"  >fdsfdsf</button>';
            listaTarea2+='<td><button type="button" id="btn_prueba" onclick="removeTarea('+j+')" class="btn colorBtnPrincipal" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
            listaTarea2+='<tr>';
            
        }
    });

    listaTarea2+='</tbody>';
    listaTarea2+='</table>';

    $("#ulTarea").empty();
    $("#ulTarea").html(listaTarea2);
    $("#selTarea").val("0").attr("selected",true);
    // $("#divListaTarea").prop('hidden',false);
    $("#divListaTarea").prop('hidden', false);
    // console.log(arrTareas);


    
    
}

  function removeTarea( item ) {
      if(arrTareas.includes(item) ==false){ 
          if ( item !== -1 ) {
              arrTareas.splice( item, 1 );
              console.log(arrTareas);
              $("#liT_"+item).remove();
              drawRowTarea();
              // divListaTarea
              if (arrTareas == '') {
                $("#divListaTarea").prop('hidden',true);
              }
              
          }   else{
              arrTareas = [];
              g=0;
              listaTarea='';
              $("#ulTarea").html('');
              $("#ulTarea").empty();
              // $("#divListaTarea").prop('hidden',true);
              
          }
      }else{
          console.log('No existe en el arreglo');
          g=0;
          listaTarea='';
          $("#ulTarea").html('');
          $("#ulTarea").empty();
          // $("#divListaTarea").prop('hidden',false);
      }
  }

  function removeEquipo( item ) {
    if(arrEquipos.includes(item) ==false){ 
        if ( item !== -1 ) {
            arrEquipos.splice( item, 1 );
            $("#tr_"+item).remove();
            drawRowEquipo();
            if (arrEquipos == '') {
                $("#divTablaEquipos").prop('hidden',true);
              }
            // console.log('entro1');
        }   else{
          // console.log('entro2');
            arrEquipos = [];
            g=0;
            tablaEquipo='';
            $("#tbEquipos").html('');
            $("#tbEquipos").empty();
        }
    }else{
        console.log('No existe en el arreglo');
        g=0;
        tablaEquipo='';
        $("#tbEquipos").html('');
        $("#tbEquipos").empty();
    }
  }

  function drawRowEquipo(){
    var tablaEquipo2 = '';
    
    $.each(arrEquipos, function(j, val){
        if (!jQuery.isEmptyObject(arrEquipos[j])) { 
    
        // tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+j+')">Ver</button></td><td>En Proceso</td>';
            tablaEquipo2+='<tr id="tr_'+j+'">';
              tablaEquipo2+='<td>- '+arrEquipos[j]['desc_tipo_equipo']+'</td>';
              tablaEquipo2+='<td>- '+arrEquipos[j]['descripcionSoporte']+'</td>';
            
              tablaEquipo2+='<td>';
              for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
                tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Servicio']+'<br>';
              }
              tablaEquipo2+='</td>';
              tablaEquipo2+='<td>';
              for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
                tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Tarea']+'<br>';
              }
              tablaEquipo2+='</td>';
            // tablaEquipo2+='<td>'+arrEquipos[j]['cantidad']+'</td>';
            // tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
            // tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "';
            // tablaEquipo2+='                      data-bs-toggle="dropdown" id="opciones"';
            // tablaEquipo2+='                       aria-haspopup="true" aria-expanded="false" >';
            // tablaEquipo2+='                      <i class="fa fa-ellipsis-v text-xs"></i>';
            // tablaEquipo2+='                  </button>';
            // tablaEquipo2+='                  <ul class="dropdown-menu" aria-labelledby="opciones1">';
            // tablaEquipo2+='                      <li>';
            // tablaEquipo2+='                          <a  ';
            // // tablaEquipo2+='                          onclick="removeEquipo('+j+');" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal">';
            // tablaEquipo2+='                          onclick="removeEquipo('+j+');" >';
            // tablaEquipo2+='                              <i class="fas fa-eye"></i> Eliminar';
            // tablaEquipo2+='                          </a>';
            // tablaEquipo2+='                      </li>';
            // tablaEquipo2+='                          <li>';
            // tablaEquipo2+='                              <a onclick="verServicioEquipo('+j+')"> ';
            // // tablaEquipo2+='                              class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">';
            // tablaEquipo2+='                                  <i class="fas fa-download"></i> Ver Servicios/Tareas';
            // tablaEquipo2+='                              </a>';
            // tablaEquipo2+='                          </li>';
            // tablaEquipo2+='                  </ul>';
            // tablaEquipo2+='              </div></td>';
            tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
            tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "data-bs-toggle="dropdown"<i class="fa fa-ellipsis-v text-xs"></i></button>';
                tablaEquipo2+='<div class="dropdown btn-group dropstart">';
                    tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
                        tablaEquipo2+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                            tablaEquipo2+='<li><a onclick="removeEquipo('+j+')" class="dropdown-item" ><i class="fas fa-trash">Elimninar</i></a></li>';
                        tablaEquipo2+='</ul>';
        tablaEquipo2+='</div></td>';
            // tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal" onclick="removeEquipo('+j+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
            tablaEquipo2+='</tr>';
        }
    });

    $("#tbEquipos").empty();
    $("#tbEquipos").html(tablaEquipo2);
          


  }

  function fnAprobarSolicitud(id_solicitud){
    
    // console.log(id_solicitud);
    Swal.fire({
      title: 'Aprobar Solicitud',
      // icon: 'warning',
      text: 'Esta Seguro de Aprobar la Solicitud..',
      showCancelButton: true,
      customClass: 'msj_solicitud',
      confirmButtonColor: '#b50915',
      cancelButtonColor: '#d33',
      cancelButtonText: 'No',
      confirmButtonText: 'Si'
      }).then((result) => {
      if (result.isConfirmed) {

        $.ajax({
          url: '/solicitudes/aprobar_solicitud/',
          type: 'GET',
          data: {'id_solicitud' : id_solicitud}
        }).always(function(r) {
            console.log(r.data);
            if (r.respuesta == true) {
              folio_solicitud = r.folio;
              Swal.fire({
                title: 'Aprobar Solicitud',
                // text: 'Se ha Registrado con Exito la Solicitud #5884',
                text: 'Se ha Aprobador con Exito la Solicitud y se Genero el Folio de Orden #'+folio_solicitud+'',
                customClass: 'msj_solicitud',
                icon: 'success',
                confirmButtonColor: '#b50915',
                allowOutsideClick: false
              }).then((result) => {
                if (result.isConfirmed) {
                    // alert('Se redireccciona al index');
                    window.location.href = "solicitudes_registros";
                }
              })
            }
            else if(r.respuesta == false){
              Swal.fire({
                title: 'Aprobar Solicitud',
                // text: 'Se ha Registrado con Exito la Solicitud #5884',
                text: 'Vuelva a Intentarlo',
                customClass: 'msj_solicitud',
                icon: 'error',
                confirmButtonColor: '#b50915',
                allowOutsideClick: false
              }).then((result) => {
                if (result.isConfirmed) {
                    // alert('Se redireccciona al index');
                    // window.location.href = "indexVentanilla";
                }
              })
            }
        });
      }
    })
  }

  function fnRechazarSolicitud(id){
    console.log(id);
    var comentario_rechazar = '';
    var select_rechazar = '';
    var myArrayOfThings=[];
    $.ajax({
      url: '/solicitudes/select_rechaza_solicitud/',
      type: 'GET'
      // data: {'vCentro_Trabajo' : vCentro_Trabajo}
      }).always(function(r) {
        // console.log(r);
        htmlselect = '';
        console.log(r.data);
        for (var i = 0; i < r.data['tipo_rechazo'].length; i++) {
          // console.log(r.data['tipo_rechazo']);
          myArrayOfThings.push({id: r.data['tipo_rechazo'][i]['id'], name: r.data['tipo_rechazo'][i]['motivo']});

          // var myArrayOfThings = [
          //   { id: r.data['tipo_rechazo'][i]['id'], name: r.data['tipo_rechazo'][i]['motivo'] }
          // ];
        }
        console.log(myArrayOfThings);

        var options = {};
        $.map(myArrayOfThings,
            function(o) {
                options[o.id] = o.name;
            });
        // console.log(htmlselect);
        Swal.fire({
        title: 'Rechazar Solicitud',
        // text: 'Escriba el motivo por el cual Rechaza la Solicitud',
        input: 'select',
        inputOptions: options,
        inputPlaceholder: 'Seleccione un Motivo de Rechazo',
        showCancelButton: true,

        // animation: 'slide-from-top',
        
        html:
            '<div class="swal_input_wrapper">'+
              '<div class="label_wrapper">Comentarios: </div>'+
                '<textarea id="swal-input3" style="width:80%" class="swal2-textarea"></textarea>'+
            '</div>',
        confirmButtonColor: '#b50915',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Siguiente',
        allowOutsideClick: false,
        // input: 'select',
        // inputOptions: inputOptionsPromise,
        preConfirm: (value) => {
          if (!value) {
            Swal.showValidationMessage(
                'El Combo de Rechazo no puede ir Vacio..'
            )
          }
          else if(!$('#swal-input3').val()){
            Swal.showValidationMessage(
                  'Debe seleccionar un tipo de Rechazo..'
              )
          }
          else{
            select_rechazar = value;
            comentario_rechazar = $('#swal-input3').val();
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {

          Swal.fire({
              title: 'Rechazar Solicitud',
              text: 'Esta Seguro de Rechazar la Solicitud ?',
              customClass: 'msj_solicitud',
              // icon: 'success',
              showCancelButton: true,
              confirmButtonColor: '#b50915',
              cancelButtonColor: '#d33',
              cancelButtonText: 'No',
              confirmButtonText: 'Si',
              allowOutsideClick: false
            }).then((result) => {
              if (result.isConfirmed) {
    
                $.ajax({
                  url: '/solicitudes/rechazar_solicitud/',
                  type: 'GET',
                  data: {
                    'comentario_rechazar' : comentario_rechazar,
                    'select_rechazar' : select_rechazar,
                    'id' : id}
                }).always(function(r) {
                    console.log(r.data);
                    if (r.respuesta == true) {
                      Swal.fire({
                        title: 'Rechazar Solicitud',
                        // text: 'Se ha Registrado con Exito la Solicitud #5884',
                        text: 'Se ha Rechazado con Exito la Solicitud # S2023-'+r.folio_solicitud+'',
                        customClass: 'msj_solicitud',
                        icon: 'success',
                        confirmButtonColor: '#b50915',
                        allowOutsideClick: false
                      }).then((result) => {
                        if (result.isConfirmed) {
                            // alert('Se redireccciona al index');
                            window.location.href = "solicitudes_registros";
                        }
                      })
                    }
                    else if(r.respuesta == false){
                      Swal.fire({
                        title: 'Rechazar Solicitud',
                        // text: 'Se ha Registrado con Exito la Solicitud #5884',
                        text: 'Vuelva a Intentarlo',
                        customClass: 'msj_solicitud',
                        icon: 'error',
                        confirmButtonColor: '#b50915',
                        allowOutsideClick: false
                      }).then((result) => {
                        if (result.isConfirmed) {
                            // alert('Se redireccciona al index');
                            // window.location.href = "indexVentanilla";
                        }
                      })
                    }
                    
                });
              }
          })
        }
      })
    });

  }

  function fnImprimirSolicitud(folio_solicitud){
    window.print();
  }

  $('#btn_cerrar').click(function(){

    $("#divListaTarea").prop('hidden', true);
    $("#divTablaEquipos").prop('hidden',false);
    arrTareas = [];
    arrServicios = [];
    arrEquipos = [];
    arrEscuelaTurno = [];
    // $('#titulo_equipos').prop('hidden', true);
    $('#tbEquipos tr').empty();
    $('#ulTarea tr').empty();
    // console.log('entra');
    $('#selTipoEquipo').prop('selectedIndex',0);
    $('#selTipoServicio').prop('selectedIndex',0);
    $('#selTarea').prop('selectedIndex',0);
    $('#txtDescripcionSoporte').val('');
  });

  $('#btn_agregar_servicio').click(function(){
    console.log('se agrego servicio');
    if (contador_servicio == 0) {
        console.log('entrooo');
    }
    
    tipo_equipo = $('#id_tipo_equipo').val();
    tipo_servicio = $('#id_tipo_servicio').val();
    console.log(tipo_equipo);
    console.log(tipo_servicio);
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
                        // console.log(arreglo_servicios[i]['vTipo_servicio']);
                        // console.log(tipo_servicio);
                        // console.log('es el miso servicio');
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
            // console.log(posicion_arreglo_servicios);
            contador_servicio = contador_servicio + 1;
            text_tipo_servicio = $("#id_tipo_servicio option:selected").text();
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
            
            // console.log(arreglo_servicios);
            // console.log('se agrego...');
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

  $('#btn_agregar_equipo').click(function(){
      $('#btn_agregar_equipo').prop('disabled', true); 
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

          // if($('#btn_replicar').is(":checked")==false){
          //   arreglo_servicios = [];
          //   contador_servicio = 0;
          //   $('#table_tipo_servicio tr').empty();
          //   // console.log('entra');
          //   $('#tipo_servicio').prop('selectedIndex',0);
          //   $('#tipo_equipo').prop('selectedIndex',0);
          //   $('#vDescripcion_Problema').val('');
          //   $('#btn_agregar_equipo').prop('disabled', false); 
          // }
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
      console.log(contador_id_tabla);
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
          // $('#listado_equipos tr').empty();
          $("#listado_equipos").hide();
          $('#div_btn_registrar').prop('hidden', true);
      }
  }

  function Eliminar_Registro(contador_registro){



    // var count_elements = 0;
    // var tipo_servicio = $('#id_tipo_servicio').val();
    // var tipo_tarea = $('#id_tipo_tarea').val();
    // var f ='';
    // var bandera_hidden = 0;

    var posicion = arreglo_registro.length
    // console.log($('tr').index(this));
    for (var i = 0; i < arreglo_registro.length; i++) {
      if (arreglo_registro[i]['id'] == contador_registro) {
          console.log('esta en la posicion '+ i+ 'el tipo servicio :' +arreglo_registro[i]['vTtipo_tarea']);
          // $('#tr_'+contador_registro+'').remove();
          $('#tr_servicio'+contador_registro+'').remove();
          $('#tr_tarea'+contador_registro+'').remove(); 
          arreglo_registro.splice(i, 1);
      }
    }


    // console.log(arreglo_registro[0]['identificador_arreglo']);
    // $.each(arreglo_registro, function(j, val){
    //     if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
    //       if (identificador_arreglo == arreglo_registro[j]['identificador_arreglo']) {
    //         if (tipo_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //           // console.log(arreglo_registro[j]);
    //           f = arreglo_registro.splice(j, 1);
    //         }
            
    //         // console.log(identificador_arreglo);
    //         // if (arreglo_registro[j]['id'] == contador_registro) {
    //           // variable_servicio = arreglo_registro[j]['vTipo_servicio'];
    //           // variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //           // if (tipo_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //           //   count_elements = count_elements + 1;
    //           //   f = arreglo_registro.slice(0, 1);  
    //           //   // console.log(f);  
    //           // }
    //           // console.log(variable_servicio.length);
    //         // }
    //         // if (variable_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //         //   console.log(arreglo_registro[j]['vTipo_servicio']);
    //         // //   variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //         // //   console.log(variable_servicio);
    //         // //   console.log(variable_tarea);
    //         // //   // count_elements = variable_tarea.length;
    //         //   // count_elements = count_elements + 1;
    //         // }
    //       }
    //     }
    // });
    // console.log(f);

    // $.each(arreglo_registro, function(j, val){
    //     if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
    //       if (identificador_arreglo == arreglo_registro[j]['identificador_arreglo']) {
    //         // console.log(identificador_arreglo);
    //         // if (arreglo_registro[j]['id'] == contador_registro) {
    //           // variable_servicio = arreglo_registro[j]['vTipo_servicio'];
    //           // variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //           if (tipo_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //             console.log(arreglo_registro[j]['vTipo_servicio']);
    //             // if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
    //               // console.log(tipo_servicio);
    //               f = arreglo_registro.slice(arreglo_registro[j]['id'], 1); 
    //             // }
    //             // count_elements = count_elements + 1;
                 
    //           }
    //           // console.log(variable_servicio.length);
    //         // }
    //         // if (variable_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //         //   console.log(arreglo_registro[j]['vTipo_servicio']);
    //         // //   variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //         // //   console.log(variable_servicio);
    //         // //   console.log(variable_tarea);
    //         // //   // count_elements = variable_tarea.length;
    //         //   // count_elements = count_elements + 1;
    //         // }
    //       }
    //     }
    // });

    // console.log(f);  


    // $('#tr_'+contador_servicio+'').remove();
    // console.log(arreglo_servicios);


    // var posicion = arreglo_servicios.length
    // console.log($('tr').index(this));
    // for (var i = 0; i < arreglo_servicios.length; i++) {
    //     // console.log('asdasd  '+arreglo_servicios.length);
    //     if (arreglo_servicios[i]['id'] == contador_servicio) {
    //         console.log('esta en la posicion '+ i+ 'el tipo servicio :' +arreglo_servicios[i]['vtext_tipo_servicio']);
    //         $('#tr_'+contador_servicio+'').remove();
    //         arreglo_servicios.splice(i, 1);
            
    //     }
    //     // console.log('asdasd  '+arreglo_servicios.length);
    // //     if (arreglo_servicios[i]['id'] == contador_servicio) {
    // //         console.log(arreglo_servicios[i]);
    // //         console.log(arreglo_servicios[i].length);
    //         // arreglo_servicios.splice(arreglo_servicios[i]['posicion'], 1);
    // //     }
    // }
    // $('#tr_'+contador_servicio+'').remove();
    // console.log(arreglo_servicios);
      
  }

  $('#btn_arreglo_registro').click(function(){
    


    tipo_equipo = $('#id_tipo_equipo').val();
    tipo_servicio = $('#id_tipo_servicio').val();
    tipo_tarea = $('#id_tipo_tarea').val();
    text_tipo_equipo = $("#id_tipo_equipo option:selected").text();
    text_tipo_servicio = $("#id_tipo_servicio option:selected").text();
    text_tipo_tarea = $("#id_tipo_tarea option:selected").text();

    if (tipo_tarea == 0 ) {
      Swal.fire({
        position: 'bottom-right',
        icon: 'warning',
        title: 'Favor de Seleccionar un Tipo de Tarea',
        showConfirmButton: false,
        customClass: 'msj_aviso',
        timer: 2000
      })
    }
    else{
      arreglo_registro.push({
      id: contador_registro,
      vTipo_equipo : tipo_equipo,
      txtTipo_equipo : text_tipo_equipo,
      txtTipo_servicio : text_tipo_servicio,
      vTipo_servicio : tipo_servicio,
      txtTipo_tarea : text_tipo_tarea,
      vTtipo_tarea : tipo_tarea,
      identificador_arreglo : identificador_arreglo});

      // prueba1.push({tipo_de_equipo : tipo_equipo});
      // console.log(arreglo_registro);

      

      
      // console.log($("#id_tipo_servicio option:selected").val());
      // console.log(tipo_servicio);

      for (var i = 0; i < arreglo_registro.length; i++) {
          if (arreglo_registro[i]['vTipo_servicio'] == tipo_servicio) {
            bandera_servicio = 1;
          }
          else{
            bandera_servicio = 0;
          }
      }
      if ($("#id_tipo_servicio option:selected").val() == tipo_servicio) {
        bandera_servicio = 1;
      }
      else{
        bandera_servicio = 0;
      }

      if ($("#id_tipo_servicio option:selected").val() == tipo_servicio) {

        
        var html='';
        if (bandera_servicio == 0) {
          html+='<tr id="tr_servicio'+contador_registro+'">';
                  html+='<td id="td_servicio'+contador_registro+'">';
                      html+='<label style="font-size:0.75em;">- '+text_tipo_servicio+'&nbsp;&nbsp;';
                      html+='</label>';
                  html+='</td>';
              html+='</tr>';
          $("#table_servicio").append(html);
        }
        else{
          html+='<tr id="tr_servicio'+contador_registro+'">';
                  html+='<td id="td_servicio'+contador_registro+'" >';
                    html+='<label style="font-size:0.75em;">- '+text_tipo_servicio+'&nbsp;&nbsp;';
                      html+='</label>';
                  html+='</td>';
              html+='</tr>';
          $("#table_servicio").append(html);
        }
        //   // html+='<table>';
        //       html+='<tr id="tr_servicio'+contador_registro+'">';
        //           html+='<td>';
        //               html+='<label style="font-size:0.75em;">- '+text_tipo_servicio+'&nbsp;&nbsp;';
        //               html+='</label>';
        //               // html+='<label style="font-size:0.75em;">'+text_tipo_tarea+'&nbsp;&nbsp;';
        //               //     html+='<i onclick="Eliminar_Registro('+contador_registro+')" style="color:red;" class="fa fa-trash" aria-hidden="true"></i>';
        //               // html+='</label>';
        //           html+='</td>';
        //       html+='</tr>';
        //   // html+='</table>';
        // $("#table_servicio").append(html);
      }
      

      var html2='';
          // html2+='<table>';
              html2+='<tr id="tr_tarea'+contador_registro+'">';
                  html2+='<td>';
                      html2+='<label style="font-size:0.75em;">- '+text_tipo_tarea+'&nbsp;&nbsp;';
                          html2+='<i onclick="Eliminar_Registro('+contador_registro+')" style="color:red;" class="fa fa-trash" aria-hidden="true"></i>';
                      html2+='</label>';
                  html2+='</td>';
              html2+='</tr>';
          // html2+='</table>';
      $("#table_tarea").append(html2);
      
      bandera_servicio = 1;
      contador_registro = contador_registro + 1;
    }

  });

  function Eliminar_Registro2(contador_registro){
    // var variable_servicio = 0;
    // var variable_tarea = 0;
    var count_elements = 0;
    var tipo_servicio = $('#id_tipo_servicio').val();
    var tipo_tarea = $('#id_tipo_tarea').val();
    var f ='';
    console.log(arreglo_registro);
    // $.each(arreglo_registro, function(j, val){
    //     if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
    //       if (identificador_arreglo == arreglo_registro[j]['identificador_arreglo']) {
    //         // console.log(identificador_arreglo);
    //         // if (arreglo_registro[j]['id'] == contador_registro) {
    //           // variable_servicio = arreglo_registro[j]['vTipo_servicio'];
    //           // variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //           if (tipo_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //             count_elements = count_elements + 1;
    //             f = arreglo_registro.slice(0, 1);  
    //             // console.log(f);  
    //           }
    //           // console.log(variable_servicio.length);
    //         // }
    //         // if (variable_servicio == arreglo_registro[j]['vTipo_servicio']) {
    //         //   console.log(arreglo_registro[j]['vTipo_servicio']);
    //         // //   variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //         // //   console.log(variable_servicio);
    //         // //   console.log(variable_tarea);
    //         // //   // count_elements = variable_tarea.length;
    //         //   // count_elements = count_elements + 1;
    //         // }
    //       }
    //     }
    // });

    // var count_elements = 0;
    
    console.log(count_elements);
    // console.log(contador_registro);
    contador_eliminar = contador_registro;
    count_elements = count_elements - 1;
    delete arreglo_registro[contador_eliminar];

    $.each(arreglo_registro, function(j, val){
        if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
          if (identificador_arreglo == arreglo_registro[j]['identificador_arreglo']) {
            // console.log(identificador_arreglo);
            // if (arreglo_registro[j]['id'] == contador_registro) {
              // variable_servicio = arreglo_registro[j]['vTipo_servicio'];
              // variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
              if (tipo_servicio == arreglo_registro[j]['vTipo_servicio']) {
                if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
                  console.log(arreglo_registro);
                  // f = arreglo_registro.slice(0, 1); 
                }
                count_elements = count_elements + 1;
                 
                // console.log(f);  
              }
              // console.log(variable_servicio.length);
            // }
            // if (variable_servicio == arreglo_registro[j]['vTipo_servicio']) {
            //   console.log(arreglo_registro[j]['vTipo_servicio']);
            // //   variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
            // //   console.log(variable_servicio);
            // //   console.log(variable_tarea);
            // //   // count_elements = variable_tarea.length;
            //   // count_elements = count_elements + 1;
            // }
          }
        }
    });
    // console.log(f);
    // if (count_elements == 1) {
    //   console.log('entro');
    //   $.each(arreglo_registro, function(j, val){
    //     if (!jQuery.isEmptyObject(arreglo_registro[j])) { 
    //       if (identificador_arreglo == arreglo_registro[j]['identificador_arreglo']) {
    //         // console.log(identificador_arreglo);
    //         // if (arreglo_registro[j]['id'] == contador_registro) {
    //           // variable_servicio = arreglo_registro[j]['vTipo_servicio'];
    //           // variable_tarea = arreglo_registro[j]['vTtipo_tarea'];
    //           console.log(arreglo_registro.shift(0));
    //       // if ($('#td_servicio'+contador_registro+'').is(":hidden")) {
    //       //   console.log('enro2');
    //       //   // console.log(arreglo_registro[j]['id']);
    //       //   // $('#td_servicio'+arreglo_registro[j]['id']+'').prop('hidden', false);
    //       // }
    //       }
    //     }
    //   });
    // }
    

    // console.log(count_elements);

    // console.log(count_elements);

    // for (var i = 0; i < arreglo_registro.length; i++) {
    //   if (identificador_arreglo == arreglo_registro[i]['identificador_arreglo']) {
    //     count_elements = arreglo_registro.length;
    //     if (count_elements == 1) {
    //       if ($('#td_servicio'+contador_registro+'').is(":hidden")) {
    //         $('#td_servicio'+contador_registro+'').prop('hidden', true);
    //       }
    //     }
    //   }
    // }
    // console.log(arreglo_registro);   
    // var f = arreglo_registro.slice(0, 1);  
    // console.log(f);  
    // $(this).closest('tr').find('.contact_name').text(); 
    // console.log($(this).closest('td').text());
    // console.log($('#td_servicio'+contador_registro+'').is(":hidden"));
    
    $('#tr_servicio'+contador_registro+'').remove();
    $('#tr_tarea'+contador_registro+'').remove();
    contador_total_registro=contador_total_registro-1;
    // console.log(contador_total_registro);
    
    if(contador_total_registro == 0){
        console.log(contador_total_registro);
        contador_total_registro = 0;
        contador_id_tabla_registro = 0;
        arreglo_registro = [];
        // $('#listado_equipos tr').empty();
        // $("#listado_equipos").hide();
        // $('#div_btn_registrar').prop('hidden', true);
    }
  }

  $('#btn_agregar_registro').click(function(){


    
    // $('#listado_equipos').html(html);
    // var bandera_servicio = 0;
    // var texto_servicio = '';

    vDescripcion_Problema = $('#vDescripcion_Problema').val();

    if (vDescripcion_Problema == '') {
      Swal.fire({
        position: 'bottom-right',
        icon: 'warning',
        title: 'Favor de llenar El campo Descripcion',
        showConfirmButton: false,
        customClass: 'msj_aviso',
        timer: 2000
      })    
    }
    else{

        arreglo_registro2.push({
          vDescripcion_Problema : vDescripcion_Problema,
          identificador_arreglo : identificador_arreglo,
          arreglo_registro : arreglo_registro
        });      
      // prueba2.push({arreglo : prueba1});
      // console.log(arreglo_registro2);
      // arreglo_registro2.push({
      //   id: identificador_arreglo,
      //   arreglo : arreglo_registro,
      //   descripcion_problema : vDescripcion_Problema,
      //   folio_solicitud_global : folio_solicitud_global});
      // console.log(folio_solicitud_global)
      // console.log(arreglo_registro2);
      // identificador_arreglo = identificador_arreglo + 1;
      // console.log(arreglo_registro2[0]['arreglo_registro'][0]['txtTipo_servicio']);
      var html='';

      
          // console.log(arreglo_registro2[i]['vDescripcion_Problema']);
      // }
      // for (var i = 0; i < arreglo_registro2.length; i++) {
        console.log(arreglo_registro2);
        console.log(arreglo_registro);

        // for (var i2 = 0; i2 < arreglo_registro.length; i2++) {
          // console.log(arreglo_registro2[i]['arreglo_registro'][i2]['txtTipo_equipo']);
            html+='<tr id="tr_'+contador_id_tabla+'">';
              html+='<td>'+$("#id_tipo_equipo option:selected").text()+'</td>';
              // html+='<td>'+$("#id_tipo_servicio option:selected").text()+'</td>';
              html+='<td>';
              for (var i = 0; i < arreglo_registro2.length; i++) {
                for (var i2 = 0; i2 < arreglo_registro.length; i2++) {
                  if (arreglo_registro2[i]['identificador_arreglo'] == arreglo_registro[i2]['identificador_arreglo']) {
                    html+='- '+arreglo_registro[i2]['txtTipo_servicio']+'<br>';
                  }
                }
                
              }
              html+='</td>';
              html+='<td>';
              for (var i = 0; i < arreglo_registro2.length; i++) {
                for (var i2 = 0; i2 < arreglo_registro.length; i2++) {
                  if (arreglo_registro2[i]['identificador_arreglo'] == arreglo_registro[i2]['identificador_arreglo']) {
                    html+='- '+arreglo_registro[i2]['txtTipo_tarea']+'<br>';
                  }
                }
                
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
          $("#listado_equipos").append(html);

      // }
      // html+='hola';
      // for (var i = 0; i < arreglo_registro2.length; i++) {
      //   for (var i2 = 0; i2 < arreglo_registro.length; i2++) {
      //     if (arreglo_registro2[i]['identificador_arreglo'] == arreglo_registro[i2]['identificador_arreglo']) {
      //       console.log(arreglo_registro[i2]['identificador_arreglo']);
      //       console.log(arreglo_registro[i2]['txtTipo_servicio']);
      //       console.log(arreglo_registro2[i]['vDescripcion_Problema']);

      //     // contador_total=contador_total+1;
      //     contador_id_tabla=contador_id_tabla+1;
      //     var html='';
      //     html+='<tr id="tr_'+contador_id_tabla+'">';
      //       html+='<td>'+arreglo_registro[i2]['txtTipo_equipo']+'</td>';
      //       html+='<td>'+arreglo_registro[i2]['txtTipo_servicio']+'</td>';
      //       html+='<td>'+arreglo_registro[i2]['txtTipo_tarea']+'</td>';
      //       // html+='<td>'+$("#tipo_servicio option:selected").text()+'<br>'+$("#tipo_servicio option:selected").text()+'<br>'+$("#tipo_servicio option:selected").text()+'<br>'+$("#tipo_servicio option:selected").text()+'</td>';
      //       html+='<td>'+arreglo_registro2[i]['vDescripcion_Problema']+'</td>';
      //       // html+='<td><button class="btn btn-danger" style="font-size:0.80em;" onclick="Eliminar('+contador_id_tabla+')">Eliminar</button></td>';
      //       html+='<td><div class="dropdown btn-group dropstart">';
      //           html+='<button class="btn btn-link text-secondary mb-0 "data-bs-toggle="dropdown"<i class="fa fa-ellipsis-v text-xs"></i></button>';
      //               html+='<div class="dropdown btn-group dropstart">';
      //                   html+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
      //                       html+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
      //                           html+='<li><a onclick="Eliminar('+contador_id_tabla+')" class="dropdown-item" ><i class="fas fa-trash">Elimninar</i></a></li>';
      //                       html+='</ul>';
      //       html+='</div></td>';
      //     html+='</tr>';
      //     console.log('entro');
      //     $("#listado_equipos").append(html);

      //     }
      //   }
      // }

      // arreglo_registro = [];
      // if($('#btn_replicar').is(":checked")==false){
      //   arreglo_registro = [];
      //   // contador_servicio = 0;
      //   $('#table_servicio tr').empty();
      //   $('#table_tarea tr').empty();
        
      //   // console.log('entra');
      //   $('#id_tipo_servicio').prop('selectedIndex',0);
      //   $('#id_tipo_equipo').prop('selectedIndex',0);
      //   $('#id_tipo_tarea').prop('selectedIndex',0);
      //   $('#vDescripcion_Problema').val('');
      //   // $('#btn_arreglo_registro').prop('disabled', false); 
      // }
    }
    identificador_arreglo = identificador_arreglo + 1;
    // console.log(arreglo_registro2);

  });




</script>



@endsection
