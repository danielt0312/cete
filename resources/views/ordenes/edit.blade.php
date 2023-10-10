@extends('layouts.contentIncludes')
@section('title','CAS CETE')
@php setPermissionsTeamId(3); @endphp

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
                        {{--auth()->user()->roles[0]['name']--}}
                        @can('177-tab-edit-equipos')
                        <?php
                            $rol=auth()->user()->roles[0]['name'];
                            $nombre=explode(' ', $rol);

                            if ($nombre[0]=='Técnico'){
                            $valor=1;
                            }else{
                            $valor=0;
                            }
                        ?>
                        <input type="hidden" id="rolTec" name="rolTec" value="<?php echo $valor; ?>">
                        @endcan
                        <div class="col-12">
                            <ul class="nav nav-pills nav-justified" id="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1" aria-current="page" data-bs-toggle="tab" href="#tabCCT">Datos del Centro de Trabajo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab2" aria-current="page" data-bs-toggle="tab" href="#tabReporte">Datos del reporte</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab3" aria-current="page" data-bs-toggle="tab" href="#tabEquipos">Equipos/Servicios</a>
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
                                        <div class="col-12" id="datosGenCentro">
                                            <label style="color:#ab0033 !important">FOLIO DE ORDEN:</label>
                                            <label style="color:#ab0033 !important">{{ $ordenServiciosDetalle->folio }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label style="color:#ab0033 !important">ESTATUS:</label>
                                            <label style="color:#ab0033 !important">{{ $ordenServiciosDetalle->desc_estatus_orden }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="datosGenCentro">
                                            <label>CENTRO DE TRABAJO:</label>
                                            <label>{{ $ordenServiciosDetalle->clave_ct }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>NOMBRE DEL C.T:</label>
                                            <label>{{ $ordenServiciosDetalle->nombrect }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>NIVEL DEL C.T.:</label>
                                            <label>{{ $ordenServiciosDetalle->nivel }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>MUNICIPIO DEL C.T.:</label> 
                                            <label>{{ $ordenServiciosDetalle->municipio }}</label><br><br>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <!-- <label for="txtCentroTrabajo">CENTRO DE TRABAJO </label>
                                        <div class="col-4">
                                            <input type="text" id="txtCentroTrabajo" style="text-align:left;" name="txtCentroTrabajo" class="form-control input-group-text" value="{{-- $id --}}" aria-describedby="btnBuscar" >       
                                        </div>
                                        
                                        <div class="col-8"> 
                                            <button class="btn btn-secondary" type="button" id="btnBuscar"  onclick="fnBuscarCCT()">Buscar</button>
                                            &nbsp;&nbsp;&nbsp;<span  id="divHistorial"> 
                                            </span>
                                            &nbsp;&nbsp;
                                            <span  id="divUbicacion">
                                            </span> 
                                        </div> -->

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtNombreCCT">NOMBRE</label>
                                            <input type="text" id="txtNombreCCT" name="txtNombreCCT" class="form-control" value="{{ $ordenServiciosDetalle->nombrect }}" readonly >
                                            <input type="hidden" id="txtIdCCT" name="txtIdCCT" class="form-control" value="{{ $ordenServiciosDetalle->id_centro }}" readonly >
                                            <input type="hidden" id="txtIdSolic" name="txtIdSolic" class="form-control" value="{{ $ordenServiciosDetalle->id_solic }}" readonly >
                                            <input type="hidden" id="txtNumFolio" name="txtNumFolio" class="form-control" value="{{ $ordenServiciosDetalle->folio }}" readonly >
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
                                        <div class="col-4">
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

                                        <div class="col-2">
                                            <div class="form-group">
                                            <label for="txtNivelEducativo">NIVEL EDUCATIVO</label>
                                            <input type="text" id="txtNivelEducativo" name="txtNivelEducativo" class="form-control" value="{{ $ordenServiciosDetalle->nivel }}" readonly >
                                            <!-- <label id="correo_titular" class="SinNegrita">{{-- $registro->correo_titular --}}</label> -->
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="col-12">
                                            <label>Observaciones: En caso de existir algún error en los datos del Centro de Trabajo añadidos, deberá indicar al Centro Educativo realice la actualización de infomación con la Dirección de Planeación de la Secretaría de Educación.</label>
                                            <br> 
                                            <br> 
                                        </div>

                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-start">
                                            <button type="button" class="btn btn-secondary" id="btnCancelarS1">Salir</button> 
                                        </div>

                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!-- <button type="submit" class="btn btn-secondary" id="btnAnterior" >ANTERIOR</button> antes tenia col-12 -->
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente">Siguiente</button> 
                                        </div>
                                    </div>
                                </div>  <!--final del tab cct-->

                                <div class="tab-pane fade" id="tabReporte">
                                <div class="row">
                                        <div class="col-12" id="datosGenCentro2">
                                            <label style="color:#ab0033 !important">FOLIO DE ORDEN:</label>
                                            <label style="color:#ab0033 !important">{{ $ordenServiciosDetalle->folio }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label style="color:#ab0033 !important">ESTATUS:</label>
                                            <label style="color:#ab0033 !important">{{ $ordenServiciosDetalle->desc_estatus_orden }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="datosGenCentro2">
                                            <label>CENTRO DE TRABAJO:</label>
                                            <label>{{ $ordenServiciosDetalle->clave_ct }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>NOMBRE DEL C.T:</label>
                                            <label>{{ $ordenServiciosDetalle->nombrect }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>NIVEL DEL C.T.:</label>
                                            <label>{{ $ordenServiciosDetalle->nivel }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>MUNICIPIO DEL C.T.:</label> 
                                            <label>{{ $ordenServiciosDetalle->municipio }}</label><br><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="selTipoOrden">TIPO DE ORDEN </label>
                                                <select class="form-select" aria-label="Default select example" id="selTipoOrden" name="selTipoOrden" disabled>
                                                    <option value="0" selected>Seleccionar</option>
                                                    @foreach($catTipoOrden as $tipoOrden)
                                                        @if( $ordenServiciosDetalle->id_tipo_orden == $tipoOrden->id_tipo_orden)
                                                            <option value="{{ $tipoOrden->id_tipo_orden }}" selected>{{ $tipoOrden->desc_tipo_orden }}</option>
                                                        @else
                                                            <option value="{{ $tipoOrden->id_tipo_orden }}">{{ $tipoOrden->desc_tipo_orden }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="selDepAtiende">DEPENDENCIA QUE ATIENDE EL SERVICIO</label>
                                                <select class="form-select" aria-label="Default select example" id="selDepAtiende" name="selDepAtiende">
                                                    <option value="0" selected>Seleccionar</option>
                                                    @foreach($catAreasAtiendeOrden as $areasAtiendeOrden)
                                                        @if( $ordenServiciosDetalle->id_coord_atiende == $areasAtiendeOrden->id)
                                                            <option value="{{ $areasAtiendeOrden->id }}" selected>{{ $areasAtiendeOrden->area_atiende }}</option>
                                                        @else
                                                            <option value="{{ $areasAtiendeOrden->id }}">{{ $areasAtiendeOrden->area_atiende }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtNombreSolicitante">NOMBRE DEL SOLICITANTE</label>
                                                <input type="text" id="txtNombreSolicitante" name="txtNombreSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->solicitante }}" >
                                                <input type="hidden" id="hdNombreSolicitante" name="hdNombreSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->solicitante }}" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtTelefonoSolicitante">TELÉFONO DEL SOLICITANTE</label> 
                                                <input type="tel" id="txtTelefonoSolicitante" name="txtTelefonoSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->telef_solicitante }}" minlength="10" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" >
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtCorreoSolicitante">CORREO INSTITUCIONAL DEL SOLICITANTE</label>
                                                <input type="email" id="txtCorreoSolicitante" name="txtCorreoSolicitante" class="form-control" value="{{ $ordenServiciosDetalle->correo_solic  }}" >
                                            </div>
                                        </div>

                                        <div class="col-12 justify-content-md-start">
                                            <div class="form-check">
                                            @can('171-chk-edit-es-director')
                                                @if (isset($ordenServiciosDetalle->es_director) && $ordenServiciosDetalle->es_director==true)
                                                    <input class="form-check-input" type="checkbox" checked="true" value="" id="checkSolicitante">
                                                @else
                                                    <input class="form-check-input" type="checkbox" value="" id="checkSolicitante">
                                                @endif
                                                <label class="form-check-label" for="checkSolicitante">
                                                Active la casilla en caso que el solicitante corresponda al Director del C.T
                                                </label>
                                            @endcan
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="txtDescripcionReporte">DESCRIPCIÓN DEL REPORTE</label>
                                                <textarea class="form-control" id="txtDescripcionReporte" name="txtDescripcionReporte" rows="3">{{ $ordenServiciosDetalle->descrip_reporte }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-9 justify-content-md-start">
                                            <div class="form-check activeCasilla"> 
                                                @if (isset($ordenServiciosDetalle->seguimiento) && $ordenServiciosDetalle->seguimiento==true)
                                                    <input class="form-check-input" type="checkbox" checked="true" value="" id="checkSeguimiento">
                                                @else
                                                    <input class="form-check-input" type="checkbox" value="" id="checkSeguimiento">
                                                @endif
                                                <label style="font-weight: normal;" for="checkSeguimiento">
                                                ¿Desea recibir notificaciones del seguimiento de su orden al correo proporcionado?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-3"> 
                                        </div>

                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-start">
                                            <br> 
                                            <br> 
                                            <button type="button" class="btn btn-secondary" id="btnCancelarS2">Salir</button> 
                                        </div>

                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <br> 
                                            <br> 
                                            <button type="button" class="btn btn-secondary" id="btnAnterior2" >Regresar</button>
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente2" >Siguiente</button>
                                        </div> 
                                    </div>
                                </div> <!--Fin tab Reporte-->
                                
                                <div class="tab-pane fade" id="tabEquipos">
                                <div class="row">
                                        <div class="col-12" id="datosGenCentro">
                                            <label style="color:#ab0033 !important">FOLIO DE ORDEN:</label>
                                            <label style="color:#ab0033 !important">{{ $ordenServiciosDetalle->folio }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label style="color:#ab0033 !important">ESTATUS:</label>
                                            <label style="color:#ab0033 !important">{{ $ordenServiciosDetalle->desc_estatus_orden }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="datosGenCentro">
                                            <label>CENTRO DE TRABAJO:</label>
                                            <label>{{ $ordenServiciosDetalle->clave_ct }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>NOMBRE DEL C.T:</label>
                                            <label>{{ $ordenServiciosDetalle->nombrect }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>NIVEL DEL C.T.:</label>
                                            <label>{{ $ordenServiciosDetalle->nivel }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label>MUNICIPIO DEL C.T.:</label> 
                                            <label>{{ $ordenServiciosDetalle->municipio }}</label><br><br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6" style="text-align:center;  background-color:#ab0033;">
                                            <span style="color:white;">Agregar equipo(s) y servicio(s) a la orden de servicio</span>
                                        </div>
                                        <div class="col-6" style="text-align:center; border-bottom:3px solid #ab0033;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" >
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txtDescripcionSoporte">DESCRIPCIÓN DEL PROBLEMA</label>
                                                    <textarea class="form-control" id="txtDescripcionSoporte" name="txtDescripcionSoporte" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3 divEtiqueta">
                                                <div class="form-group">
                                                    <label for="txtEtiquetaServicio">ETIQUETA <span class="sinNegrita">(Solo equipos)</span></label>
                                                    <input type="text" id="txtEtiquetaServicio" name="txtEtiquetaServicio" class="form-control" value="" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-6 divEtiqueta">
                                                <div class="form-group">
                                                    <label for="txtMarca">DETALLE</label>
                                                    <input type="text" id="txtDetEquipo" name="txtDetEquipo" class="form-control" value="" readonly>
                                                    <input type="hidden" id="txtMarca" name="txtMarca" class="form-control" value="" readonly>
                                                    <input type="hidden" id="txtModelo" name="txtModelo" class="form-control" value=""  readonly>
                                                    <input type="hidden" id="txtNumeroSerie" name="txtNumeroSerie" class="form-control" value="" readonly>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="txtUbicacionEquipo">UBICACIÓN</label>
                                                    <input type="text" id="txtUbicacionEquipo" name="txtUbicacionEquipo" class="form-control" value=""  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- <div class="col-1" id="divCantidad">
                                                <div class="form-group">
                                                    <label for="txtCantidadEquipos">CANTIDAD</label>
                                                    <input type="number" id="txtCantidadEquipos" min="1" onkeydown="fnNumero()" name="txtCantidadEquipos" class="form-control" value="1" >
                                                </div>
                                            </div> -->
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="selTipoEquipo">TIPO DE EQUIPO/SERVICIO</label>
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
                                                    <label for="selTipoServicio">ÁREA DE SERVICIO</label>
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
                                                <!-- <div class="form-group col-12" style="font-size:0.75rem;" id="divListaServicio">
                                                    
                                                    <ul id="ulServicio">
                                                        
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="selTarea">TIPO DE TAREA</label>
                                                        <!-- AIDA<select class="form-select" id="selTarea" name="selTarea" aria-label="Example select with button addon">
                                                            <option value="0" selected>Seleccionar</option>
                                                        </select> -->
                                                        <select class="selectpicker" data-width="100%" data-size="4" id="selTarea" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" title="Seleccionar" multiple aria-label="size 3 select example" placeholder>

                                                        </select>
                                                </div>
                                                
                                                <!-- <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                                    <span>LISTADO DE TAREAS</span>
                                                    <ul id="ulTarea">
                                                        
                                                    </ul>
                                                </div> -->
                                            </div>
                                            <div class="col-1" id="divCantidad">
                                                <div class="form-group">
                                                    <label for="txtCantidadEquipos">CANTIDAD</label>
                                                    <input type="number" id="txtCantidadEquipos" min="1" onkeydown="fnNumero()" name="txtCantidadEquipos" class="form-control" value="1" >
                                                </div>
                                            </div>
                                            <div class="col-1" style="padding-bottom:5px;"> 
                                                <div class="form-group">
                                                    <br>
                                                    @can('172-btn-edit-agregar-tareas')
                                                    <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTarea"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>
                                                    @endcan
                                                </div>
                                             </div>
                                        </div>

                                    </div>
                                    <div class="row" id="divRowListadoTareas">
                                        <!-- <div class="col-7">
                                            <div class="form-group">
                                                <label for="txtDescripcionSoporte">DESCRIPCIÓN DEL PROBLEMA</label>
                                                <textarea class="form-control" id="txtDescripcionSoporte" name="txtDescripcionSoporte" rows="3"></textarea>
                                            </div>
                                        </div> -->
                                        <div class="col-12">
                                            <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                                <span id="tituloTareas" class="tituloTareas"></span>
                                                <ul id="ulTarea" style="font-size:0.75rem;">
                                                    
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtUbicacionEquipo">UBICACIÓN DEL EQUIPO</label>
                                                <input type="text" id="txtUbicacionEquipo" name="txtUbicacionEquipo" class="form-control" value=""  >
                                            </div>
                                        </div> -->
                                    </div>

                                    <div class="row">
                                        <!-- <div class="col-9 d-md-flex justify-content-md-start">
                                            @can('173-chk-edit-replicar-equipo')
                                            <div class="form-check replicar" id="checkVer">
                                                <input class="form-check-input" type="checkbox" value="" id="checkReplicar" name="checkReplicar">
                                                <label class="form-check-label" for="checkReplicar">
                                                    Mantener descripción del problema y lista de tareas para el siguiente equipo.
                                                </label>
                                            </div>
                                            @endcan
                                        </div> -->
                                        <div class="col-9 d-md-flex justify-content-md-start">
                                        </div>

                                        <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                            @can('176-btn-edit-agregar-equipo')
                                            <button type="button" class="btn colorBtnPrincipal" id="btnAgregarEquipo" >Agregar Equipo/Servicio</button>
                                            @endcan
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6" style="text-align:center;  background-color:#ab0033;">
                                            <span style="color:white;">Descripción de equipo(s) y servicio(s) agregados</span>
                                        </div>
                                        <div class="col-6" style="text-align:center; border-bottom:3px solid #ab0033;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" >
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-12 scrollHorizontal" id="divTablaEquipos">
                                            <table class="table" id="tablaEquipos">
                                                <thead class="text-align:center;">
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CANTIDAD</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EQUIPO/SERVICIO</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESCRIPCIÓN</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ÁREA DE SERVICIO</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TAREA</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ACCIONES</th>
                                                </thead>
                                                <tbody id="tbEquipos">

                                                </tbody>
                                            </table>
                                        </div>
                                     
                                        <br>
                                        
                                        <div class="col-12 lineaHr"></div>
                                        
                                        <br>

                                        <!-- <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-start">
                                            <button type="button" class="btn btn-secondary" id="btnCancelarS3">Salir</button> 
                                        </div> 
                                        
                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior3" >Regresar</button>
                                            @can('185-edit-actualizar-orden')
                                            <button type="button" class="btn colorBtnPrincipal" id="btnActualizarO" onclick="msjeAlertConfirm()"> Actualizar</button>
                                            @endcan
                                        </div>  -->
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-start">
                                            <button type="button" class="btn btn-secondary" id="btnCancelarS3">Salir</button> 
                                        </div> 
                                        
                                        <div class="col-6 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior3" >Regresar</button>
                                            @can('185-edit-actualizar-orden')
                                            <button type="button" class="btn colorBtnPrincipal" id="btnActualizarO" onclick="msjeAlertConfirm()"> Actualizar</button>
                                            @endcan
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
<div class="modal fade" id="detallesEquipoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="detallesEquipoModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnElegirTurno" onclick="fnElegirTurno()">Aceptar</button> -->
        </div>
    </div>
  </div>
</div>
<!-- FIN MODAL MAPA-->

<!-- MODAL VER DETALLES EQUIPO -->
<div class="modal fade" id="visualizarDetalleEquipoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="visualizarDetalleEquipoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="visualizarDetalleEquipoModalLabel">Información Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> -->
            <div class="modal-body" >
                <div class="row">
                    <div class="col-12 d-md-flex justify-content-md-end" style="font-color:#ab0033;">
                    <span style="color:#ab0033;">FOLIO DE ORDEN: {{ $ordenServiciosDetalle->folio }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ESTATUS: {{ $ordenServiciosDetalle->desc_estatus_orden }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                        <span style="color:white;">Información Equipo(s)/Servicios(s)</span>
                    </div>
                    <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12"  id="divDetalleEquipoM">

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
                <div class="row" style="text-align:right;">
                    <div class="col-12" >
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            </div> -->
        </div>
    </div>
</div>
<!-- FIN MODAL VER DETALLES EQUIPO-->

<!-- MODAL HISTORIAL EQUIPO -->
<div class="modal fade" id="historialEquipoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="historialEquipoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <!-- <div class="modal-header">
            <h5 class="modal-title" id="historialEquipoModalLabel">Historial del Equipo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> -->
            <div class="modal-body overflow-scroll">
                <div class="row">
                    <div class="col-12 d-md-flex justify-content-md-end" style="font-color:#ab0033;">
                    <span style="color:#ab0033;">FOLIO DE ORDEN: {{ $ordenServiciosDetalle->folio }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ESTATUS: {{ $ordenServiciosDetalle->desc_estatus_orden }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                        <span style="color:white;">Historial del Equipo/Servicio</span>
                    </div>
                    <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" >
                    </div>
                </div>

                <input type="hidden" id="etiquetaM" name="etiquetaM" value="" readonly>

                <table class="table overflow-scroll" id="tablaHistoricoE" >
                    <thead class="text-align:center;">
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ORDEN</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CENTRO DE TRABAJO</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA DE CIERRE</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TÉCNICO ENCARGADO</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SOLICITANTE</th>
                    </thead>
                    <tbody id="tbHistoricoE">
                        
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-12" >
                    </div>
                </div>
                <div class="row" style="text-align:right;">
                    <div class="col-12" >
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
      </div> -->
        </div>
    </div>
</div>
<!-- FIN MODAL HISTORIAL EQUIPO-->

<!-- MODAL EDITAR EQUIPO -->
<div class="modal fade" id="detalleEquipoModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="detalleEquipoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="detalleEquipoModalLabel">No. de Equipo:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-12 d-md-flex justify-content-md-end">
                        <span style="color:#ab0033;">FOLIO DE ORDEN: {{ $ordenServiciosDetalle->folio }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ESTATUS: {{ $ordenServiciosDetalle->desc_estatus_orden }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <br>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-12 d-md-flex justify-content-md-end">
                        @can('181-div-edit-agregar-evidencia-equipo')
                        <div class="form-check replicar" id="checkVerCerrar">
                            <input class="form-check-input" type="checkbox" value="" id="checkCerrar" name="checkCerrar">
                            <label class="form-check-label" for="checkCerrar">
                                Desea cerrar el Equipo/Servicio
                            </label>
                        </div>
                        @endcan
                    </div>
                </div>
                <div id="divEditEqui">
                <div class="row">
                    <div class="col-6" style="text-align:center;  background-color:#ab0033;">
                        <span style="color:white;">Editar Equipo/Servicio</span>
                    </div>
                    <div class="col-6" style="text-align:center; border-bottom:3px solid #ab0033;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <br> 
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-12 d-md-flex justify-content-md-end">
                        <div class="form-check replicar" id="checkVerCerrar">
                            <input class="form-check-input" type="checkbox" value="" id="checkCerrar" name="checkCerrar">
                            <label class="form-check-label" for="checkCerrar">
                                Desea cerrar el Equipo
                            </label>
                        </div>
                    </div> 
                </div>-->
                    <form id="formEditarEquipo" name="formEditarEquipo" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <!--<label for="estatus_id">Usuario Cancela</label>
                                <input type="text" id="txtUsuarioCancela" name="txtUsuarioCancela" class="form-control" value="ATENCION DE USUARIOS">-->
                                    <input type="hidden" id="hdIdEquipoM" name="hdIdEquipoM" class="form-control">
                                    <input type="hidden" id="hdIdSolServM" name="hdIdSolServM" class="form-control">
                                    <input type="hidden" id="hdIdTipoEquipo" name="hdIdTipoEquipo" class="form-control">
                                    <!-- <input type="hidden" id="hdIdEstatusCierra" name="hdIdEstatusCierra" class="form-control">  -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="txtDescripcionSoporteM">DESCRIPCIÓN DEL PROBLEMA</label>
                                    <textarea class="form-control" id="txtDescripcionSoporteM" name="txtDescripcionSoporteM" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txtEtiquetaM">ETIQUETA</label>
                                    <input type="text" id="txtEtiquetaM" name="txtEtiquetaM" class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txtDetalleEquipoM">DETALLE</label>
                                    <input type="text" id="txtDetalleEquipoM" name="txtDetalleEquipoM" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txtUbicacionM">UBICACIÓN</label>
                                    <input type="text" id="txtUbicacionM" name="txtUbicacionM" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-4">
                                <label for="txtEtiquetaM">ETIQUETA</label>
                                <input type="text" id="txtEtiquetaM" name="txtEtiquetaM" class="form-control">
                            </div> -->
                            <div class="col-4">
                                <div class="form-group">
                                        <label for="selTipoServicioM">ÁREA DE SERVICIO</label>
                                    <!--<select class="form-select" aria-label="Default select example" id="selDepAtiende" name="selDepAtiende" >
                                        <option value="0" selected>Seleccionar</option>
                                    </select> -->

                                    <div class="input-group">
                                        <select class="form-select" id="selTipoServicioM" name="selTipoServicioM" aria-label="Example select with button addon" onchange="cargaTarea()">
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
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="selTareaM">TIPO DE TAREA</label>
                                    <!-- <select class="form-select" aria-label="Default select example" id="selTarea" name="selTarea" >
                                        <option value="0" selected>Seleccionar</option>
                                    </select> -->
                                    <div class="input-group">
                                        <!-- <select class="form-select" id="selTareaM" name="selTareaM" aria-label="Example select with button addon">
                                            <option value="0" selected>Seleccionar</option>
                                        </select> -->
                                        <select class="selectpicker" data-width="100%" data-size="4" id="selTareaM" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" title="Seleccionar" multiple aria-label="size 3 select example" placeholder>

                                        </select>
                                        <!-- <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTareaM"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button> -->
                                    </div>
                                </div>
                                <!-- <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                    <span>LISTADO DE TAREAS</span>
                                    <ul id="ulTarea">
                                        
                                    </ul>
                                </div> -->
                            </div>
                            <div class="col-1" style="padding-bottom:5px;">
                                <div class="form-group">
                                    <br>
                                    @can('180-btn-edit-agregar-tarea-equipo')
                                    <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTareaM"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 scrollVerticalEdiE" id="divEquiposReal">
                                <span id="tituloTareasM"></span>
                                <ul id="ulTareaM" style="font-size:0.75rem;">
                                    
                                </ul>
                            </div>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            <br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="text-align:right;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                @can('182-btn-upd-equipo')
                                <button type="button" class="btn colorBtnPrincipal" onclick="fnActualizarEquipo()" id="btnActualizarEquipo">Actualizar</button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div> 
            </div> 
            @can('181-div-edit-agregar-evidencia-equipo')
            <div id="divCerrarEquipo">
                    <form id="formCerrarEquipo" name="formCerrarEquipo" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                <span style="color:white;">Cierre de Equipo/Servicio</span>
                            </div>
                            <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" id="hdIdEquipoMC" name="hdIdEquipoMC" class="form-control">
                                    <input type="hidden" id="hdIdSolServMC" name="hdIdSolServMC" class="form-control">
                                    <br>
                                    <label for="txtDiagnosticoM">DIAGNÓSTICO</label>
                                    <textarea class="form-control" id="txtDiagnosticoM" name="txtDiagnosticoM" rows="3" placeholder="Capture el diagnóstico detectado en el equipo revisado."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="txtSolucionM">SOLUCIÓN</label>
                                    <textarea class="form-control" id="txtSolucionM" name="txtSolucionM" rows="3" placeholder="Capture la solución/reparación llevada a cabo en el equipo."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <br>
                                    <label for="archivoCierreEquipo">AGREGAR EVIDENCIA (Anexe fotografía del equipo/servicio reparado).</label>
                                    <input class="form-control" type="file" id="archivoCierreEquipo" name="archivoCierreEquipo">
                                    <br>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                <div class="form-group">
                                    <div class="form-check replicar d-md-flex justify-content-md-end">
                                        <input class="form-check-input" type="checkbox" value="" id="checkEs_funcionalMC" name="checkEs_funcionalMC">
                                        <label style="font-weight: normal;" for="checkEs_funcionalMC">
                                            ¿Es funcional?
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-12 d-md-flex justify-content-md-start">
                                <div class="form-check replicar">
                                    <input class="form-check-input" type="checkbox" value="" id="checkEs_funcionalMC" name="checkEs_funcionalMC">
                                    <label class="form-check-label" for="checkEs_funcionalMC">
                                        Active casilla si el equipo/servicio quedó en funcionamiento 
                                    </label>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-12">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="text-align:right;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn colorBtnPrincipal" onclick="fnCerrarEquipo()" id="btnCerrarEquipo">Cerrar Equipo/Servicio</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endcan
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

  <!--multicheck JC-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- <link href="{{ asset('css/bootstrap-select_1.14.0-beta2_css_bootstrap-select.min.css') }}" rel="stylesheet" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="{{ asset('js/bootstrap-select_1.14.0-beta2_js_bootstrap-select.min.js') }}" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <!--multicheck JC-->
<script>
    let arrTareas = [];
    let arrServicios = [];
    var arrEquipos = [];
    let arrEscuelaTurno = [];
    let arrTareasEdit = [];
    let arrEquiposElim = [];
    let arrTareasEditElim = [];
    var arrEquiposAux = [];
    var selected12 = []; //JC//edit
    var selected13 = []; //JC//editTareaEquipo
    // var equipo_servicio = {
    //             nom_equipo: '',
    //             num_inventario: '',
    //             servicios_equipo: []
    //         };

    $(document).ready(function () {
        var hdsol=$("#txtIdSolic").val();
        console.log(hdsol);  
        // fnValidaRecarga(hdsol); 

        $('.selectpicker').attr('disabled',true); //JC
        $('.selectpicker').selectpicker('refresh');  //JC

        $("#txtEtiquetaServicio").prop('disabled',true);
        
        //Para que deje navegar desde las pestañas peticio junta sub Jose Luis (junta Direc)
        $("#tab1").attr('class', 'nav-link');
        $("#tab1").tab('show');
        $("#tab2").attr('class', 'nav-link');
        $("#tab3").attr('class', 'nav-link');
        //

        //load();
        // $("#divTablaEquipos").hide()

        // $("#btnSiguiente").hide()
        // $("#btnSiguiente").prop('disabled', true);
        // $("#divCantidad").hide()
        var rolTec=$("#rolTec").val();
        if(rolTec==1){
            // $("#selTipoOrden").prop('disabled',true);
            // $("#selDepAtiende").prop('disabled',true);
            // $("#txtNombreSolicitante").prop('disabled',true);
            // $("#txtTelefonoSolicitante").prop('disabled',true);
            // $("#txtCorreoSolicitante").prop('disabled',true);
            // $("#txtDescripcionReporte").prop('disabled',true);
        }else{
            // $("#selTipoOrden").prop('disabled',false);
            // $("#selDepAtiende").prop('disabled',false);
            // $("#txtNombreSolicitante").prop('disabled',false);
            // $("#txtTelefonoSolicitante").prop('disabled',false);
            // $("#txtCorreoSolicitante").prop('disabled',false);
            // $("#txtDescripcionReporte").prop('disabled',false);
        }

        fnConsEquipos();
        $("#selTipoServicio").prop('disabled',true); ///////28_08_2023
        $("#selTarea").prop('disabled',true); ///////28_08_2023

        $('#checkCerrar').click(function(){
            if ($(this).is(':checked') ) {
                $("#divEditEqui").hide();
                // $("#hdIdEquipoMC").val("");
                // $("#hdIdSolServMC").val("");
                $("#txtDiagnosticoM").val("");
                $("#txtSolucionM").val("");
                $("#archivoCierreEquipo").val("");
                $("#checkEs_funcionalMC").prop("checked", false);
                $("#divCerrarEquipo").show();
            } else {
                $("#divCerrarEquipo").hide();
                $("#divEditEqui").show();
            }
        });

        $("#btnAgregarTarea").prop('disabled',true);
        $("#btnAgregarEquipo").hide();

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
            var vhdNombreSolicitante= $("#hdNombreSolicitante").val();
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
                msjeAlerta('', 'Debe ingresar el nombre del solicitante', 'error');
            }

            if(vTelefonoSolicitante==''){
                msjeAlerta('', 'Debe ingresar el teléfono del solicitante', 'error');
            }

            if(vTelefonoSolicitante.length<10){
                msjeAlerta('', 'Debe ingresar 10 números en teléfono', 'error');
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
            && vDescripcionReporte!='' && vTelefonoSolicitante.length==10 ){
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

        $("#tab3").click(function(){
            var vId_TipoOrden= $("#selTipoOrden").val();
            var vTipoOrden= $('select[id="selTipoOrden"] option:selected').text();

            var vId_DepAtiende= $("#selDepAtiende").val();
            var vDepAtiende= $('select[id="selDepAtiende"] option:selected').text();

            var vNombreSolicitante= $("#txtNombreSolicitante").val();
            var vhdNombreSolicitante= $("#hdNombreSolicitante").val();
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
                msjeAlerta('', 'Debe ingresar el nombre del solicitante', 'error');
            }

            if(vTelefonoSolicitante==''){
                // msjeAlerta('', 'Debe ingresar el teléfono del solicitante', 'error');
                msjeAlerta('', 'Favor de ingresar un número de teléfono válido', 'error');
            }

            if(vTelefonoSolicitante.length<10){
                // msjeAlerta('', 'Debe ingresar 10 números en teléfono', 'error');
                msjeAlerta('', 'Favor de ingresar un número de teléfono válido', 'error');
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
            && vDescripcionReporte!='' && vTelefonoSolicitante.length==10 ){
                $("#tab3").attr('class', 'nav-link');
                $("#tab3").tab('show');
            }else{
                $("#tab2").attr('class', 'nav-link');
                $("#tab2").tab('show');
            }
        });

        $("#checkReplicar").change(function() {  
            if($("#checkReplicar").is(':checked')) {  
                // $("#divCantidad").show();
            } else {  
                // $("#divCantidad").hide();
                // $("#divCantidad").val("1");
                arrTareas=[];
                $("#tbTarea").remove();
                $("#selTipoEquipo").val("0").attr("selected",true);
                $("#selTipoServicio").val("0").attr("selected",true);
                $("#selTarea").val("0").attr("selected",true);
                $("#txtDetEquipo").val("");
                $("#txtCantidadEquipos").val(1);
                $("#txtEtiquetaServicio").val("");
                $("#txtMarca").val("");
                $("#txtModelo").val(""); 
                $("#txtNumeroSerie").val(""); 
                $("#txtDescripcionSoporte").val(""); 
                $("#txtUbicacionEquipo").val(""); 
            }  
        });  

        $("#checkSolicitante").change(function() {  
            if($("#checkSolicitante").is(':checked')) {  
                var vDirector = $("#txtDirectorCCT").val();
                 $("#txtNombreSolicitante").val(vDirector);
                 $("#txtNombreSolicitante").prop('disabled', true);
            } else {  
                var vhdNombreSolicitante= $("#hdNombreSolicitante").val();
                 $("#txtNombreSolicitante").val(vhdNombreSolicitante);
                 $("#txtNombreSolicitante").prop('disabled', false);
            }  
        });  

        $("#txtCantidadEquipos").change(function() {  
            cant=$("#txtCantidadEquipos").val();
            if(cant > 1) {  
                //  $(".divEtiqueta").hide();
                $("#txtEtiquetaServicio").prop('disabled', true);
                 $("#checkVer").hide();
            } else {  
                //  $(".divEtiqueta").show();
                $("#txtEtiquetaServicio").prop('disabled', false);
                $("#checkVer").show();
            }  

            $("#txtEtiquetaServicio").val('');
            $("#txtDetEquipo").val('');
            $("#txtMarca").val('');
            $("#txtModelo").val('');
            $("#txtNumeroSerie").val('');
        });  
    
        var tablaEquipo='';
        var i=0;
        // var arrEquipos = [];
        $("#btnAgregarEquipo").click(function(){
             var bandCheck='';
            // $("#checkReplicar").click(function() {  
                if($("#checkReplicar").is(':checked')) {  
                    bandCheck=1;
                    console.log(bandCheck+'---1');
                } else {  
                    bandCheck=0;
                    console.log(bandCheck+'---2');
                }  
            // }); 

            console.log(bandCheck+'---3');

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
            // console.log(arrTareas);

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
                    id_equipo_serv_solic : 0,
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
                    fecha_cierre : null,
                    // aServicio : arrServicios /// arreglo servicios
                });
                console.log(arrEquipos,'-----fff');
                //  arrTareas=[];
                drawRowEquipo();
                i=i+1;
                console.log(bandCheck+'---34');
                if(bandCheck==0){
                    arrTareas=[];
                    $("#tbTarea").remove();
                    $("#selTipoEquipo").val("0").attr("selected",true);
                    $("#selTipoServicio").val("0").attr("selected",true);
                    $("#selTarea").val("0").attr("selected",true);
                    $("#txtDetEquipo").val("");
                    $("#txtCantidadEquipos").val("");
                    $("#txtEtiquetaServicio").val("");
                    $("#txtMarca").val("");
                    $("#txtModelo").val(""); 
                    $("#txtNumeroSerie").val(""); 
                    $("#txtDescripcionSoporte").val(""); 
                    $("#txtUbicacionEquipo").val(""); 
                    console.log(bandCheck+'---5');
                 }
            }
            $("#txtCantidadEquipos").val(1);
            $("#tituloTareas").text('');
            $("#selTipoServicio").val("0").attr("selected",true);
            $("#txtEtiquetaServicio").prop('disabled',false);
            $("#checkVer").show();
            $("#selTipoServicio").prop('disabled',true); ///////28_08_2023
            // $("#selTarea").prop('disabled',true); ///////28_08_2023
            $('.selectpicker').attr('disabled',true); //JC
            $('.selectpicker').selectpicker('refresh');  //JC

            $("#txtEtiquetaServicio").prop('disabled', false);
            // $("#divRowListadoTareas").hide();
            console.log(bandCheck+'---6');
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
            var banderatarea=0;//JC

            $("#selTipoEquipo").prop('disabled',true);

            vtipEqu= $("#selTipoEquipo").val();

            vTarea = $("#selTarea").val();
            vTareaText = $('select[id="selTarea"] option:selected').text();
            
            var element_prueba='';//JC
            var element_idServ='';//JC
            for (let index = 0; index < vTarea.length; index++) {//JC
                var element_prueba = vTarea[index];//JC
            }//JC

            vTipoServicio = $("#selTipoServicio").val();
            vTipoServicioText = $('select[id="selTipoServicio"] option:selected').text();
            element_idServ = vTipoServicio;

            for (let i = 0; i < arrTareas.length; i++) {//JC
                // console.log(selected12[i]['id']);
                // console.log(element_prueba);
                if (arrTareas[i]['idServicio'] == element_idServ && arrTareas[i]['idTarea'] == element_prueba) {
                    banderatarea = 1;
                }
            }//JC

            if (banderatarea ==1) {//JC
                msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')//JC
            }//JC
            
            // if(vtipEqu !=0){
            //     if(vTipoServicio !=0){
                    else if(vTarea != 0){
                    
                        var index = arrTareas.findIndex(e => e.idTarea === vTarea);

                        if(index == -1){
                            for (let i = 0; i < selected12.length; i++) {//JC
                              // selected.push({id:$(this).val(), texto:$(this).text()});
                              // const element = selected12[i]['id'];
                              arrTareas.push({cont:g, idTarea:selected12[i]['id'], desc_Tarea:selected12[i]['texto'],
                                idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});
                            }//JC
                            // arrTareas.push({cont:g, idTarea:vTarea, desc_Tarea:vTareaText, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText});
                            drawRowTarea();
                            // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareas});
                            g=g+1;
                            $('.selectpicker').selectpicker('refresh');//JC
                        }else{
                            $("#selTarea").val("0").attr("selected",true);
                            msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')
                        }
                    }else{
                        msjeAlerta('', 'Debe seleccionar la Tarea', 'error')
                    }
                    
                // }else{
            //         msjeAlerta('', 'Debe seleccionar el Servicio', 'error')
            //     }
            // }else{
            //     msjeAlerta('', 'Debe seleccionar el Tipo de Equipo', 'error')
            // }
            // $("#selTipoServicio").val("0").attr("selected",true);  //resetear servicio cada que agrega una tarea
        });

        $('#selTipoEquipo').on('change', function() { /// Cargar select Tarea en base a Servicio
            if(this.value==1){
                $("#txtEtiquetaServicio").val('');
                $("#txtEtiquetaServicio").prop('disabled',true);
                $("#txtDetEquipo").val('');  
            }else{
                $("#txtEtiquetaServicio").prop('disabled',false);
            }
            arrTareas=[];
            $("#divListaTarea").removeClass('scrollVerticalTareas');
            $("#tituloTareas").text('');
            $("#ulTarea").empty();

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
                    $("#selTipoServicio").prop('disabled',false); ///////28_08_2023
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
                    // var htmlSel='<option value="0" selected>Seleccionar</option>';
                    var htmlSel='';
                    for (var i = 0; i < data[0].length; i++) {
                        htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                    }

                    $("#selTarea").html(htmlSel);
                    // $("#selTarea").prop('disabled',false); ///////28_08_2023
                    $('.selectpicker').attr('disabled',false); //JC
                    $('.selectpicker').selectpicker('refresh');  //JC
                }
            });
            
        });

        $('#selTarea').on('change', function() {
            var vSelTarea=  $('#selTarea').val();
            if(vSelTarea==0){
                $("#btnAgregarTarea").prop('disabled',true);
            }else{
                $("#btnAgregarTarea").prop('disabled',false);
            }

            ///JC
             var options = $('#selTarea option:selected');
            var selected = [];
            
            $(options).each(function(){
                selected.push({id:$(this).val(), texto:$(this).text()}); 
                // or $(this).val() for 'id'
            });
            selected12 = selected;
            // write value to some field, etc
            console.log(selected);
            //JC
        });

        $("#txtEtiquetaServicio").keyup(function(){
            var vEtiqueta = $("#txtEtiquetaServicio").val();
            if(vEtiqueta!=''){
                // $("#txtMarca").val("DELL");
                // $("#txtModelo").val("12345");
                // $("#txtSerie").val("02325652");
                $("#txtMarca").val("S/D");
                $("#txtModelo").val("S/D");
                $("#txtSerie").val("S/D");
                // $("#txtDetEquipo").val('Marca:DELL - MODELO:12345 - NÚMERO DE SERIE:02325652');////ws
                $("#txtDetEquipo").val('Marca:S/D - MODELO:S/D - NÚMERO DE SERIE:S/D');
            }
        });

        // $('#selTipoServicioM').on('change', function() { /// Cargar select Tarea en base a Servicio
        //     var vtipEquipo=  $('#hdIdTipoEquipo').val();
        //     var serv= this.value;

        //     if(serv !=0){
        //         let urlEditar = '{{ route("consTarea") }}';
        //         // urlEditar = urlEditar.replace(':idserv', this.value);

        //         $("#selTareaM").val("0").attr("selected",true);
        //         let element = document.getElementById("selTareaM");
        //         element.value = '0';

        //         $.ajax({
        //             url: urlEditar,
        //             type: 'POST',
        //             data:{idequi:vtipEquipo , idserv:serv},
        //             dataType: 'json', 
        //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //             success: function(data) {
        //                 //  console.log(data[0][0]);
        //                 var htmlSel='<option value="0" selected>Seleccionar</option>';
        //                 for (var i = 0; i < data[0].length; i++) {
        //                     htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
        //                 }

        //                 $("#selTareaM").html(htmlSel);
        //             }
        //         });
        //     }else{
        //         console.log('no selecciono un servicio');
        //     }
        // });

        var listaTareaM='';
        var gM=0;
        var vTareaM = 0;
        var vTareaTextM = '';
        $("#btnAgregarTareaM").click(function(){
            // if(arrTareas.length==0){
            //     g=0;
            //     listaTarea='';
            //     $("#ulTarea").html('');
            // }
            var banderatarea=0;//JC

            vtipEqu= $("#hdIdTipoEquipo").val();

            vTareaM = $("#selTareaM").val();
            vTareaTextM = $('select[id="selTareaM"] option:selected').text();

            var element_prueba='';//JC
            var element_idServ='';
            for (let index = 0; index < vTareaM.length; index++) {//JC
                var element_prueba = vTareaM[index];//JC
            }//JC

            vTipoServicio = $("#selTipoServicioM").val();
            vTipoServicioText = $('select[id="selTipoServicioM"] option:selected').text();
            element_idServ = vTipoServicio;

            for (let i = 0; i < arrTareasEdit.length; i++) {//JC
                // console.log(selected12[i]['id']);
                // console.log(element_prueba);
                if (arrTareasEdit[i]['idServicio'] == element_idServ && arrTareasEdit[i]['idTarea'] == element_prueba) {
                    banderatarea = 1;
                }
            }//JC

            if (banderatarea ==1) {//JC
                msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaText, 'error')//JC
                $('.selectpicker').selectpicker('refresh');  //JC
                $('.selectpicker').attr('disabled',true); //JC
                $("#btnAgregarTareaM").prop('disabled',true); ///////28_08_2023
            }//JC
            
            // if(vtipEqu !=0){
            //     if(vTipoServicio !=0){
                    else if(vTareaM != 0){
                        console.log(arrTareasEdit);
                        // console.log($.inArray(vTipoServicio, arrTareasEdit.id_servicio) );
                        // var indice = arrTareasEdit.indexOf(vTareaTextM);
                        // console.log(Validar_Array(vTareaM, vTipoServicio, arrTareasEdit));
                        var bancde=Validar_Array(vTareaM, vTipoServicio, arrTareasEdit); ///Validar si existe ya Tarea
                        // if(arrTareasEdit.includes(vTareaTextM)){
                        if(bancde==true){ ///Validar si existe ya Tarea
                            $("#selTareaM").val("0").attr("selected",true);
                            msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaTextM, 'error')//Checar
                            $('.selectpicker').selectpicker('refresh');  //JC
                            $('.selectpicker').prop('disabled',true); //JC
                            $("#selTareaM").prop('disabled',true); 
                            $("#btnAgregarTareaM").prop('disabled',true); ///////28_08_2023
                        }else{
                            var index = arrTareasEdit.findIndex(e => e.id_tarea === vTareaM);
                            // console.log(index);
                            if(index == -1){

                                for (let i = 0; i < selected13.length; i++) {//JC
                                    arrTareasEdit.push(
                                    {   
                                        id_equipo_detalle: 0,
                                        id_equipo_tarea: 0,
                                        id_equipos_serv: 0,
                                        id_usuario_agrega: '',
                                        fecha_agrega: '',
                                        id_tipo_equipo: vtipEqu,
                                        tipo_equipo: '',
                                        id_servicio: vTipoServicio,
                                        servicio: vTipoServicioText,
                                        id_tarea: selected13[i]['id'], 
                                        tarea: selected13[i]['texto'],
                                        activo: false
                                    });
                                }//JC
                                // arrTareasEdit.push(
                                //     {   
                                //         id_equipo_detalle: 0,
                                //         id_equipo_tarea: 0,
                                //         id_equipos_serv: 0,
                                //         id_usuario_agrega: '',
                                //         fecha_agrega: '',
                                //         id_tipo_equipo: vtipEqu,
                                //         tipo_equipo: '',
                                //         id_servicio: vTipoServicio,
                                //         servicio: vTipoServicioText,
                                //         id_tarea: vTareaM,
                                //         tarea: vTareaTextM,
                                //         activo: false
                                //     });
                                drawRowTareaEdit();
                                // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareasEdit});
                                gM=gM+1;
                                // $('.selectpicker').selectpicker('refresh');//JC
                                $("#selTipoServicio").val("0").attr("selected",true);
                                // $("#selTarea").prop('disabled',true); ///////28_08_2023
                                
                                $('.selectpicker').selectpicker('refresh');  //JC
                                $('.selectpicker').attr('disabled',true); //JC
                                $("#btnAgregarTareaM").prop('disabled',true); ///////28_08_2023
                            }else{
                                $("#selTareaM").val("0").attr("selected",true);
                                msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaTextM, 'error')
                                
                            }
                        }
                        // var index = arrTareasEdit.findIndex(e => e.id_tarea === vTareaM);
                        // // console.log(index);
                        // if(index == -1){
                        //     arrTareasEdit.push(
                        //         {   //cont:g, 
                        //             // idTarea:vTareaM, 
                        //             // desc_Tarea:vTareaTextM, 
                        //             // idServicio:vTipoServicio, 
                        //             // desc_Servicio:vTipoServicioText
                        //             id_equipo_detalle: 0,
                        //             id_equipo_tarea: 0,
                        //             id_equipos_serv: 0,
                        //             id_usuario_agrega: '',
                        //             fecha_agrega: '',
                        //             id_tipo_equipo: vtipEqu,
                        //             tipo_equipo: '',
                        //             id_servicio: vTipoServicio,
                        //             servicio: vTipoServicioText,
                        //             id_tarea: vTareaM,
                        //             tarea: vTareaTextM,
                        //             activo: 0
                        //         });
                        //     drawRowTareaEdit();
                        //     // arrServicios.push({cont:g, idServicio:vTipoServicio, desc_Servicio:vTipoServicioText, aTarea:arrTareasEdit});
                        //     gM=gM+1;
                        // }else{
                        //     $("#selTareaM").val("0").attr("selected",true);
                        //     msjeAlerta('', 'Ya fue seleccionada la tarea '+vTareaTextM, 'error')
                        // }
                    }else{
                        msjeAlerta('', 'Debe seleccionar la Tarea', 'error')
                    }
                    
            //     }else{
            //         msjeAlerta('', 'Debe seleccionar el Servicio', 'error')
            //     }
            // }else{
            //     msjeAlerta('', 'Debe seleccionar el Tipo de Equipo', 'error')
            // }
            $("#selTipoServicioM").val("0").attr("selected",true);  //resetear servicio cada que agrega una tarea
        });

        $('#archivoCierreEquipo').change( function() {
            // console.log(this.files[0].size);
            if(this.files[0].size > 512000) { // 512000 bytes = 500 Kb
                $(this).val('');   
                msjeAlerta('','Favor de seleccionar un archivo jpg, png que no rebase los 500 Kb','error');
                // $('#errores').html("El archivo supera el límite de peso permitido.");
            } else { //ok
                var formato = (this.files[0].name).split('.').pop();
                // console.log(formato);
                //alert(formato);
                if(formato.toLowerCase() != 'jpg' && formato.toLowerCase() != 'png') {
                    $(this).val('');
                    msjeAlerta('','Favor de seleccionar un archivo tipo jpg, png','error');
                } 
            }
        });

        $('#btnCancelarS1').click( function() {
            var idSolServ = $("#txtIdSolic").val();
            fnUpdAcceso(idSolServ, false, 1);
            window.location.href  = '{{ route("listadoOrdenes") }}';
        });

        $('#btnCancelarS2').click( function() {
            var idSolServ = $("#txtIdSolic").val();
            fnUpdAcceso(idSolServ, false, 1);
            window.location.href  = '{{ route("listadoOrdenes") }}';
        });

        $('#btnCancelarS3').click( function() {
            var idSolServ = $("#txtIdSolic").val();
            fnUpdAcceso(idSolServ, false, 1);
            window.location.href  = '{{ route("listadoOrdenes") }}';
        });
    });

    $('#selTareaM').on('changed.bs.select', function (e) {
        ///JC
        var options = $('#selTareaM option:selected');
        var selected = [];
        
        $(options).each(function(){
            selected.push({id:$(this).val(), texto:$(this).text()}); 
            // or $(this).val() for 'id'
        });
        selected13 = selected;
        // write value to some field, etc
        console.log(selected);
        //JC
        $("#btnAgregarTareaM").prop('disabled',false); ///////28_08_2023
    });
 
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

    function removeEquipo( item ) {
        var titulo='';
        var contenido='<p style="font-size:1rem !important;">¿Está seguro de eliminar el registro?</p>';
        var icono='warning'; 

        Swal.fire({
            title: titulo,
            html: contenido,
            icon: icono,
            showCancelButton: true,
            confirmButtonColor: '#b50915',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            width: 600,
            }).then((result) => {
            if (result.isConfirmed) {

                if(arrEquipos.includes(item) ==false){ 
                    if ( item !== -1 ) {
                        if (arrEquipos[item].nuevo==0){ //Si viene de BD se mete en un arreglo temporal ya que estos se eliminaran de bd
                            arrEquiposElim.push({
                                id_equipo_serv_solic : arrEquipos[item].id_equipo_serv_solic, 
                            });
                        }
                        
                        console.log(arrEquiposElim);
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
        });
        
    }

    function drawRowEquipo(){
        var tablaEquipo2 = '';
        
        $.each(arrEquipos, function(j, val){
            if (!jQuery.isEmptyObject(arrEquipos[j])) { 

                var vDatos='';
                if(arrEquipos[j]['cantidad'] > 1){
                    vDatos='';
                }else{
                    vDatos='Etiqueta:'+arrEquipos[j]['etiquetaServicio']+' - Marca: '+arrEquipos[j]['marca']+' - Modelo: '+arrEquipos[j]['modelo']+' - Número de Serie: '+arrEquipos[j]['numeroSerie'];
                }
        
            // tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+j+')">Ver</button></td><td>En Proceso</td>';
                tablaEquipo2+='<tr id="tr_'+j+'">';
                var conta=j+1;
                tablaEquipo2+='<td class="text-xs text-secondary mb-0" style="text-align:center">'+conta+'</td>';
                tablaEquipo2+='<td class="text-xs text-secondary mb-0" style="text-align:center">'+arrEquipos[j]['cantidad']+'</td>';
                tablaEquipo2+='<td class="text-xs text-secondary mb-0" style="text-align:center">'+arrEquipos[j]['desc_tipo_equipo'];
                if(arrEquipos[j].nuevo!=1){ //si es diferente a 1 viene de bd y muestra opcion de editar equipo
                    if(arrEquipos[j].fecha_cierre!=null){
                        tablaEquipo2+='<br><strong>Atendido</strong></td>';
                    }
                }else{
                    tablaEquipo2+='</td>';
                }
                tablaEquipo2+='<td class="text-xs text-secondary mb-0">'+arrEquipos[j]['descripcionSoporte']+'</td>';

                var aTarea = [];

                if(arrEquipos[j].nuevo==1){  //1 es igual equipo agregado nuevo
                     aTarea=arrEquipos[j]['aTarea'];
                }else{ // 0 es igual a que biene de BD
                    aTarea = JSON.parse(arrEquipos[j]['aTarea']);
                }
                console.log(aTarea);
                // var vtare='';
                // if( typeof(aTarea[j]['tarea']) != "undefined" && aTarea[j]['tarea'] !== null){
                //     vtare=aTarea[j]['tarea'];
                // }else{
                //     vtare=aTarea[j]['desc_Tarea'];
                // }
                var aux1='';
                var aux2='';
                tablaEquipo2+='<td class="text-xs text-secondary mb-0">';
                for (var i = 0; i < aTarea.length; i++) {
                    var vserv='';
                    if( typeof(aTarea[i]['servicio']) != "undefined" && aTarea[i]['servicio'] !== null){ 
                        if(aux1==aTarea[i]['servicio']){   /// esto era para que no se repitiera el servicio 09/08/2023
                            vserv='&nbsp;';
                            // aux='';
                        }else{
                            aux1=aTarea[i]['servicio']; 
                            vserv=aTarea[i]['servicio'];
                        }
                        // vserv=aTarea[i]['servicio'];
                    }else{
                        if(aux2==aTarea[i]['desc_Servicio']){   /// esto era para que no se repitiera el servicio 09/08/2023
                            vserv='&nbsp;';
                            // aux='';
                        }else{
                            aux2=aTarea[i]['desc_Servicio'];
                            vserv=aTarea[i]['desc_Servicio'];
                        }
                        // vserv=aTarea[i]['desc_Servicio'];
                    }
                    // tablaEquipo2+='- '+arrEquipos[j]['aTarea'][i]['desc_Servicio']+'<br>';
                    tablaEquipo2+=''+vserv+'<br>';
                }
                tablaEquipo2+='</td>';

                tablaEquipo2+='<td class="text-xs text-secondary mb-0">';
                for (var h = 0; h < aTarea.length; h++) {
                    var vtare='';
                    if( typeof(aTarea[h]['tarea']) != "undefined" && aTarea[h]['tarea'] !== null){
                        vtare=aTarea[h]['tarea'];
                    }else{
                        vtare=aTarea[h]['desc_Tarea'];
                    }
                    tablaEquipo2+='- '+vtare+'<br>';
                    //     tablaEquipo2+='- '+arrEquipos[j]['aTarea'][h]['desc_Tarea']+'<br>';
                }
                tablaEquipo2+='</td>';

                // tablaEquipo2+='<td class="text-xs text-secondary mb-0">'+vDatos+'</td>';
                tablaEquipo2+='<td style="text-align:center"><div class="dropdown btn-group dropstart">';
                tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "';
                tablaEquipo2+='                      data-bs-toggle="dropdown" id="opciones"';
                tablaEquipo2+='                       aria-haspopup="true" aria-expanded="false" >';
                tablaEquipo2+='                      <i class="fa fa-ellipsis-v text-xs"></i>';
                tablaEquipo2+='                  </button>';
                tablaEquipo2+='                  <ul class="dropdown-menu" aria-labelledby="opciones1">';
                if(arrEquipos[j].nuevo!=1){ //si es diferente a 1 viene de bd y muestra opcion de editar equipo
                    if(arrEquipos[j].fecha_cierre==null){
                        tablaEquipo2+='                          @can("178-opt-edit-equipo")<li>';
                        tablaEquipo2+='                              <a onclick="verDetalleEquipo('+j+')" class="dropdown-item"> ';
                        tablaEquipo2+='                                  <i class="fas fa-edit"></i> Editar Equipo/Servicio';
                        tablaEquipo2+='                              </a>';
                        tablaEquipo2+='                          </li>@endcan';
                    }
                }
                tablaEquipo2+='                          @can("183-opt-edit-get-equipo")<li>';
                tablaEquipo2+='                              <a onclick="verDetalleEquipoA('+j+')" class="dropdown-item"> '; 
                tablaEquipo2+='                                  <i class="fas fa-eye"></i> Visualizar';
                tablaEquipo2+='                              </a>';
                tablaEquipo2+='                          </li>@endcan';
                tablaEquipo2+='                          @can("175-opt-edit-get-historial-equipo")<li>';
                tablaEquipo2+='                              <a onclick="verHistorialEquipo('+j+')" class="dropdown-item"> ';
                tablaEquipo2+='                                  <i class="fas fa-book"></i> Historial'; //<!--web Service-->
                tablaEquipo2+='                              </a>';
                tablaEquipo2+='                          </li>@endcan';
                // tablaEquipo2+='                          @can("184-opt-edit-get-detalle-equipo")<li>';
                // tablaEquipo2+='                              <a onclick="verDetalleEquipoWS('+j+')" class="dropdown-item"> ';
                // tablaEquipo2+='                                  <i class="fas fa-eye"></i> Detalle'; //<!--web Service-->
                // tablaEquipo2+='                              </a>';
                // tablaEquipo2+='                          </li>@endcan';
                if(arrEquipos[j].fecha_cierre==null){ 
                    tablaEquipo2+='                      <li>';
                    tablaEquipo2+='                          <a  ';
                    tablaEquipo2+='                          onclick="removeEquipo('+j+');" class="dropdown-item" >';
                    tablaEquipo2+='                              <i class="fas fa-trash"></i> Eliminar';
                    tablaEquipo2+='                          </a>';
                    tablaEquipo2+='                      </li>';
                }
                tablaEquipo2+='                  </ul>';
                tablaEquipo2+='              </div></td>';
                tablaEquipo2+='</tr>';
            }
        });

        $("#selTipoEquipo").prop('disabled',false);
        $("#btnAgregarTarea").prop('disabled',true);
        $("#btnAgregarEquipo").hide();
        $("#divListaTarea").hide();

        $("#tbEquipos").empty();
        $("#tbEquipos").html(tablaEquipo2);
    }


    function removeTarea( item ) { 
        if(arrTareas.includes(item) ==false){ 
            if ( item !== -1 ) {
                arrTareas.splice( item, 1 );
                // console.log(arrTareas);
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

        listaTarea2+='<table class="table" style="font-size:0.75rem;" id="tbTarea">';
        listaTarea2+='<thead>';
        listaTarea2+='<th>Área de Servicio</th>';
        listaTarea2+='<th>Tarea</th>';
        listaTarea2+='<th>Eliminar</th>';
        listaTarea2+='</thead>';
        listaTarea2+='<tbody>';

        // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
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
                // listaTarea2+='<td>'+arrTareas[j]['desc_Servicio']+'&nbsp;</td>';
                listaTarea2+='<td> - '+arrTareas[j]['desc_Tarea']+'</td>';
                // class="btn colorBtnPrincipal"
                listaTarea2+='<td><button type="button" class="btnEliminar" onclick="removeTarea('+j+');" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                listaTarea2+='<tr>';
            }
        });

        listaTarea2+='</tbody>';
        listaTarea2+='</table>';

        $("#btnAgregarEquipo").show();
        $("#divListaTarea").show();

        if(listaTarea2!=''){
            $("#divListaTarea").addClass('scrollVerticalTareas');
        }else{
            $("#divListaTarea").removeClass('scrollVerticalTareas');
        }

        $("#ulTarea").empty();
        $("#tituloTareas").text('LISTADO DE ÁREAS DE SERVICIO/TAREAS ');
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

    function msjeAlerta2(titulo, contenido, icono, id_solic_serv){

        let urlEditar = '{{ route("download-pdf", ":id") }}';
        urlEditar = urlEditar.replace(':id', id_solic_serv);
        // console.log(urlEditar);
        Swal.fire({
            title: titulo,
            html: contenido,
            icon: icono,
            showCancelButton: true,
            showConfirmButton: false,
            confirmButtonColor: '#b50915',
            cancelButtonColor: '#d33', 
            // confirmButtonText: '<i class="fas fa-download"></i>&nbsp;Descargar orden',
            cancelButtonText: 'Aceptar',
            width: 600,
            allowOutsideClick: false,
            }).then((result) => {
            if (result.isConfirmed) {
                window.open(urlEditar, '_blank');
                // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank'); 
                window.location.href = '{{ route("listadoOrdenes") }}';
                // download-pdf
            }else{
                window.location.href = '{{ route("listadoOrdenes") }}';
            }
        });
    }

    function msjeAlertConfirm(titulo, contenido, icono){
        var titulo='';
        var contenido='<p style="font-size:1rem !important;">¿Está seguro de editar la orden de servicio?</p>';
        var icono='warning';
        
        Swal.fire({
            title: titulo,
            html: contenido,
            icon: icono,
            showCancelButton: true,
            confirmButtonColor: '#b50915',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            width: 600,
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

                fnGuardar();
            }else{
                //fnUpdAcceso(idSolicServ, false, 1);
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
                            console.log(data[0][i].jstareas);
                            arrEquipos.push({
                            con : i,
                                id_equipo_serv_solic : data[0][i].id_equipo_serv_solic,
                                id_tipo_equipo : data[0][i].id_tipo_equipo, 
                                desc_tipo_equipo : data[0][i].tipo_equipo, 
                                etiquetaServicio : data[0][i].etiqueta,
                                marca : '',
                                modelo : '', 
                                numeroSerie : '',
                                descripcionSoporte : data[0][i].desc_problema,
                                ubicacionEquipo : data[0][i].ubicacion,
                                cantidad : data[0][i].cantidad,
                                estatus_equipo : 1, 
                                nuevo : 0, 
                                aTarea : data[0][i].jstareas, ///arreglo tareas
                                fecha_cierre : data[0][i].fecha_cierre,
                            // aServicio : arrServicios /// arreglo servicios
                            })
                        }
                    });
                      ////////regresa json CACHAR JSON QUE REGRESA FUNCION

                    if(arrEquiposAux !='' || arrEquiposAux !=null || arrEquiposAux.length!=0){

                        $.each(arrEquiposAux, function(j, val){
                            if (!jQuery.isEmptyObject(arrEquiposAux[j])) {
                                // console.log(data[0][i]);
                                if(arrEquiposAux[j].nuevo==1){
                                    arrEquipos.push({
                                    con : j,
                                        id_equipo_serv_solic : arrEquiposAux[j].id_equipo_serv_solic,
                                        id_tipo_equipo : arrEquiposAux[j].id_tipo_equipo, 
                                        desc_tipo_equipo : arrEquiposAux[j].desc_tipo_equipo, 
                                        etiquetaServicio : arrEquiposAux[j].etiquetaServicio,
                                        marca : '',
                                        modelo : '', 
                                        numeroSerie : '',
                                        descripcionSoporte : arrEquiposAux[j].descripcionSoporte,
                                        ubicacionEquipo : arrEquiposAux[j].ubicacionEquipo,
                                        cantidad : arrEquiposAux[j].cantidad,
                                        estatus_equipo : 1, 
                                        nuevo : 1, 
                                        aTarea : arrEquiposAux[j].aTarea, ///arreglo tareas
                                        fecha_cierre : null,
                                    });
                                }
                            }
                        });
                    }
                    drawRowEquipo();
                }else{

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
                            
                            var divH='<button class="btn btn-secondary" type="button" id="btnHistorialCCT"  onclick="fnHistorial()">Historial</button>';
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
                                        htmlHist+='<td><div class="dropdown btn-group dropend">';
                                        htmlHist+='<button class="btn btn-link text-secondary mb-0 "';
                                        htmlHist+='data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >';
                                        htmlHist+='<i class="fa fa-ellipsis-v text-xs"></i></button>';
                                        htmlHist+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                                        htmlHist+='<li>';
                                        htmlHist+='<a onclick="fnVerOrdenCentro('+data[1][j].id_orden+')" class="dropdown-item"> ';
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
                                $("#txtCentroTrabajo").val('');
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
        var folio= $("#txtNumFolio").val();
        var idSolicServ= $("#txtIdSolic").val();
        let urlEditar = '{{ route("actualizarOrden") }}'; 
        // urlEditar = urlEditar.replace(':claveCCT', claveCCT);
       
        var checkDirector='';
        var nombreSol='';
        if($("#checkSolicitante").is(':checked')) {  
            checkDirector= true;
            nombreSol=$("#txtDirectorCCT").val();
        } else {  
            checkDirector= false;
            var vhdNombreSolicitante =$("#txtNombreSolicitante").val();
            nombreSol=vhdNombreSolicitante;
            nombreSol=$("#txtNombreSolicitante").val();
        }  

        if($("#checkSeguimiento").is(':checked')) {  
            checkSeguimiento= true;
        } else {  
            checkSeguimiento= false;
        }  

        var form = $('#formOrden')[0];
         // FormData object 
         var data2 = new FormData(form);
        data2.append('arrEquipos', JSON.stringify(arrEquipos));
        data2.append('arrEquiposElim', JSON.stringify(arrEquiposElim));
        data2.append('checkDirector', JSON.stringify(checkDirector));
        data2.append('nombreSol', JSON.stringify(nombreSol)); 
        data2.append('checkSeguimiento', JSON.stringify(checkSeguimiento));

        // console.log(arrEquipos.length);
        // if (arrEquipos.length != 0){
            $.ajax({
                url: urlEditar,
                type: 'POST',
                data:data2,
                dataType: 'json', 
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {

                    var vresult = JSON.parse(data[0].updsolicservicio);
                    // console.log(vequip.exito+'-------------');
                    // console.log(data[0]['updsolicservicio']+'-------------');
                    if(data[0]['updsolicservicio']!=''){  
                        if(vresult.exito==0){  //0 = a que se edito correctamente
                            fnUpdAcceso(idSolicServ, false, 1);
                            msjeAlerta2('','<span>Se ha editado con éxito la orden de servicio con el folio: <strong>'+folio+'</strong></span>','success',idSolicServ)
                        }else{ //1= a que no se puede actualizar porque ya tiene estatus de asignada
                            fnUpdAcceso(idSolicServ, false, 1);
                            msjeAlerta2('', 'No se puede actualizar porque ya ha sido Asignada','error')
                        }
                    }else{ 
                        fnUpdAcceso(idSolicServ, false, 1);
                        msjeAlerta('', 'No se pudo realizar el registro de la orden de servicio','error')
                    }
                    
                }
            }); 
        // }else{
        //     msjeAlerta('', 'No se puede actualizar si no tiene ','error')
        // }
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
        html+='<th>Área de Servicio</th>';
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

    function verDetalleEquipoA(numArr){
        var etiquetaServicio='';
        var marca='';
        var modelo='';
        var numeroSerie='';
        var ubicacion='';

        if(arrEquipos[numArr].etiquetaServicio=='' || arrEquipos[numArr].etiquetaServicio==null){ 
            etiquetaServicio='S/D';
        }else{
            etiquetaServicio=arrEquipos[numArr].etiquetaServicio;
        }

        if(arrEquipos[numArr].marca==''){
            marca='Marca: S/D';
        }else{
            marca=arrEquipos[numArr].marca;
        }

        if(arrEquipos[numArr].modelo==''){
            modelo='Modelo: S/D';
        }else{
            modelo=arrEquipos[numArr].modelo;
        }

        if(arrEquipos[numArr].numeroSerie==''){
            numeroSerie='Número de Serie: S/D';
        }else{
            numeroSerie=arrEquipos[numArr].numeroSerie;
        }

        if(arrEquipos[numArr].ubicacionEquipo=='' || arrEquipos[numArr].ubicacionEquipo==null){
            ubicacion='S/D';
        }else{
            ubicacion=arrEquipos[numArr].ubicacionEquipo;
        }

        var htmlSel='';

        htmlSel+='<div class="row">';
        htmlSel+='<div class="col-12"><br>';
        htmlSel+='</div>';
        htmlSel+='</div>';

        htmlSel+='<div class="row">';
        htmlSel+='<div class="col-12">';
        htmlSel+='<label>Descripción del problema:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].descripcionSoporte+'</label>';
        htmlSel+='</div>';
        htmlSel+='</div>';

        htmlSel+='<div class="row">'; 
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Etiqueta:</label><label class="SinNegrita" id="lblDescProblema">'+etiquetaServicio+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Detalle:</label><label class="SinNegrita" id="lblDescProblema">'+marca+', '+modelo+', '+numeroSerie+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Ubicación:</label><label class="SinNegrita" id="lblDescProblema">'+ubicacion+'</label>';
        htmlSel+='</div>';
        htmlSel+='</div>';

        htmlSel+='<div class="row">';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Cantidad:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].cantidad+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Tipo de Equipo/Servicio:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].desc_tipo_equipo+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        if(arrEquipos[numArr].fecha_cierre!=null){
            htmlSel+='<label>Estatus:</label><label id="lblDescProblema">Atendido</label>';
        }
        htmlSel+='</div>';
        htmlSel+='</div>';
        htmlSel+='<br>';
        htmlSel+='<div class="row">';
        htmlSel+='<div class="col-12">';
        htmlSel+='<label>Listado de Áreas de Servicio/Tareas</label>';
        htmlSel+='</div>';
        htmlSel+='</div>';


        // var html='';
        htmlSel+='<table class="table">';
        htmlSel+='<thead>';
        htmlSel+='<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Área de Servicio</th>';
        htmlSel+='<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tarea</th>';
        htmlSel+='</thead>';
        htmlSel+='<tbody>';

        var aTarea = [];

        if(arrEquipos[numArr].nuevo==1){  //1 es igual equipo agregado nuevo
                aTarea=arrEquipos[numArr]['aTarea'];
                
        }else{ // 0 es igual a que biene de BD
            aTarea = JSON.parse(arrEquipos[numArr]['aTarea']);
            // console.log(aTarea)
        }
        
        var aux='';
        var aux1='';
        var aux2='';
        $.each(aTarea, function(j, val){
            if (!jQuery.isEmptyObject(aTarea[j])) {
                var vserv='';
                var vtare='';
                if( typeof(aTarea[j]['servicio']) != "undefined" && aTarea[j]['servicio'] !== null){  
                    if(aux1==aTarea[j]['servicio']){   /// esto era para que no se repitiera el servicio 09/08/2023
                        vserv='&nbsp;';
                        // aux='';
                    }else{
                        aux1=aTarea[j]['servicio']; 
                        vserv=aTarea[j]['servicio'];
                    }
                        // vserv=aTarea[i]['servicio'];
                    // vserv=aTarea[j]['servicio'];
                }else{
                    if(aux2==aTarea[j]['desc_Servicio']){   /// esto era para que no se repitiera el servicio 09/08/2023
                        vserv='&nbsp;';
                        // aux='';
                    }else{
                        aux2=aTarea[j]['desc_Servicio']; 
                        vserv=aTarea[j]['desc_Servicio'];
                    }
                    // vserv=aTarea[j]['desc_Servicio'];
                }

                if( typeof(aTarea[j]['tarea']) != "undefined" && aTarea[j]['tarea'] !== null){
                    vtare=aTarea[j]['tarea'];
                }else{
                    vtare=aTarea[j]['desc_Tarea'];
                }

                // htmlSel+='<tr>';
                // if(aux==aTarea[j]['servicio']){ 
                //     htmlSel+='<td >&nbsp;</td>';
                //     aux='';
                // }else{
                //     aux=aTarea[j]['servicio'];
                //     htmlSel+='<td class="text-xs text-secondary mb-0">'+vserv+'&nbsp;</td>';
                // }
                htmlSel+='<td class="text-xs text-secondary mb-0">'+vserv+'&nbsp;</td>';
                htmlSel+='<td class="text-xs text-secondary mb-0"> - '+vtare+'</td>';
                htmlSel+='<tr>';
            }
        });

        htmlSel+='</tbody>';
        htmlSel+='</table>';

        htmlSel+='</td>';
        htmlSel+='</tr>';

        htmlSel+='</table>';
        htmlSel+='<br>';
    
        $("#divDetalleEquipoM").html(htmlSel);

        $("#visualizarDetalleEquipoModal").modal("show");
    }

    function verHistorialEquipo(numArr){
        var detE='';
        if(arrEquipos[numArr].etiquetaServicio!=''){
            let urlEditar = '{{ route("historialEquipo", ":etiqueta") }}';
            urlEditar = urlEditar.replace(':etiqueta', arrEquipos[numArr].etiquetaServicio);

            $.ajax({
                url: urlEditar,
                type: 'GET',
                dataType: 'json', 
                // processData: false,
                // contentType: false,
                // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    console.log(data);
                    // var detE='';
                    if(data.length > 0 ){
                        $.each(data, function(j, val){
                                detE+='<tr>';
                                detE+='<td class="text-xs text-secondary mb-0">'+data[j]['folio']+'</td>';
                                detE+='<td><h6 class="mb-0 text-sm">'+data[j]['nombrect']+'</h6><p class="text-xs text-secondary mb-0">'+data[j]['clave_ct']+'</p></td>';
                                detE+='<td class="text-xs text-secondary mb-0">'+data[j]['fecha_finalizo']+'</td>';
                                detE+='<td class="text-xs text-secondary mb-0">'+data[j]['tecnico']+'</td>';
                                detE+='<td class="text-xs text-secondary mb-0">'+data[j]['solicitante']+'</td>'; 
                                detE+='</tr>';
                        });
                    }else{
                        detE+='<tr>';
                        detE+='<td colspan="5" class="text-xs text-secondary mb-0">No existen registros</td>'; 
                        detE+='</tr>';
                    }

                    $("#tbHistoricoE").html(detE);
                }
            });
        }else{
            detE+='<tr>';
            detE+='<td colspan="5" class="text-xs text-secondary mb-0">No existen registros</td>'; 
            detE+='</tr>';
            $("#tbHistoricoE").html(detE);
        }
        

        $("#historialEquipoModal").modal("show");
    }

    function verDetalleEquipo(j){   /////Modal de Editar el Equipoo

        $('#checkCerrar').prop("checked", false); 
        // console.log(j);
        $("#detalleEquipoModal").modal("show");
        // console.log(arrEquipos[j].aTarea);
        $("#divCerrarEquipo").hide();
        $("#divEditEqui").show();

        arrTareasEdit = [];
        cargaServicio(arrEquipos[j].id_tipo_equipo);
        $("#hdIdTipoEquipo").val(arrEquipos[j].id_tipo_equipo);

        $("#hdIdEquipoM").val(arrEquipos[j].id_equipo_serv_solic);
        $("#hdIdSolServM").val( $("#txtIdSolic").val() );

        $("#txtEtiquetaM").val(arrEquipos[j].etiquetaServicio);
        //  drawRowTareaEdit();

        $("#txtDescripcionSoporteM").val(arrEquipos[j].descripcionSoporte);

        if(arrEquipos[j].id_tipo_equipo == 1){
            $("#txtEtiquetaM").prop('disabled', true);
            $("#txtDetalleEquipoM").val(); ///ws
        }else{
            $("#txtEtiquetaM").val(arrEquipos[j].etiquetaServicio);
            $("#txtDetalleEquipoM").val('Marca:S/D, Modelo:S/D, Número de Serie: S/D '); ///ws
            $("#txtEtiquetaM").prop('disabled', false);
        }

        $("#txtEtiquetaM").val(arrEquipos[j].etiquetaServicio);
        // $("#txtDetalleEquipoM").val('Marca:S/D, Modelo:S/D, Número de Serie: S/D '); ///ws
        $("#txtUbicacionM").val(arrEquipos[j].ubicacionEquipo);

        ///////Inputs de Cierre Equipo
        $("#hdIdEquipoMC").val(arrEquipos[j].id_equipo_serv_solic);
        $("#hdIdSolServMC").val( $("#txtIdSolic").val() );

        var TareasAux = [];
        TareasAux = JSON.parse(arrEquipos[j]['aTarea']);

        // console.log(TareasAux);  ////////regresa json CACHAR JSON QUE REGRESA FUNCION

        $.each(TareasAux, function(i, val){
            if (!jQuery.isEmptyObject(TareasAux)) {

                // var vserv='';
                // var vtare='';
                // if( typeof(TareasAux[i].servicio) != "undefined" && TareasAux[i].servicio !== null){  
                //     vserv=TareasAux[i].servicio;
                // }else{
                //     vserv=aTarea[j]['desc_Servicio'];
                // }

                // if( typeof(TareasAux[j].tarea) != "undefined" && TareasAux[j].tarea !== null){
                //     vtare=TareasAux[j].tarea;
                // }else{
                //     vtare=TareasAux[j]['desc_Tarea'];
                // }
                    
                arrTareasEdit.push({
                    id_equipo_detalle: TareasAux[i].id,
                    id_equipo_tarea: TareasAux[i].id_equipo_tarea,
                    id_equipos_serv: TareasAux[i].id_equipos_serv,
                    id_usuario_agrega: TareasAux[i].id_usuario_agrega,
                    fecha_agrega: TareasAux[i].fecha_agrega,
                    id_tipo_equipo: TareasAux[i].id_tipo_equipo,
                    tipo_equipo: TareasAux[i].tipo_equipo,
                    id_servicio: TareasAux[i].id_servicio,
                    // servicio: vserv,//TareasAux[i].servicio,
                    servicio: TareasAux[i].servicio,
                    id_tarea: TareasAux[i].id_tarea,
                    tarea: TareasAux[i].tarea,
                    activo: TareasAux[i].activo
                });
            }
        });

        var listaTarea2 = '';

        listaTarea2+='<table class="table" style="font-size:0.75rem;" id="tbTareaM">';
        listaTarea2+='<thead>';
        listaTarea2+='<th>Área de Servicio</th>';
        listaTarea2+='<th>Tarea</th>';
        listaTarea2+='<th>Acciones</th>';
        listaTarea2+='</thead>';
        listaTarea2+='<tbody>';
        // console.log(arrTareasEdit+'-------prueba');
        // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
        var aux='';
        $.each(arrTareasEdit, function(j, val){
            if (!jQuery.isEmptyObject(arrTareasEdit[j])) {
                // listaTarea2+='<br><br>';
                listaTarea2+='<tr>';
                if(aux==arrTareasEdit[j]['servicio']){ 
                    listaTarea2+='<td>&nbsp;</td>';
                    // aux='';
                }else{
                    aux=arrTareasEdit[j]['servicio'];
                    listaTarea2+='<td>'+arrTareasEdit[j]['servicio']+'&nbsp;</td>';
                }
                
                listaTarea2+='<td> - '+arrTareasEdit[j]['tarea']+'</td>';
                // class="btn colorBtnPrincipal"
                listaTarea2+='<td><button type="button" class="btnEliminar" onclick="removeTareaEdit('+j+');" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                listaTarea2+='<tr>';
            }
        });

        listaTarea2+='</tbody>';
        listaTarea2+='</table>';

        if(listaTarea2!=''){
            $("#divListaTareaM").addClass('scrollVerticalTareas');
        }else{
            $("#divListaTareaM").removeClass('scrollVerticalTareas');
        }

        $("#ulTareaM").empty();
        $("#tituloTareasM").text('LISTADO DE ÁREAS DE SERVICIO/TAREAS ');
        $("#ulTareaM").html(listaTarea2);
        $("#selTareaM").val("0").attr("selected",true);

    }

    function removeTareaEdit( item ) { 

        var titulo='';
        var contenido='<p style="font-size:1rem !important;">¿Está seguro de eliminar el registro?</p>';
        var icono='warning'; 

        Swal.fire({
            title: titulo,
            html: contenido,
            icon: icono,
            showCancelButton: true,
            confirmButtonColor: '#b50915',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            width: 600,
            }).then((result) => {
            if (result.isConfirmed) {

                if(arrTareasEdit.includes(item) ==false){ 
                    if ( item !== -1 ) {
                        if (arrTareasEdit[item].activo==true){ //Si viene de BD se mete en un arreglo temporal ya que estos se eliminaran de bd
                        //    console.log( arrTareasEdit[item].activo);
                        //    console.log( arrTareasEdit[item].id_equipo_detalle);
                            arrTareasEditElim.push({
                                // con : 0,
                                id_equipo_detalle : arrTareasEdit[item].id_equipo_detalle, 
                            });
                        }

                        arrTareasEdit.splice( item, 1 );
                        //  console.log(arrTareasEditElim[0]['id_equipo_detalle']+'elim');
                        $("#liTM_"+item).remove();
                        drawRowTareaEdit();
                    }   else{
                        arrTareasEdit = [];
                        g=0;
                        listaTarea='';
                        $("#ulTareaM").html('');
                        $("#ulTareaM").empty();
                    }
                }else{
                    console.log('No existe en el arreglo');
                    g=0;
                    listaTarea='';
                    $("#ulTareaM").html('');
                    $("#ulTareaM").empty();
                }
            }
        });
    }

    function drawRowTareaEdit(){

        
        var listaTarea2 = '';

        listaTarea2+='<table class="table" style="font-size:0.75rem;" id="tbTareaM">';
        listaTarea2+='<thead>';
        listaTarea2+='<th>Área de Servicio</th>';
        listaTarea2+='<th>Tarea</th>';
        listaTarea2+='<th></th>';
        listaTarea2+='</thead>';
        listaTarea2+='<tbody>';

        // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
        var aux='';
        $.each(arrTareasEdit, function(j, val){
            if (!jQuery.isEmptyObject(arrTareasEdit[j])) {
                listaTarea2+='<tr>';
                if(aux==arrTareasEdit[j]['servicio']){ 
                    listaTarea2+='<td>&nbsp;</td>';
                    // aux='';
                }else{
                    aux=arrTareasEdit[j]['servicio'];
                    listaTarea2+='<td>'+arrTareasEdit[j]['servicio']+'&nbsp;</td>';
                }
                
                listaTarea2+='<td> - '+arrTareasEdit[j]['tarea']+'</td>';
                // class="btn colorBtnPrincipal"
                listaTarea2+='<td><button type="button" class="btnEliminar" onclick="removeTareaEdit('+j+');" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
                listaTarea2+='<tr>';
            }
        });

        listaTarea2+='</tbody>';
        listaTarea2+='</table>';

        if(listaTarea2!=''){
            $("#divListaTareaM").addClass('scrollVerticalTareas');
        }else{
            $("#divListaTareaM").removeClass('scrollVerticalTareas');
        }

        $("#ulTareaM").empty();
        $("#tituloTareasM").text('LISTADO DE ÁREAS DE SERVICIO/TAREAS ');
        $("#ulTareaM").html(listaTarea2);
        $("#selTareaM").val("0").attr("selected",true);
    }

    function cargaTarea(){
        var vtipEquipo=  $('#hdIdTipoEquipo').val();
            // var serv= this.value;
            var serv= $("#selTipoServicioM").val();

            if(serv !=0){
                let urlEditar = '{{ route("consTarea") }}';
                // urlEditar = urlEditar.replace(':idserv', this.value);

                $("#selTareaM").val("0").attr("selected",true);
                let element = document.getElementById("selTareaM");
                element.value = '0';

                $.ajax({
                    url: urlEditar,
                    type: 'POST',
                    data:{idequi:vtipEquipo , idserv:serv},
                    dataType: 'json', 
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(data) {
                        //  console.log(data[0][0]);
                        // var htmlSel='<option value="0" selected>Seleccionar</option>';
                        var htmlSel='';
                        for (var i = 0; i < data[0].length; i++) {
                            htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                        }

                        $("#selTareaM").html(htmlSel);
                        $('.selectpicker').attr('disabled',false); //JC
                        $('.selectpicker').selectpicker('refresh');  //JC
                    }
                });
            }else{
                console.log('no selecciono un servicio');
            }
    }

    function cargaServicio(id_tipo_equipo){

        arrTareas=[];
        $("#divListaTareaM").removeClass('scrollVerticalTareas');
        $("#tituloTareasM").text('');
        $("#ulTareaM").empty();

        let urlEditar = '{{ route("consServicio", ":idEquipo") }}';
        urlEditar = urlEditar.replace(':idEquipo', id_tipo_equipo); 

        $("#selTipoServicioM").val("0").attr("selected",true);
        let element = document.getElementById("selTipoServicioM");
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

                $("#selTipoServicioM").html(htmlSel);
            }
        });
        $("#btnAgregarTareaM").prop('disabled',true); ///////28_08_2023
    }

    function fnActualizarEquipo(){
        var claveCCT= $("#txtClaveCCT").val();
        let urlEditar = '{{ route("actualizarEquipo") }}'; 
        var idSolic_serv= $("#txtIdSolic").val();
        // urlEditar = urlEditar.replace(':claveCCT', claveCCT);
        var form = $('#formEditarEquipo')[0];
         
        var data2 = new FormData(form);
        data2.append('arrTareasEdit', JSON.stringify(arrTareasEdit));
        data2.append('arrTareasEditElim', JSON.stringify(arrTareasEditElim)); 

        $.ajax({
            url: urlEditar,
            type: 'POST',
            data:data2,
            dataType: 'json', 
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data) {
                console.log(data);
                console.log(data[0]['updtareasequipo']);
                var vequip = JSON.parse(data[0].updtareasequipo);

                if(data[0]['updtareasequipo']!=''){ 
                    Swal.fire({
                        title: '',
                        html: '<span>El equipo/servicio ha sido actualizado con éxito.</span>',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#ab0033',
                        // cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar',
                        // cancelButtonText: 'Aceptar',
                        width: 600,
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $("#detalleEquipoModal").modal("hide");
                            for (var i = 0; i < arrEquipos.length; i++) {
                                arrEquiposAux.push(arrEquipos[i]);

                            } 
                            arrEquipos=[];
                            fnConsEquipos();
                        }else{
                            
                        }
                    });
                }else{ 
                    msjeAlerta('', 'No se pudo actualizar el equipo/servicio','error')
                }
                
            }
        });
    }

    function fnCerrarEquipo(){
        var claveCCT= $("#txtClaveCCT").val();
        let urlEditar = '{{ route("cerrarEquipo") }}'; 
        var idSolic_serv= $("#txtIdSolic").val();
        var archivoCierreEquipo = $("#archivoCierreEquipo").val();
        var diagnostico = $("#txtDiagnosticoM").val();
        var solucion = $("#txtSolucionM").val(); 
        var checkEs_funcional=false;

        if($("#checkEs_funcionalMC").is(':checked')) {  
            checkEs_funcional= true;
        } else {  
            checkEs_funcional= false;
        }  

        var form = $('#formCerrarEquipo')[0];
        var data2 = new FormData(form);
        data2.append('checkEs_funcional', JSON.stringify(checkEs_funcional));

        if(archivoCierreEquipo!='' && archivoCierreEquipo!=null){
            var extension=archivoCierreEquipo.substr(-3);
            if(extension!='jpg' && extension!='png' ){
                msjeAlerta('','Favor de seleccionar un archivo tipo jpg, png','error');
            }
        }
        var band=0;
        if(diagnostico==''){
            msjeAlerta('','Favor de ingresar el diagnóstico','error');
            band=1;
        }else{
            band=0;
        }

        if(solucion==''){
            msjeAlerta('','Favor de ingresar la solución','error');
            band=1
        }else{
            band=0;
        }

        if(band==0){

            $.ajax({
                url: urlEditar,
                type: 'POST',
                data:data2,
                dataType: 'json', 
                processData: false,
                contentType: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    console.log(data);

                    if(data[0]['inscerrarequipo']!=''){ 
                        // msjeAlerta2('','El equipo ha sido registrado como ATENDIDO','success',txtIdSolic) ////este no se
                        Swal.fire({
                            title: '',
                            html: '<span>El equipo/servicio ha sido registrado como <strong>ATENDIDO</strong> en la orden de servicio.</span>',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#ab0033',
                            // cancelButtonColor: '#d33',
                            confirmButtonText: 'Aceptar',
                            // cancelButtonText: 'Aceptar',
                            width: 600,
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $("#detalleEquipoModal").modal("hide");
                                // arrEquiposAux=arrEquipos
                                for (var i = 0; i < arrEquipos.length; i++) {
                                    arrEquiposAux.push(arrEquipos[i]);

                                } 
                                arrEquipos=[];
                                fnConsEquipos();
                            }else{
                                
                            }
                        });
                    }else{ 
                        msjeAlerta('', 'No se pudo cerrar el equipo/servicio','error')
                    }
                    
                }
            });
        }else{
            msjeAlerta('', 'Debe ingresar los campos diagnóstico y solución','error')
        }
    }

    function fnValidaAcceso(idSolicServ){
        var acceso=false;

        $.ajax({
            url: '{{ route("validaAcceso") }}',
            data:{idSolicServ : idSolicServ},
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json', 
            success: function(data) {
                acceso = data.getvalidaaccesoorden; 
            }
        });

        return acceso;
    }

    function fnUpdAcceso(idSolicServ, valida, band){ 
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
                }else{
                    console.log('ss');
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
        console.log(refreshIntervalId); 
        setTimeout(() => clearInterval(refreshIntervalId), 300000); //300000
    } 

</script>
@endsection
