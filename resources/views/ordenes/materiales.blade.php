@extends('layouts.contentIncludes')
@section('title','CAS CETE')
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
  background-color: #FFF;
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
                
                

                <div class="card-body">
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
                                <thead class="text-align:center;">
                                    <tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder">CANTIDAD</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">EQUIPO/SERVICIO</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">DESCRIPCIÓN</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">SERVICIO</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">TAREA</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">AGREGAR MATERIAL</th>
                                </tr></thead>
                                <tbody id="tbEquipos">
                                    @foreach($query as $query2)
                                        <tr id="">
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
                                                            <a onclick="fnAgregarMaterial({{$query2->id_servicio_tarea}})" class="dropdown-item"> 
                                                            <i class="fas fa-edit"></i>
                                                                Agregar Material
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                        
                            </table>
                        </div>
                        
                        <br>
                        
                        
                        <br>
                        <br>
                        <div class="col-12 lineaHr"></div><br><br>
                        <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary" id="btnRegresar">Regresar</button>
                            <button type="button" class="btn btn-secondary" id="btnRegresar">Imprimir</button>
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
                    <div class="row">
                        <div class="col-4" style="text-align:center;  background-color:#ab0033;">
                            <label style="color:white;">Agregar Material o Refaccion</label>
                        </div>
                        <div class="col-8" style="text-align:center; border-bottom:3px solid #ab0033;"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div id="modal_solicitud_inf"></div>
                    </div>
                    <br>
                    <!-- <div class="row">
                        <div class="col-7">
                            <label for="">Producto</label><br>
                            <select class="form-select" title="SELECCIONAR TAREA" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" aria-label="Default select example" id="id_proucto">
                                <option value="0">Seleccionar Producto</option>
                                <option value="1">unidad termomagnetica square D un polo 10 amperes</option>
                                <option value="2">unidad termomagnetica square D tres polos 20 amperes</option>
                                <option value="3">poliflex poliflex color naranja de 1/2"</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="">Tipo de Medida</label><br>
                            <input disabled class="form-control" type="text" id="id_medida" value="Metro">
                        </div>
                        <div class="col-1">
                            <label for="">Cantidad</label><br>
                            <input class="form-control" type="number" value="1" id="cantidad">
                        </div>
                        <div class="col-1">
                            <br>
                            <button type="button"  class="btn colorBtnPrincipal" id="btnAgregarProducto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>
                        </div>
                        
                    </div> -->
                  
                    
                    <br>
                    <div class="row">
                        <div class="col-12 table-wrapper" id="divTablaProductos">
                        
                            <table class="table">
                                <thead>
                                    <th>PRODUCTO</th>
                                    <th>ESPECIFICACION</th>
                                    <th>MEDIDA</th>
                                    <th>CANTIDAD</th>
                                    <th>ACCIONES</th>
                                </thead>
                                <tbody id="tbProductos">

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
        $(function () {
            $('#exampleModal').modal({backdrop: 'static', keyboard: false})
            // $('#divTablaProductos').hide();
        });

        function fnAgregarMaterial(id){
            // id="58"
            $('#divTablaProductos').hide();
            $('#id_proucto').prop('disabled',true);
            
            $.ajax({
            url: '{{route("cat_materiales")}}',
            type: 'GET',
            data: {'id_servicio_tarea' : id}
            }).always(function(r) {
                console.log(r);
                html0='';
        
                html0+='<div class="row">';
                    html0+='<div class="col-7">';
                    html0+='<label for="">Producto</label><br>';
                    html0+='<select class="form-select" title="SELECCIONAR TAREA" data-selected-text-format="count" data-count-selected-text="{0} Tarea(s) Seleccionada(s)" aria-label="Default select example" id="id_proucto">';
                    html0+='<option value="0">Seleccionar Producto</option>';
                    for (let i = 0; i < r.select_productos.length; i++) {
                        // const element = r.select_productos[i];
                        html0+='<option value='+r.select_productos[i]['id_producto']+'><br>'+r.select_productos[i]['nombre']+' - '+r.select_productos[i]['descripcion']+'</option>';
                    }
                    html0+='</select>';
                    html0+='</div>';
                    html0+='<div class="col-3">';
                    html0+='<label for="">Tipo de Medida</label><br>';
                    html0+='<input disabled class="form-control" type="text" id="id_medida" value="">';
                    html0+='</div>';
                    html0+='<div class="col-1">';
                    html0+='<label for="">Cantidad</label><br>';
                    html0+='<input class="form-control" type="number" value="1" id="cantidad">';
                    html0+='</div>';
                    html0+='<div class="col-1">';
                    html0+='<br>';
                    html0+='<button type="button"  class="btn colorBtnPrincipal" id="btnAgregarProducto"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg></button>';
                    html0+='</div>';
                html0+='</div>';
                html0+='<div class="row">'
                    html0+='<div class="col-12">';
                        html0+='<label for="">Especificación</label><br>';
                        html0+='<span id="etiqueta_especificacion" for=""></span><br>';
                    html0+='</div>';
                html0+='</div>';

                $('#modal_solicitud_inf').html(html0);
                $('#id_proucto').prop('disabled',false);
                $('#id_proucto').change(function(){
                    // console.log($('#id_proucto').val());
                    var valor_select = $('#id_proucto').val();
                    for (let i = 0; i < r.select_productos.length; i++) {
                        if (r.select_productos[i]['id_producto'] == valor_select) {
                            console.log(r.select_productos[i]['medida']);
                            $('#id_medida').val(r.select_productos[i]['medida']);
                            $('#etiqueta_especificacion').append(r.select_productos[i]['especificacion']);
                            
                        }
                        
                    }
                });
                var contador = 0;
            
                $('#divTablaProductos').hide();
                html1='';
                $('#tbProductos').html(html1);
                
                $('#btnAgregarProducto').click(function(){
                    // console.log(arreglo_productos);
                    if ($('#id_proucto').val()==0) {
                        // alert('no');
                        Swal.fire({
                            // title: 'Aprobar Solicitud',
                            // text: 'Se ha Registrado con Exito la Solicitud #5884',
                            html: '<p>Favor de Seleccionar un Producto</p>',
                            customClass: 'msj_solicitud',
                            icon: 'warning',
                            confirmButtonColor: '#b50915',
                            confirmButtonText: 'Aceptar',
                            width: 310,
                            allowOutsideClick: false
                        })
                    }
                    else{
                        console.log('entro');
                        var id_producto = $('#id_proucto').val();
                        var id_cantidad = $('#cantidad').val();
                        var text_producto = $( "#id_proucto option:selected" ).text();
                        var text_cantidad = $('#cantidad').val();
                        var text_medida = $('#id_medida').val();
                        var text_especificacion = $('#etiqueta_especificacion').text();

                        arreglo_productos.push({contador:contador, id_detalel_equipo:id, id_producto:id_producto, text_producto:text_producto,
                            id_cantidad:id_cantidad, text_cantidad:text_cantidad, text_medida:text_medida, text_especificacion:text_especificacion});

                        contador = contador + 1;
                        drawRowMaterial();
                        $('#divTablaProductos').show();
                    }
                    
                });

                $("#btnGuardar").click(function(){
                    if (arreglo_productos=='') {
                        Swal.fire({
                            // title: 'Aprobar Solicitud',
                            // text: 'Se ha Registrado con Exito la Solicitud #5884',
                            html: '<p>Favor de Agregar un Producto antes de guardar</p>',
                            customClass: 'msj_solicitud',
                            icon: 'warning',
                            confirmButtonColor: '#b50915',
                            confirmButtonText: 'Aceptar',
                            width: 310,
                            allowOutsideClick: false
                        })
                    }
                    else{
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
                            url: '{{route("agregar_materiales")}}',
                            type: 'GET',
                            data: {'arreglo_productos' : arreglo_productos}
                            }).always(function(r) {
                                Swal.fire({
                                    // title: 'Aprobar Solicitud',
                                    // text: 'Se ha Registrado con Exito la Solicitud #5884',
                                    html: '<p>Se guardaron correctamente los materiales</p>',
                                    customClass: 'msj_solicitud',
                                    icon: 'success',
                                    confirmButtonColor: '#b50915',
                                    confirmButtonText: 'Aceptar',
                                    width: 310,
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                    // alert('Se redireccciona al index');
                                        window.location.href = '{{route("index_materiales")}}';
                                    }
                                })
                        });
                        console.log(arreglo_productos);
                    }
                });

            });

            

            // arreglo_productos = [];
            
            
           
            $('#exampleModal').modal('show');
        }

        function drawRowMaterial(){
            html1='';
            console.log(arreglo_productos);
            $.each(arreglo_productos, function(j, val){
                if (!jQuery.isEmptyObject(arreglo_productos[j])) {
                
                    html1+='<tr id="tr_'+j+'" style="text-align:left;">';
                        html1+='<td style="white-space: pre-line; word-break: break-word;">';
                            html1+=arreglo_productos[j]['text_producto'];
                        html1+='</td>';
                        html1+='<td style="white-space: pre-line; word-break: break-word;">';
                            html1+=arreglo_productos[j]['text_especificacion'];
                        html1+='</td>';
                        html1+='<td>';
                            html1+=arreglo_productos[j]['text_medida'];
                        html1+='</td>';
                        html1+='<td>';
                            html1+=arreglo_productos[j]['text_cantidad'];
                        html1+='</td>';
                        html1+='<td><button type="button" id="btn_eliminar" onclick="removeMaterial('+j+')" class="btnEliminar" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                    html1+='</tr>';
                    
                }
            });

            $("#tbProductos").empty();
            $('#tbProductos').html(html1);
        }

        function removeMaterial(item){
            if(arreglo_productos.includes(item) ==false){ 
                if ( item !== -1 ) {
                    arreglo_productos.splice( item, 1 );
                    console.log(arreglo_productos);
                    $("#tr"+item).remove();
                    drawRowMaterial();
                    if (arreglo_productos == '') {
                        $('#divTablaProductos').hide();
                    }
                    
                }   else{
                    $("#tbProductos").empty();
                    arreglo_productos = [];
                    
                }
            }
        }

        $('#btn_cerrar').click(function(){
            $("#tbProductos").empty();
            arreglo_productos = [];
            $('#id_proucto').prop('selectedIndex',0);
            $('#etiqueta_especificacion').empty();
            $('#id_medida').val('');
        })
    </script>
@endsection