@extends('layouts.contentIncludes')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    #tabs a.active{
        background: #ab0033; 
        color: #FFFFFF !important;
        /* border-bottom: 1px solid #FFFFFF; */
        border-radius: 0.75em;
    }

    #map {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>

@section('content')
<div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Editar Orden de Servicio </h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <!-- <p class="mb-0">Datos generales</p> -->
                        <!-- <p><h6 class="modal-title">Datos generales</h6></p> -->
                        <div class="col-12">
                            <ul class="nav nav-pills nav-justified" id="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1" aria-current="page" data-bs-toggle="tab" href="#tabCCT">DATOS DEL CENTRO DE TRABAJO</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab2" aria-current="page" data-bs-toggle="tab" href="#tabReporte">DATOS DEL REPORTE</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab3" aria-current="page" data-bs-toggle="tab" href="#tabEquipos">EQUIPOS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="formOrden" action="" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tabCCT">
                                    <div class="row">
                                        <!-- <label for="txtCentroTrabajo">CENTRO DE TRABAJO </label>
                                        <div class="col-6">
                                            <input type="text" id="txtCentroTrabajo" style="text-align:left;" name="txtCentroTrabajo" class="form-control input-group-text" value="{{-- $id --}}" aria-describedby="btnBuscar" >       
                                        </div>

                                        <div class="col-2">
                                            <button class="btn btn-secondary" type="button" id="btnBuscar"  onclick="fnBuscarCCT()">Buscar</button>
                                        </div>

                                        <div class="col-2" id="divHistorial">
                                            
                                        </div>

                                        <div class="col-2" id="divUbicacion">
                                           
                                        </div> -->
                                       
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtNombreCCT">NOMBRE CENTRO DE TRABAJO</label>
                                            <input type="text" id="txtNombreCCT" name="txtNombreCCT" class="form-control" value="{{ $ordenServiciosDetalle->nombrect }}" readonly >
                                            <input type="hidden" id="txtIdCCT" name="txtIdCCT" class="form-control" value="{{ $ordenServiciosDetalle->id_centro }}" readonly >
                                            <input type="hidden" id="txtIdSolic" name="txtIdSolic" class="form-control" value="{{ $ordenServiciosDetalle->id_solic }}" readonly >
                                            <!-- <label id="nombre_alumno" class="SinNegrita">{{-- $registro->nombre_alumno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtClaveCCT">CLAVE</label>
                                            <input type="text" id="txtClaveCCT" name="txtClaveCCT" class="form-control" value="{{ $ordenServiciosDetalle->clave_ct }}" readonly >
                                            <input type="hidden" id="txtLatitud" name="txtLatitud" class="form-control" value="{{ $ordenServiciosDetalle->latitud }}" readonly >
                                            <input type="hidden" id="txtLongitud" name="txtLongitud" class="form-control" value="{{ $ordenServiciosDetalle->longitud }}" readonly >
                                            <!-- <label id="ap_paterno" class="SinNegrita">{{-- $registro->ap_paterno --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtMunicipioCCT">MUNICIPIO DEL CCT</label>
                                            <input type="text" id="txtMunicipioCCT" name="txtMunicipioCCT" class="form-control" value="{{ $ordenServiciosDetalle->municipio }}" readonly >
                                            <!-- <label id="ap_materno" class="SinNegrita">{{-- $registro->ap_materno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label for="txtDirectorCCT">NOMBRE DEL DIRECTOR</label>
                                            <input type="text" id="txtDirectorCCT" name="txtDirectorCCT" class="form-control" value="{{ $ordenServiciosDetalle->director }}" readonly >
                                            <!-- <label id="escuela" class="SinNegrita">{{-- $registro->nombre_cct --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                            <label for="txtDireccionCCT">DIRECCIÓN</label>
                                            <input type="text" id="txtDireccionCCT" name="txtDireccionCCT" class="form-control" value="{{ $ordenServiciosDetalle->domicilio }}" readonly >
                                            <!-- <label id="gradoEscolar" class="SinNegrita">{{-- $registro->grado_alumno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="txtCoordinacion">COORDINACIÓN A LA QUE PERTENECE</label>
                                            <input type="text" id="txtCoordinacion" name="txtCoordinacion" class="form-control" value="{{ $ordenServiciosDetalle->coordinacion }}" readonly >
                                            <!-- <label id="nombre_municipio" class="SinNegrita">{{-- $registro->nombre_municipio --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="txtTelefono">TELÉFONO</label>
                                            <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" value="{{ $ordenServiciosDetalle->telefono }}" readonly >
                                            <!-- <label id="telefono_titular" class="SinNegrita">{{-- $registro->telefono_titular --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="txtTurno">TURNO</label>
                                            <input type="text" id="txtTurno" name="txtTurno" class="form-control" value="{{ $ordenServiciosDetalle->turno }}" readonly >
                                            <!-- <label id="domicilio_casa" class="SinNegrita">{{-- $registro->domicilio_casa --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="txtNivelEducativo">NIVEL EDUCATIVO</label>
                                            <input type="text" id="txtNivelEducativo" name="txtNivelEducativo" class="form-control" value="{{ $ordenServiciosDetalle->nivel }}" readonly >
                                            <!-- <label id="correo_titular" class="SinNegrita">{{-- $registro->correo_titular --}}</label> -->
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="col-12">
                                            <label>Observaciones: En caso de existir algún error en los datos del Centro de Trabajo añadidos, deberá indicar al Centro Educativo realice la actualización de infomación con la Dirección de Planeación de la Secretaría de Educación.</label>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!-- <button type="submit" class="btn btn-secondary" id="btnAnterior" >ANTERIOR</button> -->
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente">SIGUIENTE</button> 
                                        </div>
                                    </div>
                                </div>  <!--final del tab cct-->

                                <div class="tab-pane fade" id="tabReporte">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="selTipoOrden">TIPO DE ORDEN </label>
                                                <select class="form-select" aria-label="Default select example" id="selTipoOrden" name="selTipoOrden" >
                                                    <option value="0" selected>Seleccionar</option>
                                                    @foreach($catTipoOrden as $tipoOrden)
                                                        <option value="{{ $tipoOrden->id_tipo_orden }}">{{ $tipoOrden->desc_tipo_orden }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="selDepAtiende">DEPENDENCIA QUE ATIENDE EL SERVICIO</label>
                                                <select class="form-select" aria-label="Default select example" id="selDepAtiende" name="selDepAtiende" >
                                                    <option value="0" selected>Seleccionar</option>
                                                    <option value="1" >Area 1</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtNombreSolicitante">NOMBRE DEL SOLICITANTE</label>
                                                <input type="text" id="txtNombreSolicitante" name="txtNombreSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->solicitante }}" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtTelefonoSolicitante">TELÉFONO DEL SOLICITANTE</label> 
                                                <input type="tel" id="txtTelefonoSolicitante" name="txtTelefonoSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->telef_solicitante }}" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" >
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtCorreoSolicitante">CORREO INSTITUCIONAL DEL SOLICITANTE</label>
                                                <input type="email" id="txtCorreoSolicitante" name="txtCorreoSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->correo_solic }}" >
                                            </div>
                                        </div>

                                        <div class="col-12 justify-content-md-start">
                                            <div class="form-check">
                                                @if (isset($ordenServiciosDetalle->es_director) && $ordenServiciosDetalle->es_director==true)
                                                    <input class="form-check-input" type="checkbox" checked="true" value="" id="checkSolicitante">
                                                @else
                                                    <input class="form-check-input" type="checkbox" value="" id="checkSolicitante">
                                                @endif
                                                <label class="form-check-label" for="checkSolicitante">
                                                Active la casilla en caso que el solicitante corresponda al Director del C.T
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="txtDescripcionReporte">DESCRIPCIÓN DEL REPORTE</label>
                                                <textarea class="form-control" id="txtDescripcionReporte" name="txtDescripcionReporte" rows="3">{{ $ordenServiciosDetalle->descrip_reporte }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior2" >ANTERIOR</button>
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente2" >SIGUIENTE</button>
                                        </div> 
                                    </div>
                                </div> <!--Fin tab Reporte-->
                                
                                <div class="tab-pane fade" id="tabEquipos">
                                    <div class="row">
                                        <div class="col-12" id="divCantidad">
                                            <div class="form-group">
                                                <label for="txtCantidadEquipos">Cantidad de Equipos</label>
                                                <input type="number" id="txtCantidadEquipos" min="1" onkeydown="fnNumero()" name="txtCantidadEquipos" class="form-control" value="1" >
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="selTipoEquipo">TIPO DE EQUIPO</label>
                                                <select class="form-select" aria-label="Default select example" id="selTipoEquipo" name="selTipoEquipo" >
                                                    <option value="0" selected>Seleccionar</option>
                                                    @foreach($catTipoEquipo as $tipoEquipo)
                                                        <option value="{{ $tipoEquipo->id }}">{{ $tipoEquipo->tipo_equipo }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                 <label for="selTipoServicio">SERVICIO</label>
                                                <!--<select class="form-select" aria-label="Default select example" id="selDepAtiende" name="selDepAtiende" >
                                                    <option value="0" selected>Seleccionar</option>
                                                </select> -->

                                                <div class="input-group">
                                                    <select class="form-select" id="selTipoServicio" name="selTipoServicio" aria-label="Example select with button addon">
                                                        <option value="0" selected>Seleccionar</option>
                                                        
                                                    </select>
                                                    <!-- <button class="btn colorBtnPrincipal" type="button" id="btnAgregarServicio">Añadir</button> -->
                                                    <!-- <button type="button" class="btn colorBtnPrincipal" id="btnAgregarServicio"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button> -->
                                                </div>
                                            </div>
                                            <div class="form-group col-12" style="font-size:0.75rem;" id="divListaServicio">
                                                <!-- <span>LISTADO DE SERVICIOS</span> -->
                                                <ul id="ulServicio">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="selTarea">TAREA</label>
                                                <!-- <select class="form-select" aria-label="Default select example" id="selTarea" name="selTarea" >
                                                    <option value="0" selected>Seleccionar</option>
                                                </select> -->
                                                <div class="input-group">
                                                    <select class="form-select" id="selTarea" name="selTarea" aria-label="Example select with button addon">
                                                        <option value="0" selected>Seleccionar</option>
                                                    </select>
                                                    <!-- <button class="btn colorBtnPrincipal" type="button" id="btnAgregarTarea">Añadir</button> -->
                                                    <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTarea"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                                <span>LISTADO DE TAREAS</span>
                                                <ul id="ulTarea">
                                                    
                                                </ul>
                                            </div> -->
                                        </div>

                                        <div class="col-4">
                                            
                                        </div>

                                        
                                        <div class="col-8">
                                            <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                                <span>LISTADO DE TAREAS</span>
                                                <ul id="ulTarea" style="font-size:0.75rem;">
                                                    
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-3 divEtiqueta">
                                            <div class="form-group">
                                                <label for="txtEtiquetaServicio">ETIQUETA DE SERVICIO</label>
                                                <input type="text" id="txtEtiquetaServicio" name="txtEtiquetaServicio" class="form-control" value="" >
                                            </div>
                                        </div>
                                        <div class="col-3 divEtiqueta">
                                            <div class="form-group">
                                                <label for="txtMarca">MARCA</label>
                                                <input type="text" id="txtMarca" name="txtMarca" class="form-control" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-3 divEtiqueta">
                                            <div class="form-group">
                                                <label for="txtModelo">MODELO</label>
                                                <input type="text" id="txtModelo" name="txtModelo" class="form-control" value=""  readonly>
                                            </div>
                                        </div>
                                        <div class="col-3 divEtiqueta">
                                            <div class="form-group">
                                                <label for="txtNumeroSerie">NÚMERO DE SERIE</label>
                                                <input type="text" id="txtNumeroSerie" name="txtNumeroSerie" class="form-control" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end divEtiqueta">
                                            <button type="button" class="btn btn-secondary" id="btnVerDetalles" data-bs-toggle="modal" data-bs-target="#detallesEquipoModal">VER DETALLES</button>
                                        </div>

                                        <div class="col-9">
                                            <div class="form-group">
                                                <label for="txtDescripcionSoporte">DESCRIPCIÓN SOPORTE O PROBLEMA A REALIZAR</label>
                                                <textarea class="form-control" id="txtDescripcionSoporte" name="txtDescripcionSoporte" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtUbicacionEquipo">UBICACIÓN DEL EQUIPO</label>
                                                <input type="text" id="txtUbicacionEquipo" name="txtUbicacionEquipo" class="form-control" value=""  >
                                            </div>
                                        </div>

                                        <div class="col-12 justify-content-md-start">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="checkReplicar">
                                                <label class="form-check-label" for="checkReplicar">
                                                    Replicar datos en el siguiente equipo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn colorBtnPrincipal" id="btnAgregarEquipo" >AÑADIR EQUIPO</button>
                                        </div>
                                        <br>
                                        <div class="col-12" id="divTablaEquipos">
                                            <table class="table">
                                                <thead>
                                                    <!-- <th>EQUIPO</th><th>SERVICIO</th><th>TAREAS</th><th>ESTATUS</th><th>OPCIONES</th> -->
                                                    <th>EQUIPO</th><th>ESTATUS</th><th>CANTIDAD</th><th>OPCIONES</th>
                                                </thead>
                                                <tbody id="tbEquipos">

                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior3" >ANTERIOR</button>
                                            <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" onclick="fnGuardar()"> ACTUALIZAR</button>
                                        </div> 
                                    </div>
                                </div> <!--Fin tab Equipos-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ELEGIR CENTRO TRABAJO -->
<div class="modal fade" id="centroTrabajoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="centroTrabajoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="centroTrabajoModalLabel">Escuela cuenta con más de un Turno</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-12">
            <div class="form-group">
                <label for="selTurno">Seleccionar Turno</label>
                <select class="form-select" aria-label="Default select example" id="selTurno" name="selTurno">
                    <option value="0" selected>Seleccionar</option>
                </select>
            </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" id="btnElegirTurno" onclick="fnElegirTurno()">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL ELEGIR CENTRO TRABAJO-->

<!-- MODAL VER DETALLES EQUIPO -->
<div class="modal fade" id="detallesEquipoModal" tabindex="-1" aria-labelledby="detallesEquipoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detallesEquipoModalLabel">Detalles Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Detalles
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" id="btnSalirRev">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL VER DETALLES EQUIPO-->

<!-- MODAL HISTORIAL -->
<div class="modal fade" id="historialCCTModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="historialCCTModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="historialCCTModalLabel">Histórico de Órdenes por CCT</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-12">
                <div class="form-group" id="hist">
                    
                </div>
            </div>
        </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnElegirTurno" onclick="fnElegirTurno()">Aceptar</button> -->
        </div>
    </div>
  </div>
</div>
<!-- FIN MODAL HISTORIAL-->

<!-- MODAL MAPA -->
<div class="modal fade" id="ubicacionCCTModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="ubicacionCCTModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ubicacionCCTModalLabel">Ubicación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-12">
                <div class="form-group" id="map">
                    
                </div>
            </div>
        </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnElegirTurno" onclick="fnElegirTurno()">Aceptar</button> -->
        </div>
    </div>
  </div>
</div>
<!-- FIN MODAL MAPA-->

<!-- MODAL EDITAR EQUIPO -->
<div class="modal fade" id="detalleEquipoModal" tabindex="-1" aria-labelledby="detalleEquipoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detalleEquipoModalLabel">No. de Equipo:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formDetalleEquipo" name="formDetalleEquipo" enctype="multipart/form-data">
          <div class="col-12">
            <div class="form-group">
              <!--<label for="estatus_id">Usuario Cancela</label>
              <input type="text" id="txtUsuarioCancela" name="txtUsuarioCancela" class="form-control" value="ATENCION DE USUARIOS">-->
                <input type="hidden" id="hdIdEquipoM" name="hdIdEquipoM" class="form-control">
                <input type="hidden" id="hdIdSolServM" name="hdIdSolServM" class="form-control">
                <!-- <input type="hidden" id="hdIdEstatusCierra" name="hdIdEstatusCierra" class="form-control">  -->
            </div>
          </div>

          <div class="row">
            <div class="col-6">
                <div class="form-group">
                        <label for="selTipoServicioM">SERVICIO</label>
                    <!--<select class="form-select" aria-label="Default select example" id="selDepAtiende" name="selDepAtiende" >
                        <option value="0" selected>Seleccionar</option>
                    </select> -->

                    <div class="input-group">
                        <select class="form-select" id="selTipoServicioM" name="selTipoServicioM" aria-label="Example select with button addon">
                            <option value="0" selected>Seleccionar</option>
                            
                        </select>
                        <!-- <button class="btn colorBtnPrincipal" type="button" id="btnAgregarServicio">Añadir</button> -->
                        <!-- <button type="button" class="btn colorBtnPrincipal" id="btnAgregarServicio"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button> -->
                    </div>
                </div>
                <div class="form-group col-12" style="font-size:0.75rem;" id="divListaServicioM">
                    <!-- <span>LISTADO DE SERVICIOS</span> -->
                    <ul id="ulServicioM">
                        
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="selTareaM">TAREA</label>
                    <!-- <select class="form-select" aria-label="Default select example" id="selTarea" name="selTarea" >
                        <option value="0" selected>Seleccionar</option>
                    </select> -->
                    <div class="input-group">
                        <select class="form-select" id="selTareaM" name="selTareaM" aria-label="Example select with button addon">
                            <option value="0" selected>Seleccionar</option>
                        </select>
                        <!-- <button class="btn colorBtnPrincipal" type="button" id="btnAgregarTarea">Añadir</button> -->
                        <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTareaM"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>
                    </div>
                </div>
                <!-- <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                    <span>LISTADO DE TAREAS</span>
                    <ul id="ulTarea">
                        
                    </ul>
                </div> -->
            </div>
            </div>

          <div class="row">
            <div class="col-12 scrollVertical" id="divEquiposReal">
              <!-- <table style="border:1px solid; width:100%;">
                <tr style="border:1px solid; background-color:#8392ab;">
                  <td><label>Equipo:</label><label class="SinNegrita" id="lblEquipo"></label></td>
                  <td><label>Marca:</label><label class="SinNegrita" id="lblMarca"></label></td>
                  <td><label>Modelo:</label><label class="SinNegrita" id="lblModelo"></label></td>
                  <td><label>Número de Serie:</label><label class="SinNegrita" id="lblSerie"></label></td>
                </tr>
                <tr>
                  <td colspan="4">
                    <label>Tipo de Equipo:</label><label class="SinNegrita" id="lblTipoEquipo"></label><br>
                    <label>Servicio(s):</label><label class="SinNegrita" id="lblServicios"></label><br>
                    <label>Tarea(s):</label><label class="SinNegrita" id="lblTareas"></label><br>
                    <label>Descripción del problema:</label><label class="SinNegrita" id="lblDescProblema"></label><br>
                    <label>Ubicación del equipo:</label><label class="SinNegrita" id="lblUbic"></label><br>
                    <label>Solución/Diagnóstico:</label><label class="SinNegrita" id="lblSolucionDiag"></label><br>
                  </td>
                </tr>
              </table>
              <br> -->
            </div>
          </div>

          <!-- <div class="row">
            <div class="col-12">
              <div class="form-group">
                <div style="background-color:#ab0033; color:#FFFFFF; text-align:center;"><span>SUBIR ARCHIVO DE CIERRE DE ORDEN</span></div>
              </div>
            </div>
          </div> -->

          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="archivoEvidencia">Agregar evidencia:</label>
                <input class="form-control" type="file" id="archivoEvidencia" name="archivoEvidencia">
              </div>
            </div>
          </div>

          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn colorBtnPrincipal" onclick="" id="btnCerrar">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIN MODAL EDITAR EQUIPO-->

@endsection

@section('page-scripts')
<!-- <script src="{{ asset('js/scripts/components-modal.js') }}"></script> --> 
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- <script src="{{ asset('js/sweetalert2@11.js') }}"></script> -->

<!-- <script src="//code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer> </script> 

<script>
    let arrTareas = [];
    let arrServicios = [];
    var arrEquipos = [];
    let arrEscuelaTurno = [];
    // var equipo_servicio = {
    //             nom_equipo: '',
    //             num_inventario: '',
    //             servicios_equipo: []
    //         };

    $(document).ready(function () {
        // $("#divTablaEquipos").hide()

        // $("#btnSiguiente").hide()
        // $("#btnSiguiente").prop('disabled', true);
        // $("#divCantidad").hide()

        fnConsEquipos();

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
                 $(".divEtiqueta").show();
            } else {  
                 $(".divEtiqueta").hide();
            }  
        });  
    
        var tablaEquipo='';
        var i=0;
        // var arrEquipos = [];
        $("#btnAgregarEquipo").click(function(){
             var bandCheck='';
            $("#checkReplicar").click(function() {  
                if($("#checkReplicar").is(':checked')) {  
                    bandCheck=1;
                } else {  
                    bandCheck=0;
                }  
            });  

            var etiquetaServicio = $("#txtEtiquetaServicio").val();
            var marca = $("#txtMarca").val();
            var modelo = $("#txtModelo").val(); 
            var numeroSerie = $("#txtNumeroSerie").val(); 
            var descripcionSoporte = $("#txtDescripcionSoporte").val();
            var ubicacionEquipo = $("#txtUbicacionEquipo").val(); 
            
            // $("#divTablaEquipos").show();
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
            })
            //  arrTareas=[];
            drawRowEquipo();
            i=i+1;
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
                }else{
                    $("#selTarea").val("0").attr("selected",true);
                    msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')
                }
            }
            // $("#selTipoServicio").val("0").attr("selected",true);  //resetear servicio cada que agrega una tarea
        });

        $('#selTipoEquipo').on('change', function() { /// Cargar select Tarea en base a Servicio
            let urlEditar = '{{ route("consServicio", ":idEquipo") }}';
            urlEditar = urlEditar.replace(':idEquipo', this.value); 
            
            $("#selTipoServicio").val("0").attr("selected",true);
            let element = document.getElementById("selTipoServicio");
            element.value = '0';

            $.ajax({
                url: urlEditar,
                type: 'GET',
                dataType: 'json', 
                success: function(data) {
                    //  console.log(data[0][0]);
                    var htmlSel='<option value="0" selected>Seleccionar</option>';
                    for (var i = 0; i < data[0].length; i++) {
                        htmlSel+='<option value="'+data[0][i].id+'">'+data[0][i].servicio+'</option>'; 
                    }

                    $("#selTipoServicio").html(htmlSel);
                }
            });
            
        });

        $('#selTipoServicio').on('change', function() { /// Cargar select Tarea en base a Servicio
            var vtipEquipo=  $('#selTipoEquipo').val();
            var serv= this.value;

            let urlEditar = '{{ route("consTarea") }}';
            // urlEditar = urlEditar.replace(':idserv', this.value);
            
            $("#selTarea").val("0").attr("selected",true);
            let element = document.getElementById("selTarea");
            element.value = '0';

            $.ajax({
                url: urlEditar,
                type: 'POST',
                data:{idequi:vtipEquipo , idserv:serv},
                dataType: 'json', 
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    //  console.log(data[0][0]);
                    var htmlSel='<option value="0" selected>Seleccionar</option>';
                    for (var i = 0; i < data[0].length; i++) {
                        htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                    }

                    $("#selTarea").html(htmlSel);
                }
            });
            
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

    function removeEquipo( item ) {
        if(arrEquipos.includes(item) ==false){ 
            if ( item !== -1 ) {
                arrEquipos.splice( item, 1 );
                $("#tr_"+item).remove();
                drawRowEquipo();
            }   else{
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
                tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td><td>En Proceso</td>';
                
                tablaEquipo2+='<td>'+arrEquipos[j]['cantidad']+'</td><td><div class="dropdown btn-group dropstart">';
                tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "';
                tablaEquipo2+='                      data-bs-toggle="dropdown" id="opciones"';
                tablaEquipo2+='                       aria-haspopup="true" aria-expanded="false" >';
                tablaEquipo2+='                      <i class="fa fa-ellipsis-v text-xs"></i>';
                tablaEquipo2+='                  </button>';
                tablaEquipo2+='                  <ul class="dropdown-menu" aria-labelledby="opciones1">';
                tablaEquipo2+='                      <li>';
                tablaEquipo2+='                          <a  ';
                // tablaEquipo2+='                          onclick="removeEquipo('+j+');" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal">';
                tablaEquipo2+='                          onclick="removeEquipo('+j+');" >';
                tablaEquipo2+='                              <i class="fas fa-eye"></i> Eliminar';
                tablaEquipo2+='                          </a>';
                tablaEquipo2+='                      </li>';
                tablaEquipo2+='                          <li>';
                tablaEquipo2+='                              <a onclick="verServicioEquipo('+j+')"> ';
                // tablaEquipo2+='                              class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">';
                tablaEquipo2+='                                  <i class="fas fa-download"></i> Ver Servicios/Tareas';
                tablaEquipo2+='                              </a>';
                tablaEquipo2+='                          </li>';
                tablaEquipo2+='                          <li>';
                tablaEquipo2+='                              <a onclick="verDetalleEquipo('+j+')"> ';
                // tablaEquipo2+='                              class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">';
                tablaEquipo2+='                                  <i class="fas fa-download"></i> Editar Equipo';
                tablaEquipo2+='                              </a>';
                tablaEquipo2+='                          </li>';
                tablaEquipo2+='                  </ul>';
                tablaEquipo2+='              </div></td>';
                // tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal" onclick="removeEquipo('+j+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                tablaEquipo2+='</tr>';
            }
        });

        $("#tbEquipos").empty();
        $("#tbEquipos").html(tablaEquipo2);
    }


    function removeTarea( item ) {
        if(arrTareas.includes(item) ==false){ 
            if ( item !== -1 ) {
                arrTareas.splice( item, 1 );
                console.log(arrTareas);
                $("#liT_"+item).remove();
                drawRowTarea();
            }   else{
                arrTareas = [];
                 g=0;
                listaTarea='';
                $("#ulTarea").html('');
                $("#ulTarea").empty();
            }
        }else{
            console.log('No existe en el arreglo');
            g=0;
            listaTarea='';
            $("#ulTarea").html('');
            $("#ulTarea").empty();
        }
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
                listaTarea2+='<td><button type="button" onclick="removeTarea('+j+');" class="btn colorBtnPrincipal" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                listaTarea2+='<tr>';
            }
        });

        listaTarea2+='</tbody>';
        listaTarea2+='</table>';

        $("#ulTarea").empty();
        $("#ulTarea").html(listaTarea2);
        $("#selTarea").val("0").attr("selected",true);
    }

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
    function fnConsEquipos(){
        var idSolic= $("#txtIdSolic").val();
        let urlEditar = '{{ route("consEquipos", ":idSolic") }}';
        urlEditar = urlEditar.replace(':idSolic', idSolic);

        $.ajax({
            url: urlEditar,
            type: 'GET',
            dataType: 'json', 
            success: function(data) {

                //  console.log(data[0][0].arrequipos);   //data[0][i].id_tarea
                //  var coche = JSON.parse(data[0][0].arrequipos);

                // console.log(coche);  ////////regresa json CACHAR JSON QUE REGRESA FUNCION
                 
                    // console.log(data[0].length); 
                if(data[0] !='' || data[0] !=null || data[0].length!=0){

                    $.each(data[0], function(i, val){
                        if (!jQuery.isEmptyObject(data[0][i])) {
                            // console.log(data[0][i]);
                            arrEquipos.push({
                            con : i,
                                id_tipo_equipo : data[0][i].id_tipo_equipo, 
                                desc_tipo_equipo : data[0][i].tipo_equipo, 
                                etiquetaServicio : '',
                                marca : '',
                                modelo : '', 
                                numeroSerie : '',
                                descripcionSoporte : '',
                                ubicacionEquipo : '',
                                cantidad : 1,
                                estatus_equipo : 1, 
                                nuevo : 0, 
                                aTarea : '', ///arreglo tareas
                            // aServicio : arrServicios /// arreglo servicios
                            })
                        }
                    });
                    // console.log(arrEquipos);
                    // arrEquipos.push({
                    //     con : i,
                    //     id_tipo_equipo : vId_TipoEquipo, 
                    //     desc_tipo_equipo : vTipoEquipo, 
                    //     etiquetaServicio : etiquetaServicio,
                    //     marca : marca,
                    //     modelo : modelo, 
                    //     numeroSerie : numeroSerie,
                    //     descripcionSoporte : descripcionSoporte,
                    //     ubicacionEquipo : ubicacionEquipo,
                    //     cantidad : vCantidad,
                    //     estatus_equipo : 1, 
                    //     nuevo : 0, 
                    //     aTarea : arrTareas, ///arreglo tareas
                    //     // aServicio : arrServicios /// arreglo servicios
                    // })
                    drawRowEquipo();
                //     if(data[0].length>1){
                //         var html='';
                //         var i=0;
                //         data[0].forEach(element => {
                //             i=i+1;
                //             arrEscuelaTurno.push(element);
                //             html+='<option value="'+i+'" selected>'+element['turno']+'</option>';
                //             //  console.log(element['turno']);
                                
                //         });
                //         // console.log(arrEscuelaTurno);
                //         $("#selTurno").html(html);
                //         $("#centroTrabajoModal").modal("show");
                //     }else if(data[0].length==1){
                //         $("#txtIdCCT").val(data[0][0].id);
                //         $("#txtNombreCCT").val(data[0][0].nombrect);
                //         $("#txtClaveCCT").val(data[0][0].clavecct);
                //         $("#txtMunicipioCCT").val(data[0][0].municipio)
                //         $("#txtDirectorCCT").val(data[0][0].director);
                //         $("#txtDireccionCCT").val(data[0][0].domicilio);
                //         $("#txtCoordinacion").val(data[0][0].coordinacion);
                //         $("#txtTelefono").val(data[0][0].telefono);
                //         $("#txtTurno").val(data[0][0].turno);
                //         $("#txtNivelEducativo").val(data[0][0].nivel);
                //         $("#txtLatitud").val(data[0][0].latitud);
                //         $("#txtLongitud").val(data[0][0].longitud);

                //         $("#btnSiguiente").prop('disabled', false);
                //         // $("#btnHistorialCCT").show();
                //         // $("#btnUbicacionCCT").show();
                        
                //         var divH='<button class="btn btn-secondary" type="button" id="btnHistorialCCT"  onclick="fnHistorial()">Ver Historial</button>';
                //         var divU='<button class="btn btn-secondary" type="button" id="btnUbicacionCCT"  onclick="fnMapa()">Ubicación</button>';
                //         $("#divHistorial").html(divH);
                //         $("#divUbicacion").html(divU);

                //         if(data[1] !='' || data[1] !=null ){
                //             // $("#divHistorial").html(divH);
                //             var htmlHist='<table class="table"><thead><th>FOLIO</th><th>Fecha</th><th>Detalles</th></thead><tbody>';
                //             var j=0;
                //             $.each(data[1], function(j, val){
                //                 if (!jQuery.isEmptyObject(data[1])) {
                //                     htmlHist+='<tr><td>'+data[1][j].folio+'</td><td>'+data[1][j].fecha_orden+'</td>';
                //                     htmlHist+='<td><div class="dropdown btn-group dropstart">';
                //                     htmlHist+='<button class="btn btn-link text-secondary mb-0 "';
                //                     htmlHist+='data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >';
                //                     htmlHist+='<i class="fa fa-ellipsis-v text-xs"></i></button>';
                //                     htmlHist+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                //                     htmlHist+='<li>';
                //                     htmlHist+='<a onclick="fnVerOrdenCentro('+data[1][j].id_orden+')"> ';
                //                     htmlHist+='<i class="fas fa-download"></i> Ver Orden...';
                //                     htmlHist+='</a>';
                //                     htmlHist+='</li>';
                //                     htmlHist+='</ul>';
                //                     htmlHist+='</div></td></tr>';
                //                     //  console.log(element['turno']);
                //                     j=j+1;
                //                 }
                //             });


                //             htmlHist+='</tbody></table>';
                //             // console.log(arrEscuelaTurno);
                            
                //             $("#hist").html(htmlHist);
                //         }else{
                //             $("#hist").html('<span>No hay historial de este centro de trabajo</span>');
                //         }
                //     }else{
                //         msjeAlerta('', 'No existe el Centro de Trabajo '+claveCCT, 'error')
                //         $("#btnSiguiente").prop('disabled', true);

                //         $("#divHistorial").html('');
                //         $("#divUbicacion").html('');
                //         $("#hist").html('');

                //         fnLimpiar();
                //         }
                }else{
                //     msjeAlerta('', 'No existe el Centro de Trabajo '+claveCCT, 'error')
                //     $("#btnSiguiente").prop('disabled', true);

                //     $("#divHistorial").html('');
                //     $("#divUbicacion").html('');
                //     $("#hist").html('');

                //     fnLimpiar();
                    
                }
            }
        });
        
        drawRowEquipo()
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
        let urlEditar = '{{ route("actualizarOrden") }}';
        // urlEditar = urlEditar.replace(':claveCCT', claveCCT);
        var form = $('#formOrden')[0];
         
         // FormData object 
         var data2 = new FormData(form);
        //  data2.append('arrEquipos',arrEquipos);
        data2.append('arrEquipos', JSON.stringify(arrEquipos))
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

    function verDetalleEquipo(j){
        console.log(j);
        $("#detalleEquipoModal").modal("show");
    }


</script>
@endsection
