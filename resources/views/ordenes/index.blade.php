@extends('layouts.contentIncludes')
@section('title','CAS CETE')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')

<div class="container-fluid py-4 mt-3">
<!-- <input type="hidden" id="hiddenIdUser" name="hiddenIdUser" class="form-control"  value="{{auth()->id()}}" > -->

    <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Administración de Órdenes de Servicio</h1>
        </div>
    </div>
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card ">

        <div class="card-header pb- p-3">
          <div class="d-flex justify-content-between">
            <h6 class="mb-2">Órdenes</h6>
          </div>
        </div>

        <div class="mb-2 p-3">
        
          <!-- <button type="button" class="btn colorBtnPrincipal" id="btnFiltros">Filtros</button> -->
          <div class="row">
            <div class="col-6 text-start">
              <div class="form-group align-middle">
                <!-- <button type="button" class="btn colorBtnPrincipal" id="btnFiltros">Filtrar</button> -->
                <div class="dropdown btn-group dropend" >
                    <button class="btn colorBtnPrincipal  mb-0 "
                        data-bs-toggle="dropdown" id="btnFiltros"
                          aria-haspopup="true" aria-expanded="false" >
                        <i class="fa fa-filter"></i> Filtrar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnFiltros1">
                        <li style="margin:auto;">
                          <div class="form-group"> 
                            <label for="selCoordinacion">Coordinación</label>
                            <select class="form-select" aria-label="Default select example" id="selCoordinacion" name="selCoordinacion">
                              <option value="0" selected>Seleccionar</option>
                              
                            </select>
                          </div>
                        </li>
                        
                        <li>
                          <div class="form-group">
                            <label for="estatus_eval_id">Estatus</label>
                            <select class="form-select" aria-label="Default select example" id="selEstatusOrden" name="selEstatusOrden" onchange="load()">
                              <option value="0" selected>Seleccionar</option>
                                @foreach($catEstatusOrden as $estatusOrden)
                                  <option value="{{ $estatusOrden->id_estatus_orden }}">{{ $estatusOrden->desc_estatus_orden }}</option>
                                @endforeach
                            </select>
                          </div>  
                        </li>
                      
                        <li>
                          <div class="form-group">
                            <label for="txtFechaInicio">Fecha Inicio</label>
                            <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control">
                          </div>
                        </li>
                        <li>
                          <div class="form-group">
                            <label for="txtFechaFin">Fecha Fin </label>
                            <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control">
                          </div>
                        </li>
                        <li>
                          <div class="form-group">
                            <label for="txtCCT">CCT</label>
                            <input type="text" id="txtCCT" name="txtCCT" class="form-control">
                          </div>
                        </li>
                        <li>
                          <div class="form-group">
                          <button type="button" class="btn btn-secondary" id="btnLimpiarFiltro">Limpiar Filtro</button>
                          </div>
                        </li>
                    </ul>
                </div>
              </div>
            </div>
          
            <div class="col-6 text-end">
              <div class="form-group align-middle">
                <button type="button" class="btn btn-secondary" id="btnFiltrar">Excel</button>
              </div>
            </div>
          
          </div>

          <div class="row" id="pnFiltros">
            
            <div class="col-2">
              <div class="form-group">
                <label for="estatus_id">Coordinación</label>
                <select class="form-select" aria-label="Default select example" id="estatus_id" name="estatus_id">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            
            <div class="col-2">
              <div class="form-group">
                <label for="estatus_eval_id">Estatus</label>
                <select class="form-select" aria-label="Default select example" id="estatus_eval_id" name="estatus_eval_id" onchange="load()">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            <div class="col-2"> 
              <div class="form-group">
                <label for="txtFechaInicio">Fecha Inicio</label>
                <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control">
              </div>
            </div>

            <div class="col-2"> 
              <div class="form-group">
                <label for="txtFechaFin">Fecha Fin </label>
                <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control">
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="txtCCT">CCT</label>
                <input type="text" id="txtCCT" name="txtCCT" class="form-control">
                <!-- <select class="form-select mun" aria-label="Default select example" id="municipio_select" name="municipio_select">
                  <option value="0" selected>Seleccionar</option>
                 
                </select> -->
              </div>
            </div>
            
            <div class="col-2">
              <!-- <div class="form-group align-middle">
                <button type="button" class="btn colorBtnPrincipal" id="btnFiltrar">Filtrar</button>
              </div> -->
            </div>
            
          <!-- </div> -->
          <!-- <div class="row text-end">
            <div class="col-12">
            <div class="form-group align-middle">
                <button type="button" class="btn btn-secondary" id="btnFiltrar">Excel</button>
              </div>
            </div>
          </div> -->
        </div>
        
        <div class="table-responsive">
            <table id="tablaPrueba2" class="table table-respnsive">
              <thead>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOLIO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CENTRO DE TRABAJO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">COORDINACIÓN A LA QUE PERTENECE</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA ORDEN</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TIEMPO DE APERTURA</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS</th>
                <th class="text-secondary opacity-7"></th>
              </thead>
              <tbody >

              </tbody>
            </table>
          <br><br>
          <div id="tbGenerarExcel" ><meta charset="utf-8"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL CANCELAR ORDEN -->
<div class="modal fade" id="cancelRevisionModal" tabindex="-1" aria-labelledby="cancelRevisionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cancelRevisionModalLabel">Datos de la Cancelación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-6">
          <div class="form-group">
            <label for="estatus_id">Usuario Cancela</label>
            <input type="text" id="txtUsuarioCancela" name="txtUsuarioCancela" class="form-control" value="ATENCION DE USUARIOS">
            <input type="hidden" id="hdIdOrdenCancela" name="hdIdOrdenCancela" class="form-control">
            <input type="hidden" id="hdIdEstatusCancela" name="hdIdEstatusCancela" class="form-control">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="selMotivoCancela">Motivo de cancelación</label>
            <select class="form-select" aria-label="Default select example" id="selMotivoCancela" name="selMotivoCancela">
              <option value="0" selected>Seleccionar</option>
              <option value="1" selected>Duplicidad</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" onclick="fnGuardarCancelacion()" id="btnGuardarCancelacion">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL CANCELAR-->

@endsection 

@section('page-scripts')
<script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
<script src="{{ asset('js/sweetalert2@11.js') }}"></script>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> -->

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script>
  var tabla;
  var vRol;
  var iduser;
  // var evalu;
  var evalu = []; 
  var arrayCentro = [];
 
  function load(){
    var tipo='GET';
    // var tipo2='POST';
    // var estatus_id= $('#estatus_id').val();
    // var estatus_eval_id= $('#estatus_eval_id').val();
    // var municipio_select= $('#municipio_select').val();
    // var grado_select= $('#grado_select').val();
    // var region_select= $('#region_select').val();
    // var nivel_select= $('#nivel_select').val();
    $.ajax({
      url: '{{route("showOrdenes")}}',
      // data:{'estatus_id' : estatus_id,
      //   'estatus_eval_id' : estatus_eval_id,
      //   'municipio_select' : municipio_select,
      //   'grado_select' : grado_select,
      //   'region_select' : region_select,
      //   'nivel_select' : nivel_select},
      type: tipo,
      dataType: 'json', // added data type
      success: function(data) {
          // vRol=data.vRol;
          // console.log(data);
          fntabla(data);
          //evalu=data[1];
      }
    });
  }

  function fntabla(data){
    // evalu=data[1];
    //  hiddenIdUser=$('#hiddenIdUser').val();
    //  if(vRol=='J'){
    //   hideColumn=5;
    //  }else{
    //   hideColumn='';
    //  }
     
    if(tabla){
      $('#tablaPrueba2').DataTable().clear().destroy();
    }
    console.log(data[0]);
    tabla=$('#tablaPrueba2').DataTable({
          data:data[0],
          columns: [
            { data: 'folio' },
            { data: null, render:function(data){
                return '<h6 class="mb-0 text-sm">'+data.nombrecct+'</h6><p class="text-xs text-secondary mb-0">'+data.clavecct+'</p>';
              }
            },
            { data: null, render:function(data){
                return '<span>VICTORIA</span>';
              }
            },
            { data: 'fecha_orden' },
            // { data: 'estatus' },
            // { data: 'tiempo_apertura' },
            { data: null, render:function(data){
                if(data.tiempo_apertura>1){
                  return '<span>'+data.tiempo_apertura+' DíAS</span>';
                }else{
                  return '<span>'+data.tiempo_apertura+' DíA</span>';
                }
              }
            },
            // { data: 'desc_estatus_orden' },
            { data: null, render:function(data){
                 if(data.desc_estatus_orden=='TRABAJANDO'){
                  return '<span style="background-color:grey; border-radius:0.5em; padding:0.17em; color:white;">TRABAJANDO</span>';
                 }else{
                  return '<span>'+data.desc_estatus_orden+'</span>';
                 }
              }
            },
            { data: null, render:function(data){
              var estatuss='';
              estatuss+= '<div class="dropdown btn-group dropstart">'+
                        '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                        '<ul class="dropdown-menu" aria-labelledby="opciones1">'+
                        '<li>'+
                        '<a onclick="fnMostrarInfo('+data.id_orden+',1)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-edit"></i> Editar Orden de Servicio</a>'+
                        '</li>'+
                        '<li>'+
                        '<a onclick="cancelarOrden('+data.id_orden+',5)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="	fas fa-times"></i> Cancelar Orden</a>'+
                        '</li>'+
                        '<li>'+
                        '<a onclick="updEstatusOrden('+data.id_orden+',3)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-play"></i> Iniciar Orden</a>'+
                        '</li>'+
                        '<li>'+
                        '<a onclick="imprimirPDFOrden('+data.id_orden+')" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                        '</li>'+
                        '<li>'+
                        '<a onclick="updEstatusOrden('+data.id_orden+',4)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-check"></i> Cerrar Orden</a>'+
                        '</li>';
                      //       if(vRol=='A'){
                      //         if( !(data.estatus_id==2 || data.estatus_id==3)){
                      //           estatuss+=        '<li>'+
                      //           '<a onclick="fnMostrarInfo('+data.id_orden+',2)"  class="dropdown-item"          data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-download"></i> Revisar Dibujo </a>'+ '</li>';
                      //         }
                      //       }
                      //       if(vRol=='J'){  
                      //         if(data.estatus_eval_id!=2){
                      //           if (data.countJuez!=1){
                      //  estatuss+=         '<li>'+
                      //           '<a onclick="fnEvaluar('+data.id_orden+')" class="dropdown-item"><i class="fas fa-edit"></i> Evaluar Dibujo</a>'+
                      //            '</li>';
                      //           }
                      //         }
                      //       }
                            //   estatuss+=       '<li>'+
                            // '<a  onclick="fnPrueba('+data.id_orden+')"class="dropdown-item" ><i class="fas fa-eye"></i> Evaluación de Dibujo</a>'+
                            //     '</li>'+
                            estatuss+='</ul>'+
                        '</div>';
                  return estatuss;
              }
            },
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
        // dom: 'Bfrtip', //arriba   //dom: 'lfrtipB', ////abajo
        // buttons: [{
        // extend: 'excel', //Botón para Excel
        // footer: true,
        // title: 'Archivo',
        // filename: 'Export_File',
        // text: '<button class="btn btn-secondary">Excel <i class="fas fa-file-excel"></i></button>', //Aquí es donde generas el botón personalizado
        // exportOptions: {
        //         columns: [0,1,2,3,5,6]
        //     }
        //   }],
        columnDefs: [
                    {
                        // "targets": [ hideColumn ],
                        "visible": false,
                        "searchable": true
                    },
        ]
      });
  }

  function updEstatusOrden(idOrden,idEstatusOrden){

    if(idEstatusOrden==5){
      Swal.fire({
        title: 'Datos de Cancelación',
        html:
          '<input id="swal-Usuario" class="form-control">' +
          '<select class="form-control selectpicker show-tick" id="lista" data-style="btn-warning" data-live-search="true" ><option value="0">Seleccione una opción</option><option value="1">Duplicidad</option></select> ',
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
          console.log($("#swal-Usuario").val());
          console.log($("#lista").val());
          $.ajax({
              url: "{{ route('updEstatusO') }}",
              data:{idOrden : idOrden, idEstatusOrden : idEstatusOrden},
              type: 'POST',
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              dataType: 'json', 
              success: function(data) {
                var obj = jQuery.parseJSON(data);
                console.log(obj.exito+'--1');
                console.log(data[0]+'--2');
                console.log(data[0][0]+'--3');
                console.log(data[0][0]['exito']+'--4'); 
                // if(data[0][0]['exito']==false){
                //   msjeAlertaPrincipal('Cancelada correctamente','','success')
                //   load();
                // }else{
                //   msjeAlertaPrincipal('No se cancelo','','error')
                // }
                // console.log(data[0][0]);   //data[0][i].id_tarea
                // if(data[0][0]['exito']==false){
                //   msjeAlertaPrincipal('Estatus actualizado correctamente','','success')
                //   load();
                // }else{
                //   msjeAlertaPrincipal('Estatus No se actualizó','','error')
                // }
              }
          });
          // return fetch("{{ route('updEstatusO') }}")
          //   .then(response => {
          //     if (!response.ok) {
          //       throw new Error(response.statusText)
          //     }
          //     return response.json()
          //   })
          //   .catch(error => {
          //     Swal.showValidationMessage(
          //       `Request failed: ${error}`
          //     )
          //   })
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        // if (result.isConfirmed) {
        //   Swal.fire({
        //     title: 'Cancelada correctamente'
        //   })
        // }
      });//fin sweetAlert
    }else{

      $.ajax({
          url: "{{ route('updEstatusO') }}",
          data:{idOrden : idOrden, idEstatusOrden : idEstatusOrden},
          type: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType: 'json', 
          success: function(data) {
            console.log(data[0][0]);   //data[0][i].id_tarea
            if(data[0][0]['exito']==false){
              msjeAlertaPrincipal('Estatus actualizado correctamente','','success')
              load();
            }else{
              msjeAlertaPrincipal('Estatus No se actualizó','','error')
            }
          }
      });
    }
  }

  function imprimirPDFOrden(idOrden){

    let urlEditar = '{{ route("download-pdf", ":id") }}';
    urlEditar = urlEditar.replace(':id', idOrden);
    
    $.ajax({
        url: urlEditar,
        type: 'GET',
        // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json', 
        success: function(data) {
          console.log(data[0][0]);   //data[0][i].id_tarea
          // if(data[0][0]['exito']==false){
          //   msjeAlertaPrincipal('Estatus actualizado correctamente','','success')
          //   load();
          // }else{
          //   msjeAlertaPrincipal('Estatus No se actualizó','','error')
          // }
        }
    });
  }

  function msjeAlertaPrincipal(titulo, contenido, icono){
    Swal.fire(
      titulo,
      contenido,
      icono
    )
  }

  function msjeAlertaSecundario(titulo, contenido, icono){
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

  function cancelarOrden(idOrden,idEstatusOrden){
    $("#hdIdOrdenCancela").val("");
    $("#hdIdEstatusCancela").val("");

    $("#cancelRevisionModal").modal("show");

    $("#hdIdOrdenCancela").val(idOrden);
    $("#hdIdEstatusCancela").val(idEstatusOrden);
  }

  function fnGuardarCancelacion(){
    var hdIdOrdenCancela = $("#hdIdOrdenCancela").val();

    if( $("#selMotivoCancela").val() == 0 ){
      msjeAlertaSecundario('Debe seleccionar motivo cancelación', '', 'error');
    }

    $.ajax({
        url: "{{ route('updEstatusO') }}",
        data:{idOrden : hdIdOrdenCancela, idEstatusOrden : 5},
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json', 
        success: function(data) {
          if(data[0]['updestatusorden']==false){
            msjeAlertaPrincipal('Cancelada correctamente','','success')
            load(); 
          }else{
            msjeAlertaPrincipal('No se cancelo','','error')
          }
          $("#cancelRevisionModal").modal("hide");
          
        }
    });
  }

  $(document).ready(function () {
    load()

    $("#btnFiltrar").show();
    $("#pnFiltros").hide();
    $("#tbGenerarExcel").hide();
     $("#divPrueba").hide();
    $("#divPrueba").css("display", "none");
    $("#btnRevisar").prop('disabled', true);
    $('#estatus_selec_id option[value="0"]').attr("selected", true);
    $("#msjObli").hide();
    $("#mostrarDibujo").hide();
    $("#revisarDibujo").hide();
    $("#visualizarNoSeleccionado").hide();
    // $("#estatus_eval_id").prop('disabled', true); //lo comente 1 abr 2023 porque me desactivaba en el del juez el 
    ////

    $('#tablaListado').DataTable({
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
        // dom: 'Bfrtip', //arriba   //dom: 'lfrtipB', ////abajo
        // buttons: [{
        //   action: function ( e, dt, node, config ) {
        //       // Do custom processing
        //       // ...
        //       column = dt.column(1);  // column contains API for column 1
        //       that = this;  // Need `this` in the each loop context for excel button
                
        //       column.data().unique().sort().each( function ( d, j ) {
        //         console.log(d);
        //         column.search(d);
        //         $.fn.dataTable.ext.buttons.excelHtml5.action.call(that, e, dt, node, config);
        //       } );

        //     },
        // extend: 'excel', //Botón para Excel
        // footer: true,
        // title: 'Archivo',
        // filename: 'Export_File',
        // text: '<button class="btn btn-secondary">Excel <i class="fas fa-file-excel"></i></button>', //Aquí es donde generas el botón personalizado
        // exportOptions: {
        //         columns: [0,2,3,5,6,8,9,10,11]
        //     }
        //   }],
    "columnDefs": [
      {
          "targets": [ 2,3,5,6,8,9 ],
          "visible": false,
          // "searchable": false
      }] 
    } );

    $('#estatus_selec_id').on('change', function() {
      if(this.value==1){
        $("#btnRevisar").prop('disabled', false);
        $("#msjObli").hide();
      }else if(this.value==2){
        $("#btnRevisar").prop('disabled', true);
        $("#msjObli").show();
      }else{
        $("#btnRevisar").prop('disabled', true);
        $("#msjObli").hide();
      }
    });


      
    $( "#estatus_id").change(function () {
      $("#estatus_eval_id").val('0')

      if(this.value==1){
        $("#estatus_eval_id").prop('disabled', true);
        $("#estatus_eval_id").val('0')
        
        load();
      }else if(this.value==2){
        $("#estatus_eval_id option[value=0]").attr("selected",true);
        //  $('#estatus_eval_id option[value="3"]').prop('disabled', true);
        $("#estatus_eval_id").prop('disabled', false);
        load();
      }else{
        $("#estatus_eval_id").prop('disabled', true);
        $("#estatus_eval_id").val('0')
        load();
      }
    });

    $("#btnFiltros").click(function(){
      // $("#pnFiltros").toggle("slow");
      $('#estatus_selec_id option[value="0"]').attr("selected", true);
      $('#observaciones').val('');
      $("#cancelRevisionModal").modal("hide");
      $("#exampleModal").modal("hide");
    });

    $("#btnLimpiarFiltro").click(function(){
      // $("#pnFiltros").toggle("slow");
      // $('#selCoordinacion option[value="0"]').attr("selected", true);
      // $('#selEstatusOrden option[value="0"]').attr("selected", true);
      $("#selCoordinacion").val("0").attr("selected",true);
      $("#selEstatusOrden").val("0").attr("selected",true);
      $("#selCoordinacion").val('0')
      $('#txtFechaInicio').val('');
      $('#txtFechaFin').val('');
      $('#txtCCT').val('');
      // $("#cancelRevisionModal").modal("hide");
      // $("#exampleModal").modal("hide");
    });

    $("#btnFiltrar").click(function(){
      //  let urlEditar = '{{ route("filtrar", ":id") }}';
      //  urlEditar = urlEditar.replace(':id', id_registro_concurso);
      var est=$("#estatus_id").val();
      var est_e=$("#estatus_eval_id").val();
      var mun=$("#municipio_select").val();
      var grad=$("#grado_select").val();
      var region=$("#region_select").val();
      var nivel=$("#nivel_select").val();
      
      var tablita="";
      $.ajax({
          method: "post",
          encoding:"UTF-8",
          url:'{{ route("filtrar") }}',
          data:{
            estatus: est,
            estatus_eval: est_e,
            municipio: mun,
            region:region,
            grado: grad,
            nivel: nivel,
          },
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          dataType:"json",
          beforeSend: function() {
          },
//           success:function( data ) {
//             var reg=data.resFiltrado;
//             tablita+="<table><thead><th>FOLIO</th><th>CURP</th><th>NOMBRE COMPLETO</th><th>GENERO ALUMNO</th><th>GRADO ALUMNO</th><th>CLAVE ESCUELA</th><th>NOMBRE ESCUELA</th><th>MUNICIPIO</th><th>REGION</th><th>NIVEL</th><th>TELEFONO TITULAR</th><th>DOMICILIO</th><th>CORREO TITULAR</th><th>NOMBRE PERSONAJE</th><th>VALORES PERSONAJE</th><th>DESCRIPCIÓN PERSONAJE</th><th>JUEZ 1</th><th>JUEZ 2</th><th>JUEZ 3</th><th>JUEZ 4</th><th>JUEZ 5</th><th>TOTAL PUNTAJE</th></thead>";
//             tablita+="<tbody>";
//             for(var i=0;i<reg.length;i++){
//               // console.log(reg[i]['id_registro_concurso']);
//               tablita+="<tr>";
//               tablita+="<td>"+reg[i]['folio']+"</td>";
//               tablita+="<td>"+reg[i]['curp']+"</td>";
//               tablita+="<td>"+reg[i]['ap_paterno']+" "+reg[i]['ap_materno']+" "+reg[i]['nombre_alumno']+"</td>";
//               tablita+="<td>"+reg[i]['genero_alumno']+"</td>";
//               tablita+="<td>"+reg[i]['grado_alumno']+"° "+reg[i]['grupo_alumno']+"</td>";
//               tablita+="<td>"+reg[i]['cct']+"</td>";
//               tablita+="<td>"+reg[i]['nombre_cct']+"</td>";
//               tablita+="<td>"+reg[i]['nombre_municipio']+"</td>";
//               tablita+="<td>"+reg[i]['Region']+"</td>";
//               tablita+="<td>"+reg[i]['Nombre_Nivel']+"</td>";
//               tablita+="<td>"+reg[i]['telefono_titular']+"</td>";
//               tablita+="<td>"+reg[i]['domicilio_casa']+"</td>";
//               tablita+="<td>"+reg[i]['correo_titular']+"</td>";
//               tablita+="<td>"+reg[i]['nombre_personaje']+"</td>";
//               tablita+="<td>"+reg[i]['valores_personaje']+"</td>";
//               tablita+="<td>"+reg[i]['descripcion_personaje']+"</td>";
//               tablita+="<td>"+reg[i]['Juez1']+"</td>";
//               tablita+="<td>"+reg[i]['Juez2']+"</td>";
//               tablita+="<td>"+reg[i]['Juez3']+"</td>";
//               tablita+="<td>"+reg[i]['Juez4']+"</td>";
//               tablita+="<td>"+reg[i]['Juez5']+"</td>";
//               tablita+="<td>"+reg[i]['total_puntaje']+"</td>";
//               // if(reg[i]["estatus_id"]==2){
//               //   tablita+="<td>Seleccionado</td>";
//               // }
//               tablita+="</tr>";
//             }
//             tablita+="</tbody>";
//             tablita+="</table>";
//               $('#tbGenerarExcel').html(tablita);
//             //  console.log(tablita);
//             window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#tbGenerarExcel').html())); 
//             // var Result = 'data:application/vnd.ms-excel,';
//             // var DatosEncode = encodeURIComponent($('#tbGenerarExcel').html());

//             // window.open(Result + DatosEncode);
// // e.preventDefault();
//             // e.preventDefault();

//             // exportTableToExcel('excelDibujos')

//             // window.open('data:application/vnd.ms-excel;base64,' + jQuery.base64.encodeURIComponent(jQuery('#tbGenerarExcel').html()));
//           },
              success:function( data ) {
              // console.log(data);

              var reg=data.resFiltrado;
              var dibujos = data.resFiltrado2;
              var juez = data.jueces;

              // console.log(reg);
              // console.log(dibujos);
              // console.log(reg.length);
              // console.log(dibujos.length);
              // console.log(juez[0].name + " " + juez[0].apellidos);
              var th_jueces = "";
              for (let index = 0; index < juez.length; index++) {
              th_jueces += '<th style="background-color: #ab0033 !important; color: white;">'+ juez[index].name + ' ' + juez[index].apellidos +'</th>';
            }
            // style="background-color: #ab0033 !important;"
            tablita+='<html><head><meta charset="UTF-8"><style>.color-th{background-color: #ab0033 !important; color: white; }</style></head><table style="table-layout:none" border="1"><thead><th class="color-th">FOLIO</th><th class="color-th">CURP</th><th class="color-th">NOMBRE COMPLETO</th><th class="color-th">GENERO ALUMNO</th><th class="color-th">GRADO ALUMNO</th><th class="color-th">CLAVE ESCUELA</th><th class="color-th">NOMBRE ESCUELA</th><th class="color-th">MUNICIPIO</th><th class="color-th">REGION</th><th class="color-th">NIVEL</th><th class="color-th">TELEFONO TITULAR</th><th class="color-th">DOMICILIO</th><th class="color-th">CORREO TITULAR</th><th class="color-th">NOMBRE PERSONAJE</th><th class="color-th">VALORES PERSONAJE</th><th class="color-th">DESCRIPCIÓN PERSONAJE</th><th class="color-th">ESTATUS</th>'+ th_jueces +'<th class="color-th">TOTAL PUNTAJE</th></thead>';
              tablita+="<tbody>";
              
              for(var i=0;i<dibujos.length;i++){
                // console.log(reg[i]['id_registro_concurso']);

                
                  tablita+="<tr>";
                  tablita+="<td>"+dibujos[i]['folio']+"</td>";
                  tablita+="<td>"+dibujos[i]['curp']+"</td>";
                  tablita+="<td>"+dibujos[i]['ap_paterno']+" "+dibujos[i]['ap_materno']+" "+dibujos[i]['nombre_alumno']+"</td>";
                  tablita+="<td>"+dibujos[i]['genero_alumno']+"</td>";
                  tablita+="<td>"+dibujos[i]['grado_alumno']+"° "+dibujos[i]['grupo_alumno']+"</td>";
                  tablita+="<td>"+dibujos[i]['cct']+"</td>";
                  tablita+="<td>"+dibujos[i]['nombre_cct']+"</td>";
                  tablita+="<td>"+dibujos[i]['nombre_municipio']+"</td>";
                  tablita+="<td>"+dibujos[i]['Region']+"</td>";
                  tablita+="<td>"+dibujos[i]['Nombre_Nivel']+"</td>";
                  tablita+="<td>"+dibujos[i]['telefono_titular']+"</td>";
                  tablita+="<td>"+dibujos[i]['domicilio_casa']+"</td>";
                  tablita+="<td>"+dibujos[i]['correo_titular']+"</td>";
                  tablita+="<td>"+dibujos[i]['nombre_personaje']+"</td>";
                  tablita+="<td>"+dibujos[i]['valores_personaje']+"</td>";
                  tablita+="<td>"+dibujos[i]['descripcion_personaje']+"</td>";

                  if (dibujos[i]['estatus_id']==1){
                    tablita+="<td>Registrado</td>";
                  }else if (dibujos[i]['estatus_id']==2){
                    if (vRol=="J"){ //juradooooo si es jurado hace esto
                      if (dibujos[i]['estatus_eval_id']==3){
                        tablita+="<td>Por Evaluar</td>";
                      }else if (data.estatus_eval_id==1){
                        if (dibujos[i]['countJuez']==1){
                          tablita+="<td>Evaluado</td>";
                          }else{
                            tablita+="<td>Por Evaluar</td>";
                          }

                      }else if (dibujos[i]['estatus_eval_id']==2){
                        tablita+="<td>Evaluado</td>";
                      }
                    }else{// //si es admin
                      if(dibujos[i]['estatus_eval_id']==3){
                        tablita+="<td>Seleccionado</td>";
                      }else{
                          if( dibujos[i]['countEval'] > 0 && dibujos[i]['data.countEval'] < 5){
                            tablita+="<td>En Evaluación</td>";
                          }else if( dibujos[i]['countEval'] == 5 ){
                            tablita+="<td>Evaluado</td>";
                          }else{
                            tablita+="<td>En Evaluación</td>";
                          }
                      }
                    }
                  }else if (dibujos[i]['estatus_id']==3){
                    tablita+="<td>No Seleccionado</td>";
                  }
                  
                  // for (let w = 0; w < reg.length; w++) {
                    for (let index = 0; index < reg.length; index++) {
                      // console.log(reg[index][i]['Juez1']);
                      // var w = 0;
                      if(reg[index][i]['Juez'+index]==null){
                        tablita+="<td>-</td>";
                      }else{
                        tablita+="<td>"+reg[index][i]['Juez'+index]+"</td>";
                      }
                      // w++;
                      // tablita+="<td>"+reg[w][i]['Juez'+index]+"</td>";
                      // w++;
                      // tablita+="<td>"+reg[w][i]['Juez'+index]+"</td>";
                      // w++;
                      // tablita+="<td>"+reg[w][i]['Juez'+index]+"</td>";
                      // w++;
                      // tablita+="<td>"+reg[w][i]['Juez'+index]+"</td>";
                      // // console.log(w);
                      // break;
                    }
                  // }
                  if(dibujos[i]['total_puntaje']==null){
                    tablita+="<td>-</td>";
                  }else{
                    tablita+="<td>"+dibujos[i]['total_puntaje']+"</td>";
                  }

                  tablita+="</tr>";
              }

              tablita+="</tbody>";
              tablita+="</table></html>";
                $('#tbGenerarExcel').html(tablita);
              //  console.log(tablita);
              var Result = 'data:application/vnd.ms-excel,';
              var DatosEncode = encodeURIComponent($('#tbGenerarExcel').html());
              window.open(Result + DatosEncode);
              },
          error:function( data ) {
          },
      });

    });

  });

 </script>

@if(session('statusRev')==='OK1' )<!-- cuando revisa normalmente -->
  <script>
    Swal.fire(
      '¡Revisado correctamente!',//
      // 'El dibujo ha sido revisado correctamente',
      // 'success'
    )
  </script>
@endif

@if(session('statusRevErr')==='NOK1' ) 
  <script>
    Swal.fire(
      '¡Alerta!',
      'El dibujo ya ha sido revisado',
      'error'
    )
  </script>
@endif

@if(session('statusRevErr')==='NOK2' ) 
  <script>
    Swal.fire(
      '¡Alerta!',
      'El dibujo no se ha revisado',
      'error'
    )
  </script>
@endif

@if(session('statusRevErr')==='NOK3' ) 
  <script>
    Swal.fire(
      'Error!',
      'Ha habido un error y no se ha podido revisar el dibujo',
      'error'
    )
  </script>
@endif

@if(session('statusEval')==='OK1' )<!-- cuando evalua normalmente -->
  <script>
    Swal.fire(
      '¡Evaluado correctamente!'//,
      // 'El dibujo ha sido evaluado correctamente',
      // 'success'
    )
  </script>
@endif

<!-- ///cuando entra en la excepcion al picarle mas de una ves al boton y unique constraint no permite registrar mas de uno -->
@if(session('statusEvalErr')==='OK2' ) 
  <script>
    Swal.fire(
      '¡Evaluado correctamente!'//,
      // 'El dibujo ha sido evaluado correctamente',
      // 'success'
    )
  </script>
@endif

@if(session('statusErrEval')==='NOK1' ) 
<script>
    Swal.fire(
      '¡No se ha podido revisar!',
      'El dibujo no ha sido registrado',
      'error'
    )
  </script>
@endif

@if(session('statusErrEst')==='NOK2' ) 
<script>
    Swal.fire(
      '¡No se ha podido revisar!',
      'El dibujo no ha sido registrado',
      'error'
    )
  </script>
@endif

@if(session('statusExisEval')==='NOK3' ) 
<script>
    Swal.fire(
      '¡Alerta!',
      'El dibujo ya ha sido Evaluado por este Juez',
      'error'
    )
  </script>
@endif

@endsection
