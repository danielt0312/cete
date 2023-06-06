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
              <!-- <div class="col-12 table-responsive"> -->
                  <table class="table " id="tabla_solicitudes" width="100%">
                    


                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Municipio</th>
                              <th>Fecha Solicitud</th>
                              <th>Medio de Captacion</th>
                              <th>Tiempo de Apertura</th>
                              <th>Estatus</th>
                              <th width="100px">Action</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
              <!-- </div> -->
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

var arreglo_tipo_equipo = [];
var arreglo_tipo_servicio = [];
var arreglo_servicios = [];
var arreglo_tabla = [];

var posicion_arreglo_servicios = 0;
var contador_servicio = 0;
var contador_id_tabla = 0;
var contador_total = 0;




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
        order: [1, 'desc'],
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
            // console.log(arreglo_tipo_equipo);
            // console.log(arreglo_tipo_servicio);
            
    });

  });

  function fnMostrarInfo(folio_solicitud){
    console.log(folio_solicitud);

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
        type: 'GET', //FREE BIRD 
        data: {'folio_solicitud' : folio_solicitud}
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
        title: 'Esta seguro de Rechazar la Solicitud # #'+folio_solicitud+' ?',
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

  function fnActualizarSolicitud(folio_solicitud){
    console.log(folio_solicitud);

    html1='';
    html2='';
    html3='';
    html4='';
    htmlselect1='';
    htmlselect2='';

    $('#modal_solicitud_inf').html(html1);
    $('#modal_solicitud_inf2').html(html2);
    $('#select_tipo_equipo').html(htmlselect1);
    $('#select_tipo_servicio').html(htmlselect2);
    $('#modal_solicitud_inf4').html(html4);
    $('#numero_solicitud').html('');

    
    $.ajax({
        url: '/solicitudes/buscar_folio/',
        type: 'GET',
        data: {'folio_solicitud' : folio_solicitud}
        }).always(function(r) {
            console.log(r);
            $('#numero_solicitud').append('No. de Solicitud: '+r.data[0]['folio']+'');
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
            htmlselect1+='<label style="font-size:0.75em;">TIPO DE EQUIPO</label>';
            htmlselect1+='<select class="form-select" aria-label="Default select example" id="tipo_equipo">';
              htmlselect1+='<option selected value="0">SELECCIONAR EQUIPO</option>';
              for (var i = 0; i < arreglo_tipo_equipo.length; i++) {
                  htmlselect1+='<option value="'+arreglo_tipo_equipo[i]['id']+'">'+arreglo_tipo_equipo[i]['tipo_equipo']+'</option>';
              }
            htmlselect1+='</select>';
            $('#select_tipo_equipo').append(htmlselect1);

            htmlselect2+='<label style="font-size:0.75em;">TIPO DE SERVICIO</label>';
              htmlselect2+='<select class="form-select" aria-label="Default select example" id="tipo_servicio">';
                htmlselect2+='<option selected value="0">SELECCIONAR SERVICIO</option>';
                for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
                    htmlselect2+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
                }
            htmlselect2+='</select>';
            $('#select_tipo_servicio').append(htmlselect2);

            $('#modal_solicitud_inf').append(html1);
            $('#modal_solicitud_inf2').append(html2);
            // $('#modal_solicitud_inf3').append(html3);
            $('#titulo_equipos').prop('hidden', false);
            $('#modal_solicitud_inf3').prop('hidden', false);
        

    });

    $('#exampleModal').modal('show');

  } 

  function fnAprobarSolicitud(folio_solicitud){
    

    console.log(folio_solicitud);
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
            text: 'Se ha Aprobado con Exito la Solicitud, su # de Orden es '+folio_solicitud+' :',
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
  }

  function fnRechazarSolicitud(folio_solicitud){
    console.log(folio_solicitud);
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
  }

  function fnImprimirSolicitud(folio_solicitud){
    window.print();
  }

  $('#btn_cerrar').click(function(){
    $('#titulo_equipos').prop('hidden', true);
    $('#table_tipo_servicio tr').empty();
    $('#listado_equipos tr').empty();
    // console.log('entra');
    $('#tipo_servicio').prop('selectedIndex',0);
    $('#tipo_equipo').prop('selectedIndex',0);
    $('#vDescripcion_Problema').val('');
  });

  $('#btn_agregar_servicio').click(function(){
    // console.log('se agrego servicio');
    // if (contador_servicio == 0) {
    //     console.log('entrooo');
    // }
    
    tipo_equipo = $('#tipo_equipo').val();
    tipo_servicio = $('#tipo_servicio').val();
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
            text_tipo_servicio = $("#tipo_servicio option:selected").text();
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

          if($('#btn_replicar').is(":checked")==false){
          arreglo_servicios = [];
          contador_servicio = 0;
          $('#table_tipo_servicio tr').empty();
          // console.log('entra');
          $('#tipo_servicio').prop('selectedIndex',0);
          $('#tipo_equipo').prop('selectedIndex',0);
          $('#vDescripcion_Problema').val('');
          $('#btn_agregar_equipo').prop('disabled', false); 
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

</script>



@endsection
