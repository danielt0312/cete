@extends('layouts.contentIncludes')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
.tableFixHead          { overflow: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
.table-wrapper {
  width: 100%;
  height: 200px; /* Altura de ejemplo */
  overflow: auto;
}
.table-responsive{
    -sm|-md|-lg|-xl|-xxl
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
table td {
    word-wrap: break-word;
    max-width: 400px;
  }
  #tabla_solicitudes td {
    white-space:inherit;
  }



.highlight { background-color: red; }
</style>
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
    <div class="mb-2 p-3">


        <div>
        </div>
        
          <!-- <button type="button" class="btn colorBtnPrincipal" id="btnFiltros">Filtros</button> -->
          <div class="row">
            <div class="col-6 text-start">
              <div class="form-group align-middle">
                <!-- <button type="button" class="btn colorBtnPrincipal" id="btnFiltros">Filtrar</button> -->
                <div class="dropdown btn-group dropend" >
                  @can('169-btn-filt-registro')
                  <button class="btn colorBtnPrincipal btnFiltros"
                      data-bs-toggle="dropdown" id="btnFiltros"
                        aria-haspopup="true" aria-expanded="false" >
                      <i class="fa fa-filter"></i> Filtrar
                  </button>
                  @endcan
                  <ul class="dropdown-menu" aria-labelledby="btnFiltros1" style="padding:0.75em;">
                    <li style="margin:auto;">
                      <div class="form-group"> 
                        <label for="selCoordinacion">Coordinación</label>
                        <select class="form-select" aria-label="Default select example" id="selCoordinacion" name="selCoordinacion" onchange="load()">
                          <option value="0" selected>Seleccionar</option>
                          @foreach($catCoordinaciones as $coordinaciones)
                            <option value="{{ $coordinaciones->id }}">{{ $coordinaciones->coordinacion }}</option>
                          @endforeach
                            
                        </select>
                      </div>
                    </li>
                    
                    <li>
                      <div class="form-group">
                        <label for="selEstatusOrden">Estatus</label>
                        <select class="form-select" aria-label="Default select example" id="selEstatusOrden" name="selEstatusOrden" onchange="load()">
                          <option value="0" selected>Seleccionar</option>
                          @foreach($catEstatusOrden as $estatusOrden)
                            <option value="{{ $estatusOrden->id }}">{{ $estatusOrden->estatus }}</option>
                          @endforeach 
                        </select>
                      </div>  
                    </li>
                  
                    <li>
                      <div class="form-group">
                        <label for="txtFechaInicio">Fecha Inicio</label>
                        <input type="date" id="txtFechaInicio" name="txtFechaInicio" class="form-control" onchange="load()">
                      </div>
                    </li>
                    <li>
                      <div class="form-group">
                        <label for="txtFechaFin">Fecha Fin </label>
                        <input type="date" id="txtFechaFin" name="txtFechaFin" class="form-control" onchange="load()">
                      </div>
                    </li>
                    <li>
                      <div class="form-group">
                        <label for="txtCCT">C.C.T.</label>
                        <input type="text" id="txtCCT" name="txtCCT" class="form-control" onchange="load()">
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
                <select class="selectpicker" data-size="4" id="selColumna" data-selected-text-format="count" data-count-selected-text="{0} Columna(s) Seleccionada(s)" title="OCULTAR COLUMNAS" multiple aria-label="size 3 select example" placeholder>
                  <option value="0">Folio</option>
                  <option value="1">Estatus</option>
                  <option value="2">C.C.T</option>
                  <option value="3">Fecha</option>
                  <option value="4">Tiempo de apertura</option>
                </select>
                <!-- <button type="button" class="btn btn-secondary" id="btnFiltrar">Excel</button> boton del Excel-->
              </div>
            </div>
          
          </div>
        <div class="table-responsive">
              <div>
              <table class="table " id="tabla_solicitudes" width="100%">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Folio</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estatus</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">C.C.T</th>
                            <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Municipio</th> -->
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                            <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Medio de Captación</th> -->
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tiempo de Apertura</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="100px">Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
              </div>
        </div>
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
                    <!-- <h5 class="modal-title" id="numero_solicitud"></h5> -->
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body" id="modal_body">
                  <div class="row">
                    <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                        <label style="color:white;">Datos del centro de trabajo</label>
                    </div>
                    <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                  </div>
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                        <label style="color:white;">Datos del solicitante</label>
                    </div>
                    <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                  </div>
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf2">
                    </div>
                  </div>
                  <br>
                  <div id="div_inf_rechazada" hidden>
                      <div class="row">
                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label  style="color:white;">Datos de la solicitud rechazada</label>
                        </div>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                      </div>
                    <br>
                    <div class="row">
                      <div id="modal_solicitud_inf6">
                      </div>
                    </div>
                  </div>
                  <div id="div_inf_cancelada" hidden>
                        <div class="row">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                <label  style="color:white;">Datos de la solicitud canelada</label>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                        </div>
                        <br>
                        <div class="row">
                            <div id="modal_solicitud_inf7"></div>
                        </div>
                  </div>
                  <br>
                  <div id="div_inf_orden" hidden>
                    <div class="row">
                      <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                        <label id="label_orden" style="color:white;">Datos de la orden</label>
                        <label id="label_equipos" hidden style="color:white;">Descripción de equipo(s) y servicio(s) agregados</label>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                      </div>
                      <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                    
                    <br>
                    <div class="row">
                      <div id="modal_solicitud_inf5">
                      </div>
                      <div class="table-wrapper " style="height: 500px;">
                        <table class="table" >
                          <thead>
                            <th>#</th>
                            <th>CANTIDAD</th>
                            <th>EQUIPO / SERVICIO</th>
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
                  
                  <div  id="titulo_equipos" hidden>
                    <div class="row">
                    <div class="col-5" style="text-align:center;  background-color:#ab0033;"><label style="color:white;">Describa los detalles del equipo / servicio solicitado</label></div>
                    <div class="col-7" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                    
                  </div>
                  <br>
                  <div class="row">
                    <div id="modal_solicitud_inf3">
                      
                      <div class="row">
                        <div class="col-3"></div>
                        <!-- <div class="col-3"><table id="table_tipo_servicio"></table></div> -->
                        <div class="col-3"><table id="table_servicio"></table></div>
                        <div class="col-1"></div>
                        <div class="col-5"><table id="table_tarea"></table></div>
                        <div class="col-1"></div>
                      </div>
                      <!-- <br> -->
                      <div class="row">
                        <div class="col-12">
                          <label style="font-size:0.75em;">DESCRIPCIÓN DEL PROBLEMA O SOPORTE A REALIZAR</label>
                          <textarea style="height: 127px;" class="form-control" id="txtDescripcionSoporte" ></textarea>
                          <!-- <textarea class="form-control" id="vDescripcion_Problema" ></textarea> -->
                        </div>
                        <!-- <div class="col-3"></div>
                        <div class="col-1"></div>
                        <div class="col-1"></div> -->
                        <!-- <div class="col-7">
                          <div class="form-group col-12 scrollVerticalTareas"  style="font-size:0.75rem;" id="divListaTarea">
                              <span>LISTADO DE TAREAS</span>
                              <ul id="ulTarea" style="font-size:0.75rem;">
                                  
                              </ul>
                          </div>
                        </div> -->
                      </div>
                      <br>
                      <div class="row">
                        
                        <div class="col-3" id="select_tipo_equipo"></div>
                        <div class="col-3" id="select_tipo_servicio"></div>
                        <div class="col-4" id="select_tipo_tarea"></div>
                        <!-- <div class="col-4"> -->
                          <!-- <div class="container mt-5">
                            <select class="selectpicker" id="pruebaclickselect" multiple aria-label="size 3 select example">
                              <option value="0">seleccionar</option>
                            </select>
                          </div> -->

                          <!-- <select class="select2 form-control js-example-basic-multiple"  style='overflow-y: auto;' name="states[]" multiple="multiple" id="pruebaselect2"></select> -->

                        <!-- </div> -->
                        <div class="col-1" id="div_cantidad"></div>
                        <div class="col-1">
                          <br>
                          <button type="button"  class="btn colorBtnPrincipal" id="btnAgregarTarea"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>

                          <!-- <button class="btn btn-secondary" disabled style="font-size:0.80em;" id="btn_arreglo_registro">+</button> -->
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-12">
                        <span id="span_listado_tareas" style="color:#ab0033;">LISTADO DE TAREAS</span>
                          <div class="table-wrapper scrollVerticalTareas"   id="divListaTarea">
                              <ul id="ulTarea" >
                                  
                              </ul>
                          </div>
                        </div>
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
                                <th>DESCRIPCIÓN DEL SERVICIO</th>
                                <th></th>
                            </tr>
                            
                        </table>
                      </div> -->
                      <!-- <div class="col-8">
                          <div class="form-group col-12 overflow-auto"  style="font-size:0.75rem;" id="divListaTarea">
                              <span>LISTADO DE TAREAS</span>
                              <ul id="ulTarea" style="font-size:0.75rem;">
                                  
                              </ul>
                          </div>
                      </div> -->
                    </div>
                    <div id="div_añadir_equipo" hidden>
                      <div class="row" >
                        <div class="col-6"></div>
                        <!-- <div style="border-radius:10px; text-align: left; background-color: #e6e6e6b5; " class="col-6">
                          <input id="btn_replicar" type="checkbox">&nbsp;&nbsp;
                          <label>Mantener descripción del problema y lista de tareas para el siguiente equipo.</label>
                        </div> -->
                        <div style="text-align: right;" class="col-6">
                          <button type="button" class="btn colorBtnPrincipal" id="btnAgregarEquipo" >Agregar</button>
                        </div>
                      </div>
                          
                          
                          

                          <!-- <button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_registro">Agregar</button> -->
                      </div>
                      <br><br>
                      <div id="label_datos_ct">
                        <div class="row">
                          <div  class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label style="color:white;">Datos del centro de trabajo</label>
                          </div>
                          <div class="col-12"  style="border-bottom:3px solid #ab0033;">
                          </div>
                        </div>
                      </div>
                    <div class="col-12 table-wrapper" id="divTablaEquipos">
                    
                      <table class="table">
                          <thead>
                              <th>CANTIDAD</th>
                              <th>EQUIPO / SERVICIO</th>
                              <th>DESCRIPCIÓN</th>
                              <th>SERVICIO</th>
                              <th>TAREA</th>
                              <th>ACCIONES</th>
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
                    <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" > Guardar</button>

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
<!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->

<!-- <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<!-- <script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> -->

<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}"> 
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>





<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
var bandera_dibujo = 0;
var arrEliminarEquipos = [];
var arrContadorTabla = [];
// var arrReplicar = [];
var banderareplica = 0;


var arrTareasselect = [];
var selected12 = [];
var tabla;
var bandera_validacion_update = 0;
var bandera_validacion_update2 = 0;
var bandera_modal = 0;

$(function () {
  load();
  $('.selectpicker').selectpicker('refresh');
  // setInterval(('load()'), 5000);

});

  function load(){
    
    // console.log('entro');
      var tipo='GET';
      // var tipo='POST';
      var coordinacion_id= $('#selCoordinacion').val();
      var estatus_id= $('#selEstatusOrden').val();
      var fecha_inicio= $('#txtFechaInicio').val();
      var fecha_fin= $('#txtFechaFin').val();
      var clavecct= $('#txtCCT').val();
      console.log(fecha_inicio);
      $.ajax({
        url: '{{route("showSolicitudes")}}',
        data:{ 
          'coordinacion_id' : coordinacion_id,
          'estatus_id' : estatus_id,
          'fecha_inicio' : fecha_inicio,
          'fecha_fin' : fecha_fin,
          'clavecct' : clavecct,
        },
        type: tipo,
        dataType: 'json', // added data type
        success: function(data) {

            fntabla(data);

            // cargaSelTecnicoEncargado(data[1]);
        }
      });
  }

  function fntabla(data){
    // console.log(data);
    // if(tabla){
      $('#tabla_solicitudes').DataTable().clear().destroy();
      // tabla.ajax.reload();
    // }
    // console.log(data[0]);
    // $(function () {
    $('#exampleModal').modal({backdrop: 'static', keyboard: false})
    // var dias = 2;
    
    var tabla = $('#tabla_solicitudes').DataTable({
      
        // order: [0, 'desc'],
        // responsive: true,
        // processing: true,
        // serverSide: true,

        data:data[0],
        columns: [
            { data: null,className: "text-center", render:function(data){
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
            {data: 'estatus_solicitud', name: 'estatus_solicitud', className: "text-center"},
            // { data: null,className: "text-center", render:function(data){
            //     if (data.folio != data.folio_orden) {
            //       return '<h6 class="mb-0 text-sm">'+data.estatus_solicitud+'</h6><p class="text-xs text-secondary mb-0">'+data.estatus+'</p>';
                  
            //     }
            //     else{
            //       return '<h6 class="mb-0 text-sm">'+data.estatus_solicitud+'</h6>';

            //     }
            //   }
            // },
            { data: null, className: "text-left", render:function(data){
                return '<h6 class="mb-0 text-sm">'+data.nombrect+'</h6><p class="text-xs text-secondary mb-0">'+data.clave_ct+' ,  '+data.municipio+'</p>';
              }
            },
            { data: null, className: "text-center", render:function(data){
              var fechaO=data.fecha_captacion;
                var separaFecha = fechaO.split(" ");
                return '<h6 class="mb-0 text-sm">'+separaFecha[0]+'</h6><p class="text-xs text-secondary mb-0">'+separaFecha[1]+'</p>';
              }
            },
            // {data: 'municipio', name: 'municipio', className: "text-center"},
            
            // {data: 'captacion', name: 'captacion', className: "text-center"},
            { data: null,className: "text-center", render:function(data){
              if (data.fecha_apertura > 1) {
                return '<p class="mb-0 text-sm">'+data.fecha_apertura+' DÍAS</p>';
              }
              else if(data.fecha_apertura == 0){
                return '<p class="mb-0 text-sm">'+data.fecha_apertura+' DÍAS</p>';
              }
              else{
                return '<p class="mb-0 text-sm">'+data.fecha_apertura+' DÍA</p>';
              }
              }
            },
            { data: null, className: "text-center", render:function(data){
              var acciones='';
              if (data.id_estatus == 6) {
                                acciones+= '<div class="dropdown btn-group dro pstart">'+
                                    '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >'+
                                        '<i class="fa fa-ellipsis-v text-xs"></i>'+
                                    '</button>'+
                                    '<ul class="dropdown-menu">'+
                                        '<li>'+
                                            '<a onclick="fnMostrarInfo('+data.id+')" class="dropdown-item"> '+
                                            '<i class="fa fa-eye"></i>'+
                                                'Ver Detalles Solicitud'+
                                            '</a>'+
                                            '<a onclick="fnImprimirSolicitud('+data.id+')" class="dropdown-item"> '+
                                            '<i class="fas fa-download"></i>'+
                                                'Imprimir Solicitud'+
                                            '</a>'+
                                        '</li>'+
                                    '</ul>'+
                                '</div>';
                                return acciones;
                            }
                            else if(data.id_estatus == 2) {
                                acciones+= '<div class="dropdown btn-group dropstart">'+
                                    '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >'+
                                        '<i class="fa fa-ellipsis-v text-xs"></i>'+
                                    '</button>'+
                                    '<ul class="dropdown-menu">'+
                                        '<li>'+
                                            '<a onclick="fnMostrarInfo('+data.id+')" class="dropdown-item"> '+
                                            '<i class="fa fa-eye"></i>'+
                                                'Ver Detalles Solicitud'+
                                            '</a>'+
                                            '<a onclick="fnImprimirSolicitud('+data.id+')" class="dropdown-item"> '+
                                            '<i class="fas fa-download"></i>'+
                                                'Imprimir Solicitud'+
                                            '</a>'+
                                        '</li>'+
                                    '</ul>'+
                                '</div>';
                                return acciones;
                            }
                            else{
                              acciones+='<div class="dropdown btn-group dropstart">'+
                                '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >'+
                                '<i class="fa fa-ellipsis-v text-xs"></i>'+
                                '</button>'+
                                '<ul class="dropdown-menu">'+
                                '<li>'+
                                '<a onclick="fnMostrarInfo('+data.id+')" class="dropdown-item"> '+
                                '<i class="fa fa-eye"></i>'+
                                '    Ver Detalles Solicitud'+
                                '</a>'+
                                '<a onclick="fnActualizarSolicitud('+data.id+')" class="dropdown-item"> '+
                                '<i class="fas fa-edit"></i>'+
                                'Editar Solicitud'+
                                '</a>'+
                                '<a onclick="fnAprobarSolicitud('+data.id+')" class="dropdown-item"> '+
                                '<i class="fa fa-check"></i>'+
                                '    Aprobar Solicitud'+
                                '</a>'+
                                '<a onclick="fnRechazarSolicitud('+data.id+')" class="dropdown-item"> '+
                                '<i class="	fas fa-times"></i>'+
                                '    Rechazar Solicitud'+
                                '</a>'+
                                '<a onclick="fnImprimirSolicitud('+data.id+')" class="dropdown-item"> '+
                                '<i class="fas fa-download"></i>'+
                                '    Imprimir Solicitud'+
                                '</a>'+
                                '</li>'+
                                '</ul>'+
                                '</div>';
                                return acciones;
                            }
                                
              }
            },
            // {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
        ],
        "language": {
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 a 0 de 0 registros",
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
              "searchable": true
          },
        ],
        order: [0, "desc"],
        
    });

    
      $('#tabla_solicitudes tbody').on('click', 'tr', function () {
        // console.log(table.row( this ).data());
        $("#tabla_solicitudes tbody tr").css("background-color", "#FFFFFF");
        $(this).css("background-color", "#E8E8E6");
      });
      var column;
      $('#selColumna').on('changed.bs.select', function (e) {
        tabla.columns([0, 1, 2, 3, 4] ).visible( true );
          var options = $('#selColumna option:selected');
          var arraycheck = [];
          var arraycheck2 = [];
          // tabla.columns( [0, 1, 2] ).visible( true );     
          // tabla.columns( [3, 4] ).visible( false );    
          $(options).each(function(){
            arraycheck.push({id:$(this).val()}); 
          });
          arraycheck2 = arraycheck;
          // console.log(arraycheck2[0]['id']);
          
          for (let i = 0; i < arraycheck2.length; i++) {
            
            tabla.columns(arraycheck2[i]['id']).visible( false ); 
            
          }

      });
      // document.querySelectorAll('.toggle-vis').forEach((el) => {el.addEventListener('click', function (e) {
      //   e.preventDefault();
      //   // console.log('clicero');

      //   let columnIdx = e.target.getAttribute('data-column');
      //   let column = tabla.column(columnIdx);
      //   console.log(column);
      //   // // Toggle the visibility
      //   column.visible(!column.visible());
      //   });
      // });

    $.ajax({
        url: '{{route("selects_equipo_servicio")}}',
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
    
    // });
  }

  function fnMostrarInfo(id){
    // bandera_acceso3 = 1;
    // $(window).on('beforeunload', function (){
    //   //this will work only for Chrome
    //   $.ajax({
    //     url: '{{route("actualiza_acesso")}}',
    //     type: 'GET',
    //     data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso3}
    //   }).always(function(r) {
    //     // window.location.href = '{{route("index_solicitud")}}';
    //   });
    // });
    // window.onbeforeunload = function() {
    //   $.ajax({
    //     url: '{{route("actualiza_acesso")}}',
    //     type: 'GET',
    //     data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso3}
    //   }).always(function(r) {
    //     // window.location.href = '{{route("index_solicitud")}}';
    //   });
    // };
    contador_detalle_equipo = 1;
    $('#titulo_equipos').prop('hidden',true);
    $('#div_añadir_equipo').prop('hidden',true);
    $('#div_inf_orden').prop('hidden',true);
    $('#div_inf_rechazada').prop('hidden',true);
    $('#div_inf_cancelada').prop('hidden',true);
    // $('#btn_replicar').prop('hidden',true);
    // $('#btnAgregarEquipo').prop('hidden',true);
    console.log('entro al detalle');
    var bandera_orden = 0;
    $("#divTablaEquipos").prop('hidden',true);
    $("#label_datos_ct").prop('hidden',true);
    
    $("#btnGuardar").prop('hidden',true);

    html1='';
    html2='';
    html3='';
    html4='';
    html5='';
    html6='';
    html7='';
    html8='';
    html9='';

    $('#modal_solicitud_inf').html(html1);
    $('#modal_solicitud_inf2').html(html2);
    $('#modal_solicitud_inf5').html(html3);
    $('#modal_solicitud_inf6').html(html8);
    $('#modal_solicitud_inf7').html(html9);
    $('#tbody_orden_equipos').html(html4);
    $('#span_solicitud').html(html5);
    $('#span_estatus').html(html6);
    $('#span_orden').html(html7);
    $('#modal_solicitud_inf3').prop('hidden',true);
    $('#modal_solicitud_inf4').prop('hidden',true);
    // $('#table_tipo_servicio').html(html4);
    
    
    $('#numero_solicitud').html('');

    
    $.ajax({
        url: '{{route("buscar_folio")}}',
        type: 'GET',
        data: {'id' : id, 'bandera_orden' : bandera_orden}
        }).always(function(r) {
          console.log(r);
          if (r.id_estatus == 6) {
            $('#div_inf_rechazada').prop('hidden',false);

            console.log('entro la rechazada');
            html5+='No. de Solicitud: '+r.data[0]['folio']+'';
            html6+='Estatus Solicitud: '+r.estatus_solicitud+'';
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
              html1+='<div class="col-5">';
              html1+='<label>Estatus Solicitud: &nbsp;</label>';
                  html1+='<span>'+r.estatus_solicitud+'</span>';
                
              html1+='</div>';
              html1+='<div class="col-4">';
              html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                  html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
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
            $('#tbody_orden_equipos').append(html4);
            $('#span_solicitud').append(html5);
            $('#span_estatus').append(html6);
            $('#span_orden').append(html7);
            
            $('#modal_solicitud_inf').append(html1);
            $('#modal_solicitud_inf2').append(html2);
            $('#modal_solicitud_inf5').append(html3);
            $('#modal_solicitud_inf6').append(html8);
          }
          else if(r.id_estatus == 7){
            $('#div_inf_cancelada').prop('hidden',false);
            console.log(r);
            console.log('entro la cancelada');
            html5+='No. de Solicitud: '+r.data[0]['folio']+'';
            if (r.folio_orden!= null) {
                html6+='Estatus Orden: '+r.estatus+'';
                html7+='No. de Orden : '+r.folio_orden+'';
            }
            else{
                html6+='Estatus Solicitud: '+r.estatus+'';
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
                html1+='<div class="col-2">';
                  html1+='<label>Estatus Solicitud: &nbsp;</label>';
                    html1+='<span>'+r.estatus_solicitud+'</span>';
                html1+='</div>';
                html1+='<div class="col-3">';
                html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                  html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
                html1+='</div>';
                html1+='<div class="col-2">';
                  html1+='<label>Estatus Orden: &nbsp;</label>';
                    html1+='<span>'+r.estatus+'</span>';
                html1+='</div>';
                html1+='<div class="col-3">';
                html1+='<label>Fecha de la Orden : &nbsp;</label>';
                  html1+='<span>'+r.data_folio_orden[0]['fecha']+'</span>';
                html1+='</div>';
                html1+='<div class="col-2">';
                html1+='<label>Usuario : &nbsp;</label>';
                  html1+='<span>'+r.data_folio_orden[0]['nombre_usuario']+'</span>';
                html1+='</div>';
                
              }
              else{
                html1+='<div class="col-5">';
                  html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                    html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
                html1+='</div>';
                html1+='<div class="col-4">';
                  html1+='<label>Estatus Solicitud: &nbsp;</label>';
                    html1+='<span>'+r.estatus_solicitud+'</span>';
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

            html8+='<div class="row">';
            html8+='<div class="col-5">';
                html8+='<label>Motivo : &nbsp;</label>';
                html8+='<span>'+r.motivo_cancelada[0]['motivo']+'</span>';
            html8+='</div>';
            html8+='<div class="col-5">';
                html8+='<label>Comentarios : &nbsp;</label>';
                if (r.motivo_cancelada[0]['comentarios'] == null || r.motivo_cancelada[0]['comentarios'] == '') {
                    html8+='<span>No tiene comentarios</span>';
                }
                else{
                    html8+='<span>'+r.motivo_cancelada[0]['comentarios']+'</span>';
                }
                
            html8+='</div>';
            html8+='</div>';
            $('#tbody_orden_equipos').append(html4);
            $('#span_solicitud').append(html5);
            $('#span_estatus').append(html6);
            $('#span_orden').append(html7);
            
            $('#modal_solicitud_inf').append(html1);
            $('#modal_solicitud_inf2').append(html2);
            $('#modal_solicitud_inf5').append(html3);
            $('#modal_solicitud_inf7').append(html8);
          }
          else{
            html5+='No. de Solicitud: '+r.data[0]['folio']+'';
            if (r.folio_orden!= null) {
              html6+='Estatus Orden: '+r.estatus+'';
              html7+='No. de Orden : '+r.folio_orden+'';
            }
            else{
                html6+='Estatus Solicitud: '+r.estatus_solicitud+'';
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
                html1+='<div class="col-2">';
                  html1+='<label>Estatus Solicitud: &nbsp;</label>';
                    html1+='<span>'+r.estatus_solicitud+'</span>';
                html1+='</div>';
                html1+='<div class="col-3">';
                html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                  html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
                html1+='</div>';
                html1+='<div class="col-2">';
                  html1+='<label>Estatus Orden: &nbsp;</label>';
                    html1+='<span>'+r.estatus+'</span>';
                html1+='</div>';
                html1+='<div class="col-3">';
                html1+='<label>Fecha de la Orden : &nbsp;</label>';
                  html1+='<span>'+r.data_folio_orden[0]['fecha']+'</span>';
                html1+='</div>';
                html1+='<div class="col-2">';
                html1+='<label>Usuario : &nbsp;</label>';
                  html1+='<span>'+r.data_folio_orden[0]['nombre_usuario']+'</span>';
                html1+='</div>';
              }
              else{
                html1+='<div class="col-5">';
                html1+='<label>Estatus Solicitud: &nbsp;</label>';
                    html1+='<span>'+r.estatus_solicitud+'</span>';
                  
                html1+='</div>';
                html1+='<div class="col-4">';
                html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
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

            
            if (r.datos_orden != '') {
              
              $('#div_inf_orden').prop('hidden',false);
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
              console.log('entor');
              console.log(r.datos_orden);
              for (let i = 0; i < r.datos_orden.length; i++) {
                html4+='<tr>';
                // console.log(id_equipo_detalle+'_'+r.datos_orden[i]['tipo_equipo']);
                // if (id_equipo_detalle+r.datos_orden[i]['tipo_equipo'] == id_equipo_detalle+tipo_equipo) {
                //   html4+='<td></td>';
                // }
                // else{
                  if (r.datos_orden[i]['id_equipo_detalle'] == r.datos_orden[i]['id_principal']) {
                      html4+='<td style="text-align:center;">'+contador_detalle_equipo+'</td>';
                      contador_detalle_equipo = contador_detalle_equipo + 1; 
                      html4+='<td style="text-align:center;">'+r.datos_orden[i]['cantidad']+'</td>';
                      html4+='<td>- '+r.datos_orden[i]['tipo_equipo']+'</td>';
                      html4+='<td style="white-space: pre-line; word-break: break-word;">- '+r.datos_orden[i]['desc_problema']+'</td>';
                  }
                  else{
                      html4+='<td></td>';
                      html4+='<td></td>';
                      html4+='<td></td>';
                      html4+='<td></td>';
                  }
                  
                  // html4+='<td> '+r.datos_orden[i]['cantidad']+'</td>';
                  
                // }
                // if (r.datos_orden[i]['desc_problema'] == desc_problema) {
                //   html4+='<td></td>';
                // }
                // else{
                  // html4+='<td style="white-space: pre-line; word-break: break-word;">- '+r.datos_orden[i]['desc_problema']+'</td>';
                // }
                // if (r.datos_orden[i]['servicio'] == servicio) {
                //   html4+='<td></td>';
                // }
                // else{
                  html4+='<td>- '+r.datos_orden[i]['servicio']+'</td>';
                // }
                html4+='<td>- '+r.datos_orden[i]['tarea']+'</td>';
                html4+='</tr>'; 
                id_equipo_detalle = r.datos_orden[i]['id_equipo_detalle'];
                desc_problema = r.datos_orden[i]['desc_problema'];
                tipo_equipo = r.datos_orden[i]['tipo_equipo'];
                servicio = r.datos_orden[i]['servicio'];
              }              
            }

            
            // html4+='<tr>'; 
            // html4+='</tr>';
                
            $('#tbody_orden_equipos').append(html4);
            $('#span_solicitud').append(html5);
            $('#span_estatus').append(html6);
            $('#span_orden').append(html7);
            
            $('#modal_solicitud_inf').append(html1);
            $('#modal_solicitud_inf2').append(html2);
            $('#modal_solicitud_inf5').append(html3);
          }
          // if (r.data[0]['id_estatus'] != 1 || r.data[0]['id_estatus'] != 6 || r.data[0]['id_estatus'] != 7) {
          //   console.log('tiene equipos o tecnicos');
          // }

            

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
              confirmButtonColor: '#b50915',
              confirmButtonText: 'Aceptar'
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
              confirmButtonColor: '#b50915',
              confirmButtonText: 'Aceptar'
            }).then((result) => {
            // if (result.isConfirmed) {
                
                // window.location.href = "indexVentanilla";
            // }
          })
        }
      })
    });

  } 

  function fnupdateAcceso(id,bandera_acceso3){
    console.log(id);
    $.ajax({
        url: '{{route("actualiza_acesso")}}',
        type: 'GET',
        data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso3}
      }).always(function(r) {
        window.location.href = '{{route("index_solicitud")}}';
      });
    
  }

  function fnActualizarSolicitud(id){
      bandera_acceso3 = 1;
      $(window).on('beforeunload', function (){
        //this will work only for Chrome
        $.ajax({
          url: '{{route("actualiza_acesso")}}',
          type: 'GET',
          data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso3}
        }).always(function(r) {
          // window.location.href = '{{route("index_solicitud")}}';
        });
      });
      var refreshIntervalId  = setInterval(('fnupdateAcceso('+id+','+bandera_acceso3+')'), 300000);
      // clearInterval(refreshIntervalId);
      setTimeout(() => clearInterval(refreshIntervalId), 300000)
      var bandera_acceso2 = 0; 
      $.ajax({
        url: '{{route("actualiza_acesso")}}',
        type: 'GET',
        data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso2}
      }).always(function(r) {
        if (r.respuesta == true) {


          console.log(r);
          // bandera_acceso = true;

          $('#btnGuardar').prop('disabled',false);
          $('#div_inf_orden').prop('hidden',true);
          $('#div_añadir_equipo').prop('hidden',false);
          $('#div_inf_rechazada').prop('hidden',true);
          $('#div_inf_cancelada').prop('hidden',true);
          
          // console.log(arrEquipos);
          // console.log(arrTareas);


          bandera_orden = 1;
          $("#divListaTarea").prop('hidden', true);
          $("#span_listado_tareas").prop('hidden', true);
          
          $("#btnGuardar").prop('hidden',false);
          id_solicitud_global = id;
          // console.log(id_solicitud_global);
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
          htmldiv_cantidad='';
          htmlselect1='';
          htmlselect2='';
          htmlselect3='';

          $('#modal_solicitud_inf').html(html1);
          $('#modal_solicitud_inf2').html(html2);
          $('#div_cantidad').html(htmldiv_cantidad);
          $('#select_tipo_equipo').html(htmlselect1);
          $('#select_tipo_servicio').html(htmlselect2);
          $('#select_tipo_tarea').html(htmlselect3);
          $('#modal_solicitud_inf4').html(html4);
          $('#span_solicitud').html(html5);
          $('#span_estatus').html(html6);
          $('#span_orden').html(html7);
          $('#numero_solicitud').html('');

          
          $.ajax({
            
              url: '{{route("buscar_folio")}}',
              type: 'GET',
              dataType: 'json',
              data: {'id' : id, 'bandera_orden' : bandera_orden}
              }).always(function(r) {
                // console.log(r);
                folio_solicitud_global = r.data[0]['folio'];
                // $('#numero_solicitud').append('No. de Solicitud: '+r.data[0]['folio']+'');
                // console.log(r.data3);
                if (r.data3['original'].length!=0) {
                  if(r.data3['original'] !='' || r.data3['original'] !=null || r.data3['original'].length!=0){
                  bandera_dibujo = 1;
                  $.each(r.data3['original'], function(i, val){
                    // console.log('entro');
                      if (!jQuery.isEmptyObject(r.data3['original'][i])) {
                        // console.log(r.data3['original'][i]['id_solic_serv']);
                          // console.log(r.data3[0][i]["id_equipo_tarea"]);
                          // console.log(r.data3['original'][i]['tareas'][i].id);
                          // console.log(r.data3['original'][i]['tareas']['id']);
                          // console.log(r.data3[0][i]['id_equipo_tarea']);
                          // console.log(r.data3[0][i]);
                        arrEquipos.push({
                          con : i,
                          id_equipo_serv_solic : r.data3['original'][i]['id'],
                          id_tipo_equipo : r.data3['original'][i]['id_tipo_equipo'], 
                          desc_tipo_equipo : r.data3['original'][i]['tipo_equipo'], 
                          etiquetaServicio : '',
                          marca : '',
                          modelo : '', 
                          numeroSerie : '',
                          descripcionSoporte : r.data3['original'][i]['desc_problema'],
                          ubicacionEquipo : '',
                          cantidad : r.data3['original'][i]['cantidad'],
                          estatus_equipo : 1, 
                          nuevo : 0, 
                          aTarea : r.data3['original'][i]['tareas'], ///arreglo tareas
                          vJson : 1
                        
                        })
                      }
                    });        
                  }
                  drawRowEquipo2();
                }
                else{
                  $("#divTablaEquipos").hide()
                  $("#label_datos_ct").prop('hidden',true);
                }
                
                // console.log(bandera_dibujo);
                
                // console.log(arrEquipos);
                // else{
                    
                // }

                    html5+='No. de Solicitud: '+r.data[0]['folio']+'';
                    html6+='Estatus Solicitud: '+r.data[0]['estatus']+'';
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
                  html1+='<div class="col-5">';
                  html1+='<label>Estatus Solicitud : &nbsp;</label>';
                      html1+='<span>'+r.data[0]['estatus']+'</span>';
                  
                  html1+='</div>';
                  html1+='<div class="col-3">';
                  html1+='<label>Fecha de la Solicitud : &nbsp;</label>';
                      html1+='<span>'+r.data[0]['fecha_captacion']+'</span>';
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
                    html2+='<label>NOMBRE : &nbsp;</label>';
                      html2+='<input class="form-control" type="text" id="editar_nombre_solicitante" maxlength="100" value="'+r.data[0]['solicitante']+'">';
                  html2+='</div>';
                  html2+='<div class="col-4">';
                    html2+='<label>TELÉFONO : &nbsp;</label>';
                      html2+='<input class="form-control" type="text" maxlength="10" id="editar_telefono_solicitante" value="'+r.data[0]['telef_solicitante']+'">';
                      // html2+='<span>'+r.data[0]['telef_solicitante']+'</span>';
                  html2+='</div>';
                  html2+='<div class="col-4">';
                    html2+='<label>CORREO ELECTRÓNICO : &nbsp;</label>';
                    html2+='<br>'
                    // html2+='<input class="form-control" id="editar_correo_solicitante" value="'+r.data[0]['correo_solic']+'">';
                      html2+='<span>'+r.data[0]['correo_solic']+'</span>';
                  html2+='</div>';
                html2+='</div>';
                // html2+='<div class="row">';
                //   html2+='<div class="col-12">';
                //     html2+='<label>Correo Electrónico : &nbsp;</label>';
                //     html2+='<input class="form-control" id="editar_correo_solicitante" value="'+r.data[0]['correo_solic']+'">';
                //       // html2+='<span>'+r.data[0]['correo_solic']+'</span>';
                //   html2+='</div>';
                // html2+='</div>';
                html2+='<br>'
                html2+='<div class="row">';
                  html2+='<div class="col-12">';
                    html2+='<label>DESCRIPCIÓN DEL REPORTE : &nbsp;</label>';
                      html2+='<textarea style="height: 127px;" class="form-control" maxlength="450" id="editar_descripcion_solicitante">'+r.data[0]['descrip_reporte']+'</textarea class="form-control">';
                  html2+='</div>';
                html2+='</div>';
                html2+='<br>'
                
                htmldiv_cantidad+='<label  for="selTipoEquipo">CANTIDAD</label>';
                htmldiv_cantidad+='<input class="form-control" type="number" value="1" id="input_cantidad">';
                $('#div_cantidad').append(htmldiv_cantidad);

                htmlselect1+='<label for="selTipoEquipo">TIPO DE EQUIPO/SERVICIO</label>';
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

                htmlselect2+='<label for="selTipoServicio">ÁREA DE SERVICIO</label>';
                  htmlselect2+='<select class="form-select" id="selTipoServicio" name="selTipoServicio" aria-label="Example select with button addon">';
                    htmlselect2+='<option value="0" selected>SELECCIONAR EQUIPO/SERVICIO</option>';
                                                            
                  // htmlselect2+='</select>';
                  // htmlselect2+='<select disabled class="form-select" aria-label="Default select example" id="id_tipo_servicio">';
                  //   htmlselect2+='<option  selected value="0">SELECCIONAR SERVICIO</option>';
                    // for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
                    //     htmlselect2+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
                    // }
                // htmlselect2+='</select>';
                $('#select_tipo_servicio').append(htmlselect2);

                htmlselect3+='<label for="selTarea">TIPO DE TAREA</label><br>';
                //   htmlselect3+='<select class="form-select" id="selTarea" name="selTarea" aria-label="Example select with button addon">';
                //     htmlselect3+='<option value="0" selected>SELECCIONAR TAREA</option>';
                //   htmlselect3+='</select>';
                
                // htmlselect3+='<div class="container mt-5">';
                  htmlselect3+='<select class="selectpicker" data-width="100%" data-size="4" id="selTarea" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" title="SELECCIONAR TAREA" multiple aria-label="size 3 select example" placeholder>';
                    // htmlselect3+='<option value="0" data-hidden="true">Please select</option>';
                  htmlselect3+='</select>';
                // htmlselect3+='</div>';

                //   htmlselect3+='<select disabled class="form-select" aria-label="Default select example" id="id_tipo_tarea">';
                //     htmlselect3+='<option  selected value="0">SELECCIONAR TAREA</option>';
                //     // for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
                //     //     htmlselect3+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
                //     // }
                // htmlselect3+='</select>';
                $('#select_tipo_tarea').append(htmlselect3);
                // $('#select_tipo_tarea').append(htmlselect3);
                $('.selectpicker').attr('disabled',true);
                $('.selectpicker').selectpicker('refresh');
                // $('.selectpicker').attr('disabled',true);
                

                $('#modal_solicitud_inf').append(html1);
                $('#modal_solicitud_inf2').append(html2);
                $('#span_solicitud').append(html5);
                $('#span_estatus').append(html6);
                // $('#modal_solicitud_inf3').append(html3);
                $('#titulo_equipos').prop('hidden', false);
                $('#modal_solicitud_inf3').prop('hidden', false);

                $('#editar_telefono_solicitante').keypress(function (e) {    
                  var charCode = (e.which) ? e.which : event.keyCode    
                  if (String.fromCharCode(charCode).match(/[^0-9]/g))    
                    return false;                        
                }); 

                $("#id_tipo_equipo").change(function(){
                  // console.log($('#id_tipo_equipo').val());
                  
                  var pId_equipo = $('#id_tipo_equipo').val();
                  $.ajax({
                      url: '{{route("select_servicio")}}',
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
                        htmlselect2+='<option  selected value="0">SELECCIONAR EQUIPO/SERVICIO</option>';
                        for (var i = 0; i < arreglo_equipos_servicios.length; i++) {
                            htmlselect2+='<option value="'+arreglo_equipos_servicios[i]['id']+'">'+arreglo_equipos_servicios[i]['servicio']+'</option>';
                        }
                    htmlselect2+='</select>';
                    $('#select_tipo_servicio').append(htmlselect2);

                    htmlselect3+='<label style="font-size:0.75em;">TIPO DE TAREA</label>';
                      htmlselect3+='<select disabled class="form-select" title="SELECCIONAR TAREA" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" aria-label="Default select example" id="id_tipo_tarea">';
                        // htmlselect3+='<option value="" selected disabled>SELECCIONAR TAREA</option>';
                        // for (var i = 0; i < arreglo_tipo_servicio.length; i++) {
                        //     htmlselect3+='<option value="'+arreglo_tipo_servicio[i]['id']+'">'+arreglo_tipo_servicio[i]['servicio']+'</option>';
                        // }
                    htmlselect3+='</select>';
                    $('#select_tipo_tarea').append(htmlselect3);
                    $('.selectpicker').attr('disabled',true)
                    $('#btn_arreglo_registro').prop('disabled',true);
                    
                    $("#id_tipo_servicio").change(function(){
                      // pruebaselect='';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';
                      // pruebaselect+='<option value="0">SELECCIONAR TAREA</option>';


                      // $('#pruebaselect').change(function(){

                          // $('#multiple-select-field').append(pruebaselect);
                          // $('#multiple-select-field').prop('disabled',false);
                      // });

                      // console.log($('#id_tipo_equipo').val());
                      bandera_servicio = 0;
                      var pId_servicio = $('#id_tipo_servicio').val();
                      $.ajax({
                          url: '{{route("select_tarea")}}',
                          type: 'GET',
                          data: {'pId_equipo' : pId_equipo,'pId_servicio' : pId_servicio}
                        }).always(function(r) {
                          
                          htmlselect3='';
                          $('#select_tipo_tarea').html(htmlselect3);
                          arreglo_servicios_tareas = r.data['tipo_tareas'];

                          // console.log(r.data);
                          htmlselect3+='<label style="font-size:0.75em;">TIPO DE TAREA</label>';
                            htmlselect3+='<select class="form-select" title="SELECCIONAR TAREA" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" aria-label="Default select example" id="id_tipo_tarea">';
                              // htmlselect3+='<option value="" selected disabled>SELECCIONAR TAREA</option>';
                              for (var i = 0; i < arreglo_servicios_tareas.length; i++) {
                                  htmlselect3+='<option value="'+arreglo_servicios_tareas[i]['id']+'">'+arreglo_servicios_tareas[i]['tarea']+'</option>';
                              }
                          htmlselect3+='</select>';
                          $('#select_tipo_tarea').append(htmlselect3);
                          $('.selectpicker').attr('disabled',true);
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
                    // $("#divTablaEquipos").hide()

                    // $("#btnSiguiente").hide()
                    // $("#btnSiguiente").prop('disabled', true);
                    // $("#divCantidad").hide()

                    $("#btn_prueba_select").click(function(){
                      console.log($('#pruebaclickselect').val());
                    });

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
                    if (bandera_dibujo == 1) {
                      console.log(r.data3['original'].length);
                      i=r.data3['original'].length;
                      // i=i+1
                    }
                    else if (bandera_dibujo == 0) {
                      var i=0;
                    }
                    
                    // var arrEquipos = [];
                    $("#btnAgregarEquipo").click(function(){
                      // $('#input_cantidad').val(1);
                      // let arrTareas = [];
                      // console.log(arrTareas);
                      

                      $("#selTipoEquipo").prop('disabled',false);
                      // $("#divListaTarea").prop('hidden', true);
                      $("#divTablaEquipos").prop('hidden',false);
                      
                        var bandCheck='';
                        // $("#btn_replicar").click(function() {  
                        if($("#btn_replicar").is(':checked')) {  
                          // console.log('entro');
                            bandCheck=1;
                            $("#selTipoEquipo").prop('disabled',true);
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
                        
                        
                        var vId_TipoEquipo= $("#selTipoEquipo").val();
                        var vTipoEquipo= $('select[id="selTipoEquipo"] option:selected').text();
                        var vCantidad=$("#txtCantidadEquipos").val(); 
                        vTarea2 = $("#selTarea").val();
                        var input_cantidad = $('#input_cantidad').val();
                        // tablaEquipo+='<tr id="tr_'+i+'"><td>'+vTipoEquipo+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+i+')">Ver</button></td><td>En Proceso</td>';
                        // // tablaEquipo+='<tr id="tr_'+i+'"><td>PC</td><td>Mantemiento</td><td>Limpieza</td><td>En Proceso</td>';
                        // tablaEquipo+='<td><button type="button" class="btn colorBtnPrincipal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                        // tablaEquipo+='</tr>';
                        // $("#tbEquipos").html(tablaEquipo);
                        // i=i+1;
                        // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareas});
                        // console.log(arrTareas);

                        if(vId_TipoEquipo==0 && vId_TipoEquipo=='0'){
                          // console.log(vId_TipoEquipo);
                            // msjeAlerta('', 'Favor de seleccionar Tipo de Equipo', 'error')
                        }else if(arrTareas==null || arrTareas==[]){
                            msjeAlerta('', 'Favor de seleccionar Servicios y Tares', 'error')
                            $("#selTipoEquipo").prop('disabled',true);
                        }else if(descripcionSoporte==null || descripcionSoporte=='' ){
                            msjeAlerta('', 'Favor de ingresar Descripción de Soporte o Problema', 'error')
                            $("#selTipoEquipo").prop('disabled',true);
                        }else{
                          $("#label_datos_ct").prop('hidden',false);
                          $("#divTablaEquipos").prop('hidden',false);
                          $("#label_datos_ct").prop('hidden',false);
                          $("#divTablaEquipos").show();

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
                              vJson : 0,
                              cantidad : input_cantidad

                            });
                            $('#input_cantidad').val(1);
                          console.log(arrEquipos);

                          // arrEquipos.push({
                          //   con : i,
                          //   id_tipo_equipo : vId_TipoEquipo, 
                          //   desc_tipo_equipo : vTipoEquipo, 
                          //   etiquetaServicio : etiquetaServicio,
                          //   marca : marca,
                          //   modelo : modelo, 
                          //   numeroSerie : numeroSerie,
                          //   descripcionSoporte : descripcionSoporte,
                          //   ubicacionEquipo : ubicacionEquipo,
                          //   cantidad : vCantidad,
                          //   estatus_equipo : 1, 
                          //   nuevo : 1, 
                          //   aTarea : arrTareas, ///arreglo tareas
                          //   vJson : 0
                          // });

                            // console.log(arrEquipos);
                            
                            //  arrTareas=[];
                            drawRowEquipo();
                            i=i+1;
                            $('.selectpicker').attr('disabled',true);
                            $('.selectpicker').selectpicker('refresh');
                            // console.log($("#tbEquipos > tr").length);
                            contadortabla = $("#tbEquipos > tr").length;
                            // for (let i = 0; i < contadortabla; i++) {
                              arrContadorTabla.push(contador = contadortabla)
                              
                            // }8341194720
                            // console.log(arrContadorTabla);
                            if (bandCheck==1) {
                              // arrTareas = new Array();
                              // banderareplica = 1;
                              // var arrReplicar = new Array();
                              // arrReplicar=[];
                              var last_element = arrEquipos[arrEquipos.length - 1];
                              // arrReplicar = last_element['aTarea'];
                              // console.log(last_element['aTarea']);
                              // console.log(last_element);
                              // console.log(arrReplicar);
                              
                              $('#divListaTarea').prop('hidden',false);
                              $("#span_listado_tareas").prop('hidden', false);
                              $('#selTarea').prop('disabled',false);
                              $('#selTipoServicio').prop('disabled',false);
                            }
                            else{
                              banderareplica
                              $("#divListaTarea").prop('hidden',true);
                              $("#span_listado_tareas").prop('hidden', true);
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


                        // console.log(arrEquipos);
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
                      banderatarea = 0;
                        // if(arrTareas.length==0){
                        //     g=0;
                        //     listaTarea='';
                        //     $("#ulTarea").html('');
                        // }

                        // arrTareasselect.push({id_tarea : 

                        // })
                        
                        // console.log($("#selTarea").val());
                        // console.log($('select[id="selTarea"] option:selected').text());

                        
                        vTarea = $("#selTarea").val();
                        var element_prueba='';
                        var element_prueba2='';
                        for (let index = 0; index < vTarea.length; index++) {
                          var element_prueba = vTarea[index];
                          
                          
                        }
                        console.log(element_prueba);
                        reaText = $('select[id="selTarea"] option:selected').text();

                        element_prueba2 = $("#selTipoServicio").val();
                        vTipoServicio = $("#selTipoServicio").val();
                        vTipoServicioText = $('select[id="selTipoServicio"] option:selected').text();
                        // console.log(element);
                        
                        // console.log(selected12);
                        // console.log('selected12');

                        for (let i = 0; i < arrTareas.length; i++) {
                          // console.log(selected12[i]['id']);
                          // console.log(element_prueba);
                          if (element_prueba2 == arrTareas[i]['idServicio'] && arrTareas[i]['idTarea'] == element_prueba) {
                            banderatarea = 1;
                          }
                        }
                        if (banderatarea ==1) {
                          msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')
                        }
                        else if(vTarea != 0){
                            var index = arrTareas.findIndex(e => e.idTarea === vTarea);
                            
                            if(index == -1){
                              // console.log(idTarea);
                            
                                
                                // if (selected12!='') {
                                  for (let i = 0; i < selected12.length; i++) {
                                    // selected.push({id:$(this).val(), texto:$(this).text()});
                                    // const element = selected12[i]['id'];
                                    arrTareas.push({cont:g, idTarea:selected12[i]['id'], desc_Tarea:selected12[i]['texto'],
                                      idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});
                                  }
                                // }

                                // arrTareas.push({cont:g, idTarea:vTarea, desc_Tarea:vTareaText,
                                //    idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});

                                // arrTareas.push({cont:g, idTarea:vTarea, desc_Tarea:vTareaText, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});
                                drawRowTarea();
                                // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareas});
                                g=g+1;
                                $("#selTipoEquipo").prop('disabled',true);
                                $("#divListaTarea").prop('hidden',false);
                                $("#span_listado_tareas").prop('hidden', false);
                                $('#btnAgregarEquipo').prop('hidden',false);
                                $('#btnAgregarTarea').prop('disabled',true);
                                $('.selectpicker').selectpicker('refresh');
                                
                            }else{
                                $("#selTarea").val("0").attr("selected",true);
                                $('#btnAgregarTarea').prop('disabled',true);
                                msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')
                            }
                        }
                        // $("#selTipoServicio").val("0").attr("selected",true);  //resetear servicio cada que agrega una tarea
                    });

                    $('#selTipoEquipo').on('change', function() { /// Cargar select Tarea en base a Servicio
                      $('.selectpicker').attr('disabled',true);
                      $('.selectpicker').selectpicker('refresh');
                      let urlEditar = '{{ route("consServicio", ":idEquipo") }}';
                      urlEditar = urlEditar.replace(':idEquipo', this.value); 
                      
                      $("#selTipoServicio").val("0").attr("selected",true);
                      $('#selTarea').prop('disabled',true);
                      $("#selTarea").val("0").attr("selected",true);
                      $('#btnAgregarTarea').prop('disabled',true);
                      let element = document.getElementById("selTipoServicio");
                      element.value = '0';
                      if ($("#selTipoEquipo").val() == 0) {
                        // console.log('entor');
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
                              var htmlSel='<option value="0" selected>SELECCIONAR EQUIPO/SERVICIO</option>';
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
                                var htmlSel2='';
                                for (var i = 0; i < data[0].length; i++) {
                                    htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                                }
                                // var htmlSel2='<option value="0" selected>SELECCIONAR TAREA</option>';
                                for (var i = 0; i < data[0].length; i++) {
                                    htmlSel2+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                                }

                                // $("#selTarea").html(htmlSel);
                                // $('#selTarea').prop('disabled',false);

                                // $('#multiple-select-field').append(htmlSel);
                                // $('#multiple-select-field').prop('disabled',false);
                                // $('.js-example-basic-multiple').select2({
                                //   width: '300px'
                                // });
                                // $('#pruebaselect2').html(htmlSel2);
                                $('#selTarea').html(htmlSel2);
                                $('.selectpicker').attr('disabled',false);
                                $('.selectpicker').selectpicker('refresh');
                                

                            }
                          });
                        }

                        
                        
                    });
                    $('#selTarea').on('change', function() { /// Cargar select Tarea en base a Servicio
                      console.log('entro');  
                      var vselTarea=  $('#selTarea').val();
                        if (vselTarea == 0) {
                          $('#btnAgregarTarea').prop('disabled',true);
                        }
                        else{
                          $('#btnAgregarTarea').prop('disabled',false);
                        }
                    });

                    $('#selTarea').on('changed.bs.select', function (e) {
                        var options = $('#selTarea option:selected');
                        var selected = [];
                        
                        $(options).each(function(){
                            selected.push({id:$(this).val(), texto:$(this).text()}); 
                            // or $(this).val() for 'id'
                        });
                        selected12 = selected;
                        // write value to some field, etc
                        console.log(selected);
                    });
                    $('#selTarea').on('hide.bs.select', function (e) {
                        $("#bs-select-1").prop('hidden',true);

                    });
                    $('#selTarea').on('show.bs.select', function (e) {
                        console.log('test2');
                        $("#bs-select-1").prop('hidden',false);
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
            
              $("#btnGuardar").click(function(){
                $('#btnGuardar').prop('disabled',true);
                // var bandera_guardar = 0;
                var bandera_condicion = 0;
                var editar_nombre_solicitante = $('#editar_nombre_solicitante').val();
                var editar_telefono_solicitante = $('#editar_telefono_solicitante').val();
                var editar_descripcion_solicitante = $('#editar_descripcion_solicitante').val();
                // console.log(r.data[0]['solicitante']);
                // console.log($('#editar_nombre_solicitante').val());
                // console.log(r.data[0]['telef_solicitante']);
                // console.log($('#editar_telefono_solicitante').val());
                // console.log(r.data[0]['descrip_reporte']);
                // console.log($('#editar_descripcion_solicitante').val());
                console.log(arrEquipos);
                // console.log(bandera_dibujo);

                if (bandera_dibujo == 1 && bandera_validacion_update == 0) {
                  console.log('entro1');
                  // if (r.data[0]['solicitante'] != editar_nombre_solicitante ||
                  //   r.data[0]['telef_solicitante'] != editar_telefono_solicitante ||
                  //   r.data[0]['descrip_reporte'] != editar_descripcion_solicitante ||
                  //   bandera_condicion == 1) {
                      if (editar_nombre_solicitante == '' || editar_telefono_solicitante == '' || editar_descripcion_solicitante =='') {
                        Swal.fire({
                          position: 'bottom-right',
                          icon: 'warning',
                          title: 'Revisar que ningun campo del Solicitante vaya vacio..',
                          showConfirmButton: false,
                          customClass: 'msj_aviso',
                          timer: 2000
                        })
                        $('#btnGuardar').prop('disabled',false);
                      }
                      else{
                        if (editar_telefono_solicitante.length != 10) {
                          Swal.fire({
                            position: 'bottom-right',
                            icon: 'warning',
                            title: 'El teléfono del solicitante debe ser de 10 digitos.',
                            showConfirmButton: false,
                            customClass: 'msj_aviso',
                            timer: 2000
                          })
                          $('#btnGuardar').prop('disabled',false);
                        }
                        else{
                          $('#btnGuardar').prop('disabled',true);
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
                          
                          $.ajax({
                          url: '{{route("actualizar_solicitud")}}',
                          type: 'POST',
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          data: {
                            // 'folio_solicitud_global' : folio_solicitud_global,
                            'arrEquipos' : arrEquipos,
                            'arrEliminarEquipos' : arrEliminarEquipos,
                            'id_solicitud_global' : id_solicitud_global,
                            'editar_nombre_solicitante' : editar_nombre_solicitante,
                            'editar_telefono_solicitante' : editar_telefono_solicitante,
                            'editar_descripcion_solicitante' : editar_descripcion_solicitante
                            // 'bandera_guardar' : bandera_guardar
                          }
                          }).always(function(r) {
                            bandera_validacion_update == 1;
                            
                            Swal.fire({
                                  // title: 'Editado',
                                  html:'<p>Se ha actualizado con éxito la solicitud con el folio: <strong>'+folio_solicitud_global+'</strong></p>'+
                                        '<p>A continuación, realice la aprobación o rechazo de la misma a través del menú "Acciones" del sistema.</p>',
                                  customClass: 'msj_solicitud',
                                  icon: 'success',
                                  confirmButtonColor: '#b50915',
                                  confirmButtonText: 'Aceptar',
                                  allowOutsideClick: false
                                }).then((result) => {
                                if (result.isConfirmed) {
                                  // alert('Se redireccciona al index');
                                  window.location.href = '{{route("index_solicitud")}}';
                              }
                            })
                          });
                        }
                      }
                    // }
                    // else{
                    //   Swal.fire({
                    //       position: 'bottom-right',
                    //       icon: 'warning',
                    //       title: 'Debe editar o agregar algun dato para poder Guardar la Solicitud..',
                    //       showConfirmButton: false,
                    //       customClass: 'msj_aviso',
                    //       timer: 2000
                    //   })
                    // } 
                }
                else if(bandera_dibujo == 0 && bandera_validacion_update2 == 0){
                  console.log('entro2');
                  if (r.data[0]['solicitante'] != editar_nombre_solicitante ||
                    r.data[0]['telef_solicitante'] != editar_telefono_solicitante ||
                    r.data[0]['descrip_reporte'] != editar_descripcion_solicitante || arrEquipos != '') {
                      if (editar_nombre_solicitante == '' || editar_telefono_solicitante == '' || editar_descripcion_solicitante =='') {
                        Swal.fire({
                          position: 'bottom-right',
                          icon: 'warning',
                          title: 'Revisar que ningun campo del Solicitante vaya vacio..',
                          showConfirmButton: false,
                          customClass: 'msj_aviso',
                          timer: 2000
                        })
                        $('#btnGuardar').prop('disabled',false);
                      }
                      else{
                        if (editar_telefono_solicitante.length != 10) {
                          Swal.fire({
                            position: 'bottom-right',
                            icon: 'warning',
                            title: 'El teléfono del solicitante debe ser de 10 digitos.',
                            showConfirmButton: false,
                            customClass: 'msj_aviso',
                            timer: 2000
                          })
                          $('#btnGuardar').prop('disabled',false);
                        }
                        else{
                          $('#btnGuardar').prop('disabled',true);
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
                          $.ajax({
                          url: '{{route("actualizar_solicitud")}}',
                          type: 'POST',
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          data: {
                            // 'folio_solicitud_global' : folio_solicitud_global,
                            'arrEquipos' : arrEquipos,
                            'arrEliminarEquipos' : arrEliminarEquipos,
                            'id_solicitud_global' : id_solicitud_global,
                            'editar_nombre_solicitante' : editar_nombre_solicitante,
                            'editar_telefono_solicitante' : editar_telefono_solicitante,
                            'editar_descripcion_solicitante' : editar_descripcion_solicitante
                            // 'bandera_guardar' : bandera_guardar
                          }
                          }).always(function(r) {
                            bandera_validacion_update2 == 1;
                            $('#btnGuardar').prop('disabled',true);
                            Swal.fire({
                                // position: 'bottom-right',
                                // icon: 'warning',
                                width: 300,
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
                            Swal.fire({
                                  // title: 'Editado',
                                  html:'<p>Se ha actualizado con éxito la solicitud con el folio: <strong>'+folio_solicitud_global+'</strong></p>'+
                                        '<p>A continuación, realice la aprobación o rechazo de la misma a través del menú "Acciones" del sistema.</p>',
                                  customClass: 'msj_solicitud',
                                  icon: 'success',
                                  confirmButtonColor: '#b50915',
                                  confirmButtonText: 'Aceptar',
                                  allowOutsideClick: false
                                }).then((result) => {
                                if (result.isConfirmed) {
                                  // alert('Se redireccciona al index');
                                  window.location.href = '{{route("index_solicitud")}}';
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
                          title: 'Debe editar o agregar algún dato para poder Guardar la Solicitud.',
                          showConfirmButton: false,
                          customClass: 'msj_aviso',
                          timer: 2000
                      })
                      $('#btnGuardar').prop('disabled',false);
                    }
                }


              });
          

          });


          $('#exampleModal').modal('show');
        }
        else{
          Swal.fire({
            icon: 'warning',
            title: 'La solicitud esta siendo utilizada por otro usuario. Favor de verificar.',
            showConfirmButton: true,
            customClass: 'msj_aviso',
            confirmButtonColor: '#b50915',
            confirmButtonText: 'Aceptar',
            allowOutsideClick: false,
          })
        }
      });  
    
    $('#exampleModal').on('hidden.bs.modal', function (e) {
      // console.log(id);
      clearInterval(refreshIntervalId)
      bandera_acceso2 = 1;
      $.ajax({
        url: '{{route("actualiza_acesso")}}',
        type: 'GET',
        data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso2}
      }).always(function(r) {

      });
      $('.selectpicker').attr('disabled',false);
      $('.selectpicker').selectpicker('refresh');
    })
  }

  function drawRowTarea(){
    var listaTarea2 = '';

    listaTarea2+='<table class="table" id="tbTarea">';
    listaTarea2+='<thead>';
    listaTarea2+='<th>Servicio</th>';
    listaTarea2+='<th>Tarea</th>';
    listaTarea2+='<th>Eliminar</th>';
    listaTarea2+='</thead>';
    listaTarea2+='<tbody>';

    // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
    console.log(arrTareas);
    var aux='';
    $.each(arrTareas, function(j, val){
        if (!jQuery.isEmptyObject(arrTareas[j])) {
        
            listaTarea2+='<tr>';
            if(aux==arrTareas[j]['desc_Servicio']){ 
                listaTarea2+='<td>&nbsp;</td>';
                // aux='';
            }else{
                aux=arrTareas[j]['desc_Servicio'];
                listaTarea2+='<td>'+arrTareas[j]['desc_Servicio']+'&nbsp;</td>';
            }
            
            listaTarea2+='<td> - '+arrTareas[j]['desc_Tarea']+'</td>';
            
            // listaTarea2+='<td><button type="button" class="btn btn-secondary " id="prueba"  >fdsfdsf</button>';
            listaTarea2+='<td><button type="button" id="btn_prueba" onclick="removeTarea('+j+')" class="btnEliminar" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            listaTarea2+='<tr>';
            
        }
    });

    listaTarea2+='</tbody>';
    listaTarea2+='</table>';

    $("#ulTarea").empty();
    $("#ulTarea").html(listaTarea2);
    $("#selTarea").val("0").attr("selected",true);
    $("#divListaTarea").prop('hidden', false);
    $("#span_listado_tareas").prop('hidden', false);
    // console.log(arrTareas);


    
    
  }

  function removeTarea( item ) {
    console.log(arrTareas);
      if(arrTareas.includes(item) ==false){ 
          if ( item !== -1 ) {
              arrTareas.splice( item, 1 );
              console.log(arrTareas);
              $("#liT_"+item).remove();
              drawRowTarea();
              // divListaTarea
              if (arrTareas == '') {
                $("#selTipoEquipo").prop('disabled',false);
                $("#btnAgregarEquipo").prop('hidden',true);
                $("#divListaTarea").prop('hidden',true);
                $("#span_listado_tareas").prop('hidden', true);
                $("#selTipoEquipo").val("0").attr("selected",true);
                $("#selTipoServicio").val("0").attr("selected",true);
                $("#selTarea").val("0").attr("selected",true);
                // $('#selTipoEquipo').attr('disabled',true);
                $('#selTipoServicio').attr('disabled',true);
                $('.selectpicker').attr('disabled',true);
                $('.selectpicker').selectpicker('refresh');
              }
              
          }   else{
            // console.log('entro la ');
              arrTareas = [];
              g=0;
              listaTarea='';
              $("#ulTarea").html('');
              $("#ulTarea").empty();
              $('#selTipoEquipo').attr('disabled',true);
              $('#selTipoServicio').attr('disabled',true);
              $('.selectpicker').attr('disabled',true);
              $('.selectpicker').selectpicker('refresh');
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

    Swal.fire({
      // title: 'Rechazar Solicitud',
      // text: 'Se ha Registrado con Exito la Solicitud #5884',
      html: '<p style="font-size:1rem !important;">¿Está seguro de que desea eliminar el registro?</p>',
      customClass: 'msj_solicitud',
      icon: 'warning',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      allowOutsideClick: false,
      confirmButtonColor: '#b50915',
      showCancelButton: true,
      confirmButtonText: 'Aceptar'
    }).then((result) => {
      if (result.isConfirmed) {
          if(arrEquipos.includes(item) ==false){ 
            if ( item !== -1 ) {
                arrEquipos.splice( item, 1 );
                $("#tr_"+item).remove();
                drawRowEquipo();
                if (arrEquipos == '') {
                  $("#selTipoEquipo").prop('disabled',false);
                    $("#divTablaEquipos").prop('hidden',true);
                    $("#label_datos_ct").prop('hidden',true);
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
    })

    
  }
  function removeEquipo2( item ) {
    Swal.fire({
      // title: 'Rechazar Solicitud',
      // text: 'Se ha Registrado con Exito la Solicitud #5884',
      html: '<p style="font-size:1rem !important;">¿Está seguro de que desea eliminar el registro?</p>',
      customClass: 'msj_solicitud',
      icon: 'warning',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      allowOutsideClick: false,
      confirmButtonColor: '#b50915',
      showCancelButton: true,
      confirmButtonText: 'Aceptar'
    }).then((result) => {
      var posicion = item;
      // console.log(arrEquipos[posicion]);
      // for (i = 0; i < arrEquipos[posicion].length; i++) {
      //   console.log(arrEquipos);
      arrEliminarEquipos.push({id_elimina : arrEquipos[posicion]['id_equipo_serv_solic']});
      // }
      // console.log(arrEliminarEquipos);
      if(arrEquipos.includes(item) ==false){ 
          if ( item !== -1 ) {
              arrEquipos.splice( item, 1 );
              $("#tr_"+item).remove();
              drawRowEquipo2();
              if (arrEquipos == '') {
                $("#selTipoEquipo").prop('disabled',false);
                  $("#divTablaEquipos").prop('hidden',true);
                  $("#label_datos_ct").prop('hidden',true);
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
      }
      else{
          console.log('No existe en el arreglo');
          g=0;
          tablaEquipo='';
          $("#tbEquipos").html('');
          $("#tbEquipos").empty();
      }
    })
    
  }

  function drawRowEquipo(){
    console.log(arrEquipos);

    var tablaEquipo2 = '';
    // console.log('entro');
    $.each(arrEquipos, function(j, val){
        if (!jQuery.isEmptyObject(arrEquipos[j])) {
          // console.log('entro a dibujar 1');

          if (arrEquipos[j]['id_tipo_equipo']!=1) {
            var cantidad_int = parseInt(arrEquipos[j]['cantidad']);
            
            // console.log('entro condicion cantidad');

            for (let i = 1; i <= cantidad_int; i++) {
              tablaEquipo2+='<tr id="tr_'+j+'">';
                tablaEquipo2+='<td style="text-align:center;">1</td>';
                
                tablaEquipo2+='<td>- '+arrEquipos[j]['desc_tipo_equipo']+'</td>';
                tablaEquipo2+='<td style="white-space: pre-line; word-break: break-word;">- '+arrEquipos[j]['descripcionSoporte']+'</td>';
                var desc_problema_vJson = '';
                var desc_problema_vJson2 = '';
                if (arrEquipos[j]['vJson'] == 1) {
                  jsonTareas = JSON.parse(arrEquipos[j]['aTarea']);
                  tablaEquipo2+='<td>';
                  $.each(jsonTareas, function(j2, val){
                    if (!jQuery.isEmptyObject(jsonTareas[j2])) { 
                        tablaEquipo2+='- '+jsonTareas[j2]['servicio']+'<br>';
                      desc_problema_vJson = jsonTareas[j2]['servicio'];
                    }
                  });
                  tablaEquipo2+='</td>';
                  tablaEquipo2+='<td>';
                  $.each(jsonTareas, function(j2, val){
                    if (!jQuery.isEmptyObject(jsonTareas[j2])) { 
                        tablaEquipo2+='- '+jsonTareas[j2]['tarea']+'<br>';
                    }
                  });
                  tablaEquipo2+='</td>';
                }
                else if(arrEquipos[j]['vJson'] == 0){
                  tablaEquipo2+='<td>';
                  for (var i2 = 0; i2 < arrEquipos[j]['aTarea'].length; i2++) {
                      tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i2]['desc_Servicio']+'<br>';
                      desc_problema_vJson2 = arrEquipos[j]['aTarea'][i2]['desc_Servicio'];
                  }
                  tablaEquipo2+='</td>';
                  tablaEquipo2+='<td>';
                  for (var i3 = 0; i3 < arrEquipos[j]['aTarea'].length; i3++) {
                    tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i3]['desc_Tarea']+'<br>';
                  }
                  tablaEquipo2+='</td>';
                }

                tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
                        tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
                            tablaEquipo2+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                                tablaEquipo2+='<li><a onclick="removeEquipo('+j+')" class="dropdown-item" ><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar</a></li>';
                            tablaEquipo2+='</ul>';
                tablaEquipo2+='</div></td>';
              tablaEquipo2+='</tr>';
              
            }
            
          }
          else{
            // tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+j+')">Ver</button></td><td>En Proceso</td>';
            tablaEquipo2+='<tr id="tr_'+j+'">';
              tablaEquipo2+='<td style="text-align:center;">'+arrEquipos[j]['cantidad']+'</td>';
              
              tablaEquipo2+='<td>- '+arrEquipos[j]['desc_tipo_equipo']+'</td>';
              tablaEquipo2+='<td style="white-space: pre-line; word-break: break-word;">- '+arrEquipos[j]['descripcionSoporte']+'</td>';
              var desc_problema_vJson = '';
              var desc_problema_vJson2 = '';
              if (arrEquipos[j]['vJson'] == 1) {
                jsonTareas = JSON.parse(arrEquipos[j]['aTarea']);
                tablaEquipo2+='<td>';
                $.each(jsonTareas, function(j2, val){
                  if (!jQuery.isEmptyObject(jsonTareas[j2])) { 
                      tablaEquipo2+='- '+jsonTareas[j2]['servicio']+'<br>';
                    desc_problema_vJson = jsonTareas[j2]['servicio'];
                  }
                });
                tablaEquipo2+='</td>';
                tablaEquipo2+='<td>';
                $.each(jsonTareas, function(j2, val){
                  if (!jQuery.isEmptyObject(jsonTareas[j2])) { 
                      tablaEquipo2+='- '+jsonTareas[j2]['tarea']+'<br>';
                  }
                });
                tablaEquipo2+='</td>';
              }
              else if(arrEquipos[j]['vJson'] == 0){
                tablaEquipo2+='<td>';
                for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
                    tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Servicio']+'<br>';
                    desc_problema_vJson2 = arrEquipos[j]['aTarea'][i]['desc_Servicio'];
                }
                tablaEquipo2+='</td>';
                tablaEquipo2+='<td>';
                for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
                  tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Tarea']+'<br>';
                }
                tablaEquipo2+='</td>';
              }

              tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
                      tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
                          tablaEquipo2+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                              tablaEquipo2+='<li><a onclick="removeEquipo('+j+')" class="dropdown-item" ><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar</a></li>';
                          tablaEquipo2+='</ul>';
              tablaEquipo2+='</div></td>';
            tablaEquipo2+='</tr>';
          }
          
        }
    });

    $("#tbEquipos").empty();
    $("#tbEquipos").html(tablaEquipo2);
          


  }
  function drawRowEquipo2(){
    console.log(arrEquipos);
    var tablaEquipo2 = '';
    // console.log('entro a drawRowEquipo2');
    var jsonTareas = '';
    $.each(arrEquipos, function(j, val){
      console.log('entro a dibujar 2');
        if (!jQuery.isEmptyObject(arrEquipos[j])) { 
          // console.log('entro2');
          jsonTareas = JSON.parse(arrEquipos[j]['aTarea']);
          
            tablaEquipo2+='<tr id="tr_'+j+'">';

              tablaEquipo2+='<td style="text-align:center;">'+arrEquipos[j]['cantidad']+'</td>';
              tablaEquipo2+='<td>- '+arrEquipos[j]['desc_tipo_equipo']+'</td>';
              tablaEquipo2+='<td style="white-space: pre-line; word-break: break-word;">- '+arrEquipos[j]['descripcionSoporte']+'</td>';
              var desc_problema_vJson = '';
              var desc_problema_vJson2 = '';
              if (arrEquipos[j]['vJson'] == 1) {
                jsonTareas = JSON.parse(arrEquipos[j]['aTarea']);
              tablaEquipo2+='<td>';
              // if (bandera_dibujo == 0) {
                $.each(jsonTareas, function(j2, val){
                  if (!jQuery.isEmptyObject(jsonTareas[j2])) { 
                    // console.log(jsonTareas[j2]['id']);
                    // if (jsonTareas[j2]['servicio'] == desc_problema_vJson) {
                    //   tablaEquipo2+='';
                    // }
                    // else{
                      tablaEquipo2+='- '+jsonTareas[j2]['servicio']+'<br>';
                    // }
                      // tablaEquipo2+='- '+jsonTareas[j2]['servicio']+'<br>';
                      desc_problema_vJson = jsonTareas[j2]['servicio'];
                  }
                });
                tablaEquipo2+='</td>';
                tablaEquipo2+='<td>';
                $.each(jsonTareas, function(j2, val){
                  if (!jQuery.isEmptyObject(jsonTareas[j2])) { 
                    // console.log(jsonTareas[j2]['id']);
                      tablaEquipo2+='- '+jsonTareas[j2]['tarea']+'<br>';
                  }
                });
                tablaEquipo2+='</td>';
              }

            tablaEquipo2+='<td><div class="dropdown btn-group dropstart">';
            tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "data-bs-toggle="dropdown"<i class="fa fa-ellipsis-v text-xs"></i></button>';
                // tablaEquipo2+='<div class="dropdown btn-group dropstart">';
                    tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 " data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>';
                        tablaEquipo2+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                            tablaEquipo2+='<li><a onclick="removeEquipo2('+j+')" class="dropdown-item" ><i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;Eliminar</a></li>';
                        tablaEquipo2+='</ul>';
        tablaEquipo2+='</div></td>';
            // tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal" onclick="removeEquipo('+j+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
            tablaEquipo2+='</tr>';
        }
    });

    $("#tbEquipos").empty();
    $("#tbEquipos").html(tablaEquipo2);
    // $("#divTablaEquipos").show();
    // $("#divTablaEquipos").css("display", "block");
    // console.log(tablaEquipo2);
          


  }

  function fnAprobarSolicitud(id_solicitud){
    
    // console.log(id_solicitud);
    bandera_acceso3 = 1;
    $(window).on('beforeunload', function (){
      //this will work only for Chrome
      $.ajax({
        url: '{{route("actualiza_acesso")}}',
        type: 'GET',
        data: {'id_solicitud' : id_solicitud, 'bandera_acceso2' : bandera_acceso3}
      }).always(function(r) {
        // window.location.href = '{{route("index_solicitud")}}';
      });
    });
      var refreshIntervalId  = setInterval(('fnupdateAcceso('+id_solicitud+','+bandera_acceso3+')'), 300000);
      // clearInterval(refreshIntervalId);
      setTimeout(() => clearInterval(refreshIntervalId), 300000)
    var bandera_acceso2 = 0; 
    $.ajax({
      url: '{{route("actualiza_acesso")}}',
      type: 'GET',
      data: {'id_solicitud' : id_solicitud, 'bandera_acceso2' : bandera_acceso2}
    }).always(function(r) {
      if (r.respuesta == true) {
        Swal.fire({
          // title: 'Aprobar Solicitud',
          icon: 'warning',
          text: '¿Está seguro de aprobar la solicitud?',
          showCancelButton: true,
          customClass: 'msj_solicitud',
          confirmButtonColor: '#b50915',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Aceptar'
          }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
                // position: 'bottom-right',
                // icon: 'warning',
                width: 300,
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
            $.ajax({
              url: '{{route("aprobar_solicitud")}}',
              type: 'GET',
              data: {'id_solicitud' : id_solicitud}
            }).always(function(r) {
                console.log(r.data);
                if (r.respuesta == true) {
                  folio_orden = r.folio;
                  folio_solicitud = r.folio_solicitud;
                  Swal.fire({
                    // title: 'Aprobar Solicitud',
                    // text: 'Se ha Registrado con Exito la Solicitud #5884',
                    html: '<p>Se ha aprobado con éxito la solicitud con el folio:</p>'+
                          '<strong>'+folio_solicitud+'.</strong>',
                    customClass: 'msj_solicitud',
                    icon: 'success',
                    confirmButtonColor: '#b50915',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                  }).then((result) => {
                    if (result.isConfirmed) {
                        // alert('Se redireccciona al index');
                        window.location.href = '{{route("index_solicitud")}}';
                    }
                  })
                }
                else if(r.respuesta == false){
                  Swal.fire({
                    // title: 'Aprobar Solicitud',
                    // text: 'Se ha Registrado con Exito la Solicitud #5884',
                    html: '<p>Favor de agregar equipos a la solicitud de servicio.</p>',
                    customClass: 'msj_solicitud',
                    icon: 'warning',
                    confirmButtonColor: '#b50915',
                    confirmButtonText: 'Aceptar',
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
          else{
            clearInterval(refreshIntervalId)
            bandera_acceso2 = 1;
            $.ajax({
              url: '{{route("actualiza_acesso")}}',
              type: 'GET',
              data: {'id_solicitud' : id_solicitud, 'bandera_acceso2' : bandera_acceso2}
            }).always(function(r) {

            });
          }
        })
      }
      else{
        Swal.fire({
          icon: 'warning',
          title: 'La solicitud esta siendo utilizada por otro usuario. Favor de verificar.',
          showConfirmButton: true,
          customClass: 'msj_aviso',
          confirmButtonColor: '#b50915',
          confirmButtonText: 'Aceptar',
          allowOutsideClick: false,
        })
      }
    }); 
  }

  function fnRechazarSolicitud(id){
    bandera_acceso3 = 1;
    $(window).on('beforeunload', function (){
      //this will work only for Chrome
      $.ajax({
        url: '{{route("actualiza_acesso")}}',
        type: 'GET',
        data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso3}
      }).always(function(r) {
        // window.location.href = '{{route("index_solicitud")}}';
      });
    });
      var refreshIntervalId  = setInterval(('fnupdateAcceso('+id+','+bandera_acceso3+')'), 300000);
      // clearInterval(refreshIntervalId);
      setTimeout(() => clearInterval(refreshIntervalId), 300000)
    var bandera_acceso2 = 0; 
    $.ajax({
      url: '{{route("actualiza_acesso")}}',
      type: 'GET',
      data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso2}
    }).always(function(r) {
      if (r.respuesta == true) {
        console.log(id);
        var comentario_rechazar = '';
        var select_rechazar = '';
        var myArrayOfThings=[];
        $.ajax({
          url: '{{route("select_rechaza_solicitud")}}',
          type: 'GET'
          // data: {'vCentro_Trabajo' : vCentro_Trabajo}
          }).always(function(r) {
            // console.log(r);
            htmlselect = '';
            console.log(r.data);

            html34='';
            // <select class="swal2-select style="display: flex;"">
            html34+='<select class="swal2-select" style="display: flex;" id="swal-input34">';
            html34+='<option value="0">Seleccione motivo de rechazo de solicitud</option>'
            for (var i = 0; i < r.data['tipo_rechazo'].length; i++) {
              html34+='<option value="'+r.data['tipo_rechazo'][i]['id']+'">'+r.data['tipo_rechazo'][i]['motivo']+'</option>';
            }
            
            html34+='</select>';
            console.log(html34);

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
            // title: 'Rechazar Solicitud',
            // text: 'Escriba el motivo por el cual Rechaza la Solicitud',
            // input: 'select',
            // input2: 'textarea',
            // inputOptions: options,
            // inputPlaceholder: 'Seleccione motivo de rechazo de solicitud',
            showCancelButton: true,

            // animation: 'slide-from-top',
            
            html:
                // '<div class="swal_input_wrapper">'+
                  // '<div class="label_wrapper">Descrbia comentarios adicionales: </div>'+
                  html34+
                  '<br>'+
                  'Describa comentarios adicionales: '+
                    '<textarea id="swal-input3" style="width:80%" class="swal2-textarea"></textarea>',
                // '</div>',
            confirmButtonColor: '#b50915',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar',
            width: 600,
            allowOutsideClick: false,
            // input: 'select',
            // inputOptions: inputOptionsPromise,
            preConfirm: () => {
              if ($('#swal-input34').val() == 0) {
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
                select_rechazar = $('#swal-input34').val();
                comentario_rechazar = $('#swal-input3').val();
              }
            }
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                  // position: 'bottom-right',
                  // icon: 'warning',
                  width: 300,
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
                // console.log(select_rechazar);
                // console.log(comentario_rechazar);
              $.ajax({
                url: '{{route("rechazar_solicitud")}}',
                type: 'GET',
                data: {
                  'comentario_rechazar' : comentario_rechazar,
                  'select_rechazar' : select_rechazar,
                  'id' : id}
              }).always(function(r) {
                  console.log(r.data);
                  if (r.respuesta == true) {
                    Swal.fire({
                      // title: 'Rechazar Solicitud',
                      // text: 'Se ha Registrado con Exito la Solicitud #5884',
                      html: '<p style="font-size:1rem !important;">Se ha rechazado con éxito la solicitud con el folio:</p>'+
                      '<strong>'+r.folio_solicitud+'.</strong>'+
                      '<p style="font-size:1rem !important;">Se ha notificado al usuario mediante el correo electrónico proporcionado.</p>',

                      customClass: 'msj_solicitud',
                      icon: 'success',
                      confirmButtonColor: '#b50915',
                      confirmButtonText: 'Aceptar',
                      allowOutsideClick: false
                    }).then((result) => {
                      if (result.isConfirmed) {
                          // alert('Se redireccciona al index');
                          window.location.href = '{{route("index_solicitud")}}';
                      }
                    })
                  }
                  else if(r.respuesta == false){
                    Swal.fire({
                      // title: 'Rechazar Solicitud',
                      // text: 'Se ha Registrado con Exito la Solicitud #5884',
                      text: 'Vuelva a Intentarlo',
                      customClass: 'msj_solicitud',
                      icon: 'error',
                      confirmButtonColor: '#b50915',
                      confirmButtonText: 'Aceptar',
                      allowOutsideClick: false
                    }).then((result) => {
                      if (result.isConfirmed) {
                          // alert('Se redireccciona al index');
                          window.location.href = "indexVentanilla";
                      }
                    })
                  }
                  
              });
            }
            else{
              clearInterval(refreshIntervalId)
              bandera_acceso2 = 1;
              $.ajax({
                url: '{{route("actualiza_acesso")}}',
                type: 'GET',
                data: {'id_solicitud' : id, 'bandera_acceso2' : bandera_acceso2}
              }).always(function(r) {

              });
            }
          })
        });
      }
      else{
        Swal.fire({
          icon: 'warning',
          title: 'La solicitud esta siendo utilizada por otro usuario. Favor de verificar.',
          showConfirmButton: true,
          customClass: 'msj_aviso',
          confirmButtonColor: '#b50915',
          confirmButtonText: 'Aceptar',
          allowOutsideClick: false,
        })
      }
    }); 
  }

  function fnImprimirSolicitud(id_solicitud){
    
 
      let urlEditar = '{{ route("downloadPdf_solicitud", ":id") }}';
      urlEditar = urlEditar.replace(':id', id_solicitud);
 
      // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank');
      var win = window.open(urlEditar, '_blank');
     /// para abrir una nueva pestaña y que se muestre el pdf // este es el bueno para descargar

  }

  $('#btn_cerrar').click(function(){

    $("#divListaTarea").prop('hidden', true);
    $("#span_listado_tareas").prop('hidden', true);
    $("#divTablaEquipos").prop('hidden',false);
    $("#label_datos_ct").prop('hidden',false);
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
                                  html+='<li><a onclick="Eliminar('+contador_id_tabla+')" class="dropdown-item" ><i class="fas fa-trash">Eliminar</i></a></li>';
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
        title: 'Favor de llenar El campo Descripción',
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
                                  html+='<li><a onclick="Eliminar('+contador_id_tabla+')" class="dropdown-item" ><i class="fas fa-trash">Eliminar</i></a></li>';
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
      //                           html+='<li><a onclick="Eliminar('+contador_id_tabla+')" class="dropdown-item" ><i class="fas fa-trash">Eliminar</i></a></li>';
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

  $('#exampleModal').on('hidden.bs.modal', function (e) {
    
    $('.selectpicker').attr('disabled',false);
    $('.selectpicker').selectpicker('refresh');
  })



</script>



@endsection
