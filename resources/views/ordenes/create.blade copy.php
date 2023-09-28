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
    
    .fixedHeight {
        /* color:red; */
        font-size:10px;
        max-height: 200px;
        margin-bottom: 10px;
        overflow-x: auto;
        overflow-y: auto;
    }
</style>

@section('content')
<div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Nueva Orden de Servicio </h1>
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
                                    <a class="nav-link active" id="tab1" aria-current="page" data-bs-toggle="tab" href="#tabCCT">Datos del Centro de Trabajo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab2" aria-current="page" data-bs-toggle="tab" href="#tabReporte">Datos del reporte</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab3" aria-current="page" data-bs-toggle="tab" href="#tabEquipos">Equipos</a>
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
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-12">
                                            <div class="form-group">
                                            <label for="txtCentroTrabajo">CENTRO DE TRABAJO </label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="txtCentroTrabajo" name="txtCentroTrabajo" class="form-control input-group-text" value="{{-- $id --}}" aria-describedby="btnBuscar" >
                                                <button class="btn btn-secondary" type="button" id="btnBuscar"  onclick="fnBuscarCCT()">Buscar</button>
                                                </div>
                                            </div>
                                        </div> -->
                                        <label for="txtCentroTrabajo">CENTRO DE TRABAJO </label>
                                        <div class="col-7">
                                            <!-- <input type="text" id="txtCentroTrabajo" style="text-align:left;" name="txtCentroTrabajo" class="form-control input-group-text" value="{{-- $id --}}" aria-describedby="btnBuscar" >        -->
                                            <!-- <div class="col-9"> -->
                                                <div class="ui-widget">
                                                    <input class="form-control input-group-text" style="text-align:left; text-transform: uppercase;" id="txtCentroTrabajo" name="txtCentroTrabajo" aria-describedby="btnBuscar">
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                        
                                        <div class="col-5"> <!--col-6-->
                                            @can('194-btn-get-buscar-cct')
                                            <button class="btn btn-secondary" type="button" id="btnBuscar"  onclick="fnBuscarCCT()">Buscar</button>
                                            @endcan 
                                            &nbsp;&nbsp;&nbsp;<span  id="divHistorial"> 
                                            </span>
                                            &nbsp;&nbsp;
                                            <span  id="divUbicacion">
                                            </span>
                                        </div>
                                        
                                        <!-- <div class="col-2" id="divHistorial"> -->
                                            <!-- <button class="btn btn-secondary" type="button" id="btnHistorialCCT"  onclick="">Ver Historial</button> -->
                                        <!-- </div> -->

                                        <!-- <div class="col-2" id="divUbicacion"> -->
                                            <!-- <button class="btn btn-secondary" type="button" id="btnUbicacionCCT"  onclick="fnMapa()">Ubicación</button> -->
                                        <!-- </div> -->
                                       
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtNombreCCT">NOMBRE</label>
                                            <input type="text" id="txtNombreCCT" name="txtNombreCCT" class="form-control" value="" readonly >
                                            <input type="hidden" id="txtIdCCT" name="txtIdCCT" class="form-control" value="" readonly >
                                            <!-- <label id="nombre_alumno" class="SinNegrita">{{-- $registro->nombre_alumno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtClaveCCT">CLAVE</label>
                                            <input type="text" id="txtClaveCCT" name="txtClaveCCT" class="form-control" value="" readonly >
                                            <input type="hidden" id="txtLatitud" name="txtLatitud" class="form-control" value="" readonly >
                                            <input type="hidden" id="txtLongitud" name="txtLongitud" class="form-control" value="" readonly >
                                            <!-- <label id="ap_paterno" class="SinNegrita">{{-- $registro->ap_paterno --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtMunicipioCCT">MUNICIPIO DEL CCT</label>
                                            <input type="text" id="txtMunicipioCCT" name="txtMunicipioCCT" class="form-control" value="" readonly >
                                            <!-- <label id="ap_materno" class="SinNegrita">{{-- $registro->ap_materno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                            <label for="txtDirectorCCT">NOMBRE DEL DIRECTOR</label>
                                            <input type="text" id="txtDirectorCCT" name="txtDirectorCCT" class="form-control" value="" readonly >
                                            <!-- <label id="escuela" class="SinNegrita">{{-- $registro->nombre_cct --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                            <label for="txtDireccionCCT">DIRECCIÓN</label>
                                            <input type="text" id="txtDireccionCCT" name="txtDireccionCCT" class="form-control" value="" readonly >
                                            <!-- <label id="gradoEscolar" class="SinNegrita">{{-- $registro->grado_alumno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtCoordinacion">COORDINACIÓN A LA QUE PERTENECE</label>
                                            <input type="text" id="txtCoordinacion" name="txtCoordinacion" class="form-control" value="" readonly >
                                            <!-- <label id="nombre_municipio" class="SinNegrita">{{-- $registro->nombre_municipio --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="txtTelefono">TELÉFONO</label>
                                            <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" value="" readonly >
                                            <!-- <label id="telefono_titular" class="SinNegrita">{{-- $registro->telefono_titular --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                            <label for="txtTurno">TURNO</label>
                                            <input type="text" id="txtTurno" name="txtTurno" class="form-control" value="" readonly >
                                            <!-- <label id="domicilio_casa" class="SinNegrita">{{-- $registro->domicilio_casa --}}</label> -->
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                            <label for="txtNivelEducativo">NIVEL EDUCATIVO</label>
                                            <input type="text" id="txtNivelEducativo" name="txtNivelEducativo" class="form-control" value="" readonly >
                                            <!-- <label id="correo_titular" class="SinNegrita">{{-- $registro->correo_titular --}}</label> -->
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="col-12">
                                            <label>Observaciones: En caso de existir algún error en los datos del Centro de Trabajo añadidos, deberá indicar al Centro Educativo realice la actualización de infomación con la Dirección de Planeación de la Secretaría de Educación.</label>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <!-- <button type="submit" class="btn btn-secondary" id="btnAnterior" >ANTERIOR</button> -->
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente" disabled>Siguiente</button> 
                                        </div>
                                    </div>
                                </div>  <!--final del tab cct-->

                                <div class="tab-pane fade" id="tabReporte">
                                    <div class="row">
                                        <div class="col-12" id="datosGenCentro2">
                                            
                                        </div>
                                    </div>
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
                                                    @foreach($catAreasAtiendeOrden as $areasAtiendeOrden)
                                                        <option value="{{ $areasAtiendeOrden->id }}">{{ $areasAtiendeOrden->area_atiende }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtNombreSolicitante">NOMBRE DEL SOLICITANTE</label>
                                                <input type="text" id="txtNombreSolicitante" name="txtNombreSolicitante" class="form-control" value="" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtTelefonoSolicitante">TELÉFONO DEL SOLICITANTE</label> 
                                                <input type="tel" id="txtTelefonoSolicitante" name="txtTelefonoSolicitante" class="form-control" value="" minlength="10" maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" >
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtCorreoSolicitante">CORREO INSTITUCIONAL DEL SOLICITANTE</label>
                                                <input type="email" id="txtCorreoSolicitante" name="txtCorreoSolicitante" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="col-4 justify-content-md-start">
                                            <div class="form-check">
                                            @can('197-chk-es-director')
                                                <input class="form-check-input" type="checkbox" value="" id="checkSolicitante" name="checkSolicitante">
                                                <label style="font-weight: normal;" for="checkSolicitante">
                                                Active la casilla en caso que el solicitante corresponda al Director del C.T
                                                </label>
                                            @endcan
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-check">
                                                <label style="font-weight: normal;" >
                                                Favor de ingresar teléfono celular. Nos pondremos en contacto a este número.
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="txtDescripcionReporte">DESCRIPCIÓN DEL REPORTE</label>
                                                <textarea class="form-control" id="txtDescripcionReporte" name="txtDescripcionReporte" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 justify-content-md-start">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="checkSeguimiento" name="checkSeguimiento">
                                                <label style="font-weight: normal;" for="checkSeguimiento">
                                                ¿Desea recibir notificaciones del seguimiento de su orden al correo proporcionado?
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior2" >Regresar</button>
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente2" >Siguiente</button>
                                        </div> 
                                    </div>
                                </div> <!--Fin tab Reporte-->
                                
                                <div class="tab-pane fade" id="tabEquipos">
                                    <div class="row">
                                        <div class="col-12" id="datosGenCentro3">
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                            <span style="color:white;">Agregar equipo(s) a la orden de servicio</span>
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
                                                <label for="txtEtiquetaServicio">ETIQUETA DE SERVICIO</label>
                                                <input type="text" id="txtEtiquetaServicio" name="txtEtiquetaServicio" class="form-control" value="" >
                                            </div>
                                        </div>
                                        <div class="col-6 divEtiqueta">
                                            <div class="form-group">
                                                <label for="txtDetEquipo">DETALLE EQUIPO</label>
                                                <input type="text" id="txtDetEquipo" name="txtDetEquipo" class="form-control" value="" readonly>
                                                <input type="hidden" id="txtMarca" name="txtMarca" class="form-control" value="" readonly>
                                                <input type="hidden" id="txtModelo" name="txtModelo" class="form-control" value=""  readonly>
                                                <input type="hidden" id="txtNumeroSerie" name="txtNumeroSerie" class="form-control" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtUbicacionEquipo">UBICACIÓN DEL EQUIPO</label>
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
                                            <!-- <div class="form-group col-12" style="font-size:0.75rem;" id="divListaServicio">
                                                
                                                <ul id="ulServicio">
                                                    
                                                </ul>
                                            </div> -->
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="selTarea">TAREA</label>
                                                <!-- <select class="form-select" aria-label="Default select example" id="selTarea" name="selTarea" >
                                                    <option value="0" selected>Seleccionar</option>
                                                </select> -->
                                                <!-- <div class="input-group"> -->
                                                    <select class="form-select" id="selTarea" name="selTarea" aria-label="Example select with button addon">
                                                        <option value="0" selected>Seleccionar</option>
                                                    </select>
                                                    <!-- <button class="btn colorBtnPrincipal" type="button" id="btnAgregarTarea">Añadir</button> -->
                                                    <!-- <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTarea"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button> -->
                                                <!-- </div> -->
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
                                                @can('198-btn-add-tareas')
                                                <button type="button" class="btn colorBtnPrincipal" id="btnAgregarTarea"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>
                                                @endcan
                                            </div>
                                        </div>

                                    </div>
                                    

                                    <div class="row">
                                        <!-- <div class="col-7">
                                            <div class="form-group">
                                                <label for="txtDescripcionSoporte">DESCRIPCIÓN DEL PROBLEMA</label>
                                                <textarea class="form-control" id="txtDescripcionSoporte" name="txtDescripcionSoporte" rows="3"></textarea>
                                            </div>
                                        </div> 09/08/2023 comentado cambios vistas-->
                                        <div class="col-12">  <!--tenia col-5  09/08/2023 comentado cambios vistas-->
                                            <div class="form-group col-12"  style="font-size:0.75rem;" id="divListaTarea">
                                                <span id="tituloTareas" class="tituloTareas"></span>
                                                <!-- <ul id="ulTarea" style="font-size:0.75rem;">
                                                    
                                                </ul> -->
                                                <div id="ulTarea" style="font-size:0.75rem;">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- <div class="col-9 d-md-flex justify-content-md-start">
                                            <div class="form-check replicar" id="checkVer">
                                                <input class="form-check-input" type="checkbox" value="" id="checkReplicar" name="checkReplicar">
                                                <label class="form-check-label" for="checkReplicar">
                                                    Mantener descripción del problema y lista de tareas para el siguiente equipo.
                                                </label>
                                            </div>
                                        </div> -->
                                        <div class="col-9 d-md-flex justify-content-md-start">
                                        </div>

                                        <div class="col-3 d-grid gap-2 d-md-flex justify-content-md-end">
                                            @can('199-btn-add-equipo')
                                            <button type="button" class="btn colorBtnPrincipal" id="btnAgregarEquipo" >Agregar Equipo</button>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                                            <span style="color:white;">Descripción de equipos agregados</span>
                                        </div>
                                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <br>
                                        <div class="col-12 scrollHorizontal" id="divTablaEquipos">
                                            <table class="table">
                                                <thead class="text-align:center;">
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CANTIDAD</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EQUIPO/SERVICIO</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESCRIPCIÓN</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SERVICIO</th>
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
                                        <br>
                                        
                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior3" >Regresar</button>     
                                            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" onclick="fnGuardar()"> Guardar</button>     -->
                                            @can('203-btn-ins-orden')
                                            <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" onclick="msjeAlertConfirm()"> Guardar</button>    
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <!-- <div class="modal-header"> -->
            <!-- <div class="container">
            <div class="row">
                <div class="col-12" style="text-align:right;">
                    <span id="spclavecct" style="color:#ab0033;"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                    <span style="color:white;">Histórico de Órdenes</span>
                </div>
                <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                </div>
            </div>
            </div> -->

            <!-- <h5 class="modal-title" id="historialCCTModalLabel">Histórico de Órdenes - <span id="spclavecct"></span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <!-- </div> -->
        <div class="modal-body">
        <!-- <div class="container"> -->
            <div class="row">
                <div class="col-12" style="text-align:right;">
                    <span id="spclavecct" style="color:#ab0033;>"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                    <span style="color:white;">Histórico de Órdenes</span>
                </div>
                <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                </div>
            </div>
            <div class="row">
                <div class="col-12" >
                </div>
            </div>
            <!-- </div> -->
            <!-- <div class="row">
                <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                    <span style="color:white;">Histórico de Órdenes</span>
                </div>
                <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                </div>
            </div> -->
            <div class="row">
                <div class="col-12">
                    <div class="form-group" id="hist">
                        
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button> -->
            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnElegirTurno" onclick="fnElegirTurno()">Aceptar</button> -->
        <!-- </div> -->
    </div>
  </div>
</div>
<!-- FIN MODAL HISTORIAL-->

<!-- MODAL MAPA -->
<div class="modal fade" id="ubicacionCCTModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="ubicacionCCTModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- <div class="modal-header">
            <h5 class="modal-title" id="ubicacionCCTModalLabel">Ubicación</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> -->
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                    <span style="color:white;">Ubicación</span>
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
                <div class="col-12">
                    <div class="form-group" id="map"> 
                        
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> -->
            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnElegirTurno" onclick="fnElegirTurno()">Aceptar</button> -->
        <!-- </div> -->
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
                    <div class="col-12">
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                        <span style="color:white;">Información Equipo(s)</span>
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button> -->
        <!-- <button type="button" class="btn colorBtnPrincipal" id="btnSalirRev">Aceptar</button> -->
      <!-- </div> -->
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
        <div class="modal-body"> <!---->
            <div class="row">
                <div class="col-12">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                    <span style="color:white;">Historial del Equipo</span>
                </div>
                <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;">
                </div>
            </div>
            <div class="row">
                <div class="col-12" >
                </div>
            </div>
            <input type="hidden" id="etiquetaM" name="etiquetaM" value="" readonly>
            <!-- <div class="row">
                <div class="col-12" >
                </div>
            </div> -->
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button> -->
            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnSalirRev">Aceptar</button> -->
        <!-- </div> -->
    </div>
  </div>
</div>
<!-- FIN MODAL HISTORIAL EQUIPO-->

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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer> </script>  -->
      <script src="{{ asset('js/leaflet.js') }}"></script>
      
      <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
    let arrTareas = [];
    let arrServicios = [];
    var arrEquipos = [];
    let arrEscuelaTurno = [];
    // var vDirector='';
    // var equipo_servicio = {
    //             nom_equipo: '',
    //             num_inventario: '',
    //             servicios_equipo: []
    //         };

    $(document).ready(function () {
        //load();
        // $("#divTablaEquipos").hide()

        // $("#btnSiguiente").hide()
        // $("#btnSiguiente").prop('disabled', true);
        // $("#divCantidad").hide()
        $("#btnAgregarTarea").prop('disabled',true);
        $("#btnAgregarEquipo").hide();
        $("#selTipoServicio").prop('disabled',true); ///////28_08_2023
        $("#selTarea").prop('disabled',true); ///////28_08_2023

        $("#txtCentroTrabajo").on("keypress", function () {
            input=$(this);
            setTimeout(function () {
            input.val(input.val().toUpperCase());
            },50);
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
                // vDirector = $("#txtDirectorCCT").val();
                 $("#txtNombreSolicitante").val(vDirector);
                 $("#txtNombreSolicitante").prop('disabled', true);
            } else {  
                 $("#txtNombreSolicitante").val('');
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
                console.log(arrEquipos);
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
                 }else{
                    // arrTareas=[];
                 }
            }
            // arrTareas=[]; checarrr repolicarrrr
            $("#txtCantidadEquipos").val(1);
            $("#tituloTareas").text('');
            $("#selTipoServicio").val("0").attr("selected",true);
            $("#txtEtiquetaServicio").prop('disabled',false);
            $("#checkVer").show();
            $("#selTipoServicio").prop('disabled',true); ///////28_08_2023
            $("#selTarea").prop('disabled',true); ///////28_08_2023
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
            // if(arrTareas.length==0){
            //     g=0;
            //     listaTarea='';
            //     $("#ulTarea").html('');
            // }

            $("#selTipoEquipo").prop('disabled',true);
    
            vtipEqu= $("#selTipoEquipo").val();

            vTarea = $("#selTarea").val();
            vTareaText = $('select[id="selTarea"] option:selected').text();


            vTipoServicio = $("#selTipoServicio").val();
            vTipoServicioText = $('select[id="selTipoServicio"] option:selected').text();
            
            if(vtipEqu !=0){
                if(vTipoServicio !=0){
                    if(vTarea != 0){
                        $("#btnAgregarTarea").prop('disabled',false);
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
                    }else{
                        msjeAlerta('', 'Debe seleccionar la Tarea', 'error')
                    }
                    
                }else{
                    msjeAlerta('', 'Debe seleccionar el Servicio', 'error')
                }
            }else{
                msjeAlerta('', 'Debe seleccionar el Tipo de Equipo', 'error')
            }
            // $("#selTipoServicio").val("0").attr("selected",true);  //resetear servicio cada que agrega una tarea
        });

        $('#selTipoEquipo').on('change', function() { /// Cargar select Tarea en base a Servicio

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
                    var htmlSel='<option value="0" selected>Seleccionar</option>';
                    for (var i = 0; i < data[0].length; i++) {
                        htmlSel+='<option value="'+data[0][i].id_tarea+'">'+data[0][i].desc_tarea+'</option>'; 
                    }

                    $("#selTarea").html(htmlSel);
                    $("#selTarea").prop('disabled',false); ///////28_08_2023
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
                // $("#txtDetEquipo").val('Marca:DELL - MODELO:12345 - NÚMERO DE SERIE:02325652'); /// info del es
                $("#txtDetEquipo").val('Marca:S/D - MODELO:S/D - NÚMERO DE SERIE:S/D');
            }
        });

        $("#txtCentroTrabajo").keyup(function(e){
            var txt1 = $(this).val();
            // txt.toUpperCase();
            var txt2 = txt1.toUpperCase();
            if (e.which >= 46 && e.which <= 90 || e.which >= 96 && e.which <= 105 ){
                console.log('entro');
                if (txt2.length > 0) {
                    $.ajax({
                    url: '{{route("consclaveCCT")}}',
                    type: 'GET',
                    data: {
                        txt : txt2
                    }
                    }).always(function(r) {
                        array2=[];
                        console.log(r.arreglo);

                        for (let i = 0; i < r.arreglo.length; i++) {
                            array2.push(r.arreglo[i]['clavenombremun']);
                        }
                        // console.log(array2);
                        $( "#txtCentroTrabajo" ).autocomplete({
                            // maxShowItems: 5,
                            // minLength: 2,
                            source: array2,
                        
                        });
                        $( "#txtCentroTrabajo" ).autocomplete("widget").addClass("fixedHeight");
                        // $('#btn_consultar').prop('disabled', false);
                        // $('#div_btn_siguiente').prop('hidden', false);
                        // $( "#tags" ).autocomplete("widget").show();
                    });
                }
                else{
                    // $('#btn_consultar').prop('disabled', true);
                }
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
                tablaEquipo2+='<td class="text-xs text-secondary mb-0" style="text-align:center">'+arrEquipos[j]['desc_tipo_equipo']+'</td>';
                tablaEquipo2+='<td class="text-xs text-secondary mb-0">'+arrEquipos[j]['descripcionSoporte']+'</td>';
                var aux1='';
                tablaEquipo2+='<td class="text-xs text-secondary mb-0">';
                for (var i = 0; i < arrEquipos[j]['aTarea'].length; i++) {
                    var vserv='';
                    if(aux1==arrEquipos[j]['aTarea'][i]['desc_Servicio']){   /// esto era para que no se repitiera el servicio 09/08/2023
                        vserv='&nbsp;';
                        // aux='';
                    }else{
                        aux1=arrEquipos[j]['aTarea'][i]['desc_Servicio']; 
                        vserv=arrEquipos[j]['aTarea'][i]['desc_Servicio'];
                    }
                    tablaEquipo2+=''+vserv+'<br>';
                }
                tablaEquipo2+='</td>';

                tablaEquipo2+='<td class="text-xs text-secondary mb-0">';
                for (var h = 0; h < arrEquipos[j]['aTarea'].length; h++) {
                    tablaEquipo2+='- '+arrEquipos[j]['aTarea'][h]['desc_Tarea']+'<br>';
                }
                tablaEquipo2+='</td>';

                // tablaEquipo2+='<td class="text-xs text-secondary mb-0">'+vDatos+'</td>';
                tablaEquipo2+='<td style="text-align:center"><div class="dropdown btn-group dropstart" style="text-align:center;>';
                tablaEquipo2+='<button class="btn btn-link text-secondary mb-0 "';
                tablaEquipo2+='                      data-bs-toggle="dropdown" id="opciones"';
                tablaEquipo2+='                       aria-haspopup="true" aria-expanded="false" >';
                tablaEquipo2+='                      <i class="fa fa-ellipsis-v text-xs"></i>';
                tablaEquipo2+='                  </button>';
                tablaEquipo2+='                  <ul class="dropdown-menu" aria-labelledby="opciones1">';
                // tablaEquipo2+='                          <li>';
                // tablaEquipo2+='                              <a onclick="verServicioEquipo('+j+')"> ';
                // // tablaEquipo2+='                              class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">';
                // tablaEquipo2+='                                  <i class="fas fa-download"></i> Ver Servicios/Tareas';
                // tablaEquipo2+='                              </a>';
                // tablaEquipo2+='                          </li>';
                tablaEquipo2+='                          @can("200-opt-get-equipo")<li>';
                tablaEquipo2+='                              <a onclick="verDetalleEquipoA('+j+')" class="dropdown-item"> '; 
                // class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visualizarDetalleEquipoModal">';
                tablaEquipo2+='                                  <i class="fas fa-eye"></i> Visualizar';
                tablaEquipo2+='                              </a>';
                tablaEquipo2+='                          </li>@endcan';
                tablaEquipo2+='                           @can("201-opt-get-historial-equipo")<li>';
                tablaEquipo2+='                              <a onclick="verHistorialEquipo('+j+')" class="dropdown-item"> ';
                // tablaEquipo2+='                              class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">';
                tablaEquipo2+='                                  <i class="fas fa-book"></i> Historial'; //<!--web Service-->
                tablaEquipo2+='                              </a>';
                tablaEquipo2+='                          </li>@endcan';
                // tablaEquipo2+='                           @can("202-opt-get-detalle-equipo")<li>';
                // tablaEquipo2+='                              <a onclick="verDetalleEquipoWS('+j+')" class="dropdown-item"> ';
                // tablaEquipo2+='                                  <i class="fas fa-eye"></i> Detalle'; //<!--web Service-->
                // tablaEquipo2+='                              </a>';
                // tablaEquipo2+='                          </li>@endcan';
                tablaEquipo2+='                      <li>';
                tablaEquipo2+='                          <a  ';
                // tablaEquipo2+='                          onclick="removeEquipo('+j+');" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal">';
                tablaEquipo2+='                          onclick="removeEquipo('+j+');" class="dropdown-item" >';
                tablaEquipo2+='                              <i class="fas fa-trash"></i> Eliminar';
                tablaEquipo2+='                          </a>';
                tablaEquipo2+='                      </li>';
                tablaEquipo2+='                  </ul>';
                tablaEquipo2+='              </div></td>';
                // tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal" onclick="removeEquipo('+j+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
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

    // function drawTareasEnEquipos(){
    //     $.each(arrEquipos, function(j, val){
    //         if (!jQuery.isEmptyObject(arrEquipos[j])) { 
    //                 if (!jQuery.isEmptyObject(arrEquipos[j])) { 
    //                     tablaEquipo2+='<td class="text-xs text-secondary mb-0">'+aTareasEquipos[h]['descripcionSoporte']+'</td>';
    //                     tablaEquipo2+='<td class="text-xs text-secondary mb-0">'+aTareasEquipos[h]['descripcionSoporte']+'</td>';
    //                 }else{

    //                 }
    //             }
        
    // }


    function removeTarea( item ) {
        if(arrTareas.includes(item) ==false){ 
            if ( item !== -1 ) {
                arrTareas.splice( item, 1 );
                // console.log(arrTareas);
                $("#liT_"+item).remove();
                if (arrTareas==''){
                    $("#selTipoEquipo").prop('disabled',false);
                    $("#selTipoEquipo").val("0").attr("selected",true);
                    $("#selTipoServicio").val("0").attr("selected",true);
                    $("#divListaTarea").hide();
                }else{
                    $("#selTipoEquipo").prop('disabled',true);
                }
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
        listaTarea2+='<th>Servicio</th>';
        listaTarea2+='<th>Tarea</th>';
        listaTarea2+='<th>Eliminar</th>';
        listaTarea2+='</thead>';
        listaTarea2+='<tbody>';

        // var aTarea=arrEquipos[i]['aTarea'];arrTareas[i]
        var aux='';
        $.each(arrTareas, function(j, val){
            if (!jQuery.isEmptyObject(arrTareas[j])) {
            
                listaTarea2+='<tr>';
                if(aux==arrTareas[j]['desc_Servicio']){   /// esto era para que no se repitiera el servicio 09/08/2023
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
        $("#tituloTareas").text('LISTADO DE SERVICIOS/TAREAS ');
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
        // console.log(id_solic_serv);
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
                // window.location.href = urlEditar;
                // download-pdf

                window.open(urlEditar, '_blank'); // este es el bueno para descargar
                // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank');
                window.location.href = '{{ route("listadoOrdenes") }}';
            }else{
                window.location.href = '{{ route("listadoOrdenes") }}';
            }
        });
    }

    function msjeAlertConfirm(titulo, contenido, icono){
        var titulo='';
        var contenido='<p style="font-size:1rem !important;">¿Está seguro de registrar la orden de servicio?</p>';
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
            }
        });
    }

    function fnBuscarCCT(){
    
        var claveCCT= $("#txtCentroTrabajo").val();
        claveCCT= claveCCT.substr(0, 10);
        let urlEditar = '{{ route("consCCT", ":claveCCT") }}';
        urlEditar = urlEditar.replace(':claveCCT', claveCCT);
        arrEscuelaTurno=[];
        // $("#selTarea").val("0").attr("selected",true);
        // let element = document.getElementById("selTarea");
        // element.value = '0';

        if(claveCCT==''){
            msjeAlerta('', 'Debe introducir la Clave de Centro de Trabajo ', 'error')
            // $('#formOrden').trigger("reset");
            // $("#divHistorial").html('');
            // $("#divUbicacion").html('');
            // $("#hist").html('');
            fnLimpiar();
            arrEquipos = [];
            $("#btnSiguiente").prop('disabled', true);
            $("#tbEquipos").html('');
            $("#tbEquipos").empty();
            $("#datosGenCentro2").html('');
            $("#datosGenCentro3").html('');
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

                            var divdatosGenCentro='';
                             divdatosGenCentro+='<label>CENTRO DE TRABAJO:</label>';
                             divdatosGenCentro+='<label>'+data[0][0].clavecct+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                             divdatosGenCentro+='<label>NOMBRE DEL C.T:</label>';
                             divdatosGenCentro+='<label>'+data[0][0].nombrect+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                             divdatosGenCentro+='<label>NIVEL DEL C.T.:</label>';    
                             divdatosGenCentro+='<label>'+data[0][0].nivel+'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                             divdatosGenCentro+='<label>MUNICIPIO DEL C.T.:</label>';    
                             divdatosGenCentro+='<label>'+data[0][0].municipio+'</label><br><br>';

                            $("#datosGenCentro").html(divdatosGenCentro);
                            $("#datosGenCentro2").html(divdatosGenCentro);
                            $("#datosGenCentro3").html(divdatosGenCentro);

                            $("#btnSiguiente").prop('disabled', false);
                            // $("#btnHistorialCCT").show();
                            // $("#btnUbicacionCCT").show();
                            
                            var divH='@can("195-btn-get-historial-cct")<button class="btn btn-secondary" type="button" id="btnHistorialCCT"  onclick="fnHistorial()">Historial</button>@endcan';
                            var divU='@can("196-btn-get-ubicacion-cct")<button class="btn btn-secondary" type="button" id="btnUbicacionCCT"  onclick="fnMapa()">Ubicación</button>@endcan';
                            $("#divHistorial").html(divH);
                            // $("#divUbicacion").html(divU); //20/09_2023  habia dicho que en lo que se soluciona se quitara

                            if(data[1] !='' || data[1] !=null ){
                                // $("#divHistorial").html(divH);
                                var htmlHist='<table class="table theadCentrar"><thead><th>Folio</th><th>Fecha de Solicitud</th><th>Fecha de Cierre</th><th>Acciones</th></thead><tbody>';
                                var j=0;
                                $.each(data[1], function(j, val){
                                    if (!jQuery.isEmptyObject(data[1])) {
                                        var nombree="'"+data[1][j].nombre_archivo+"'";

                                        htmlHist+='<tr><td >'+data[1][j].folio+'</td><td>'+data[1][j].fecha_orden+'</td><td>'+data[1][j].fecha_cierre+'</td>';
                                        htmlHist+='<td><div class="dropdown btn-group dropend">';
                                        htmlHist+='<button class="btn btn-link text-secondary mb-0 "';
                                        htmlHist+='data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >';
                                        htmlHist+='<i class="fa fa-ellipsis-v text-xs"></i></button>';
                                        htmlHist+='<ul class="dropdown-menu" aria-labelledby="opciones1">';
                                        htmlHist+='<li>';
                                        htmlHist+='<a onclick="fnVerOrdenCentro('+nombree+')" class="dropdown-item"> ';
                                        // htmlHist+='<i class="fas fa-download"></i> Ver Orden...';
                                        htmlHist+='<i class="fas fa-download"></i> Visualizar...';
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

                            // $("#divHistorial").html('');
                            // $("#divUbicacion").html('');
                            // $("#hist").html('');

                                fnLimpiar();
                                $("#datosGenCentro").html('');
                                $("#datosGenCentro2").html('');
                                $("#datosGenCentro3").html('');
                            }
                    }else{
                        msjeAlerta('', 'No existe el Centro de Trabajo '+claveCCT, 'error')
                        $("#btnSiguiente").prop('disabled', true);

                        // $("#divHistorial").html('');
                        // $("#divUbicacion").html('');
                        // $("#hist").html('');

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

        // var macc = {lat: latitud, lng: longitud};
        // // var macc = {lat: latitud, lng: longitud};

        // var map = new google.maps.Map(
        // document.getElementById('map'), {zoom: 15, center: macc});

        // var marker = new google.maps.Marker({position: macc, map: map});

        var map = L.map('map').setView([latitud, longitud], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker = L.marker([latitud, longitud]).addTo(map);

        var circle = L.circle([latitud, longitud], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);

//         L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
// attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
// maxZoom: 18
// }).addTo(map);

    }

    function fnHistorial(){
        var clave = $("#txtClaveCCT").val();
        var nombrecct = $("#txtNombreCCT").val();
        $("#spclavecct").text('C.C.T.: '+clave +' - '+ nombrecct);  

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
        
        var checkDirector='';
        var nombreSol='';
        if($("#checkSolicitante").is(':checked')) {  
            checkDirector= true;
            nombreSol=$("#txtDirectorCCT").val();
        } else {  
            checkDirector= false;
            nombreSol='';
        }  

        if($("#checkSeguimiento").is(':checked')) {  
            checkSeguimiento= true;
        } else {  
            checkSeguimiento= false;
        }  
         
        var form = $('#formOrden')[0];
         // FormData object 
         var data2 = new FormData(form);
        //  data2.append('arrEquipos',arrEquipos);
        data2.append('arrEquipos', JSON.stringify(arrEquipos));
        data2.append('checkDirector', JSON.stringify(checkDirector));
        data2.append('nombreSol', JSON.stringify(nombreSol));
        data2.append('checkSeguimiento', JSON.stringify(checkSeguimiento));
        // data2.append('equipo_servicio',equipo_servicio);
        var vCorreo = data2.get('txtCorreoSolicitante');
        //  console.log(data2);
        
        $.ajax({
            url: urlEditar,
            type: 'POST',
            data:data2,
            dataType: 'json', 
            processData: false,
            contentType: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data) {

                // var vequip = JSON.parse(data[0].inssolicservicio);  //V1 Con Equipos solamente sin detalle
                var vequip = JSON.parse(data[0].inssolicservicio); //v2 Con Equipos y detalle
                  
                // if(data[0]['inssolicservicio']!=''){ 
                 if(data[0]['inssolicservicio']!=''){ 
                     msjeAlerta2('','<span>Se ha registrado con éxito la orden de servicio con el folio: <strong>'+vequip.vpfolio+'.</strong> <br>Favor de agendar cita para la visita de soporte y contactar al usuario.</span>','success',vequip.vpid_solic_serv)

                    // $.ajax({
                    //     url: '{{route('enviarCorreo')}}',
                    //     type: 'POST',
                    //     data: {
                    //         folio: vequip.vpfolio,
                    //         correo: vCorreo
                    //     },
                    //     dataType: 'json', 
                    //     processData: false,
                    //     contentType: false,
                    //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    //     success: function(data) {
                    //         console.log(data+'---correooo1');
                    //         console.log(data.exito+'---correooo2');

                            
                    //     }
                    // });
                }else{ 
                    msjeAlerta('', 'No se pudo realizar el registro de la Orden de Servicio','error')
                }
                
            }
        });
    }

    function fnLimpiar(){
        $("#formOrden")[0].reset();
        $("#divHistorial").html('');
        $("#divUbicacion").html('');
        $("#hist").html('');
    }

    function fnNumero(){
        var tecla = event.key;
        if (['.','e'].includes(tecla))
        event.preventDefault()
    }

    function fnVerOrdenCentro(nombreA){
        var nombre_archivo=nombreA;
        let urlArchivo = '{{ asset("cierreOrden/:id") }}';
        urlArchivo = urlArchivo.replace(':id', nombre_archivo);

        window.open(urlArchivo, '_blank');
    }

    // function fnValidarCorreo(){
    //     var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    //     if (! regex.test($('#email').val().trim())) {
    //         // alert('Correo validado');
    //         msjeAlerta('', 'El correo no es valido', 'error')

    //     } 
    //     // else {
    //     //     msjeAlerta('', 'El correo no es valido', 'error')
    //     // }
    // }

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

        // var macc = {lat: 42.1382114, lng: -71.5212585};
        // // var macc = {lat: latitud, lng: longitud};

        // var map = new google.maps.Map(
        // document.getElementById('map'), {zoom: 15, center: macc});

        // var marker = new google.maps.Marker({position: macc, map: map});

        // var map = L.map('map').setView([51.505, -0.09], 13);

        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     maxZoom: 19,
        //     attribution: '© OpenStreetMap'
        // }).addTo(map);

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
        htmlSel+='<label>Detalle del Equipo:</label><label class="SinNegrita" id="lblDescProblema">'+marca+', '+modelo+', '+numeroSerie+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Ubicación del Equipo:</label><label class="SinNegrita" id="lblDescProblema">'+ubicacion+'</label>';
        htmlSel+='</div>';
        htmlSel+='</div>';

        htmlSel+='<div class="row">';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Cantidad:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].cantidad+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        htmlSel+='<label>Tipo de Equipo:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].desc_tipo_equipo+'</label>';
        htmlSel+='</div>';
        htmlSel+='<div class="col-4">';
        htmlSel+='</div>';
        htmlSel+='</div>';
        htmlSel+='<br>';
        htmlSel+='<div class="row">';
        htmlSel+='<div class="col-12">';
        htmlSel+='<label>Listado de Servicios/Tareas</label>';
        htmlSel+='</div>';
        htmlSel+='</div>';

        // htmlSel+='<table style="border:1px solid; width:100%;">';
        //     htmlSel+='<tr style="border:1px solid;">'; //background-color:#8392ab;
        //     htmlSel+='<td><label>Etiqueta:</label><label class="SinNegrita" id="lblEtiqueta">'+etiquetaServicio+'</label></td>';
        //     htmlSel+='<td><label>Marca:</label><label class="SinNegrita" id="lblMarca">'+marca+'</label></td>';
        //     htmlSel+='<td><label>Modelo:</label><label class="SinNegrita" id="lblModelo">'+modelo+'</label></td>';
        //     htmlSel+='<td><label>Número de Serie:</label><label class="SinNegrita" id="lblSerie">'+numeroSerie+'</label></td>';
        //     htmlSel+='<td colspan="2"></td>';
        //     htmlSel+='</tr>';

        //     htmlSel+='<tr>';
        //     htmlSel+='<td colspan="2">';
        //     htmlSel+='<label>Tipo de Equipo:</label><label class="SinNegrita" id="lblTipoEquipo">'+arrEquipos[numArr].desc_tipo_equipo+'</label></td>';
        //     htmlSel+='<td colspan="2">';
        //     htmlSel+='<label>Cantidad:</label><label class="SinNegrita" id="lblCantidad">'+arrEquipos[numArr].cantidad+'</label></td>';
        //     htmlSel+='<td colspan="2">';
        //     htmlSel+='<label>Ubicación del equipo:</label><label class="SinNegrita" id="lblUbic">'+arrEquipos[numArr].ubicacionEquipo+'</label>';
        //     htmlSel+='</td>';
        //     htmlSel+='</tr>';

        //     htmlSel+='<tr>';
        //     htmlSel+='<td colspan="6">';
        //     htmlSel+='<label>Descripción del problema:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].descripcionSoporte+'</label><br>';
        //     htmlSel+='</td>';
        //     htmlSel+='</tr>';

        //     htmlSel+='<tr>';
        //     htmlSel+='<td colspan="6"><label>Listado de Servicios/Tareas:</label></td>';
        //     htmlSel+='</tr>';

        //     htmlSel+='<tr>';
        //     htmlSel+='<td colspan="6" style="text-align:center;">';

                // var html='';
                htmlSel+='<table class="table">';
                htmlSel+='<thead>';
                htmlSel+='<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Servicio</th>';
                htmlSel+='<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tarea</th>';
                htmlSel+='</thead>';
                htmlSel+='<tbody>';
    
                var aTarea=arrEquipos[numArr]['aTarea'];
                var aux='';
                $.each(aTarea, function(j, val){
                    if (!jQuery.isEmptyObject(aTarea[j])) {
                        htmlSel+='<tr>';
                        if(aux==aTarea[j]['desc_Servicio']){ 
                            htmlSel+='<td >&nbsp;</td>';
                            // aux='';
                        }else{
                            aux=aTarea[j]['desc_Servicio'];
                            htmlSel+='<td class="text-xs text-secondary mb-0">'+aTarea[j]['desc_Servicio']+'&nbsp;</td>';
                        }
                        // htmlSel+='<td class="text-xs text-secondary mb-0">'+aTarea[j]['desc_Servicio']+'&nbsp;</td>';
                        htmlSel+='<td class="text-xs text-secondary mb-0"> - '+aTarea[j]['desc_Tarea']+'</td>';
                        htmlSel+='<tr>';
                    }
                });

                htmlSel+='</tbody>';
                htmlSel+='</table>';

            htmlSel+='</td>';
            htmlSel+='</tr>';

            htmlSel+='</table>';
            htmlSel+='<br>';

            // htmlSel+='<tr>';
            // htmlSel+='<td colspan="4">';
            // htmlSel+='<label>Tipo de Equipo:</label><label class="SinNegrita" id="lblTipoEquipo">'+arrEquipos[numArr].desc_tipo_equipo+'</label><br>';
            // htmlSel+='<label>Descripción del problema:</label><label class="SinNegrita" id="lblDescProblema">'+arrEquipos[numArr].descripcionSoporte+'</label><br>';
            // htmlSel+='<label>Ubicación del equipo:</label><label class="SinNegrita" id="lblUbic">'+arrEquipos[numArr].ubicacionEquipo+'</label><br>';
            // htmlSel+='<label>Servicio(s):</label><label class="SinNegrita" id="lblServicios">'+arrEquipos[numArr].servicio+'</label><br>';
            // htmlSel+='<label>Tarea(s):</label><label class="SinNegrita" id="lblTareas">'+arrEquipos[numArr].tarea+'</label><br>';
            // htmlSel+='</td>';
            // htmlSel+='</tr>';
            // htmlSel+='</table>';
            // htmlSel+='<br>';
        
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


</script>
@endsection
