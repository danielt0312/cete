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
                                            &nbsp; Busqueda por Folio
                                            </label></b>
                                    </div>
                                    <div class="col-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="radio_correo">
                                            <b><label class="form-check-label" for="flexRadioDefault1">
                                            &nbsp; Busqueda por Email
                                            </label></b>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="row" id="div_folio">
                            <div class="col-2" style="text-align:right;">
                                <label for="">Ingresar folio : </label>
                            </div>
                            <div class="col-5">
                            <input type="text" id="vFolio" placeholder="Ingrese el folio de su solicitud" class="form-control">
                            </div>
                            <div class="col-3"></div>
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
                                    <span><b>Token:</b></span>&nbsp;&nbsp;&nbsp;
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
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS SOLICITUD</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA DE SOLICITUD</th>
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
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS SOLICITUD</th>
                            <th data-orderable="false"  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FECHA DE SOLICITUD</th>
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
                      <div class="col-12 table-wrapper" >
                        <table class="table" >
                          <thead>
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
  <div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script>
    bandera = 0;
    gvCorreo = '';
    gvToken = '';
//     $( function() {
//     var availableTags = [
//       "ActionScript",
//       "AppleScript",
//       "Asp",
//       "BASIC",
//       "C",
//       "C++",
//       "Clojure",
//       "COBOL",
//       "ColdFusion",
//       "Erlang",
//       "Fortran",
//       "Groovy",
//       "Haskell",
//       "Java",
//       "JavaScript",
//       "Lisp",
//       "Perl",
//       "PHP",
//       "Python",
//       "Ruby",
//       "Scala",
//       "Scheme"
//     ];
//     $( "#tags" ).autocomplete({
//       source: availableTags
//     });
//   } );

    $("#vFolio").keyup(function(){
        var txt = $(this).val();
        
        $(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ return $1.toUpperCase( ); }));
        console.log(txt);
        if (txt.length > 2) {
            $.ajax({
            url: '{{route("pruebaJC2")}}',
            type: 'GET',
            // minLength: 3,
            data: {
                txt : txt
            }
            }).always(function(r) {
                console.log(r.arreglo);

                // $( "#tags" ).autocomplete({
                // source: r.arreglo
                // });
            });
        }
        
    });


</script>
@endsection