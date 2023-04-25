@extends('layouts.contentIncludes')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    /* .tabb {
        color: white;
        background: #ab0033;
    }  

     .tab-content {
        display: none;
    }*/

    .show {
        display: block;
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
                            <ul class="nav nav-pills nav-justified">
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
                                        <div class="col-6">
                                            <input type="text" id="txtCentroTrabajo" style="text-align:left;" name="txtCentroTrabajo" class="form-control input-group-text" value="{{-- $id --}}" aria-describedby="btnBuscar" >       
                                        </div>

                                        <div class="col-6">
                                            <button class="btn btn-secondary" type="button" id="btnBuscar"  onclick="fnBuscarCCT()">Buscar</button>
                                        </div>
                                       
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtNombreCCT">NOMBRE</label>
                                            <input type="text" id="txtNombreCCT" name="txtNombreCCT" class="form-control" value="" readonly >
                                            <!-- <label id="nombre_alumno" class="SinNegrita">{{-- $registro->nombre_alumno --}}</label> -->
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="txtClaveCCT">CLAVE</label>
                                            <input type="text" id="txtClaveCCT" name="txtClaveCCT" class="form-control" value="" readonly >
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
                                        <div class="col-3">
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

                                        <div class="col-3">
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
                                            <button type="button" class="btn colorBtnPrincipal" id="btnSiguiente" disabled>SIGUIENTE</button> 
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
                                                    <option value="1" selected>Area 1</option>
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
                                                <input type="text" id="txtTelefonoSolicitante" name="txtTelefonoSolicitante" class="form-control" value="" >
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txtCorreoSolicitante">CORREO INSTITUCIONAL DEL SOLICITANTE</label>
                                                <input type="text" id="txtCorreoSolicitante" name="txtCorreoSolicitante" class="form-control" value=""  >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="txtDescripcionReporte">DESCRIPCIÓN DEL REPORTE</label>
                                                <textarea class="form-control" id="txtDescripcionReporte" name="txtDescripcionReporte" rows="3"></textarea>
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
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="selTipoEquipo">TIPO DE EQUIPO A REVISAR</label>
                                                <select class="form-select" aria-label="Default select example" id="selTipoEquipo" name="selTipoEquipo" >
                                                    <option value="0" selected>Seleccionar</option>
                                                    <option value="1" >PC</option>
                                                    <option value="2" >PC</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                 <label for="selTipoServicio">TIPO DE SERVICIO</label>
                                                <!--<select class="form-select" aria-label="Default select example" id="selDepAtiende" name="selDepAtiende" >
                                                    <option value="0" selected>Seleccionar</option>
                                                </select> -->

                                                <div class="input-group">
                                                    <select class="form-select" id="selTipoServicio" name="selTipoServicio" aria-label="Example select with button addon">
                                                        <option value="0" selected>Seleccionar</option>
                                                        @foreach($catTipoServicio as $tipoServicio)
                                                            <option value="{{ $tipoServicio->id_tipo_servicio }}">{{ $tipoServicio->desc_tipo_servicio }}</option>
                                                        @endforeach
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

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtEtiquetaServicio">ETIQUETA DE SERVICIO</label>
                                                <input type="text" id="txtEtiquetaServicio" name="txtEtiquetaServicio" class="form-control" value="" >
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtMarca">MARCA</label>
                                                <input type="text" id="txtMarca" name="txtMarca" class="form-control" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtModelo">MODELO</label>
                                                <input type="text" id="txtModelo" name="txtModelo" class="form-control" value=""  readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txtNumeroSerie">NÚMERO DE SERIE</label>
                                                <input type="text" id="txtNumeroSerie" name="txtNumeroSerie" class="form-control" value="" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
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

                                        <div class="col-3 justify-content-md-start">
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
                                                    <th>EQUIPO</th><th>SERVICIO</th><th>ESTATUS</th><th>OPCIONES</th>
                                                </thead>
                                                <tbody id="tbEquipos">

                                                </tbody>
                                            </table>
                                        </div>
                                        <br>
                                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="button" class="btn btn-secondary" id="btnAnterior3" >ANTERIOR</button>
                                            <button type="button" class="btn colorBtnPrincipal" id="btnGuardar" onclick="fnGuardar()"> GUARDAR</button>
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
@endsection

@section('page-scripts')
<script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="{{ asset('js/sweetalert2@11.js') }}"></script>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->

<script>
    let arrTareas = [];
    let arrServicios = [];
    var arrEquipos = [];
    // var equipo_servicio = {
    //             nom_equipo: '',
    //             num_inventario: '',
    //             servicios_equipo: []
    //         };

    $(document).ready(function () {
        // $("#divTablaEquipos").hide()

        // $("#btnSiguiente").hide()
        // $("#btnSiguiente").prop('disabled', true);
        

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
            }

            if(vDescripcionReporte==''){
                msjeAlerta('', 'Debe ingresar la descripción del reporte', 'error');
            }

            if(vId_TipoOrden!=0 && vId_DepAtiende!=0 && vNombreSolicitante!='' && vTelefonoSolicitante!=''&& vCorreoSolicitante!=''&& vDescripcionReporte!='' ){
                $("#tab3").attr('class', 'nav-link');
                $("#tab3").tab('show');
            }
            // else{
            //     msjeAlerta('', 'Debe llenar todos los campos', 'error');
            // }
            
        });


        $("#btnAnterior2").click(function(){
            $("#tab1").attr('class', 'nav-link');
            $("#tab1").tab('show');
        });

        $("#btnAnterior3").click(function(){
            $("#tab2").attr('class', 'nav-link');
            $("#tab2").tab('show');
        });

        var tablaEquipo='';
        var i=0;
        // var arrEquipos = [];
        $("#btnAgregarEquipo").click(function(){
            // var bandCheck=0;
            $("#checkReplicar").click(function() {  
                if($("#checkbox").is(':checked')) {  
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
                $("#selServicio").val("0").attr("selected",true);
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

        $('#selTipoServicio').on('change', function() { /// Cargar select Tarea en base a Servicio
            let urlEditar = '{{ route("consTarea", ":idserv") }}';
            urlEditar = urlEditar.replace(':idserv', this.value);
            
            $("#selTarea").val("0").attr("selected",true);
            let element = document.getElementById("selTarea");
            element.value = '0';

            $.ajax({
                url: urlEditar,
                type: 'GET',
                dataType: 'json', 
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

    //   tablaEquipo2+='<tr id="tr_'+i+'"><td>'+vTipoEquipo+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+i+')">Ver</button></td><td>En Proceso</td>';
    //     tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
    //     tablaEquipo2+='</tr>';
    //     $("#tbEquipos").html(tablaEquipo2);
        
    $.each(arrEquipos, function(j, val){
        if (!jQuery.isEmptyObject(arrEquipos[j])) {
        
            tablaEquipo2+='<tr id="tr_'+j+'"><td>'+arrEquipos[j]['desc_tipo_equipo']+'</td><td><button type="button" btn class="btn btn-secondary" onclick="verServicioEquipo('+j+')">Ver</button></td><td>En Proceso</td>';
            tablaEquipo2+='<td><button type="button" class="btn colorBtnPrincipal" onclick="removeEquipo('+j+');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></td>';
            tablaEquipo2+='</tr>';
        }
    });


    $("#tbEquipos").empty();
    $("#tbEquipos").html(tablaEquipo2);
    //   $("#selTarea").val("0").attr("selected",true);
    }


    function removeTarea( item ) {
        if(arrTareas.includes(item) ==false){ 
            if ( item !== -1 ) {
                arrTareas.splice( item, 1 );
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

    //   $.each(arrTareas, function(i, val){
    //     if (!jQuery.isEmptyObject(arrTareas[i])) {
    //         console.log(arrTareas[i]);
    //         listaTarea2+='<li id="liT_'+i+'">'+arrTareas[i]['desc_Tarea']; 
    //         listaTarea2+='&nbsp;<button type="button" onclick="removeTarea('+i+');" class="btn colorBtnPrincipal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button>';
    //     }
    //   });

    var listaTarea2='';

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

    function fnBuscarCCT(){
    
        var claveCCT= $("#txtCentroTrabajo").val();
        let urlEditar = '{{ route("consCCT", ":claveCCT") }}';
        urlEditar = urlEditar.replace(':claveCCT', claveCCT);
        
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
                    //   console.log(data[0][0]);   //data[0][i].id_tarea
                    if(data !=''){
                        $("#txtNombreCCT").val(data[0][0].nombre);
                        $("#txtClaveCCT").val(data[0][0].clave);
                        $("#txtMunicipioCCT").val(data[0][0].municipio)
                        $("#txtDirectorCCT").val(data[0][0].director);
                        $("#txtDireccionCCT").val(data[0][0].direccion);
                        $("#txtCoordinacion").val(data[0][0].coordinacion);
                        $("#txtTelefono").val(data[0][0].telefono);
                        $("#txtTurno").val(data[0][0].turno);
                        $("#txtNivelEducativo").val(data[0][0].nivel_educativo);

                        $("#btnSiguiente").prop('disabled', false);
                    }else{
                        msjeAlerta('', 'No existe el Centro de Trabajo '+claveCCT, 'error')
                        $("#btnSiguiente").prop('disabled', true);
                        fnLimpiar();
                    }
                }
            });
        }
    }

    function fnGuardar(){
        var claveCCT= $("#txtClaveCCT").val();
        let urlEditar = '{{ route("guardarOrden") }}';
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

    function verServicioEquipo(i){
        // var aServicio=arrEquipos[i]['aServicio'];
        // console.log('-----servicio arr-----');
        //  console.log(arrEquipos[i]['aTarea']);
        //  console.log('-----fin servicio arr-----');
        //  var long=0;
        //  long=aServicio.length;
         var html='';
        // html+='<ul>';
        html+='<table>';
            html+='<thead>';
            html+='<th>Servicio</th>';
            html+='<th>Tarea</th>';
            html+='</thead>';
            html+='<tbody>';
        //     console.log(aServicio[i]);
        // $.each(aServicio, function(i, val){
        // if (!jQuery.isEmptyObject(aServicio[i])) {
           
            // console.log(aServicio[i]);
            // html+='<li id="liT_'+i+'">'+aTarea[i]['desc_Servicio']+': '+aTarea[i]['desc_Tarea']; 
            // html+='</li>';

            // html+='<tr>';
            // html+='<td>'+aTarea[i]['desc_Servicio']+'</td><td>'+aTarea[i]['desc_Tarea']+'</td>';
            // html+='</tr>';
            // console.log(i);
            //  console.log(aServicio[i]['desc_Servicio'])
            
            
            
            // var aTarea=aServicio[i]['aTarea'];
            var aTarea=arrEquipos[i]['aTarea'];
            var aux='';
            $.each(aTarea, function(j, val){
            if (!jQuery.isEmptyObject(aTarea[j])) {
                // aux=aTarea[j]['desc_Servicio'];
                // console.log(aTarea[j]);
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
                
                // html+='<li id="liT_'+i+'">'+aTarea[i]['desc_Servicio']+': '+aTarea[i]['desc_Tarea']; 
                // html+='</li>';
                html+='<td> - '+aTarea[j]['desc_Tarea']+'</td>';
                html+='<tr>';
                
            }
            });
            
    //     }
    //   });
      html+='</tbody>';
        html+='</table>';
    //   html+='</ul>';

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
    



</script>
@endsection
