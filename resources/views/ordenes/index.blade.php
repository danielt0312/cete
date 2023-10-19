@extends('layouts.contentIncludes')
@section('title','CAS CETE')
@php setPermissionsTeamId(3); @endphp
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')
<style>
  .table-responsive{
    -sm|-md|-lg|-xl|-xxl
  }

  .select2-selection__rendered {
    font-size: 0.875rem !important;
  }

  .select2-search__field {
    font-size: 0.875rem !important;
  }

  .select2-selection__choice{
    font-size: 0.875rem !important;
  }

  /* table {
  table-layout:fixed; 
} */

</style>
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
        <input type="hidden" name="hdIdRol" id="hdIdRol" value="{{auth()->user()->roles[0]['id']}}">
        <!-- <div class="card-header pb- p-3">
          <div class="d-flex justify-content-between">
            <h6 class="mb-2">Órdenes</h6>
          </div>
        </div> -->
        {{--auth()->user()->roles[0]['name']--}}
        {{--auth()->user()->roles[0]['id']--}}
        <div class="mb-2 p-3">
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
              <!-- <div class="col-3 " style="float:right;"> --> 
              <select class="selectpicker" data-size="4" id="selColumna" data-selected-text-format="count" data-count-selected-text="{0} Columna(s) Seleccionada(s)" title="Ocultar columnas" multiple aria-label="size 3 select example" placeholder>
                <option value="0">FOLIO</option>
                <option value="1">ESTATUS</option>
                <option value="2">CENTRO DE TRABAJO</option>
                <option value="3">COORDINACIÓN</option>
                <option value="4">FECHA</option>
                <option value="5">MEDIO DE CAPTACIÓN</option>
                <option value="6">TIEMPO DE APERTURA</option>
              </select>
          <!-- </div> -->
                <!-- <button type="button" class="btn btn-secondary" id="btnFiltrar">Excel</button> boton del Excel-->
              </div>
            </div>
          
          </div>

          <!-- <div class="row" id="pnFiltros">
            
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
              </div>
            </div>
            
            <div class="col-2">
            </div>
          </div> -->
        
        <div class="table-responsive">
          <!-- <div class="col-3 " style="float:right;">
            <select class="selectpicker" data-size="4" id="selColumna" data-selected-text-format="count" data-count-selected-text="{0} Columna(s) Seleccionada(s)" title="OCULTAR COLUMNAS" multiple aria-label="size 3 select example" placeholder>
            <option value="0">FOLIO</option>
            <option value="1">ESTATUS</option>
            <option value="2">CENTRO DE TRABAJO</option>
            <option value="3">COORDINACIÓN</option>
            <option value="4">FECHA</option>
            <option value="5">MEDIO DE CAPTACIÓN</option>
            <option value="6">TIEMPO DE APERTURA</option>
            </select>
          </div> -->
        <!-- <span class="text-xs opacity-7">Ocultar columnas:</span>
        <a id="a_0" class="toggle-vis text-xxs opacity-7" data-column="0">FOLIO</a> - 
        <a id="a_1" class="toggle-vis text-xxs opacity-7" data-column="1">ESTATUS</a> - 
        <a id="a_2" class="toggle-vis text-xxs opacity-7" data-column="2">CENTRO DE TRABAJO</a> - 
        <a id="a_3" class="toggle-vis text-xxs opacity-7" data-column="3">COORDINACIÓN</a> - 
        <a id="a_4" class="toggle-vis text-xxs opacity-7" data-column="4">FECHA</a> - 
        <a id="a_5" class="toggle-vis text-xxs opacity-7" data-column="5">MEDIO DE CAPTACIÓN</a> - 
        <a id="a_6" class="toggle-vis text-xxs opacity-7" data-column="6">TIEMPO DE APERTURA</a> -->

            <table id="tablaPrueba2" class="table align-middle">
              <thead style="text-align:center;">
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOLIO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CENTRO DE TRABAJO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">COORDINACIÓN A LA<br> QUE PERTENECE</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA <br></th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">MEDIO DE <br> CAPTACIÓN</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TIEMPO <br> DE APERTURA</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ACCIONES</th>
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

<!-- MODAL ASIGNAR TECNICOS -->
<div class="modal fade" id="asignarTecnicosModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="asignarTecnicosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="asignarTecnicosModalLabel">Asignar Técnicos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>-->
      <div class="modal-body"> 
        <div class="row">
          <div class="col-12" style="text-align:right;">
              <span id="EtiquetaInfoOrdenTec" style="color:#ab0033;"></span>
          </div>
        </div>
        <div class="row">
            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Asignar técnicos</span>
            </div>
            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
        </div>
        <div class="row">
            <div class="col-12" >
                <br>
            </div>
        </div>
        <form id="formTecnicos" name="formTecnicos" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
                <div class="form-group"> 
                    <label>Seleccione el Técnico encargado de la orden de servicio, así como los técnicos auxiliares. A continuación, presione clic en el botón Agregar.</label>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="selTecnicoEncargado">TÉCNICO ENCARGADO</label>
                    <!-- <select class="select2 form-control" multiple="multiple" data-mdb-filter="true" data-max-options="1" id="selTecnicoEncargado" name="selTecnicoEncargado" data-placeholder="Selecciona uno o varios técnicos"> -->
                    <select class="form-select" id="selTecnicoEncargado" name="selTecnicoEncargado" >
                      
                    </select>
                    <input type="hidden" name="idSolModTec" id="idSolModTec" value="">
                    <input type="hidden" name="folioModTec" id="folioModTec" value="">
                    <input type="hidden" name="folioSolModTec" id="folioSolModTec" value="">
                    <input type="hidden" name="correoModTec" id="correoModTec" value="">
                    <input type="hidden" name="nombrecctModTec" id="nombrecctModTec" value="">
                    <input type="hidden" name="solicitanteModTec" id="solicitanteModTec" value="">
                    <input type="hidden" name="hdIdAsigna" id="hdIdAsigna" value="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="selTecnicosAuxiliares">TÉCNICOS AUXILIARES</label>
                    <select disabled class="select2 form-control" style="font-size: 0.875rem !important;" multiple="multiple" data-mdb-filter="true" id="selTecnicosAuxiliares" name="selTecnicosAuxiliares" data-placeholder="Seleccionar técnico(s) auxiliar(es)">
                    </select>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-12" style="text-align:right;">
              <div class="form-group">
                  <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" id="btnCancelTec">Cancelar</button>
                  <button type="button" class="btn colorBtnPrincipal" disabled id="btnAsignarTecnico" onclick="fnAgregarTecnicos()">Agregar</button>
                  <br>
              </div>
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-12">
              <label style="font-color:#ab0033 !important;">Listado de técnicos:</label> <br>
                <div class="" id="divTecnicos">
                    <table id="tablaTecnicos" class="table">
                        <thead>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NÚMERO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TÉCNICO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TIPO DE TÉCNICO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ELIMINAR</th>
                        </thead>
                        <tbody id="tbTecnicos">

                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-12">
                
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Seleccionar fecha de visita</span>
            </div>
            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-12">
                <br>
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-12">
                <div class="form-group">
                    <label>Seleccione la fecha de visita en que será programado el inicio y término de la orden de servicio. La fecha de inicio será notificado al usuario por correo electrónico.</label>
                </div>
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-5">
                <div class="form-group">
                    <label for="selTecnicosAuxiliares">FECHA DE PROGRAMACIÓN PARA INICIO DE ORDEN:</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                  <input type="datetime-local" name="fecha_inicio_prog" id="fecha_inicio_prog">
                </div>
            </div>
          </div>
          <br>
          <br>
          <div class="row detalleTecnicos">
            <div class="col-5">
                <div class="form-group">
                    <label for="selTecnicosAuxiliares">FECHA DE PROGRAMACIÓN PARA CIERRE DE ORDEN:</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                  <input type="datetime-local" name="fecha_fin_prog" id="fecha_fin_prog">
                </div>
            </div>
          </div>
        </form>
        <div class="row detalleTecnicos">
            <div class="col-12" >
            </div>
        </div>
        <div class="row detalleTecnicos">
            <div class="col-12" style="text-align:right;" >
              <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" onclick="fnCancelarModTecnicos()">Cancelar</button>
              <button type="button" class="btn colorBtnPrincipal" id="btnAsignarTec" onclick="fnAsignarTecnicos()">Asignar Técnico(s)</button>
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="fnCancelarModTecnicos()">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" id="btnAsignarTec" onclick="fnAsignarTecnicos()">Asignar</button>
      </div> -->
    </div>
  </div>
</div>
<!-- FIN MODAL ASIGNAR TECNICOS-->

<!-- MODAL CANCELAR ORDEN -->
<div class="modal fade" id="cancelOrdenModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="cancelOrdenModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="cancelOrdenModalLabel">Datos de la Cancelación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        <div class="row">
          <div class="col-12" style="text-align:right;">
              <span id="EtiquetaInfoOrdenCan" style="color:#ab0033;>"></span>
          </div>
        </div>
        <div class="row">
            <div class="col-8" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Cancelación de orden de servicio</span>
            </div>
            <div class="col-4" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
        </div>
        <div class="row">
            <div class="col-12" >
                <br>
            </div>
        </div>

        <div class="col-12">
          <div class="form-group">
            <label for="estatus_id">USUARIO QUE CANCELA:</label>
            <!-- <input type="text" id="txtUsuarioCancela" name="txtUsuarioCancela" class="form-control" value="{{Auth()->user()->name}}" readonly> -->
            <input type="text" id="txtUsuarioCancela" name="txtUsuarioCancela" class="form-control" value="{{ $getUsername[0]->nameuser}}" readonly>
            <input type="hidden" id="hdIdSolicServ" name="hdIdSolicServ" class="form-control"> 
            <input type="hidden" id="hdFolio" name="hdFolio" class="form-control">
            <input type="hidden" id="hdFolioSol" name="hdFolioSol" class="form-control">
            <input type="hidden" id="hdCorreo" name="hdCorreo" class="form-control">
            <input type="hidden" id="hdNombrecct" name="hdNombrecct" class="form-control">
            <input type="hidden" id="hdSolicitante" name="hdSolicitante" class="form-control">
            <input type="hidden" id="hdIdUsuarioCancela" name="hdIdUsuarioCancela" class="form-control" value="{{Auth()->user()->id}}" >
            
            <!-- <input type="hidden" id="hdIdEstatusCancela" name="hdIdEstatusCancela" class="form-control"> -->
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="selMotivoCancela">MOTIVO DE CANCELACIÓN:</label>
            <select class="form-select" aria-label="Default select example" id="selMotivoCancela" name="selMotivoCancela">
              <option value="0" selected>Seleccione motivo de cancelación de orden</option>
              @foreach($catMotivoCancela as $cancelaOrden)
                <option value="{{ $cancelaOrden->id }}">{{ $cancelaOrden->motivo }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="txtComentarios">DESCRIBA COMENTARIOS ADICIONALES:</label>
            <input type="text" id="txtComentarios" name="txtComentarios" class="form-control">
          </div>
        </div>
        
        <div class="row">
            <div class="col-12" >
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="text-align:right;" >
              <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" id="btnCancelarCancelacion">Cancelar</button>
              @can("192-btn-ins-cancelar")
              <button type="button" class="btn colorBtnPrincipal" onclick="fnGuardarCancelacion()" id="btnGuardarCancelacion">Aceptar</button>
              @endcan
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" onclick="fnGuardarCancelacion()" id="btnGuardarCancelacion">Guardar</button>
      </div> -->
    </div>
  </div>
</div>
<!-- FIN MODAL CANCELAR-->

<!-- MODAL CERRAR ORDEN -->
<div class="modal fade" id="cerrarOrdenModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="cerrarOrdenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="cerrarOrdenModalLabel">No. de Orden:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        <div class="row">
        <div class="col-12" style="text-align:right;">
              <span id="EtiquetaInfoOrdenCerr" style="color:#ab0033;>"></span>
          </div>
        </div>

        <div class="row">
            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Datos del Centro de Trabajo</span>
            </div>
            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
        </div>
        <div class="row">
            <div class="col-12" >
              <br>
            </div>
        </div>

        <form id="formCierre" name="formCierre" method="POST" enctype="multipart/form-data">
          <div class="col-12">
            <div class="form-group">
              <!--<label for="estatus_id">Usuario Cancela</label>
              <input type="text" id="txtUsuarioCancela" name="txtUsuarioCancela" class="form-control" value="ATENCION DE USUARIOS">-->
                <input type="hidden" id="hdIdOrdenCierra" name="hdIdOrdenCierra" class="form-control"> 
                <input type="hidden" id="hdFolioCierra" name="hdFolioCierra" class="form-control">
                <input type="hidden" id="hdFolioSolCierra" name="hdFolioSolCierra" class="form-control">
                <input type="hidden" id="correoCierre" name="correoCierre" class="form-control">
                <input type="hidden" id="nombrecctCierre" name="nombrecctCierre" class="form-control">
                <input type="hidden" id="solicitanteCierre" name="solicitanteCierre" class="form-control"> 
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div style="background-color:#ab0033; color:#FFFFFF; text-align:center;"><span>DATOS DEL CENTRO DE TRABAJO</span></div>
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="nombrect">Nombre del C.T. :</label>
                <label class="SinNegrita" id="lblNombreCTT"></label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="clavect">Clave del C.T. :</label>
                <label class="SinNegrita" id="lblClaveCTT"></label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="muni">Municipio:</label>
                <label class="SinNegrita" id="lblMunicipio"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="muni">Nombre del Director:</label>
                <label class="SinNegrita" id="lblDirector"></label>
              </div>
            </div>
            <div class="col-8">
              <div class="form-group">
                <label for="muni">Dirección:</label>
                <label class="SinNegrita" id="lblDireccion"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="muni">Coordinación a la que pertenece:</label>
                <label class="SinNegrita" id="lblCoordinacion"></label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="muni">Teléfono:</label>
                <label class="SinNegrita" id="lblTelefono"></label>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="muni">Turno:</label>
                <label class="SinNegrita" id="lblTurno"></label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="muni">Nivel Educativo:</label>
                <label class="SinNegrita" id="lblNivel"></label>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-12">
                <br>
              </div>
          </div>

          <div class="row">
              <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                  <span style="color:white;">Datos del Solicitante</span>
              </div>
              <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
              </div>
          </div>
          <div class="row">
              <div class="col-12" >
                <br>
              </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="muni">Tipo de Orden:</label>
                <label class="SinNegrita" id="lblTipoOrden"></label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="muni">Dependencia que atiende el servicio:</label>
                <label class="SinNegrita" id="lblAreaAtiende"></label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="muni">Nombre del Solicitante:</label>
                <label class="SinNegrita" id="lblSolicitante"></label>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="muni">Teléfono del Solicitante:</label>
                <label class="SinNegrita" id="lblSolicitanteTel"></label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="muni">Correo electrónico del Solicitante:</label>
                <label class="SinNegrita" id="lblSolicitanteCorr"></label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="muni">Descripción del Reporte:</label>
                <label class="SinNegrita" id="lblDescReporte"></label>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-12">
              </div>
          </div>

          <div class="row">
              <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                  <span style="color:white;">Técnicos de Soporte Asignados</span>
              </div>
              <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
              </div>
          </div>
          <div class="row">
              <div class="col-12" >
                <br>
              </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="muni">Técnico Encargado:</label>
                <label class="SinNegrita" id="lblTecEnc"></label>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="muni">Técnico(s) Auxiliares:</label>
                <label class="SinNegrita" id="lblTecAux"></label>
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-12" style="text-align:right;">
                <br>
              </div>
          </div>

          <div class="row">
              <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                  <span style="color:white;">Equipos/Servicios Atendidos</span>
              </div>
              <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
              </div>
          </div>
          <div class="row">
              <div class="col-12" >
                <br>
              </div>
          </div>

          <div class="row">
            <div class="col-12 scrollVertical" id="divEquiposRealizados">
              
            </div>
          </div>

          <div class="row bandVer2">
              <div class="col-12" >
                <br>
              </div>
          </div>

          <div class="row bandVer2">
              <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                  <span style="color:white;">Archivos de cierre de la orden</span>
              </div>
              <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
              </div>
          </div>
          <div class="row bandVer2">
              <div class="col-12" >
                <br>
              </div>
          </div>

          <div class="row">
              <div class="col-12" style="text-align:left;">
                <div id="divImgCierreOrden">

                </div>
              </div>
          </div>

          <div class="row bandVer">
              <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                  <span style="color:white;">Cierre de Orden de Servicio</span>
              </div>
              <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
              </div>
          </div>
          <div class="row bandVer">
              <div class="col-12" >
                <br>
              </div>
          </div>

          <div class="row bandVer">
              <div class="col-12" >
                <div class="form-group">
                  <label for="archivoCierre">Agregar orden de servicio impresa en formato .PDF con la firma y sello de las autoridades solicitantes, así como firmal del Técnico encargado de la orden.</label>
                </div>
              </div>
          </div>

          <div class="row bandVer">
            <div class="col-6">
              <div class="form-group">
                <!-- <label for="archivoCierre">Agregar orden de servicio impresa en formato .PDF con la firma y sello de las autoridades solicitantes, así como firmal del Técnico encargado de la orden.</label> -->
                <!-- <input class="form-control" type="file" id="archivoCierre" name="archivoCierre"> -->
                <input class="form-control" type="file" multiple id="archivoCierre" name="archivoCierre[]" accept="pdf"/>
              </div>
            </div>
          </div>

          <div class="row bandVer">
            <div class="col-12">
              <div class="form-group">
                <label for="txtObservacionesC">Observaciones</label>
                <textarea class="form-control" id="txtObservacionesC" name="txtObservacionesC" rows="3"></textarea>
              </div>
            </div>
          </div>

          
        </form>
        <div class="row bandVer">
              <div class="col-12" >
              </div>
          </div>
          <div class="row">
            <div class="col-12" style="text-align:right;" >
                <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" id="btnCancelarCierre">Cancelar</button>
                <button type="button" class="btn colorBtnPrincipal bandVer" onclick="fnCierreOrden()" id="btnCerrar">Cerrar Orden</button>
              </div>
          </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" onclick="fnCierreOrden()" id="btnCerrar">Cerrar Orden</button>
      </div> -->
    </div>
  </div>
</div>
<!-- FIN MODAL CERRAR-->

<!-- MODAL VER ARCHIVO CIERRE  -->
<div class="modal fade" id="verArchivoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="verArchivoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verArchivoModalLabel">Archivo de Cierre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="form-group" id="divArchivosCierre">

            <!-- <img  id="archivoCierreOrden" />
            <input type="hidden" id="rutaArchivoCierreO" name="rutaArchivoCierreO"> -->
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <!-- <button type="button" class="btn colorBtnPrincipal" onclick="fnDescargarArchivo()" id="btnDescargarArchivo">Descargar</button> -->
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL MODAL VER ARCHIVO CIERRE -->

<!-- MODAL VER ARCHIVOS (IMAGENES) CIERRE ORDEN  -->
<div class="modal fade" id="verArchivosOrdenModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="verArchivosOrdenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="verArchivosOrdenModalLabel">Archivo de Cierre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
      <div class="modal-body">
        <div class="row">
          <div class="col-12" style="text-align:right;">
              <!-- <span id="EtiquetaInfoOrdenCan" style="color:#ab0033;>"></span> -->
              <br>
          </div>
        </div>
        <div class="row">
            <div class="col-8" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Archivos de Cierre de la Orden</span>
            </div>
            <div class="col-4" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
        </div>
        <div class="row">
          <div class="col-12" >
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group" id="divArchivosCierreOrden" style="text-align:center;">
              <!-- <img  id="archivoCierreOrden" />
              <input type="hidden" id="rutaArchivoCierreO" name="rutaArchivoCierreO"> -->
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-12" >
            </div>
        </div>
        <div class="row">
          <div class="col-12" style="text-align:right;" >
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div> 
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div> -->
    </div>
  </div>
</div>
<!-- FIN MODAL VER ARCHIVOS (IMAGENES) CIERRE ORDEN -->

<!-- MODAL ASIGNAR TECNICOS -->
<div class="modal fade" id="editarTecnicosModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editarTecnicosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body"> 
        <div class="row">
          <div class="col-12" style="text-align:right;">
              <span id="EtiquetaInfoOrdenTecE" style="color:#ab0033;"></span>
          </div>
        </div>
        <div class="row">
            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Editar técnicos</span>
            </div>
            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
        </div>
        <div class="row">
            <div class="col-12" >
                <br>
            </div>
        </div>
        <form id="formEditarTecnicos" name="formEditarTecnicos" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
                <div class="form-group"> 
                    <label>Seleccione el Técnico encargado de la orden de servicio, así como los técnicos auxiliares. A continuación, presione clic en el botón Agregar.</label>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="selTecnicoEncargadoE">TÉCNICO ENCARGADO</label>
                    <!-- <select class="select2 form-control" multiple="multiple" data-mdb-filter="true" data-max-options="1" id="selTecnicoEncargado" name="selTecnicoEncargado" data-placeholder="Selecciona uno o varios técnicos"> -->
                    <select class="form-select" id="selTecnicoEncargadoE" name="selTecnicoEncargadoE" >
                      
                    </select>
                    <input type="hidden" name="idSolModTecE" id="idSolModTecE" value="">
                    <input type="hidden" name="folioModTecE" id="folioModTecE" value="">
                    <input type="hidden" name="folioSolModTecE" id="folioSolModTecE" value="">
                    <input type="hidden" name="correoModTecE" id="correoModTecE" value="">
                    <input type="hidden" name="nombrecctModTecE" id="nombrecctModTecE" value="">
                    <input type="hidden" name="solicitanteModTecE" id="solicitanteModTecE" value="">
                    <input type="hidden" name="seguimientoModTec" id="seguimientoModTec" value="">
                    <input type="hidden" name="hdIdAsignaE" id="hdIdAsignaE" value="">
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="selTecnicosAuxiliaresE">TÉCNICOS AUXILIARES</label>
                    <select disabled class="select2 form-control" style="font-size: 0.875rem !important;" multiple="multiple" data-mdb-filter="true" id="selTecnicosAuxiliaresE" name="selTecnicosAuxiliaresE" data-placeholder="Seleccionar técnico(s) auxiliar(es)">
                    </select>
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-12" style="text-align:right;">
              <div class="form-group">
                  <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" id="btnCancelTecE">Cancelar</button>
                  <button type="button" class="btn colorBtnPrincipal" disabled id="btnAsignarTecnicoE" onclick="fnAgregarTecnicosE()">Agregar</button>
                  <br>
              </div>
            </div>
          </div>
          <div class="row detalleTecnicosE">
            <div class="col-12">
              <label style="font-color:#ab0033 !important;">Listado de técnicos:</label> <br>
                <div class="" id="divTecnicos">
                    <table id="tablaTecnicosE" class="table">
                        <thead>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NÚMERO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TÉCNICO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TIPO DE TÉCNICO</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ELIMINAR</th>
                        </thead>
                        <tbody id="tbTecnicosE">

                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
          </div>
          <div class="row detalleTecnicosE">
            <div class="col-12">
                
            </div>
          </div>
          <div class="row detalleTecnicos">
            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                <span style="color:white;">Seleccionar fecha de visita</span>
            </div>
            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
            </div>
          </div>
          <div class="row detalleTecnicosE">
            <div class="col-12">
                <br>
            </div>
          </div>
          <div class="row detalleTecnicosE">
            <div class="col-12">
                <div class="form-group">
                    <label>Seleccione la fecha de visita en que será programado el inicio y término de la orden de servicio. La fecha de inicio será notificado al usuario por correo electrónico.</label>
                </div>
            </div>
          </div>
          <div class="row detalleTecnicosE">
            <div class="col-5">
                <div class="form-group">
                    <label for="fecha_inicio_progE">Fecha de programación para inicio de orden:</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                  <input type="datetime-local" name="fecha_inicio_progE" id="fecha_inicio_progE">
                </div>
            </div>
          </div>
          <br>
          <br>
          <div class="row detalleTecnicosE">
            <div class="col-5">
                <div class="form-group">
                    <label for="fecha_fin_progE">Fecha de programación para cierre de orden:</label>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                  <input type="datetime-local" name="fecha_fin_progE" id="fecha_fin_progE">
                </div>
            </div>
          </div>
        </form>
        <div class="row detalleTecnicosE">
            <div class="col-12" >
            </div>
        </div>
        <div class="row detalleTecnicosE">
            <div class="col-12" style="text-align:right;" >
              <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" onclick="fnCancelarModTecnicosE()">Cancelar</button>
              <button type="button" class="btn colorBtnPrincipal" id="btnAsignarTecE" onclick="fnAsignarTecnicosE()">Actualizar Técnico(s)</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL EDITAR TECNICOS-->

<div class="modal fade" id="verDetEquipoAtendidoModal" data-bs-backdrop="static" role="dialog"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- <div class="modal-header"> 
      </div>  -->
      <div class="modal-body"> 
        <div class="row">
          <div class="col-12" >
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-4" style="text-align:center;  background-color:#ab0033;">
              <span style="color:white;">Evidencia del equipo/servicio</span>
          </div>
          <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
          </div>
        </div>
        <div class="row">
          <div class="col-12" >
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <label>Equipo/Servicio:</label>
            <label id="lblEquipoM" class="SinNegrita"></label>
          </div>
          <div class="col-4">
            <label>Estatus:</label>
            <label id="lblEstatusM" class="SinNegrita"></label>
          </div>
          <div class="col-4">
            <label>Ubicación:</label>
            <label id="lblUbicacionM" class="SinNegrita"></label>
          </div>
        </div>
        <div class="row" id="divDetalleEquipoM">
          <div class="col-4">
            <label>Etiqueta:</label>
            <label id="lblEtiquetaM" class="SinNegrita">
            </label>
          </div>
          <div class="col-4">
            <label>Detalle:</label>
            <label id="lblDetalleM" class="SinNegrita">
            </label>
          </div>
          <div class="col-4">
            <!-- <label>Ubicación:</label>
            <label id="lblUbicacionM" class="SinNegrita">
            </label> -->
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <label>Descripción del problema:</label>
            <label id="lblDescProblemaM" class="SinNegrita"></label>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <label>Listado de Áreas de Servicio/Tareas:</label>
          </div>
        </div>
        <div class="row">
          <div class="col-12" id="divListTareasServEquipoM">
            <!-- <table>
              <thead>
                <th><label class="SinNegrita">Área de Servicio</label></th>
                <th><label class="SinNegrita">Tarea</label></th>
              </thead>
              <tbody>
                
                <tr>
                    <td>
                        <label class="SinNegrita"></label>
                    </td>
                    <td>
                        <label class="SinNegrita"></label>
                    </td>
                </tr>
              </tbody>
            </table> -->
          </div>
        </div>

        <div class="row">
            <div class="col-12" >
                <label>Diagnóstico:</label>
                <label id="lblDiagnosticoM" class="SinNegrita"></label>
            </div>
        </div>
        <div class="row">
            <div class="col-12" >
                <label>Solución:</label>
                <label id="lblSolucionM" class="SinNegrita"></label>
            </div>
        </div>
        <div class="row">
          <div class="col-12" >
            <br>
          </div>
        </div>
        <div class="row">
            <div class="col-12" id="divEvidenciaEquipo">
                
            </div>
        </div>
        <div class="row">
          <div class="col-12" >
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-12" style="text-align:right;" >
              <button type="button" class="btn colorBtnCancelar" data-bs-dismiss="modal" id="btnCancelarCierre">Cancelar</button>
            </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
      </div> -->
    </div>
  </div>
</div>

@endsection 

@section('page-scripts') 
<!-- <script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script> -->
<!-- <script src="{{ asset('js/sweetalert2@11.js') }}"></script> -->

<!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>

<!-- <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> -->

<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}"> 
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>

<!--multicheck JC--> 
<!-- <link href="{{ asset('css/bootstrap-select_1.14.0-beta2_css_bootstrap-select.min.css') }}" rel="stylesheet" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="{{ asset('js/bootstrap-select_1.14.0-beta2_js_bootstrap-select.min.js') }}" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--multicheck JC--> 

<script>
  var tabla;
  var vRol;
  var iduser;
  // var evalu;
  var evalu = []; 
  var arrayCentro = [];
  var tecnicosAuxiliaresArray = []; 
  var tecnicosAuxiliaresArrayE = []; 
  var arrTecnicosElim = []; 
 
  function load(){
    var tipo='GET';
    // var tipo='POST';
    var coordinacion_id= $('#selCoordinacion').val();
    var estatus_id= $('#selEstatusOrden').val();
    var fecha_inicio= $('#txtFechaInicio').val();
    var fecha_fin= $('#txtFechaFin').val();
    var clavecct= $('#txtCCT').val();
    // console.log(fecha_inicio);
    $.ajax({
      url: '{{route("showOrdenes")}}',
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

          cargaSelTecnicoEncargado(data[1]);
      }
    });
  }

  function cargaSelTecnicoEncargado(data){
    var htmlSel='<option value="0" selected>Seleccionar</option>';
    for (var i = 0; i < data.length; i++) {
        htmlSel+='<option value="'+data[i].id_tecnico+'">'+data[i].nombre_tecnico+'</option>'; 
    } 

    $("#selTecnicoEncargado").html(htmlSel);
    $("#selTecnicoEncargadoE").html(htmlSel);
  }

  function fntabla(data){
     
    if(tabla){
      $('#tablaPrueba2').DataTable().clear().destroy();
      // tabla.ajax.reload();
    }
    // console.log(data[0]);
    tabla=$('#tablaPrueba2').DataTable({
        // processing:true,
        // responsive:true,
          data:data[0],
          columns: [
            { data: null, className: "text-left", render:function(data){
                if(data.folio_solic!='' && data.folio_solic!=null){
                  // return '<h6 class="mb-0 text-sm">'+data.folio+'</h6><span class="text-xs text-secondary mb-0">'+data.folio_solic+'</span>';
                  return '<h6 class="mb-0 text-sm">'+data.folio+'</h6><p class="text-xs text-secondary mb-0">'+data.folio_solic+'</p>';
                }else{
                  return '<h6 class="mb-0 text-sm">'+data.folio+'</h6>';
                }
              }
            },
            { data: null, className: "text-center", render:function(data){
                if(data.desc_estatus_orden=='TRABAJANDO'){
                  // return '<span class="text-xs" style="background-color:grey; border-radius:0.5em; padding:0.17em; color:grey;">TRABAJANDO</span>';
                  return '<span style="background-color:grey; border-radius:0.5em; padding:0.17em; color:grey;">TRABAJANDO</span>';
                }else{
                  // return '<span class="text-xs">'+data.desc_estatus_orden+'</span>';
                  return '<span>'+data.desc_estatus_orden+'</span>';
                }
              }
            },
            { data: null, className: "text-left", render:function(data){
                return '<div><h6 class="mb-0 text-sm">'+data.nombrecct+'</h6><p class="text-xs text-secondary mb-0">'+data.clavecct+', '+data.municipio+'</p></div>';
              }
            },
            { data: null, className: "text-center", render:function(data){
                // return '<span class="text-xs">'+data.coordinacion+'</span>';
                return '<span>'+data.coordinacion+'</span>';
              }
            },
            { data: null, className: "text-center", render:function(data){
                // return '<span class="text-xs">'+data.fecha_orden+'</span>';
                var fechaO=data.fecha_orden;
                var separaFecha = fechaO.split(" ");
                // console.log(separaFecha);
                return '<span>'+separaFecha[0]+' <br>'+separaFecha[1]+'</span>';
                // return '<span>'+data.fecha_orden+'</span>';
              }
            },
            { data: null, className: "text-center", render:function(data){
                // return '<span class="text-xs">'+data.captacion+'</span>';
                return '<span>'+data.captacion+'</span>';
              }
            },
            { data: null, className: "text-center", render:function(data){
                if(data.tiempo_apertura>1){
                  // return '<span class="text-xs">'+data.tiempo_apertura+' DÍAS</span>';
                  return '<span class="mb-0 text-sm">'+data.tiempo_apertura+' DÍAS</span>';
                }if(data.tiempo_apertura==0){
                  // return '<span class="text-xs">'+data.tiempo_apertura+' DÍAS</span>';
                  return '<span class="mb-0 text-sm">'+data.tiempo_apertura+' DÍAS</span>';
                }else{
                  // return '<span class="text-xs">'+data.tiempo_apertura+' DÍA</span>';
                  return '<span class="mb-0 text-sm">'+data.tiempo_apertura+' DÍA</span>';
                }
              }
            },
            { data: null, className: "text-center", render:function(data){
              // console.log(data.totalequipos);
              var estatuss='';
              var fol="'"+data.folio+"'";
              var folSol='';

              if(data.folio_solic==null ){
                folSol=data.folio_solic;
              }else{
                folSol="'"+data.folio_solic+"'";
              }

              var correoSol="'"+data.correo_solicitante+"'";
              var nombrecctSol="'"+data.nombrecct+"'";
              var solicitanteSol="'"+data.nombre_solicitante+"'"; 
              var desc_estatus="'"+data.desc_estatus_orden+"'"; 
              var totalEquipos = data.totalequipos;
              var totalEquiposCerrados = data.totalequiposcerrados; 
              var seguimiento=data.seguimiento;
              var contAsesoServ=data.contaseserv;

                if(data.desc_estatus_orden=='Cancelada' ){
                  estatuss+= '<div class="dropdown btn-group dropstart">'+
                          '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                          '<ul class="dropdown-menu" aria-labelledby="opciones1">'+
                          '@can("188-opt-imprimir-registro")<li>'+ 
                          '<a onclick="imprimirPDFOrden('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                          '</li>@endcan'+
                          '<li>';
                    return estatuss;
                }else{
                  if(data.desc_estatus_orden=='En espera'){
                    estatuss+= '<div class="dropdown btn-group dropstart">'+
                          '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                          '<ul class="dropdown-menu" aria-labelledby="opciones1">'+
                          '@can("170-opt-edit-registro")<li>'+
                          '<a onclick="fnEditar('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-edit"></i> Editar Orden</a>'+
                          '</li>@endcan'+
                          '@can("186-opt-ins-tecnicos")<li>'+
                          '<a onclick="verTecnicos('+data.id_orden+','+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+','+seguimiento+')" class="dropdown-item" > <i class="fas fa-user-plus"></i> Asignar Técnicos</a>'+
                          '</li>@endcan'+  
                          '@can("188-opt-imprimir-registro")<li>'+
                          '<a onclick="imprimirPDFOrden('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                          '</li>@endcan'+
                          '@can("191-opt-cancelar-registro")<li>'+
                          '<a onclick="cancelarOrden('+data.id_orden+',5,'+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+')" class="dropdown-item" > <i class="	fas fa-times"></i> Cancelar Orden</a>'+
                          '</li>@endcan'+
                          '</ul>'+
                          '</div>';
                    return estatuss;
                  }else if(data.desc_estatus_orden=='Asignada'){ ///AIDA
                   
                   estatuss+= '<div class="dropdown btn-group dropstart">'+
                         '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                         '<ul class="dropdown-menu" aria-labelledby="opciones1">';
                    
                    var vIdRol=$("#hdIdRol").val();
                    ///que solo puedan editar una ves asignada tecnicos y adminis
                    if(vIdRol==16 || vIdRol==17 || vIdRol==22 || vIdRol==23 || vIdRol==24 || vIdRol==25){
                      estatuss+='@can("170-opt-edit-registro")<li>'+
                         '<a onclick="fnEditar('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-edit"></i> Editar Orden</a>'+
                         '</li>@endcan';
                    }
                        //  '@can("170-opt-edit-registro")<li>'+
                        //  '<a onclick="fnEditar('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-edit"></i> Editar Orden</a>'+
                        //  '</li>@endcan'+ 
                         
                        //  '@can("235-opt-edit-tecnicos")<li>'+  ////////////////  si esta ASIGNADA NO puede editar tecnicos 
                        //   '<a onclick="editTecnicos('+data.id_orden+','+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+')" class="dropdown-item" > <i class="fas fa-user-plus"></i> Editar Técnicos</a>'+
                        //   '</li>@endcan'+ /////////////////
                    estatuss+='@can("187-opt-iniciar-registro")<li>'+
                          '<a onclick="updEstatusOrden('+data.id_orden+','+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+','+seguimiento+')" class="dropdown-item" > <i class="fas fa-play"></i> Iniciar Orden</a>'+
                          '</li>@endcan'+
                         '@can("188-opt-imprimir-registro")<li>'+
                         '<a onclick="imprimirPDFOrden('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                         '</li>@endcan'+
                         '@can("191-opt-cancelar-registro")<li>'+
                         '<a onclick="cancelarOrden('+data.id_orden+',5,'+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+')" class="dropdown-item"> <i class="	fas fa-times"></i> Cancelar Orden</a>'+
                         '</li>@endcan'+
                         '</ul>'+
                         '</div>';
                   return estatuss;
                  }else if(data.desc_estatus_orden=='Atendida'){
                   estatuss+= '<div class="dropdown btn-group dropstart">'+
                         '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                         '<ul class="dropdown-menu" aria-labelledby="opciones1">';
                   if(contAsesoServ > 0){ 
                    estatuss+= '@can("272-opt-get-materiales")<li>'+ 
                         '<a onclick="fnMateriales('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-plus"></i> Agregar Materiales</a>'+
                         '</li>@endcan';
                   }  
                  
                   estatuss+='@can("188-opt-imprimir-registro")<li>'+ 
                        //  '<a onclick="imprimirPDFOrden('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                         '<a onclick="imprimirPDFOrdenGuardado('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                         '</li>@endcan'+
                        //  '@can("188-opt-imprimir-registro")<li>'+
                        //  '<a onclick="verArchivosOrden('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Ver Archivos</a>'+
                        //  '</li>@endcan'+
                         '@can("188-opt-imprimir-registro")<li>'+
                         '<a onclick="fnCerrarOrden('+data.id_orden+',4,'+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+','+totalEquiposCerrados+',1)" class="dropdown-item" > <i class="fas fa-eye"></i> Ver Detalle</a>'+
                         '</li>@endcan'+
                         '</ul>'+
                         '</div>';
                   return estatuss;
                  }else{
                    estatuss+= '<div class="dropdown btn-group dropstart">'+
                          '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                          '<ul class="dropdown-menu" aria-labelledby="opciones1">';
                          // '@can("170-opt-edit-registro")<li>'+
                          // '<a onclick="fnEditar('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-edit"></i> Editar Orden</a>'+
                          // '</li>@endcan';

                          if(data.desc_estatus_orden=='Trabajando' ){ 
                            var vIdRol2=$("#hdIdRol").val();
                            ///que solo puedan editar una ves asignada tecnicos y adminis
                            if(vIdRol2==16 || vIdRol2==17 || vIdRol2==22 || vIdRol2==23 || vIdRol2==24 || vIdRol2==25){
                              estatuss+='@can("170-opt-edit-registro")<li>'+
                                '<a onclick="fnEditar('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-edit"></i> Editar Orden</a>'+
                                '</li>@endcan';
                            }

                            if(contAsesoServ > 0){ 
                              estatuss+= '@can("272-opt-get-materiales")<li>'+ 
                                  '<a onclick="fnMateriales('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-plus"></i> Agregar Materiales</a>'+
                                  '</li>@endcan';
                            }  
                          }else{
                            estatuss+='@can("170-opt-edit-registro")<li>'+
                                '<a onclick="fnEditar('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-edit"></i> Editar Orden</a>'+
                                '</li>@endcan';
                          }

                          if(data.desc_estatus_orden!='Trabajando' ){
                            estatuss+='@can("186-opt-ins-tecnicos")<li>'+ 
                          '<a onclick="verTecnicos('+data.id_orden+','+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+','+seguimiento+')" class="dropdown-item"> <i class="fas fa-user-plus"></i> Asignar Técnicos</a>'+
                          '</li>@endcan';
                          }
                          
                          if(data.desc_estatus_orden!='Trabajando' ){
                            estatuss+='@can("187-opt-iniciar-registro")<li>'+
                          '<a onclick="updEstatusOrden('+data.id_orden+','+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+','+seguimiento+')" class="dropdown-item" > <i class="fas fa-play"></i> Iniciar Orden</a>'+
                          '</li>@endcan';
                          }
                          estatuss+='@can("188-opt-imprimir-registro")<li>'+
                          '<a onclick="imprimirPDFOrden('+data.id_orden+')" class="dropdown-item" > <i class="fas fa-download"></i> Imprimir Solicitud</a>'+
                          '</li>@endcan';

                          // if(totalEquipos == totalEquiposCerrados){
                            estatuss+='@can("189-opt-cerrar-registro")<li>'+
                            '<a onclick="fnCerrarOrden('+data.id_orden+',4,'+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+','+totalEquipos+','+totalEquiposCerrados+',0)" class="dropdown-item"  > <i class="fas fa-check"></i> Cerrar Orden</a>'+
                            // '<a onclick="fnCerrarOrden('+data.id_orden+',4,'+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+')" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#cerrarOrdenModal" > <i class="fas fa-check"></i> Cerrar Orden</a>'+
                            '</li>@endcan';  
                          // }

                    if(data.desc_estatus_orden=='En espera' || data.desc_estatus_orden=='Trabajando'){
                      estatuss+='@can("191-opt-cancelar-registro")<li>'+
                            '<a onclick="cancelarOrden('+data.id_orden+',5,'+fol+','+folSol+','+correoSol+','+nombrecctSol+','+solicitanteSol+','+desc_estatus+')" class="dropdown-item" > <i class="	fas fa-times"></i> Cancelar Orden</a>'+
                            '</li>@endcan'; 
                    }
                    estatuss+='</ul>'+
                            '</div>';
                      return estatuss;
                  }
                  
                }
              }
            },
          ],
          "language": {
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 de _TOTAL_ registros", 
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
            },
        },
        columnDefs: [
                    {
                        "targets": [],
                        "visible": false,
                        "searchable": true
                    },
                    { width: 15, targets: 2}
        ],
        fixedColumns: true,
        order: [[4, "desc"], [1, "asc"]],///  ordenar campos de la tabla desde aqui
        // paging: false,
        // scrollY: '400px'
      });
    
    $('#tablaPrueba2 tbody').on('click', 'tr', function () {
      // console.log(table.row( this ).data());
      $("#tablaPrueba2 tbody tr").css("background-color", "#FFFFFF");
      $(this).css("background-color", "#E8E8E6");
    });

    var column;
    $('#selColumna').on('changed.bs.select', function (e) {
      tabla.columns([0, 1, 2, 3, 4, 5, 6] ).visible( true );
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

    //   document.querySelectorAll('a.toggle-vis').forEach((el) => {el.addEventListener('click', function (e) {
    //     e.preventDefault();
    //     // console.log('clicero');
    //     console.log(e.target);
    //     let columnIdx = e.target.getAttribute('data-column');
    //     let column = tabla.column(columnIdx);
 
    //     // Toggle the visibility
    //     column.visible(!column.visible());
    //     if(!column.visible()){
    //       $("#a_"+columnIdx).css('color', '#ab0033');
    //     }else{
    //       $("#a_"+columnIdx).css('color', '#344767'); 
    //     }
        
    //   });
    // });
  }

  function updEstatusOrden(vidSolicServ, folio, folioSol, correo, nombrecct, solicitante, desc_estatus, totalEquipos, seguimiento){

    fnValidaRecarga(vidSolicServ); 

    fnValidaAcceso(vidSolicServ).then((data) => { 
      // console.info('Response:', data)
      if(data.getvalidaaccesoorden==false){ 
        fnUpdAcceso(vidSolicServ, true, 1);

        if(totalEquipos != 0){
          Swal.fire({
              title: '',
              html: '<spann>¿Está seguro que desea iniciar la orden de servicio?</spann>',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#ab0033',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Aceptar',
              cancelButtonText: 'Cancelar',
              }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire({
                    html: '<div class="fa-3x">'+
                            '<span class="input-group" style="display:flex; justify-content:center; padding-left: 0%; padding-top: 15%; font-size: 5rem;" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'+
                            '<p></p>'+
                            '<p>Espere por favor</p>'+
                                
                            '</div>',
                    allowOutsideClick: false,
                    showConfirmButton: false
                });

                $.ajax({
                    url: "{{ route('updEstatusI') }}",
                    data:{idSolicServ : vidSolicServ, folio : folio, folioSol : folioSol, correo : correo, nombrecct : nombrecct, solicitante : solicitante, seguimiento : seguimiento},
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json', 
                    success: function(data) {
                      if(data[0]['insiniciasolicitud']==false){
                        msjeAlertaPrincipal('','<span>Se ha iniciado con éxito la orden de servicio con el folio: <strong>'+folio+'</strong>. Se ha notificado al usuario mediante el correo electrónico proporcionado.</span>','success')
                        fnUpdAcceso(vidSolicServ, false, 1);
                        load();
                      }else{
                        msjeAlertaPrincipal('','No se pudo iniciar la orden','error')
                      }
                    }
                });
              }else{
                // console.log('no iniciar');
                fnUpdAcceso(vidSolicServ, false, 1);
                //window.location.href = '{{ route("listadoOrdenes") }}';
              }
          });
        }else{
          msjeAlertaPrincipal('','Favor de agregar equipos a la orden de servicio','info');
          fnUpdAcceso(vidSolicServ, false, 1);
        }
      }else{
        msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
      }
    });
  }

  function imprimirPDFOrden(idOrden){

    // let urlEditar = '{{ route("download-pdf", ":id") }}';
    // urlEditar = urlEditar.replace(':id', idOrden);

    let urlEditar = '{{ route("download-cierre-pdf", ":id") }}';
    urlEditar = urlEditar.replace(':id', idOrden);
 
    var win = window.open(urlEditar, '_blank'); /// para abrir una nueva pestaña y que se muestre el pdf // este es el bueno para descargar
    // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank');
    
    // $.ajax({
    //     url: urlEditar,
    //     type: 'GET',
    //     // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //     dataType: 'json', 
    //     success: function(data) {
    //       console.log(data);   //data[0][i].id_tarea
    //       // if(data[0][0]['exito']==false){
    //       //   msjeAlertaPrincipal('Estatus actualizado correctamente','','success')
    //       //   load();
    //       // }else{
    //       //   msjeAlertaPrincipal('Estatus No se actualizó','','error')
    //       // }
    //     }
    // });
  }

  function imprimirPDFOrdenGuardado(idSolicServ){

    let urlEditar = '{{ route("verArchivoCierre", ":id") }}';
    urlEditar = urlEditar.replace(':id', idSolicServ);
    
    $.ajax({
        url: urlEditar,
        type: 'GET',
        dataType: 'json', 
        success: function(data) {
          console.log(data);  
          // var nombre="64cd883de4cd1_78.jpg";
          var html='';
          $.each(data, function(j, val){
            if (!jQuery.isEmptyObject(data[j])) {

              var nombre= data[j].nombre_archivo;
              let urlArchivo = '{{ asset("public/cierreOrden/:id") }}'; //////31/08/2023 
               urlArchivo = urlArchivo.replace(':id', nombre);

              // html+='<a href="'+urlArchivo+'" target="_blank"><img id="archivo_'+j+'" src="'+urlArchivo+'" /></a>';
              // $("#divArchivosCierre").html(html);
              // $(location).attr('href',urlArchivo);
              window.open(urlArchivo, '_blank');
            }
          });
      
        }
    });
    
    
  }

  function fnDescargarArchivo(){
    document.location=$("#rutaArchivoCierreO") .val();
  }

  function msjeAlertaPrincipal(titulo, contenido, icono){

    Swal.fire({
        title: titulo,
        html: contenido,
        icon: icono,
        showCancelButton: false,
        confirmButtonColor: '#ab0033',
        // cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        // cancelButtonText: 'Aceptar',
        width: 600,
        allowOutsideClick: false,
        }).then((result) => {
        if (result.isConfirmed) {

        }else{
            
        }
    });
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

  function cancelarOrden(idSolicServ,idEstatusOrden, folio, folioSol, correo, nombrecct, solicitante, desc_estatus){
    // var validaAcces=fnValidaAcceso(idSolicServ);
    // if (validaAcces=='false'){
    fnValidaRecarga(idSolicServ);

    fnValidaAcceso(idSolicServ).then((data) => { 
      // console.info('Response:', data)
      if(data.getvalidaaccesoorden==false){ 
        fnUpdAcceso(idSolicServ, true, 1);
        $("#hdIdSolicServ").val("");
        $("#selMotivoCancela").val('');
        $("#txtComentarios").val('');
        $("#hdFolio").val('');
        $("#hdFolioSol").val('');
        $("#hdCorreo").val('');
        $("#hdNombrecct").val('');
        $("#hdSolicitante").val('');

        $("#cancelOrdenModal").modal("show");

        $("#hdIdSolicServ").val(idSolicServ);
        $("#hdFolio").val(folio);
        $("#hdFolioSol").val(folioSol);
        $("#hdCorreo").val(correo);
        $("#hdNombrecct").val(nombrecct);
        $("#hdSolicitante").val(solicitante);
        
        var EtiquetaInfoOrdenCan='';
        EtiquetaInfoOrdenCan+='FOLIO DE ORDEN: ';
        EtiquetaInfoOrdenCan+=''+folio+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        EtiquetaInfoOrdenCan+='ESTATUS: '; 
        EtiquetaInfoOrdenCan+=''+desc_estatus+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $("#EtiquetaInfoOrdenCan").html(EtiquetaInfoOrdenCan);
      }else{
        msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
      } 
    });
  }
 
  function fnCierreOrden(){
    var vidSolicServ = $("#hdIdOrdenCierra").val();
    var archivoEvidencia = $("#archivoCierre").val();
    var folio = $("#hdFolioCierra").val();

    var formCierre = $('#formCierre')[0];
    var data2 = new FormData(formCierre);  

    // console.log(archivoEvidencia);

    if(archivoEvidencia=='' || archivoEvidencia==null){
      msjeAlertaSecundario('','Debe seleccionar el archivo de cierre de la orden','error');
    }else{
      var extension=archivoEvidencia.substr(-3);
      // console.log(extension);
      if(extension!='pdf' && extension!='PDF' ){
        msjeAlertaSecundario('','Debe seleccionar un archivo tipo pdf','error');
      }else{

        Swal.fire({
            title: '',
            text: '¿Está seguro que desea finalizar la orden de servicio?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ab0033',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {

              Swal.fire({
                  html: '<div class="fa-3x">'+
                          '<span class="input-group" style="display:flex; justify-content:center; padding-left: 0%; padding-top: 15%; font-size: 5rem;" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'+
                          '<p></p>'+
                          '<p>Espere por favor</p>'+
                              
                          '</div>',
                  allowOutsideClick: false,
                  showConfirmButton: false
              });

              $.ajax({
                  url: "{{ route('cerrarOrden') }}",
                  data: data2,
                  type: 'POST',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  dataType: 'json', 
                  processData: false,  // tell jQuery not to process the data
                  contentType: false ,  // tell jQuery not to set contentType
                  success: function(data) {
                    // console.log(data);
                    if(data[0]['inscierrasolicitud']==0){
                      msjeAlertaPrincipal('','<span>Se ha finalizado con éxito la orden de servicio con el folio: <strong>'+folio+'</strong>. Se ha notificado al usuario mediante el correo electrónico proporcionado.</span>','success')
                      $("#cerrarOrdenModal").modal("hide");
                      fnUpdAcceso(vidSolicServ, false, 1); 
                      load();
                    }else{
                      msjeAlertaPrincipal('','No se cerró la orden','error')
                      // fnUpdAcceso(idSolicServ, false, 1);
                    }
                  }
              });
            }else{
              // console.log('no iniciar');
                //window.location.href = '{{ route("listadoOrdenes") }}';
            }
        });

      }
      
    }
  }

  function fnGuardarCancelacion(){
    var hdIdSolicServ = $("#hdIdSolicServ").val();
    var hdFolio = $("#hdFolio").val();
    var vId_motivo_canc = $("#selMotivoCancela").val();
    var vComentarios= $("#txtComentarios").val();
    var vId_usuario= $("#hdIdUsuarioCancela").val();
    var vDesc_rol_usr= 'admin';
    var hdFolioSol= $("#hdFolioSol").val();
    var hdCorreo= $("#hdCorreo").val();
    var hdNombrecct= $("#hdNombrecct").val();
    var hdSolicitante= $("#hdSolicitante").val();

    if( $("#selMotivoCancela").val() == 0 ){
      msjeAlertaSecundario('', 'Debe seleccionar motivo cancelación', 'error');
    }else{
      Swal.fire({
            title: '',
            text: '¿Está seguro que desea cancelar la orden de servicio?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ab0033',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                  html: '<div class="fa-3x">'+
                          '<span class="input-group" style="display:flex; justify-content:center; padding-left: 0%; padding-top: 15%; font-size: 5rem;" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'+
                          '<p></p>'+
                          '<p>Espere por favor</p>'+
                              
                          '</div>',
                  allowOutsideClick: false,
                  showConfirmButton: false
              });

              $.ajax({
                  url: "{{ route('updEstatusO') }}",
                  data:{idSolicServ : hdIdSolicServ, id_motivo_canc : vId_motivo_canc, comentarios:vComentarios, id_usuario:vId_usuario, desc_rol_usr:vDesc_rol_usr, hdFolioSol : hdFolioSol, hdCorreo : hdCorreo, hdNombrecct : hdNombrecct, hdSolicitante : hdSolicitante,},
                  type: 'POST',
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  dataType: 'json', 
                  success: function(data) {
                    if(data[0]['inscancelasolicitud']==false){
                      msjeAlertaPrincipal('','<span>Se ha cancelado con éxito la orden de servicio con el folio: <strong>'+hdFolio+'</strong>. Se ha notificado al usuario mediante el correo electrónico proporcionado.</span>','success')
                      fnUpdAcceso(idSolicServ, false, 1);
                      load();
                      $("#cancelOrdenModal").modal("hide");
                    }else{
                      fnUpdAcceso(idSolicServ, false, 1);
                      msjeAlertaPrincipal('','No se cancelo','error')
                    }
                    $("#cancelOrdenModal").modal("hide");
                    
                  }
              });
            }else{
              // console.log('no cancelo');
                //window.location.href = '{{ route("listadoOrdenes") }}';
            }
        });
      
    }
  }

  function verTecnicos(idOrden, folio, folioSol, correo,nombrecct,solicitante,desc_estatus, totalEquipos, seguimiento){

    fnValidaRecarga(idOrden);  

    fnValidaAcceso(idOrden).then((data) => {
      // console.info('Response:', data)
      if(data.getvalidaaccesoorden==false){
        fnUpdAcceso(idOrden, true, 1);

        if(totalEquipos != 0){
          $("#idSolModTec").val('');
          $("#folioModTec").val('');
          $("#folioSolModTec").val('');
          $("#correoModTec").val('');
          $("#seguimientoModTec").val(''); 

          $("#btnCancelTec").show();
          $(".detalleTecnicos").hide();
          $("#selTecnicoEncargado").val("0").attr("selected",true);
          $("#selTecnicoEncargado").prop("disabled",false);
          $("#selTecnicosAuxiliares option:selected").prop("selected", false);
          $("#selTecnicosAuxiliares option").remove();
          $("#selTecnicosAuxiliares").prop("disabled",true);
          $("#btnAsignarTecnico").prop("disabled",true);

          $("#asignarTecnicosModal").modal("show");
          $("#idSolModTec").val(idOrden);
          $("#folioModTec").val(folio);
          $("#folioSolModTec").val(folioSol);
          $("#correoModTec").val(correo);
          $("#nombrecctModTec").val(nombrecct);
          $("#solicitanteModTec").val(solicitante); 
          $("#seguimientoModTec").val(seguimiento); 
          
          var EtiquetaInfoOrdenTec='';
          EtiquetaInfoOrdenTec+='FOLIO DE ORDEN: ';
          EtiquetaInfoOrdenTec+=''+folio+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
          EtiquetaInfoOrdenTec+='ESTATUS: '; 
          EtiquetaInfoOrdenTec+=''+desc_estatus+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
          $("#EtiquetaInfoOrdenTec").html(EtiquetaInfoOrdenTec);

          // $("#fecha_inicio_prog").val('');
          var now = new Date();
          now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
          now.setMilliseconds(null);
          now.setSeconds(null);
          $('#fecha_inicio_prog').val(now.toISOString().slice(0, -1));

          // $("#fecha_fin_prog").val('');
          var objDate = new Date($('#fecha_inicio_prog').val());
          var date=addHoursToDate(objDate,-4).toISOString().replace("Z","");
          $('#fecha_fin_prog').val(date);

        }else{
          msjeAlertaPrincipal('','Favor de agregar equipos a la orden de servicio','info');
          fnUpdAcceso(idOrden, false, 1);
        }

      }else{
        console.log('no entro--3');
        msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
      }
      
    });
    
    // if (validaAcces==false){
    //   console.log('entro--2'); 
    //   fnUpdAcceso(idOrden, true, 1);

    //   if(totalEquipos != 0){
    //     $("#idSolModTec").val('');
    //     $("#folioModTec").val('');
    //     $("#folioSolModTec").val('');
    //     $("#correoModTec").val('');
    //     $("#seguimientoModTec").val(''); 

    //     $("#btnCancelTec").show();
    //     $(".detalleTecnicos").hide();
    //     $("#selTecnicoEncargado").val("0").attr("selected",true);
    //     $("#selTecnicosAuxiliares option:selected").prop("selected", false);
    //     $("#selTecnicosAuxiliares option").remove();
    //     $("#selTecnicosAuxiliares").prop("disabled",true);
    //     $("#btnAsignarTecnico").prop("disabled",true);

    //     $("#asignarTecnicosModal").modal("show");
    //     $("#idSolModTec").val(idOrden);
    //     $("#folioModTec").val(folio);
    //     $("#folioSolModTec").val(folioSol);
    //     $("#correoModTec").val(correo);
    //     $("#nombrecctModTec").val(nombrecct);
    //     $("#solicitanteModTec").val(solicitante); 
    //     $("#seguimientoModTec").val(seguimiento); 
        
    //     var EtiquetaInfoOrdenTec='';
    //     EtiquetaInfoOrdenTec+='FOLIO DE ORDEN: ';
    //     EtiquetaInfoOrdenTec+=''+folio+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    //     EtiquetaInfoOrdenTec+='ESTATUS: '; 
    //     EtiquetaInfoOrdenTec+=''+desc_estatus+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    //     $("#EtiquetaInfoOrdenTec").html(EtiquetaInfoOrdenTec);

    //     // $("#fecha_inicio_prog").val('');
    //     var now = new Date();
    //     now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    //     now.setMilliseconds(null);
    //     now.setSeconds(null);
    //     $('#fecha_inicio_prog').val(now.toISOString().slice(0, -1));

    //     // $("#fecha_fin_prog").val('');
    //     var objDate = new Date($('#fecha_inicio_prog').val());
    //     var date=addHoursToDate(objDate,-4).toISOString().replace("Z","");
    //     $('#fecha_fin_prog').val(date);

    //   }else{
    //     msjeAlertaPrincipal('','Favor de agregar equipos a la orden de servicio','info');
    //     fnUpdAcceso(idOrden, false, 1);
    //   }

    // }else{
    //   console.log('no entro--3');
    //   msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
    // }

  }
  // var band=0;
  function fnAgregarTecnicos(){
    
    if($("#selTecnicoEncargado").val()!=0){
       // console.log('asignar tecnico');
      vEncargado=parseInt($("#selTecnicoEncargado").val());
      vEncargadoNombre=$("#selTecnicoEncargado option:selected").text(); 
      
      
      // if(band==0){
      //   tecnicosAuxiliaresArray.unshift({id_tecnico:vEncargado, nombre_tecnico:vEncargadoNombre, es_responsable:1});
      //     console.log(tecnicosAuxiliaresArray);
      //     drawRowTecnico();
      //     $("#btnCancelTec").hide();
      //     $(".detalleTecnicos").show();
      //     $("#selTecnicoEncargado").prop('disabled',true);
      //     band=band+1;
      // }else{
      
        if(tecnicosAuxiliaresArray != ''){
          if(tecnicosAuxiliaresArray[0].id_tecnico==vEncargado){
            console.log('es igual');
          }else{
            // cnsole.log(vEncargadoNombre);
            // tecnicosAuxiliaresArray.unshift({id_tecnico:vEncargado, nombre_tecnico:vEncargadoNombre, es_responsable:1});
            if(tecnicosAuxiliaresArray[0].id_tecnico==0){
              msjeAlertaSecundario('','Debe seleccionar un Técnico Auxiliar','error');
               
              $("#selTecnicoEncargado").val("0").attr("selected",true);
              $("#selTecnicosAuxiliares option:selected").prop("selected", false);
              $("#selTecnicosAuxiliares option").remove();
              $("#selTecnicosAuxiliares").prop("disabled",true);
            }else{
              tecnicosAuxiliaresArray.unshift({id_tecnico:vEncargado, nombre_tecnico:vEncargadoNombre, es_responsable:1, nuevo:0, id_asignacion:0, id_tecnico_orden:0});
              console.log(tecnicosAuxiliaresArray);
              drawRowTecnico();
              $(".detalleTecnicos").show();
              $("#selTecnicoEncargado").prop('disabled',true); 
            }
            
          }
        }
      // }
    }else{
      msjeAlertaSecundario('Debe seleccionar un Técnico Encargado','','error');
    }
   
   
  }

  function fnAsignarTecnicos(){
    var folio=$("#folioModTec").val();
    var folioSol=$("#folioSolModTec").val();
    var correo=$("#correoModTec").val();
    var vselTecnicoEncargado=$("#selTecnicoEncargado").val();
    var seguimiento=$("#seguimientoModTec").val();
    var idSolicServ=$("#idSolModTec").val();

    var formTecnicos = $('#formTecnicos')[0];
    var data2 = new FormData(formTecnicos)
    data2.append('tecnicosAuxiliaresArray', JSON.stringify(tecnicosAuxiliaresArray));
    data2.append('selTecnicoEncargado', vselTecnicoEncargado);
    data2.append('seguimientoModTec', seguimiento);
    // console.log(data2);
    // console.log(tecnicosAuxiliaresArray[0].es_responsable);
    if(tecnicosAuxiliaresArray != ''){
      // console.log('no esta vacio');
      Swal.fire({
          html: '<div class="fa-3x">'+
                  '<span class="input-group" style="display:flex; justify-content:center; padding-left: 0%; padding-top: 15%; font-size: 5rem;" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'+
                  '<p></p>'+
                  '<p>Espere por favor</p>'+
                      
                  '</div>',
          allowOutsideClick: false,
          showConfirmButton: false
      });

      if(tecnicosAuxiliaresArray[0].es_responsable==1){
        $.ajax({
            url: "{{ route('asignarTecnico') }}",
            data:data2,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json', 
            processData: false,  // tell jQuery not to process the data
            contentType: false ,  // tell jQuery not to set contentType
            success: function(data) {
              // console.log('regreso tecnicos de asignar');
              console.log(data[0]['fninstecnicos']);
              if(data[0]['fninstecnicos']==1){
                msjeAlertaPrincipal('','<span>Se han asignado correctamente los Técnicos de Soporte a la orden de servicio con el folio: <strong>'+folio+'</strong>. Se ha notificado al usuario mediante el correo electrónico proporcionado.</span>','success')
                fnUpdAcceso(idSolicServ, false, 1);
                load();
                $("#asignarTecnicosModal").modal("hide");
              }else{
                fnUpdAcceso(idSolicServ, false, 1);
                msjeAlertaPrincipal('','Técnicos no se asignaron','error')
                $("#asignarTecnicosModal").modal("hide");
              }
            }
        });
      }else{
        msjeAlertaSecundario('Tiene que seleccionar un Técnico Encargado','','error');
      }
    }else{
        msjeAlertaSecundario('','Tiene que seleccionar un Técnico Encargado','error');
    }

  }

  function drawRowTecnico(){
    var htmlSel='';
    for (var i = 0; i < tecnicosAuxiliaresArray.length; i++) {
        htmlSel+='<tr_'+i+'><td class="text-xs text-secondary mb-0">'+i+'</td><td class="text-xs text-secondary mb-0">'+tecnicosAuxiliaresArray[i].nombre_tecnico+'</td><td class="text-xs text-secondary mb-0">'; 
        // htmlSel+='<tr><td>'+i+'</td><td>'+tecnicosAuxiliaresArray[i]+'</td><td>';
        if(i==0){
          htmlSel+='<span>Técnico Encargado</span></td>'; 
        }else{
          htmlSel+='<span>Técnico Auxiliar</span></td>'; 
        }
        htmlSel+='<td><button type="button" class="btnEliminar" onclick="removeTecnico('+i+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>'
        htmlSel+='</tr>';
    }
    $("#btnCancelTec").hide();
    $("#tbTecnicos").html(htmlSel);
  }

  function removeTecnico( item ) {
    if(tecnicosAuxiliaresArray.includes(item) ==false){ 
      if ( item !== -1 ) {
        //////////////Edit Tecnicos 28_08_2023
        if (tecnicosAuxiliaresArray[item].nuevo==1){ //Si viene de BD se mete en un arreglo temporal ya que estos se eliminaran de bd
          arrTecnicosElim.push({
              id_tenico_orden : tecnicosAuxiliaresArray[item].id_tenico_orden, 
              id_tecnico : tecnicosAuxiliaresArray[item].id_tecnico, 
              id_asignacion : tecnicosAuxiliaresArray[item].id_asignacion, 
          });
          // console.log(tecnicosAuxiliaresArray);
        }//////////////Edit Tecnicos 28_08_2023

        tecnicosAuxiliaresArray.splice( item, 1 );
        
        $("#tr_"+item).remove();
        if(tecnicosAuxiliaresArray==''){
          $(".detalleTecnicos").hide();
          $("#selTecnicoEncargado").val("0").attr("selected",true);
          $("#selTecnicosAuxiliares option:selected").prop("selected", false);
          $("#selTecnicosAuxiliares option").remove();
          $("#selTecnicosAuxiliares").prop("disabled",true);
          $("#btnAsignarTecnico").prop("disabled",true);
          $("#selTecnicoEncargado").prop('disabled',false);
          $("#btnCancelTec").show(); 
        }else{
          drawRowTecnico();
        }
        // drawRowTecnico();
      } else{
        tecnicosAuxiliaresArray = [];
        f=0;
        // listaServicio='';
        $("#tbTecnicos").html('');
        $("#tbTecnicos").empty();
      }
    }else{
      console.log('No existe en el arreglo');
      f=0;
      // listaServicio='';
      $("#tbTecnicos").html('');
      $("#tbTecnicos").empty();
    }
  }

  function fnEditar(idOrden){ 
    // fnValidaRecarga(idOrden); 

    fnValidaAcceso(idOrden).then((data) => {

         console.info('Response:', data);
      if(data.getvalidaaccesoorden==false){
        var hh=fnUpdAcceso(idOrden, true, 1);
        // console.log(hh);
        let urlEditar = '{{ route("editarOrden", ":id") }}';
        urlEditar = urlEditar.replace(':id', idOrden);

        window.location = urlEditar;  
      }else{
        msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
      }

    });
  }

  function fnCerrarOrden(idOrden,idEstatusOrden, folio, folioSol, correo,nombrecct,solicitante, desc_estatus, totalEquipos, totalEquiposCerrados,bandVer){
    fnValidaRecarga(idOrden); 
    // bandVer  0== Cerrar    ///bandVer  1== Ver Detalle
    fnValidaAcceso(idOrden).then((data) => { 
      // console.info('Response:', data)
      if(data.getvalidaaccesoorden==false){ 
        fnUpdAcceso(idOrden, true, 1);
      // if (totalEquipos > 0){  //// quiere decir que si tiene equipos
        if (totalEquipos > 0 && totalEquipos == totalEquiposCerrados){  // 
          $(".bandVer").hide();

          if(bandVer==0){
            $(".bandVer").show();
            fnUpdAcceso(idOrden, true, 1);
          }else{
            $(".bandVer").hide();
            fnUpdAcceso(idOrden, false, 1);
          }

          $("#hdIdOrdenCierra").val("");
          $("#hdIdEstatusCierra").val("");
          $("#hdFolioCierra").val(""); 
          $("#archivoCierre").val(""); 
          $("#hdFolioSolCierra").val(""); 
          $("#correoCierre").val(""); 
          $("#nombrecctCierre").val(""); 
          $("#solicitanteCierre").val(""); 

          $("#cerrarOrdenModal").modal("show");

          $("#hdIdOrdenCierra").val(idOrden);
          $("#hdIdEstatusCierra").val(idEstatusOrden);
          $("#hdFolioCierra").val(folio);
          $("#hdFolioSolCierra").val(folioSol); 
          $("#correoCierre").val(correo); 
          $("#nombrecctCierre").val(nombrecct); 
          $("#solicitanteCierre").val(solicitante); 

          var EtiquetaInfoOrdenCerr='';
          EtiquetaInfoOrdenCerr+='FOLIO DE ORDEN: ';
          EtiquetaInfoOrdenCerr+=''+folio+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
          EtiquetaInfoOrdenCerr+='ESTATUS: '; 
          EtiquetaInfoOrdenCerr+=''+desc_estatus+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
          $("#EtiquetaInfoOrdenCerr").html(EtiquetaInfoOrdenCerr);

          let urlEditar = '{{ route("verDetalleOrden", ":id") }}';
          urlEditar = urlEditar.replace(':id', idOrden);
          
          $.ajax({
            url: urlEditar,
            type: 'GET',
            dataType: 'json', // added data type
            success: function(data) {
              // console.log(data);
              //Datos Centro de Trabajo-------------------------------------------------------------------------
              $("#lblNombreCTT").text(data[0].nombrect);
              $("#lblClaveCTT").text(data[0].clave_ct);
              $("#lblMunicipio").text(data[0].municipio);
              $("#lblDirector").text(data[0].director);
              $("#lblDireccion").text(data[0].domicilio);
              $("#lblCoordinacion").text(data[0].coordinacion);
              $("#lblTelefono").text(data[0].telefono);
              $("#lblTurno").text(data[0].turno);
              $("#lblNivel").text(data[0].nivel);
              //Datos Reporte-------------------------------------------------------------------------
              $("#lblTipoOrden").text(data[0].desc_tipo_orden);
              $("#lblAreaAtiende").text(data[0].area_atiende);
              // console.log(data[0].area_atiende);
              $("#lblSolicitante").text(data[0].solicitante);
              $("#lblSolicitanteTel").text(data[0].telef_solicitante);
              $("#lblSolicitanteCorr").text(data[0].correo_solic);
              $("#lblDescReporte").text(data[0].descrip_reporte);

              //Datos Tecnicos-------------------------------------------------------------------------
              // console.log(data[0].jtecnicos);   //data[0][i].id_tarea
              if(data[0].jtecnicos != null){
                var coche = JSON.parse(data[0].jtecnicos);
                // console.log(coche);  ////////regresa json CACHAR JSON QUE REGRESA FUNCION
                var vtecniA='';
                var vtecniE='';
                for (var i = 0; i < coche.length; i++) {
                  if(coche[i].es_responsable==0){
                    if(vtecniA==''){
                      vtecniA=coche[i].nombre; 
                    }else{
                      vtecniA=vtecniA+', '+coche[i].nombre; 
                    }
                  }else{
                    vtecniE=coche[i].nombre; 
                  }
                }
                
                $("#lblTecAux").html(vtecniA);
                $("#lblTecEnc").html(vtecniE);
              }else{
                $("#lblTecAux").html('');
                $("#lblTecEnc").html('');
              }

              var htmlSel='';
              htmlSel+='<table style="border:none; width:100%;">';
              htmlSel+='<tr>'; 
              htmlSel+='<td class="text-center"><label>#</label></td>'; 
              htmlSel+='<td><label>Equipo/Servicio</label></td>';
              htmlSel+='<td class="text-center"><label>Estatus</label></td>';
              htmlSel+='<td class="text-center"><label>Etiqueta</label></td>';
              htmlSel+='<td class="text-center"><label>Detalle</label></td>';
              htmlSel+='<td class="text-center"><label>Evidencia</label></td>';
              htmlSel+='</tr>';

              //Datos Equipos-------------------------------------------------------------------------
              if(data[0].jequipos != null){
                var vequip = JSON.parse(data[0].jequipos);
                console.log(vequip);  ////////regresa json CACHAR JSON QUE REGRESA FUNCION
                // var htmlSel='';
                // var vtecniA='';
                // var vtecniE='';
                var vubicacion ='';
                var vsolucion ='';

                for (var i = 0; i < vequip.length; i++) {

                  if(vequip[i].etiqueta=='' || vequip[i].etiqueta==null){
                    vetiqueta='S/D';
                  }else{
                    vetiqueta=vequip[i].etiqueta;
                  }

                  if(vequip[i].ubicacion=='' || vequip[i].ubicacion==null){
                    vubicacion='S/D';
                  }else{
                    vubicacion=vequip[i].ubicacion;
                  }

                  if(vequip[i].diagnostico=='' || vequip[i].diagnostico==null){
                    vdiagnostico='S/D';
                  }else{
                    vdiagnostico=vequip[i].diagnostico;
                  }

                  if(vequip[i].solucion=='' || vequip[i].solucion==null){
                    vsolucion='S/D';
                  }else{
                    vsolucion=vequip[i].solucion;
                  }
                  
                  var vtareas=vequip[i].tareas;
                  var cadenaTareas='';
                  var cadenaServicios='';
                  var auxSe='';
                  for (var j = 0; j < vtareas.length; j++) {
                      // console.log(vtareas[j].tarea);
                    cadenaTareas += vtareas[j].tarea + ', ';

                    if(auxSe != vtareas[j].servicio){
                      auxSe=vtareas[j].servicio;
                      if(cadenaServicios==''){
                        cadenaServicios = auxSe;
                      }else{
                        cadenaServicios = cadenaServicios+', '+auxSe;
                      }
                      
                    }
                    // cadenaServicios += vtareas[j].servicio+ ', '; // checar que si es el mismo servicio que solo lo ponga una vez
                  } 

                  var vMarcaa='S/D';
                  var vModeloo='S/D';
                  var vNumSeriee='S/D'; 

                  // console.log(vequip[i].id_equipo_tarea);
                  // htmlSel+='<table style="border:none; width:100%;">';
                  // htmlSel+='<tr style="border:1px solid; background-color:#54565a;">';

                  var contI=i+1;
                  htmlSel+='<tr>';
                  htmlSel+='<td style="text-align:center;"><label>'+contI+'</label></td>'; //style="color:#FFFFFF !important;"
                  htmlSel+='<td><label class="SinNegrita" id="lblEquipo">'+vequip[i].tipo_equipo+'</label></td>';
                  htmlSel+='<td style="text-align:center;"><label class="SinNegrita" id="lblEsta">Atendido</label></td>';
                  
                  if(vequip[i].id_tipo_equipo != 1){ 
                    htmlSel+='<td style="text-align:center;"><label class="SinNegrita" id="lblEquipo">'+vetiqueta+'</label></td>';
                    htmlSel+='<td style="text-align:center;"><label class="SinNegrita" id="lblMarca">'+vMarcaa+', '+vModeloo+', '+vNumSeriee+'</label></td>';
                  }else{ 
                    htmlSel+='<td style="text-align:center;"><label class="SinNegrita">S/D</label></td>';
                    htmlSel+='<td style="text-align:center;"><label class="SinNegrita">S/D</label></td>'; 
                  }
                  htmlSel+='<td style="text-align:center;">';

                  var videquipserv= vequip[i].id; 
                  let urlDet = '{{ route("equipoAtendido", ":videquipserv") }}';
                  urlDet = urlDet.replace(':videquipserv', videquipserv);
                  
                  // htmlSel+='<a href="'+urlDet+'" target="_blank"><i class="fas fa-file-pdf" style="color:white;"></i>&nbsp;&nbsp;</a>';
                  htmlSel+='<a href="" onclick="fnVerDetalleEquipoCerrado('+videquipserv+')"><i class="fas fa-eye" ></i>&nbsp;&nbsp;</a>';
                  // if(bandVer==1){
                  //   if(vequip[i].nombre_archivo != null && vequip[i].nombre_archivo != ''){
                  //     var nombre= vequip[i].nombre_archivo; 
                  //     let urlArchivo = '{{ asset("public/cierreEquipo/:nomVar") }}';
                  //     // let urlArchivo = '{{ asset("cierreEquipo/:nomVar") }}'; //////31/08/2023  //LOCAL
                  //     urlArchivo = urlArchivo.replace(':nomVar', nombre); 

                  //     htmlSel+='<a href="'+urlArchivo+'" target="_blank"><i class="fas fa-file-pdf"></i>&nbsp;&nbsp;</a>';
                  //   }
                  // }
                  
                  htmlSel+='</td>';
                  // htmlSel+='<td><label>Marca:</label><label class="SinNegrita" id="lblMarca">'+vMarcaa+'</label></td>';
                  // htmlSel+='<td><label>Modelo:</label><label class="SinNegrita" id="lblModelo">'+vModeloo+'</label></td>';
                  // htmlSel+='<td><label>Número de Serie:</label><label class="SinNegrita" id="lblSerie">'+vNumSeriee+'</label></td>';
                  htmlSel+='</tr>';
                  // htmlSel+='<tr>';
                  // htmlSel+='<td colspan="4">'; 
                  // htmlSel+='<label>Ubicación:</label><label class="SinNegrita" id="lblUbic">'+vubicacion+'</label><br>';
                  // htmlSel+='<label>Descripción del problema:</label><label class="SinNegrita" id="lblDescProblema">'+vequip[i].desc_problema+'</label><br>';
                  // htmlSel+='<label>Listado de Áreas de Servicio/Tareas:</label><br>';
                  
                  // htmlSel+='<table>'+
                  //   '<thead>'+
                  //     '<th><label class="SinNegrita">Área de Servicio</label></th>'+
                  //     '<th><label class="SinNegrita">Tarea</label></th>'+
                  //   '</thead>'+
                  //   '<tbody>';
                  //   for (var j = 0; j < vtareas.length; j++) {
                  //     htmlSel+='<tr>';
                  //     htmlSel+='<td><label class="SinNegrita">'+vtareas[j].servicio+'</label></td>';
                  //     htmlSel+='<td><label class="SinNegrita">'+vtareas[j].tarea+'</label></td>'; 
                  //     htmlSel+='</td>';
                  //   } 
                  //   htmlSel+='</tbody>'+
                  // '</table>';

                  // htmlSel+='<label>Diagnóstico:</label><label class="SinNegrita" id="lblSolucionDiag">'+vdiagnostico+'</label><br>';
                  // htmlSel+='<label>Solución:</label><label class="SinNegrita" id="lblSolucionDiag">'+vsolucion+'</label><br>';
                  // htmlSel+='</td>';
                  // htmlSel+='</tr>';
                }
                htmlSel+='</table>';
                htmlSel+='<br>';
                
                $("#divEquiposRealizados").html(htmlSel);
              }else{
                $("#divEquiposRealizados").html('');
              }

              if(bandVer==1){
                if(data[0].jcierre_det_orden != null){
                  
                  var det_cierre = JSON.parse(data[0].jcierre_det_orden);
                  
                  var links_html='';

                  for (var i = 0; i < det_cierre.length; i++) {
                    var nomCierre=det_cierre[i].nombre_archivo; 
                    
                    let urlArchivoC = '{{ asset("public/cierreOrden/:nomVarC") }}'; //////31/08/2023  //LOCAL
                    urlArchivoC = urlArchivoC.replace(':nomVarC', nomCierre);

                    links_html+='<a href="'+urlArchivoC+'" target="_blank"><i class="fas fa-image" style="color:#ab0033 !important;font-size:3em;"></i>&nbsp; </a>';
                  }

                  $("#divImgCierreOrden").html(links_html);
                  $(".bandVer2").show();
                }else{
                  $("#divImgCierreOrden").html('');
                  $(".bandVer2").hide();
                }
              }else{
                $(".bandVer2").hide();
              }

            }
          });
        }else if(totalEquipos==0){
          fnUpdAcceso(idOrden, false, 1);
          msjeAlertaPrincipal('','Favor de agregar equipos a la orden de servicio','info');
          // $("#cerrarOrdenModal").modal("hide");
        }else{
          fnUpdAcceso(idOrden, false, 1);
          msjeAlertaSecundario('','No puede finalizar la orden porque hay equipos sin finalizar','error');
          // $("#cerrarOrdenModal").modal("hide");
        }

      }else{
        msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
      }
    });
  } 

  function fnCancelarModTecnicos(){
    tecnicosAuxiliaresArray=[];
    $("#selTecnicoEncargado option[value='0']").attr("selected",true);

    $("#selTecnicosAuxiliares option[value='0']").attr("selected",true);
    $("#selTecnicosAuxiliares").prop('disabled', true);

    var idSolServ = $("#idSolModTec").val();
    fnUpdAcceso(idSolServ, false, 1);

    $("#idSolModTec").val('');
    $("#tbTecnicos").html('');
  }

  function fnCancelarModTecnicosE(){
    tecnicosAuxiliaresArrayE=[];
    $("#selTecnicoEncargadoE option[value='0']").attr("selected",true);

    $("#selTecnicosAuxiliaresE option[value='0']").attr("selected",true);
    $("#selTecnicosAuxiliaresE").prop('disabled', true);

    var idSolServ = $("#idSolModTecE").val();
    fnUpdAcceso(idSolServ, false, 1);

    $("#idSolModTecE").val('');
    $("#tbTecnicosE").html('');
  }
  //////////////////Editar Tecnicos 
  function editTecnicos(idOrden, folio, folioSol, correo,nombrecct,solicitante,desc_estatus, totalEquipos){
    fnConsTecnicos(idOrden); 

    $("#idSolModTecE").val('');
    $("#folioModTecE").val('');
    $("#folioSolModTecE").val('');
    $("#correoModTecE").val('');

    $("#btnCancelTecE").show();
    $(".detalleTecnicosE").hide();
    $("#selTecnicoEncargadoE").val("0").attr("selected",true);
    $("#selTecnicosAuxiliaresE option:selected").prop("selected", false);
    $("#selTecnicosAuxiliaresE option").remove();
    // $("#selTecnicosAuxiliaresE").prop("disabled",true);
    $("#btnAsignarTecnicoE").prop("disabled",true);

    $("#editarTecnicosModal").modal("show");
    $("#idSolModTecE").val(idOrden);
    $("#folioModTecE").val(folio);
    $("#folioSolModTecE").val(folioSol);
    $("#correoModTecE").val(correo);
    $("#nombrecctModTecE").val(nombrecct);
    $("#solicitanteModTecE").val(solicitante); 
    // console.log(solicitante);

    var EtiquetaInfoOrdenTecE='';
    EtiquetaInfoOrdenTecE+='FOLIO DE ORDEN: ';
    EtiquetaInfoOrdenTecE+=''+folio+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    EtiquetaInfoOrdenTecE+='ESTATUS: '; 
    EtiquetaInfoOrdenTecE+=''+desc_estatus+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    $("#EtiquetaInfoOrdenTecE").html(EtiquetaInfoOrdenTecE);
  }

  function fnAgregarTecnicosE(){
    
    if($("#selTecnicoEncargadoE").val()!=0){
       // console.log('asignar tecnico');
      vEncargado=parseInt($("#selTecnicoEncargadoE").val());
      vEncargadoNombre=$("#selTecnicoEncargadoE option:selected").text(); 
      // console.log('1');
        if(tecnicosAuxiliaresArrayE != ''){
          if(tecnicosAuxiliaresArrayE[0].id_tecnico==vEncargado){
            // console.log('es igual');
            drawRowTecnicoE();
            $(".detalleTecnicosE").show();
            $("#selTecnicoEncargadoE").prop('disabled',true);
            // console.log(tecnicosAuxiliaresArrayE);
          }else{
            tecnicosAuxiliaresArrayE.unshift({id_tecnico:vEncargado, nombre_tecnico:vEncargadoNombre, es_responsable:1, nuevo:0, id_asignacion:0, id_tecnico_orden:0});
            // console.log(tecnicosAuxiliaresArrayE);
            drawRowTecnicoE();
            $(".detalleTecnicosE").show();
            $("#selTecnicoEncargadoE").prop('disabled',true);
            // console.log('2');
          }
          // console.log('3');
        }else{ ///cuando eliminan todos hasta el encargado y vuelven a agregarlos
          tecnicosAuxiliaresArrayE.unshift({id_tecnico:vEncargado, nombre_tecnico:vEncargadoNombre, es_responsable:1, nuevo:0, id_asignacion:0, id_tecnico_orden:0});
            // console.log(tecnicosAuxiliaresArrayE);
            drawRowTecnicoE();
            $(".detalleTecnicosE").show();
            $("#selTecnicoEncargadoE").prop('disabled',true);
            // console.log('4');
        }
    }else{
      msjeAlertaSecundario('Debe seleccionar un Técnico Encargado','','error');
    }
  }

  function fnAsignarTecnicosE(){
    var folio=$("#folioModTecE").val();
    var folioSol=$("#folioSolModTecE").val();
    var correo=$("#correoModTecE").val();;

    var formEditarTecnicos = $('#formEditarTecnicos')[0];
    var data2 = new FormData(formEditarTecnicos)
     data2.append('tecnicosAuxiliaresArrayE', JSON.stringify(tecnicosAuxiliaresArrayE))
     data2.append('arrTecnicosElim', JSON.stringify(arrTecnicosElim))
    // console.log(data2);
    // console.log(tecnicosAuxiliaresArrayE[0].es_responsable);
    if(tecnicosAuxiliaresArrayE != ''){
      // console.log('no esta vacio');
      Swal.fire({
          html: '<div class="fa-3x">'+
                  '<span class="input-group" style="display:flex; justify-content:center; padding-left: 0%; padding-top: 15%; font-size: 5rem;" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'+
                  '<p></p>'+
                  '<p>Espere por favor</p>'+
                  '</div>',
          allowOutsideClick: false,
          showConfirmButton: false
      });

      if(tecnicosAuxiliaresArrayE[0].es_responsable==1){
        $.ajax({
            url: "{{ route('actualizarTecnicos') }}",
            data:data2,
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json', 
            processData: false,  // tell jQuery not to process the data
            contentType: false ,  // tell jQuery not to set contentType
            success: function(data) {
              // console.log('regreso tecnicos de asignar');
              if(data[0]['updtecnicos']==1){
                msjeAlertaPrincipal('','<span>Se han editado correctamente los Técnicos de Soporte a la orden de servicio con el folio: <strong>'+folio+'</strong>. Se ha notificado al usuario mediante el correo electrónico proporcionado.</span>','success')
                load();
                $("#editarTecnicosModal").modal("hide");
              }else{
                msjeAlertaPrincipal('','Técnicos no se editaron','error')
                $("#editarTecnicosModal").modal("hide");
              }
            }
        });
      }else{
        msjeAlertaSecundario('','Tiene que seleccionar un Técnico Encargado','error');
      }
    }else{
        msjeAlertaSecundario('','Tiene que seleccionar un Técnico Encargado','error');
    }

  }

  function drawRowTecnicoE(){
    var htmlSel='';
    for (var i = 0; i < tecnicosAuxiliaresArrayE.length; i++) {
        htmlSel+='<tr_'+i+'><td class="text-xs text-secondary mb-0">'+i+'</td><td class="text-xs text-secondary mb-0">'+tecnicosAuxiliaresArrayE[i].nombre_tecnico+'</td><td class="text-xs text-secondary mb-0">'; 
        // htmlSel+='<tr><td>'+i+'</td><td>'+tecnicosAuxiliaresArrayE[i]+'</td><td>';
        if(i==0){
          htmlSel+='<span>Técnico Encargado</span></td>'; 
        }else{
          htmlSel+='<span>Técnico Auxiliar</span></td>'; 
        }
        htmlSel+='<td><button type="button" class="btnEliminar" onclick="removeTecnicoE('+i+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>'
        htmlSel+='</tr>';
    }
    $("#btnCancelTecE").hide();
    $("#tbTecnicosE").html(htmlSel);
  }

  function removeTecnicoE( item ) {
    if(tecnicosAuxiliaresArrayE.includes(item) ==false){ 
      if ( item !== -1 ) {
        //////////////Edit Tecnicos 28_08_2023
        if (tecnicosAuxiliaresArrayE[item].nuevo==1){ //Si viene de BD se mete en un arreglo temporal ya que estos se eliminaran de bd
          arrTecnicosElim.push({
              id_tecnico_orden : tecnicosAuxiliaresArrayE[item].id_tecnico_orden, 
              id_tecnico : tecnicosAuxiliaresArrayE[item].id_tecnico, 
              id_asignacion : tecnicosAuxiliaresArrayE[item].id_asignacion, 
          });
          console.log(tecnicosAuxiliaresArrayE);
        }//////////////Edit Tecnicos 28_08_2023

        tecnicosAuxiliaresArrayE.splice( item, 1 );
        
        $("#tr_"+item).remove();
        if(tecnicosAuxiliaresArrayE==''){
          $(".detalleTecnicosE").hide();
          $("#selTecnicoEncargadoE").val("0").attr("selected",true);
          $("#selTecnicosAuxiliaresE option:selected").prop("selected", false);
          $("#selTecnicosAuxiliaresE option").remove();
          $("#selTecnicosAuxiliaresE").prop("disabled",true);
          $("#btnAsignarTecnicoE").prop("disabled",true);
          $("#selTecnicoEncargadoE").prop('disabled',false);
          $("#btnCancelTecE").show();
        }
        drawRowTecnicoE();
      } else{
        tecnicosAuxiliaresArrayE = [];
        f=0;
        // listaServicio='';
        $("#tbTecnicosE").html('');
        $("#tbTecnicosE").empty();
      }
    }else{
      console.log('No existe en el arreglo');
      f=0;
      // listaServicio='';
      $("#tbTecnicosE").html('');
      $("#tbTecnicosE").empty();
    }
  }

  function addHoursToDate(objDate, intHours) {
      var numberOfMlSeconds = objDate.getTime();
      var addMlSeconds = (intHours * 60)* 60000;
      var newDateObj = new Date(numberOfMlSeconds + addMlSeconds);
      return newDateObj;
  }

  function fnConsTecnicos(idSolic){
    let urlEditar = '{{ route("consTecnicos", ":idSolic") }}';
    urlEditar = urlEditar.replace(':idSolic', idSolic);
    tecnicosAuxiliaresArrayE = [];//Limpiar Array
    $.ajax({
      url: urlEditar, 
      type: 'GET',
      dataType: 'json', 
      success: function(data) {
        console.log(data); 
        
          //  console.log(data[0][0].arrequipos);   //data[0][i].id_tarea
           var arTecnicosE = JSON.parse(data[0].jtecnicos);
          //  console.log(arTecnicosE);  ////////regresa json CACHAR JSON QUE REGRESA FUNCION
          
          if(data[0] !='' || data[0] !=null || data[0].length!=0){
            // console.log(data[0]); 
            $("#hdIdAsignaE").val(data[0].id_asigna);
            $("#fecha_inicio_progE").val(data[0].fecha_inicio_programada);
            $("#fecha_fin_progE").val(data[0].fecha_fin_programada);
            // console.log(data[0].fecha_inicio_programada,' - ',data[0].fecha_fin_programada)
            // var 
            $.each(arTecnicosE, function(i, val){
              if (!jQuery.isEmptyObject(arTecnicosE[i])) {
                // console.log(arTecnicosE[i].id_tecnico_orden,arTecnicosE[i].id_tecnico, arTecnicosE[i].es_responsable);
                tecnicosAuxiliaresArrayE.push({
                  con : i,
                  id_tecnico_orden : arTecnicosE[i].id_tecnico_orden,
                  id_tecnico : arTecnicosE[i].id_tecnico,
                  id_asignacion : arTecnicosE[i].id_asignacion,
                  es_responsable : arTecnicosE[i].es_responsable,
                  nombre_tecnico:arTecnicosE[i].nombre_tecnico,
                  nuevo : 1
                });
              }
            });
            $("#selTecnicoEncargadoE").val(arTecnicosE[0].id_tecnico).attr("selected",true);
            $("#selTecnicoEncargadoE").prop('disabled',true);
            $("#selTecnicosAuxiliaresE").prop('disabled',false);
            drawRowTecnicoE();
            var vEncargadoE=$("#selTecnicoEncargadoE").val();
            if( vEncargadoE != 0 ){
              let urlEditar = '{{ route("cargarTecAux", ":id") }}';
              urlEditar = urlEditar.replace(':id', vEncargadoE);
              
              $.ajax({
                url: urlEditar,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(data) {
                    // console.log(data);
                    var htmlSel='<option value="0">Seleccionar técnico(s) auxiliar(es)</option>';

                    for (var i = 0; i < data.length; i++) {
                        htmlSel+='<option value="'+data[i].id_tecnico+'" data-tec="'+data[i].nombre_tecnico+'">'+data[i].nombre_tecnico+'</option>'; 
                    }
      
                    $("#selTecnicosAuxiliaresE").html(htmlSel);
                    $("#selTecnicosAuxiliaresE").prop('disabled', false);
                }
              });

              // for (var j = 0; j < tecnicosAuxiliaresArrayE.length; j++) {  ////////Aida
              //   if(data[i].id_tecnico==tecnicosAuxiliaresArrayE[j].id_tecnico){  //tecnicosAuxiliaresArrayE
              //     htmlSel+='<option selected value="'+data[i].id_tecnico+'" data-tec="'+data[i].nombre_tecnico+'">'+data[i].nombre_tecnico+'</option>'; 
              //   }else{
              //     htmlSel+='<option value="'+data[i].id_tecnico+'" data-tec="'+data[i].nombre_tecnico+'">'+data[i].nombre_tecnico+'</option>'; 
              //   }
              // }

              $("#selTecnicosAuxiliaresE").prop('disabled', false);
              $("#btnAsignarTecnicoE").prop('disabled', false);
            }else{
              $("#btnAsignarTecnicoE").prop('disabled', true);
              $("#selTecnicosAuxiliaresE").prop('disabled', true);
              msjeAlertaSecundario('','Favor de seleccionar el Técnico Encargado','error');

              tecnicosAuxiliaresArrayE = [];
              $("#tbTecnicosE").html('');
              $("#tbTecnicosE").empty();
            }

            $(".detalleTecnicosE").show();
          }else{
              
          }
      }
    });
  }

  function Validar_Array(valor, valor2, arr) {
      var b=false;
      for (var i = 0; i < arr.length; i++) {
          if(valor==arr[i].id_tarea && valor2==arr[i].id_servicio){
              b = true;
              break;
          }
      }
      return b;
  }
  
  function verArchivosOrden(idSolicServ){
    let urlEditar = '{{ route("verImagenesCierre", ":id") }}';
    urlEditar = urlEditar.replace(':id', idSolicServ);
    
    $.ajax({
        url: urlEditar,
        type: 'GET',
        dataType: 'json', 
        success: function(data) {
          console.log(data);  
          // var nombre="64cd883de4cd1_78.jpg";
          var html='';
          $.each(data, function(j, val){
            if (!jQuery.isEmptyObject(data[j])) {

              var nombre= data[j].nombre_archivo; 
              let urlArchivo = '{{ asset("public/cierreOrden/:id") }}'; //////31/08/2023  //DEV
              // let urlArchivo = '{{ asset("cierreOrden/:id") }}'; //////31/08/2023  //LOCAL
               urlArchivo = urlArchivo.replace(':id', nombre); 

              html+='<a href="'+urlArchivo+'" target="_blank"><img id="archivo_'+j+'" src="'+urlArchivo+'" /></a>';
              // $("#divArchivosCierre").html(html);
              // $(location).attr('href',urlArchivo);
              // window.open(urlArchivo, '_blank');
            }
          });
          $("#divArchivosCierreOrden").html(html);
          $("#verArchivosOrdenModal").modal("show");
        }
    });

  }

  async function fnValidaAcceso(idSolicServ) {
    const result = await $.ajax({
      url: '{{ route("validaAcceso") }}',
      data:{idSolicServ : idSolicServ},
      type: 'POST',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: 'json', 
      success: function(data) {
        // console.log(data);
        if (!data.getvalidaaccesoorden) {
          return false;
        }else{
          return true;
        }
        // acceso = data.getvalidaaccesoorden;
      }
    });
    return result
  }

  function fnVerDetalleEquipoCerrado(idEquipo){

    // console.log(id);
    let urlEditar = '{{ route("equipoAtendido", ":id") }}';
    urlEditar = urlEditar.replace(':id', idEquipo);
    
    $.ajax({
        url: urlEditar,
        type: 'GET',
        dataType: 'json', 
        success: function(data) {
          // console.log(data);  
          var etiquetaM='';
          var ubicacionM='';

          $("#lblEquipoM").text(data.tipo_equipo);
          $("#lblEstatusM").text('Atendido');

          if(data.etiqueta==null || data.etiqueta==''){
            etiquetaM='S/D';
          }else{
            etiquetaM=data.etiqueta;
          }

          if(data.ubicacion==null || data.ubicacion==''){
            ubicacionM='S/D';
          }else{
            ubicacionM=data.ubicacion;
          }

          if(data.id_tipo_equipo==1){ //Servicio / Asesoría
            $("#divDetalleEquipoM").hide();
          }else{
            $("#divDetalleEquipoM").show();
          }

          $("#lblEtiquetaM").text(etiquetaM);
          $("#lblDetalleM").text('S/D');
          $("#lblUbicacionM").text(ubicacionM); 
          $("#lblDescProblemaM").text(data.desc_problema);
          $("#lblDiagnosticoM").text(data.diagnostico);
          $("#lblSolucionM").text(data.solucion);

          if(data.jtareas != null){
            var jtareasE = JSON.parse(data.jtareas);
            var htmlTareas='';

            htmlTareas+='<table>';
                htmlTareas+='<thead>';
                htmlTareas+='<th><label class="SinNegrita">Área de Servicio</label></th>';
                htmlTareas+='<th><label class="SinNegrita">Tarea</label></th>';
                htmlTareas+='</thead>';
                htmlTareas+='<tbody>';
            var auxdd='';
            $.each(jtareasE, function(j, val){
              if (!jQuery.isEmptyObject(jtareasE[j])) {

                htmlTareas+='<tr>';
                if(auxdd==jtareasE[j].servicio){ 
                  htmlTareas+='<td>&nbsp;</td>';
                }else{
                  auxdd=jtareasE[j].servicio;
                  htmlTareas+='<td><label class="SinNegrita">'+jtareasE[j].servicio+'&nbsp;</label></td>';
                }
                htmlTareas+='<td>';
                htmlTareas+='<label class="SinNegrita">'+jtareasE[j].tarea+'</label>';
                htmlTareas+='</td>';
                htmlTareas+='</tr>';
              }
            });

            htmlTareas+='</tbody>';
            htmlTareas+='</table>';
            $('#divListTareasServEquipoM').html(htmlTareas);
          }
          var htmlEviden='';
          var urlArchivo='';
          var nomArch='';
          nomArch=data.nombre_archivo;

          if(nomArch==null || nomArch==''){
            htmlEviden='';
          }else{ 
            let urlArchivo = '{{ asset("public/cierreEquipo/:nomVarE") }}';
            // let urlArchivo = '{{ asset("cierreEquipo/:nomVarE") }}'; //////31/08/2023  //LOCAL
            urlArchivo = urlArchivo.replace(':nomVarE', nomArch); 
            htmlEviden+='<img src="'+urlArchivo+'" style="width:100%; heigth:100%;"/>';
          }
          $('#divEvidenciaEquipo').html(htmlEviden);

          $('#verDetEquipoAtendidoModal').modal('show');
        }
    });
  
  }

  function fnUpdAcceso(idSolicServ, valida, band){ 
    // var acceso=false;
    $.ajax({ 
      url: '{{ route("actualizaAcceso") }}',
        data:{idSolicServ : idSolicServ, valida : valida},
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'json', 
        success: function(data) {
          if(band==0){
            // return  data.updAccesoOrden;
            window.location.href  = '{{ route("listadoOrdenes") }}';
          }
        }
    });
  }

  function fnValidaRecarga(idSolicServ){
    bandListado=0; ///0 es que va a listadoOrdenes
    $(window).on('beforeunload', function (){
      //this will work only for Chrome
      fnUpdAcceso(idSolicServ, false, bandListado);  
    });
    var refreshIntervalId  = setInterval(('fnUpdAcceso('+idSolicServ+',false,'+bandListado+')'), 300000); // 
    // clearInterval(refreshIntervalId);
    // console.log(refreshIntervalId);
    setTimeout(() => clearInterval(refreshIntervalId), 300000); //300000
  } 

  function fnMateriales(idSolicServ){
    // fnValidaRecarga(idSolicServ); 
    // // bandVer  0== Cerrar    ///bandVer  1== Ver Detalle
    // fnValidaAcceso(idSolicServ).then((data) => { 

    //   if(data.getvalidaaccesoorden==false){ 
    //     fnUpdAcceso(idSolicServ, true, 1);

        let urlMat = '{{ route("index_materiales", ":id") }}';
        urlMat = urlMat.replace(':id', idSolicServ);

        window.location.href = urlMat;  
        // window.open(urlMat); 
    //   }else{ 
    //     msjeAlertaPrincipal('', '<span>La orden esta siendo utilizada por otro usuario. <br> Favor de verificar.</span>', 'warning');
    //   }
    // });
  }

  $(document).ready(function () {
    load();

    $('.selectpicker').attr('disabled',false); //JC
    $('.selectpicker').selectpicker('refresh');  //JC

    // $("#btnFiltrar").show();
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
    $(".detalleTecnicos").hide();

    $("#btnFiltros").click(function(){
      // $("#pnFiltros").toggle("slow");
      $('#estatus_selec_id option[value="0"]').attr("selected", true);
      $('#observaciones').val('');
      $("#cancelRevisionModal").modal("hide");
      $("#exampleModal").modal("hide");
    });

    $("#btnLimpiarFiltro").click(function(){
      // $("#pnFiltros").toggle("slow");
      $("#selCoordinacion").val("0").attr("selected",true);
      $("#selEstatusOrden").val("0").attr("selected",true);
      // $("#selCoordinacion").val('0')
      $('#txtFechaInicio').val('');
      $('#txtFechaFin').val('');
      $('#txtCCT').val('');
      load();
    });
    
    vEncargado=0;
    $("#selTecnicoEncargado").change(function() {  
      vEncargado=$("#selTecnicoEncargado").val();
      
      if( vEncargado != 0 ){
        let urlEditar = '{{ route("cargarTecAux", ":id") }}';
        urlEditar = urlEditar.replace(':id', vEncargado);
        
        $.ajax({
          url: urlEditar,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(data) {
              // console.log(data);
              var htmlSel='<option value="0">Seleccionar técnico(s) auxiliar(es)</option>';

              for (var i = 0; i < data.length; i++) {
                  htmlSel+='<option value="'+data[i].id_tecnico+'" data-tec="'+data[i].nombre_tecnico+'">'+data[i].nombre_tecnico+'</option>'; 
              }
 
              $("#selTecnicosAuxiliares").html(htmlSel);
              $("#selTecnicosAuxiliares").prop('disabled', false);
          }
        });
        $("#selTecnicosAuxiliares").prop('disabled', false);
        $("#btnAsignarTecnico").prop('disabled', false);
      }else{
        $("#btnAsignarTecnico").prop('disabled', true);
        $("#selTecnicosAuxiliares").prop('disabled', true);
        msjeAlertaSecundario('','Favor de seleccionar el Técnico Encargado','error');

        tecnicosAuxiliaresArray = [];
        $("#tbTecnicos").html('');
        $("#tbTecnicos").empty();
      }

    });

    $("#selTecnicosAuxiliares").change(function() {  
        var vTecnicoEnc=$("#selTecnicoEncargado").val();
        // console.log($("#selTecnicoEncargado").val());
        if(vTecnicoEnc==0 || vTecnicoEnc=='' || vTecnicoEnc==null){
          msjeAlertaSecundario('','Favor de seleccionar el Técnico Encargado','error');

        }else{
            var vTecnicoAux=$("#selTecnicosAuxiliares").val();
            // var tecnicosAuxiliaresArray = []; 
            if(vTecnicoAux != vTecnicoEnc){
              tecnicosAuxiliaresArray = []; 

              var tecnicosAux = document.getElementById("selTecnicosAuxiliares");
              for (var i = 0; i < tecnicosAux.options.length; i++) {
                  if(tecnicosAux.options[i].selected == true){
                    tecnicosAuxiliaresArray.push({
                      id_tecnico:parseInt(tecnicosAux.options[i].value), 
                      nombre_tecnico:tecnicosAux.options[i].text, 
                      es_responsable:0,
                      id_tecnico_orden:0, 
                      id_asignacion:0, 
                      nuevo:0
                    });
                  }
              }
            }else{
              msjeAlertaSecundario('','Ya fue seleccionado el técnico como Técnico Encargado','error');
            }
        }
    });  

    $('#fecha_inicio_prog').change(function() {
      // console.log(this.value);
       var objDate = new Date(this.value);
      // console.log(addHoursToDate(objDate,-1));
      var date=addHoursToDate(objDate,-4).toISOString().replace("Z","");

      $('#fecha_fin_prog').val(date);
    });
    /////////////////Editar Tecnicos
    vEncargadoE=0;
    $("#selTecnicoEncargadoE").change(function() {  
      vEncargadoE=$("#selTecnicoEncargadoE").val();
      
      if( vEncargadoE != 0 ){
        let urlEditar = '{{ route("cargarTecAux", ":id") }}';
        urlEditar = urlEditar.replace(':id', vEncargadoE);
        
        $.ajax({
          url: urlEditar,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(data) {
               console.log(data);
              var htmlSel='<option value="0">Seleccionar técnico(s) auxiliar(es)</option>';

              for (var i = 0; i < data.length; i++) {
                  htmlSel+='<option value="'+data[i].id_tecnico+'" data-tec="'+data[i].nombre_tecnico+'">'+data[i].nombre_tecnico+'</option>'; 
              }
 
              $("#selTecnicosAuxiliaresE").html(htmlSel);
              $("#selTecnicosAuxiliaresE").prop('disabled', false);
          }
        });
        $("#selTecnicosAuxiliaresE").prop('disabled', false);
        $("#btnAsignarTecnicoE").prop('disabled', false);
      }else{
        $("#btnAsignarTecnicoE").prop('disabled', true);
        $("#selTecnicosAuxiliaresE").prop('disabled', true);
        msjeAlertaSecundario('','Favor de seleccionar el Técnico Encargado','error');

        tecnicosAuxiliaresArrayE = [];
        $("#tbTecnicosE").html('');
        $("#tbTecnicosE").empty();
      }

    });

    $("#selTecnicosAuxiliaresE").change(function() {  
        var vTecnicoEnc=$("#selTecnicoEncargadoE").val();
        // console.log($("#selTecnicoEncargado").val());
        if(vTecnicoEnc==0 || vTecnicoEnc=='' || vTecnicoEnc==null){
          msjeAlertaSecundario('','Favor de seleccionar el Técnico Encargado','error');

        }else{
            var vTecnicoAux=$("#selTecnicosAuxiliaresE").val();
            // var tecnicosAuxiliaresArrayE = []; 
            // console.log('5');
            if(vTecnicoAux != vTecnicoEnc){
              // console.log('6');
              if(tecnicosAuxiliaresArrayE==''){
                tecnicosAuxiliaresArrayE = [];   
                /////////////// cuando eliminan todos los tecnicos aux y encargado y vuelven a poner nuevos
                var tecnicosAux = document.getElementById("selTecnicosAuxiliaresE");
                for (var i = 0; i < tecnicosAux.options.length; i++) {
                  // console.log('911');
                  if(tecnicosAux.options[i].selected == true){
                    // console.log('1111');
                    tecnicosAuxiliaresArrayE.push({
                      id_tecnico:parseInt(tecnicosAux.options[i].value), 
                      nombre_tecnico:tecnicosAux.options[i].text, 
                      es_responsable:0,
                      id_tecnico_orden:0, 
                      id_asignacion:0, 
                      nuevo:0
                    });
                  }
                }
                /////////////////
              }else{
                // console.log('8'); 
                var tecnicosAux = document.getElementById("selTecnicosAuxiliaresE");
                for (var i = 0; i < tecnicosAux.options.length; i++) {
                  var index = tecnicosAuxiliaresArrayE.findIndex(e => e.id_tecnico === parseInt(tecnicosAux.options[i].value));
                  // console.log(index);
                  // console.log('9');
                  if(index == -1){
                    // console.log('10');
                    if(tecnicosAux.options[i].selected == true){
                      // console.log('11');
                      tecnicosAuxiliaresArrayE.push({
                        id_tecnico:parseInt(tecnicosAux.options[i].value), 
                        nombre_tecnico:tecnicosAux.options[i].text, 
                        es_responsable:0,
                        id_tecnico_orden:0, 
                        id_asignacion:0, 
                        nuevo:0
                      });
                    }
                  }
                }
              }
            }else{
              msjeAlertaSecundario('','Ya fue seleccionado el técnico como Técnico Encargado','error');
            }
        }
    });  

    // $('#fecha_inicio_progE').change(function() {
    //   // console.log(this.value);
    //    var objDate = new Date(this.value);
    //   // console.log(addHoursToDate(objDate,-1));
    //   var date=addHoursToDate(objDate,-4).toISOString().replace("Z","");

    //   $('#fecha_fin_progE').val(date);
    // });
    /////////////////Fin Editar Tecnicos

    // $("#btnCancelTec").click(function() {  
      
    //   var idSolServ = $("#idSolModTec").val();
    //   console.log(idSolServ);
    //   console.log('--4');
    //   fnUpdAcceso(idSolServ, false, 1);
    // });  

    $("#btnCancelTec").click(function() {  
      
      var idSolServ = $("#idSolModTec").val();
      fnUpdAcceso(idSolServ, false, 1);
    }); 
    
    $("#btnCancelTecE").click(function() {  
      
      var idSolServ = $("#idSolModTecE").val();
      fnUpdAcceso(idSolServ, false, 1);
    }); 

    $("#btnCancelarCancelacion").click(function() { 
      var idSolServ = $("#hdIdSolicServ").val();
      fnUpdAcceso(idSolServ, false, 1);
    }); 

    $("#btnCancelarCierre").click(function() { 
      var idSolServ = $("#hdIdOrdenCierra").val();
      fnUpdAcceso(idSolServ, false, 1);
    });  

  });

 </script>

@endsection
