@extends('layouts.contentIncludes')
@section('title','CAS CETE')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
.table-wrapper {
    width: 100%;
    height: 400px; /* Altura de ejemplo */
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
  /* background-color: #FFF; */
}

</style>
@section('content')
<div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Materiales o Refacciones </h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                
                
                <input type="text" id="id_solicitud_input" hidden value="{{ $query[0]->id_servicio}}">
                <input type="text" id="id_solicitud_actividad_input" hidden value="{{ $query[0]->actividad_realizada}}">
                <input type="text" id="id_solicitud_nota_input" hidden value="{{ $query[0]->nota_tecnica}}">
                <div class="card-body">
                    @foreach($datos as $datos2)
                        <div class="row">
                            <div class="col-12">
                                <label style="color:#ab0033 !important">FOLIO DE ORDEN:</label>
                                <label style="color:#ab0033 !important">{{$datos2->folio}}</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label style="color:#ab0033 !important">ESTATUS:</label>
                                <label style="color:#ab0033 !important">{{$datos2->estatus}}</label>
                            
                            <div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                            
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO&nbsp;: {{$datos2->clavecct}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">NOMBRE DEL C.T.&nbsp;: {{$datos2->nombrect}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">NIVEL DEL C.T.&nbsp;: {{$datos2->nivel}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">MUNICIPIO DEL C.T.&nbsp;: {{$datos2->municipio}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <div>
                        </div>
                    @endforeach
                    <br>
                    <div class="row">
                        <div class="col-5" style="text-align:center;  background-color:#ab0033;">
                            <span style="color:white;">Descripción de servicio(s) o asesoria(s) agregados</span>
                        </div>
                        <div class="col-7" style="text-align:center; border-bottom:3px solid #ab0033;">
                        </div>
                    </div>
                   <br>
                    <div class="row">
                        <div class="col-12 table-wrapper" id="divTablaEquipos">
                            <table class="table-responsive" id="tablaEquipos" width="100%">
                                <thead class="text-align:center;" style="background-color: white;">
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">CANTIDAD</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">EQUIPO/SERVICIO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">DESCRIPCIÓN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">SERVICIO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">TAREA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder">AGREGAR MATERIAL</th>
                                    </tr>
                                </thead>
                                <tbody id="tbEquipos" >
                                    @foreach($query as $query2)
                                        @if( $query2->id_tarea == 22 || $query2->id_tarea == 23 || $query2->id_tarea == 37)
                                            <tr>
                                                <td style="text-align:center;" class="text-s text-secondary mb-0">{{$query2->cantidad}}</td>
                                                <td class="text-s text-secondary mb-0">{{$query2->tipo_equipo}}</td>
                                                <td class="text-s text-secondary mb-0">{{$query2->desc_problema}}</td>
                                                <td class="text-s text-secondary mb-0">{{$query2->servicio}}</td>
                                                <td class="text-s text-secondary mb-0">{{$query2->tarea}}</td>
                                                <td style="text-align:center;">
                                                    <div class="dropdown btn-group dro pstart">
                                                        <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" >
                                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a onclick="fnAgregarMaterial({{$query2->id_servicio_tarea}},{{$query2->id_equipo_detalle}})" class="dropdown-item"> 
                                                                <i class="fas fa-edit"></i>
                                                                    Agregar Material
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a onclick="fnImprimirMaterial({{$query2->id_servicio}},{{$query2->id_equipo_detalle}})" class="dropdown-item"> 
                                                                <i class="fas fa-download"></i>
                                                                    Imprimir Material
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                        
                            </table>
                        </div>
                        
                        <br>
                        
                        
                        <br>
                        <br>
                        <div class="col-12 lineaHr"></div><br><br>
                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" href='{{route("listadoOrdenes")}}' id="btnRegresar">Regresar</button>
                            <button type="button" class="btn btn-secondary" id="btnImprimir">Imprimir</button>
                            <!-- <button type="button" class="btn colorBtnPrincipal" id="btnActualizar"> Actualizar</button> -->
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
                </div>
                <div class="modal-body" id="modal_body">
                    @foreach($datos as $datos2)
                        <div class="row">
                            <div class="col-12">
                                <label style="color:#ab0033 !important">FOLIO DE ORDEN:</label>
                                <label style="color:#ab0033 !important">{{$datos2->folio}}</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label style="color:#ab0033 !important">ESTATUS:</label>
                                <label style="color:#ab0033 !important">{{$datos2->estatus}}</label>
                            
                            <div>
                        </div>
                        <input hidden id="input_estatus" value="{{$datos2->id_esatus}}" type="number">
                        <!-- <div class="row">
                            <div class="col-12">
                            
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">CENTRO DE TRABAJO&nbsp;: {{$datos2->clavecct}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">NOMBRE DEL C.T.&nbsp;: {{$datos2->nombrect}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">NIVEL DEL C.T.&nbsp;: {{$datos2->nivel}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <b><span id="span_centro_trabajo" style="font-size:0.75em;">MUNICIPIO DEL C.T.&nbsp;: {{$datos2->municipio}}</span></b>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            <div>
                        </div> -->
                    @endforeach
                    <br>
                    <div class="row">
                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label style="color:white;">Agregar Material o Refaccion</label>
                        </div>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                    <br>
                    <div class="row" id="div_select"></div>
                  
                    
                    <br>

                    <div class="row">
                        <div class="col-12 table-wrapper" id="divTablaProductos2">
                        
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">DESCRIPCION</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">ESPECIFICACION</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">MEDIDA</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">TIPO</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">CANTIDAD</th>
                                </thead>
                                <tbody id="tbProductos2">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <!-- <button class="btn btn-secondary float-right" style="font-size:0.80em;" id="btn_regresar1">Regresar</button> -->
                        <button  class="ms-3 btn btn-primary float-right" style="font-size:0.80em;"  id="btn_agregar_material">Agregar Material</button>
                    </div>
                    <br>
                    <div class="row" id="divEncabezadoTabla">
                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label style="color:white;">Tabla de materiales agregados</label>
                        </div>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-wrapper" id="divTablaProductos3">
                        
                            <table class="table">
                                <thead>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Producto</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">DESCRIPCION</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">ESPECIFICACION</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">MEDIDA</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">TIPO</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">CANTIDAD</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">ACCION</th>
                                </thead>
                                <tbody id="tbProductos3">

                                </tbody>
                            </table>
                        </div>
                    </div>

                  
                    
                </div>
                <div class="modal-footer">
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
        var arreglo_productos = [];
        var arreglo_productos2 = [];
        var arreglo_productos_guardar = [];
        var arreglo_productos_guardar2 = [];

        // var arreglo_productos3 = [];
        var arreglo_eliminar_producto = [];
        var bandera_material = 0;
        var bandera_guardar = 0;
        var id_global_producto = 0;
        
        $(function () {
            $('#exampleModal').modal({backdrop: 'static', keyboard: false})
            // $("#tablaEquipos tbody tr").css("background-color", "#E8E8E6");
            // $('#tablaEquipos tbody').on('click', 'tr', function () {
            //     console.log($(this));
            //     // console.log(table.row( this ).data());
            //     $("#tbEquipos tbody tr").css("background-color", "#FFFFFF");
            //     $(this).css("background-color", "#E8E8E6");
            // });
            
        });
        $('#tablaEquipos tbody').on('click', 'tr', function () {
                // console.log($(this));
                // console.log(table.row( this ).data());
                // $("#tbEquipos tbody tr").css("background-color", "#FFFFFF");
                var trs = $("#tablaEquipos").find("tbody>tr");
                trs.css("background-color", "#FFFFFF");
                $(this).css("background-color", "#E8E8E6");
            });
        

        function fnAgregarMaterial(id,id_equipo_detalle){
            
            
            
            var contador_1 = 0;
            var id_equipo_detalle = id_equipo_detalle;
            id_global_producto = id_equipo_detalle;
            // id="58"
            console.log(id_equipo_detalle);
            $('#divTablaProductos').hide();
            $('#divEncabezadoTabla').hide();
            
            $('#id_proucto').prop('disabled',true);
            

            $('#divTablaProductos2').hide();
            $('#divTablaProductos3').hide();
            
            $('#btn_agregar_material').hide();

            $.ajax({
                url: '{{route("detalle_material")}}',
                type: 'GET',
                data: {'id_equipo_detalle' : id_equipo_detalle}
                }).always(function(r) {
                    var contador3 = 0;
                    console.log(r);
                    for (let i = 0; i < r.detalle_material.length; i++) {
                        if (r.detalle_material[i]['activo'] == true) {
                            arreglo_productos_guardar.push({contador:contador3, id_producto:r.detalle_material[i]['id_producto'], nombre:r.detalle_material[i]['nombre'],
                                id_servicio_tarea:r.detalle_material[i]['id_servicio_tarea'], descripcion:r.detalle_material[i]['descripcion'],
                                especificacion:r.detalle_material[i]['especificacion'], medida:r.detalle_material[i]['medida'], tipo:r.detalle_material[i]['tipo'],
                                bandera :1, contador: contador3, cantidad : r.detalle_material[i]['cantidad'], update:1, id_producto_detalle : r.detalle_material[i]['id_producto_detalle']});
                            contador3 = contador3 + 1;
                        }
                        
                    }
                    // arreglo_productos3.push(r.detalle_material);
                    // console.log(arreglo_productos3);
                    drawRowMaterial2_1();
                    // $('#divTablaProductos2').show();
            });

            $.ajax({
                url: '{{route("select_materiales")}}',
                type: 'GET',
                data: {'id_servicio_tarea' : id}
            }).always(function(r) {
                // console.log(r);
                
                var contador = 0;
                var html0 = '';
                // html0+='';
                html0+='<div class="col-7">';
                    html0+='<label for="">Productos</label><br>';
                    html0+='<select class="form-select" title="SELECCIONAR TAREA" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" aria-label="Default select example" id="id_producto2">';
                        html0+='<option value="0">Seleccionar Productos</option>';
                        for (let i = 0; i < r.select_agrupado2.length; i++) {
                            // console.log(r.select_agrupado2[i]['nombre']);
                            html0+='<option value='+r.select_agrupado2[i]['nombre']+'>'+r.select_agrupado2[i]['nombre']+'</option>';
                            
                        }
                    html0+='</select>';
                html0+='</div>';

                $("#div_select").html(html0);


                $('#id_producto2').change(function(){
                    // console.log('entro el change');
                    bandera_material = 0;
                    bandera_guardar = 0;
                    $('#btn_agregar_material').prop('disabled',true);
                    // console.log($("#id_producto2 option:selected").text());
                    var nombre = $("#id_producto2 option:selected").text();
                    $.ajax({
                        url: '{{route("cat_materiales2")}}',
                        type: 'GET',
                        data: {'nombre' : nombre, 'id_servicio_tarea' : id}
                    }).always(function(r) {
                        
                        // console.log(r);
                        
                        var contador2 = 0;
                        arreglo_productos2 = [];
                        
                        for (let i = 0; i < r.select_productos2.length; i++) {
                            // console.log(r.select_productos2[i]['descripcion']);
                            arreglo_productos2.push({contador:contador_1, id_producto:r.select_productos2[i]['id_producto'], nombre:r.select_productos2[i]['nombre'],
                                id_servicio_tarea:r.select_productos2[i]['id_servicio_tarea'], descripcion:r.select_productos2[i]['descripcion'],
                                especificacion:r.select_productos2[i]['especificacion'], medida:r.select_productos2[i]['medida'], tipo:r.select_productos2[i]['tipo']});
                                
                                contador_1 = contador_1 + 1;
                        }
                        // console.log(arreglo_productos2);
                        
                        drawRowMaterial2();
                        $('#divTablaProductos2').show();
                        $('#btn_agregar_material').show();
                        
                        
                        for (let i = 0; i < arreglo_productos2.length; i++) {
                            // console.log('entro el arreglo_productos2');
                            arreglo_productos_guardar.push({id_producto:arreglo_productos2[i]['id_producto'],
                                id_servicio_tarea:arreglo_productos2[i]['id_servicio_tarea'], descripcion:arreglo_productos2[i]['descripcion'],
                                especificacion:arreglo_productos2[i]['especificacion'], medida:arreglo_productos2[i]['medida'],
                                tipo:arreglo_productos2[i]['tipo'], nombre:arreglo_productos2[i]['nombre'],bandera :0, cantidad:1, contador:arreglo_productos2[i]['contador'],
                                update:0, id_producto_detalle :0});
                              
                            
                            $('#check_'+i).click(function(){
                                // console.log('entro el change');
                                if ($('#check_'+i).is(':checked')) {
                                    
                                    // arreglo_productos_guardar[i]['bandera'] = 1;
                                    // arreglo_productos_guardar[i]['cantidad'] = $('#cantidad_'+i+'').val();
                                    console.log(arreglo_productos2[i]['id_producto']);
                                    // console.log('entro');
                                    console.log(arreglo_productos_guardar);

                                    for (let i2 = 0; i2 < arreglo_productos_guardar.length; i2++) {
                                        // console.log(arreglo_productos_guardar[i2]['id_producto']);
                                        if (arreglo_productos2[i]['id_producto']+'_'+arreglo_productos2[i]['contador'] ==
                                            arreglo_productos_guardar[i2]['id_producto']+'_'+arreglo_productos_guardar[i2]['contador']) {
                                                arreglo_productos_guardar[i2]['bandera'] = 1;
                                        }
                                        // if (arreglo_productos2[i]['id_producto'] == arreglo_productos_guardar[i2]['id_producto']) {
                                        //     arreglo_productos_guardar[i2]['bandera'] = 1;
                                        // }
                                        
                                    }
                                    $('#btn_agregar_material').prop('disabled',false);
                                }
                                else{

                                    for (let i3 = 0; i3 < arreglo_productos_guardar.length; i3++) {
                                        // console.log(arreglo_productos_guardar[i3]['id_producto']);
                                        if (arreglo_productos2[i]['id_producto']+'_'+arreglo_productos2[i]['contador'] ==
                                            arreglo_productos_guardar[i3]['id_producto']+'_'+arreglo_productos_guardar[i3]['contador']) {
                                                arreglo_productos_guardar[i3]['bandera'] = 0;
                                        }
                                        // if (arreglo_productos2[i]['id_producto'] == arreglo_productos_guardar[i3]['id_producto']) {
                                        //     arreglo_productos_guardar[i3]['bandera'] = 0;
                                        // }
                                        
                                    }
                                    $('#btn_agregar_material').prop('disabled',true);
                                }
                            });
                        }

                        


                    });

                });

                // $(document).ready(function () {
                $('#btn_agregar_material').click(function(){
                    // console.log('entro la respuesta');
                    // console.log(bandera_material);
                    $('#btn_agregar_material').prop('disabled',true);
                    if (bandera_material == 0) {
                        bandera_material = 1;
                        // console.log(arreglo_productos_guardar);
                        console.log('btn_agregar_material');
                        console.log(bandera_material);

                        for (let i = 0; i < arreglo_productos2.length; i++) {
                            for (let i2 = 0; i2 < arreglo_productos_guardar.length; i2++) {
                                // const element = array[i2];
                                if (arreglo_productos2[i]['id_producto']+'_'+arreglo_productos2[i]['contador'] ==
                                    arreglo_productos_guardar[i2]['id_producto']+'_'+arreglo_productos_guardar[i2]['contador']) {
                                    // console.log('entro contador');
                                    // console.log($('#cantidad_'+i+'').val());
                                    arreglo_productos_guardar[i2]['cantidad'] = $('#cantidad_'+i+'').val();
                                    // console.log('cantidad_'+i);
                                }
                                
                                // console.log(i+' '+$('#cantidad_'+i+'').val());
                            }
                        }
                        
                        // console.log(arreglo_productos_guardar);

                        drawRowMaterial3();
                        $('#divEncabezadoTabla').show();
                        $('#divTablaProductos3').show();
                        // arreglo_productos_guardar = [];
                        $("#id_producto2").val("0").attr("selected",true);
                        $('#divTablaProductos2').hide();
                        $('#btn_agregar_material').hide();
                        $("#tbProductos2").empty();
                        // bandera_material = 1;
                        // }
                        // console.log(arreglo_productos_guardar);
                    }
                
                
                });
                // });
                

                $("#btnGuardar").click(function(){
                    // var bandera_ruta_guardar = 0;
                    
                        
                    
                        // console.log(arreglo_productos_guardar);
                        for (let i = 0; i < arreglo_productos_guardar.length; i++) {
                            if (arreglo_productos_guardar[i]['bandera'] == 1) {
                                arreglo_productos_guardar2.push(
                                    {id_producto:arreglo_productos_guardar[i]['id_producto'],
                                    id_servicio_tarea:arreglo_productos_guardar[i]['id_servicio_tarea'], descripcion:arreglo_productos_guardar[i]['descripcion'],
                                    especificacion:arreglo_productos_guardar[i]['especificacion'], medida:arreglo_productos_guardar[i]['medida'],
                                    tipo:arreglo_productos_guardar[i]['tipo'], nombre:arreglo_productos_guardar[i]['nombre'],
                                    cantidad:arreglo_productos_guardar[i]['cantidad'], update:arreglo_productos_guardar[i]['update'], id_producto_detalle : arreglo_productos_guardar[i]['id_producto_detalle']}
                                );
                            }
                        }

                        for (let i = 0; i < arreglo_productos_guardar2.length; i++) {
                            for (let i2 = 0; i2 < arreglo_eliminar_producto.length; i2++) {
                                if (arreglo_productos_guardar2[i]['id_producto_detalle'] == arreglo_eliminar_producto[i2]['id_producto_detalle']) {
                                    arreglo_eliminar_producto[i2]['bandera'] = 0;
                                }
                            }
                            
                        }
                        console.log(arreglo_productos_guardar2);
                        console.log(arreglo_eliminar_producto);
                        // if (bandera_ruta_guardar == 0) {
                            $('#btnGuardar').prop('disabled',true);
                            $('#btn_cerrar').prop('disabled',true);
                        if (bandera_guardar == 0) {
                            console.log(id_global_producto);
                            bandera_guardar = 1;
                            $.ajax({
                            url: '{{route("guardar_materiales")}}',
                            type: 'POST',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {'arreglo_productos_guardar2' : arreglo_productos_guardar2,
                                 'id_equipo_detalle' : id_global_producto, 'arreglo_eliminar_producto' : arreglo_eliminar_producto}
                            }).always(function(r) {
                                console.log(r);
                                var id_solicitud = $('#id_solicitud_input').val();
                                let urlEditar = '{{ route("index_materiales", ":id") }}';
                                urlEditar = urlEditar.replace(':id', id_solicitud);
                                window.location.href = urlEditar;
                            }); 
                        }
                        // }
                        // bandera_ruta_guardar = 1;
                        


                        
                        
                    
                    // console.log('entro a guardar');
                    // console.log(arreglo_productos_guardar2);
                    // console.log('entro a guardar');
                    

                    

                });

            });

            

            // arreglo_productos = [];
            
            
           
            $('#exampleModal').modal('show');
        }

        function drawRowMaterial2(){
            html1='';
            // console.log(arreglo_productos2);
            $.each(arreglo_productos2, function(j, val){
                if (!jQuery.isEmptyObject(arreglo_productos2[j])) {
                
                    html1+='<tr id="tr_'+j+'" >';
                        html1+='<td style="white-space: pre-line; word-break: break-word; text-align:center;"><div class="form-check"><input  class="form-check-input" type="checkbox" value="" id="check_'+j+'"></div></td>';
                        html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:center;">';
                            html1+=arreglo_productos2[j]['descripcion'];
                        html1+='</td>';
                        html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:center;">';
                            html1+=arreglo_productos2[j]['especificacion'];
                        html1+='</td>';
                        html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                            html1+=arreglo_productos2[j]['medida'];
                        html1+='</td>';
                        html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                            html1+=arreglo_productos2[j]['tipo'];
                        html1+='</td>';
                        html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                            html1+='<input class="form-control" style="width:40%;" type="number" value="1" id="cantidad_'+j+'">';
                        html1+='</td>';
                        // html1+='<td><button type="button" id="btn_eliminar" onclick="removeMaterial('+j+')" class="btnEliminar" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                    html1+='</tr>';
                    
                }
            });

            $("#tbProductos2").empty();
            $('#tbProductos2').html(html1);
        }

        function drawRowMaterial2_1(){
            html1='';
            contador_tabla = 0;
            var id_producto_contador = '';
            // console.log('drawRowMaterial3');
            // console.log(arreglo_productos_guardar);

            $.each(arreglo_productos_guardar, function(j, val){
                if (!jQuery.isEmptyObject(arreglo_productos_guardar[j])) {
                    if (arreglo_productos_guardar[j]['bandera'] == 1) {
                        id_producto_contador = arreglo_productos_guardar[j]['id_producto']+'_'+arreglo_productos_guardar[j]['contador'];
                        // console.log(id_producto_contador+'entro 35');
                        html1+='<tr id="tr_'+j+'" >';
                            html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['nombre'];
                            html1+='</td>';    
                            html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['descripcion'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:left;">';
                                html1+=arreglo_productos_guardar[j]['especificacion'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['medida'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['tipo'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['cantidad'];
                            html1+='</td>';
                            html1+="<td><button type='button' id='btn_eliminar' onclick='removeMaterial2(\""+id_producto_contador+"\");' class='btnEliminar' ><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        html1+='</tr>';
                        contador_tabla = contador_tabla + 1;
                    }
                }
            });

            if (contador_tabla == 0) {
                $('#divTablaProductos3').hide();
                $('#divEncabezadoTabla').hide();
            }
            else{
                $('#divTablaProductos3').show();
                $('#divEncabezadoTabla').show();
                $("#tbProductos3").empty();
                $('#tbProductos3').html(html1);
            }
            
        }

        function drawRowMaterial3(){
            html1='';
            contador_tabla = 0;
            var id_producto_contador = '';
            // console.log('drawRowMaterial3');
            // console.log(arreglo_productos_guardar);

            $.each(arreglo_productos_guardar, function(j, val){
                if (!jQuery.isEmptyObject(arreglo_productos_guardar[j])) {
                    if (arreglo_productos_guardar[j]['bandera'] == 1) {
                        id_producto_contador = arreglo_productos_guardar[j]['id_producto']+'_'+arreglo_productos_guardar[j]['contador'];
                        // console.log(id_producto_contador+'entro 35');
                        html1+='<tr id="tr_'+j+'" >';
                            html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['nombre'];
                            html1+='</td>';    
                            html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['descripcion'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="white-space: pre-line; word-break: break-word; text-align:left;">';
                                html1+=arreglo_productos_guardar[j]['especificacion'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['medida'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['tipo'];
                            html1+='</td>';
                            html1+='<td class="text-xs text-secondary mb-0" style="text-align:center;">';
                                html1+=arreglo_productos_guardar[j]['cantidad'];
                            html1+='</td>';
                            html1+="<td><button type='button' id='btn_eliminar' onclick='removeMaterial2(\""+id_producto_contador+"\");' class='btnEliminar' ><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        html1+='</tr>';
                        contador_tabla = contador_tabla + 1;
                    }
                }
            });

            if (contador_tabla == 0) {
                $('#divTablaProductos3').hide();
                $('#divEncabezadoTabla').hide();
            }
            else{
                $('#divTablaProductos3').show();
                $('#divEncabezadoTabla').show();
                $("#tbProductos3").empty();
                $('#tbProductos3').html(html1);
            }
            
        }

        function removeMaterial2(item){
            // console.log('entro');
            // console.log(item+'entro 356');
            for (let i = 0; i < arreglo_productos_guardar.length; i++) {
                // console.log(item);
                // console.log('-');
                // console.log(arreglo_productos_guardar[i]['id_producto'],arreglo_productos_guardar[i]['contador']);
                if (arreglo_productos_guardar[i]['id_producto']+'_'+arreglo_productos_guardar[i]['contador'] == item) {
                    console.log('entro2');
                    arreglo_productos_guardar[i]['bandera'] = 0;
                }
                if (arreglo_productos_guardar[i]['id_producto_detalle'] != 0) {
                    arreglo_eliminar_producto.push({id_producto_detalle : arreglo_productos_guardar[i]['id_producto_detalle'], bandera : 1});
                }
                // console.log(i+' '+$('#cantidad_'+i+'').val());
            }
            console.log(arreglo_productos_guardar);
            drawRowMaterial3();

        }

        $('#btn_cerrar').click(function(){
            html0='';
            $("#div_select").html(html0);
            $("#tbProductos2 tr").empty();
            $("#tbProductos3 tr").empty();
            
            // $("#tbProductos3").empty();
            $("#divEncabezadoTabla").hide();
            arreglo_productos = [];
            arreglo_productos2 = [];
            arreglo_productos_guardar = [];
            arreglo_productos_guardar2 = [];
            $('#id_producto2').prop('selectedIndex',0);
            // $('#etiqueta_especificacion').empty();
            // $('#id_medida').val('');
        })

        $('#btnRegresar').click(function(){
            window.location.href = '{{route("listadoOrdenes")}}';
        });
        
        function fnImprimirMaterial(id,id_equipo_detalle){
            $.ajax({
                url: '{{route("revisar_detalle")}}',
                type: 'GET',
                data: {'id_equipo_detalle' : id_equipo_detalle}
                }).always(function(r) {
                    console.log(r);
                    if (r.exito==true) {
                        let urlEditar = '{{ route("imprimir_material", ":id_equipo_detalle") }}';
                        urlEditar = urlEditar.replace(':id_equipo_detalle', id_equipo_detalle);

                        // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank');
                        var win = window.open(urlEditar, '_blank');
                    }
                    else{
                        Swal.fire({
                            position: 'bottom-right',
                            icon: 'warning',
                            title: 'No tiene Material/Refaccion que imprimir.',
                            showConfirmButton: false,
                            customClass: 'msj_aviso',
                            timer: 2000
                        })
                    }
            });

            
        }

        $('#btnImprimir').click(function(){
            id_servicio = $('#id_solicitud_input').val();
            solicitud_actividad = $('#id_solicitud_actividad_input').val();
            solicitud_nota = $('#id_solicitud_nota_input').val();
            actividad_realizada = '';
            nota_tecnica = '';
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                position: 'center',
                // title: 'No tiene Material/Refaccion que imprimir.',
                showConfirmButton: true,
                customClass: 'msj_aviso',
                showCancelButton: true,
                html:
                  'Escribe las Actividades Realizadas: '+
                    '<textarea maxlength="450" maxlength="450" id="swal-input3" style="width:80%"  class="swal2-textarea">'+solicitud_actividad+'</textarea>'+
                    '<br><br>'+
                    'Escribe la Nota Técnica: '+
                    '<textarea maxlength="450" maxlength="450" id="swal-input4" style="width:80%"  class="swal2-textarea">'+solicitud_nota+'</textarea>',
                // '</div>',
                confirmButtonColor: '#b50915',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                width: 800,
                allowOutsideClick: false,
                preConfirm: () => {
                    if ($('#swal-input3').val().length<4) {
                        Swal.showValidationMessage(
                            'La actividad debe tener al menos 4 caracteres...'
                        )
                    }
                    else if ($('#swal-input3').val().length>450) {
                        Swal.showValidationMessage(
                            'La actividad no puede tener mas de 450 caracteres...'
                        )
                    }
                    if ($('#swal-input4').val().length<4) {
                        Swal.showValidationMessage(
                            'La nota técnica debe tener al menos 4 caracteres...'
                        )
                    }
                    else if ($('#swal-input4').val().length>450) {
                        Swal.showValidationMessage(
                            'La nota técnica no puede tener mas de 450 caracteres...'
                        )
                    }
                }
            }).then((result) => {
                console.log($('#swal-input3').val());
                if (result.isConfirmed) { 
                    actividad_realizada = $('#swal-input3').val();
                    nota_tecnica = $('#swal-input4').val();
                    console.log(actividad_realizada);
                    console.log(nota_tecnica);
                    $.ajax({
                        url: '{{route("editar_actividad")}}',
                        type: 'GET',
                        data: {'id_servicio' : id_servicio, 'actividad_realizada' : actividad_realizada, 'nota_tecnica' : nota_tecnica}
                        }).always(function(r) {
                            console.log(r);
                            
                            let urlEditar = '{{ route("imprimir_material2", ":id_servicio") }}';
                            urlEditar = urlEditar.replace(':id_servicio', id_servicio);

                            // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank');
                            var win = window.open(urlEditar, '_blank');
                            // var id_solicitud = $('#id_solicitud_input').val();
                            console.log('llego aca');
                            let urlEditar2 = '{{ route("index_materiales", ":id") }}';
                            urlEditar2 = urlEditar2.replace(':id', id_servicio);
                            window.location.href = urlEditar2;
                            
                    });
                }
            });
            
            // console.log($('#id_solicitud_input').val());
            // id_servicio = $('#id_solicitud_input').val();
            // let urlEditar = '{{ route("imprimir_material2", ":id_servicio") }}';
            // urlEditar = urlEditar.replace(':id_servicio', id_servicio);

            // // var win = window.open("{{ asset('images/documentoConstruccion.jpg') }}", '_blank');
            // var win = window.open(urlEditar, '_blank');
        });
    </script>
@endsection