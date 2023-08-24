@extends('layouts.contentIncludes')
@section('title','CAS CETE')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')

<div class="container-fluid py-4 mt-3">
<input type="hidden" id="hiddenIdUser" name="hiddenIdUser" class="form-control"  value="{{auth()->id()}}" >
  
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">En espera</p>
                <h3 class="font-weight-bolder">
                  {{ $total_enespera->getcountordenes }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
              </div>
              <!-- <img src="{{asset('images/icon/icono1.png') }}" width="50px" height="50px"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Asignadas</p>
                <h3 class="font-weight-bolder">
                {{ $total_asignadas->getcountordenes }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
              </div>
              <!-- <img src="{{asset('images/icon/icono2.png') }}" width="50px" height="50px"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Trabajando</p>
                <h3 class="font-weight-bolder">
                {{ $total_trabajando->getcountordenes }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-success shadow-success text-center rounded-circle">
                <i class="ni ni-settings text-lg opacity-10" aria-hidden="true"></i>
              </div>
              <!-- <img src="{{asset('images/icon/icono3.png') }}" width="50px" height="50px"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Atendidas</p>
                <h3 class="font-weight-bolder">  <!-- tenia h5 -->
                {{ $total_atendidas->getcountordenes }}
                </h3>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
              </div>
              <!-- <img src="{{asset('images/icon/icono4.png') }}" width="50px" height="50px"> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <!-- <h1 class="mb-2 colorTitle">Registros</h1> -->
        </div>
    </div>
  
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card ">
        
        <!-- <div class="card-header pb- p-3">
          <div class="d-flex justify-content-between">
            <h6 class="mb-2">Dibujos a Evaluar</h6>
          </div>
        </div>
      
        <div class="card-header pb- p-3">
          <div class="d-flex justify-content-between">
            <h6 class="mb-2">Alumnos registrados</h6>
          </div>
        </div> 
        

        <div class="mb-2 p-3">
        
          <div class="row">
          <div class="col-6 text-start">
          <div class="form-group align-middle">
          <button type="button" class="btn colorBtnPrincipal" id="btnFiltros">Filtros</button>
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
                <label for="estatus_id">Estatus Dibujo</label>
                <select class="form-select" aria-label="Default select example" id="estatus_id" name="estatus_id">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            
            <div class="col-2">
              <div class="form-group">
                <label for="estatus_eval_id">Estatus Evaluación</label>
                <select class="form-select" aria-label="Default select example" id="estatus_eval_id" name="estatus_eval_id" onchange="load()">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            <div class="col-2"> 
              <div class="form-group">
                <label for="region_select">Región</label>
                <select class="form-select reg" aria-label="Default select example" id="region_select" name="region_select">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="municipio_select">Municipio</label>
                <select class="form-select mun" aria-label="Default select example" id="municipio_select" name="municipio_select">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            <div class="col-2"> 
              <div class="form-group">
                <label for="nivel_select">Nivel</label>
                <select class="form-select" aria-label="Default select example" id="nivel_select" name="nivel_select" onchange="load()">
                  <option value="0" selected>Seleccionar</option>
                  
                </select>
              </div>
            </div>
            <div class="col-2">
              <div class="form-group">
                <label for="grado_select">Grado Escolar</label>
                <select class="form-select" aria-label="Default select example" id="grado_select" name="grado_select" onchange="load()">
                  <option value="0" selected>Seleccionar</option>
                    <option value="1">1° </option>
                    <option value="2">2° </option>
                    <option value="3">3° </option>
                    <option value="4">4° </option>
                    <option value="5">5° </option>
                    <option value="6">6° </option>
                </select>
              </div>
            </div>
            <div class="col-2">
            </div>
        </div>
        
        <div class="table-responsive">
            
            <table id="tablaPrueba2" class="table table-respnsive">
              <thead>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">FOLIO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CURP/NOMBRE</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">MUNICIPIO/REGIÓN</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CCT/ESCUELA</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NOMBRE DIBUJO</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PUNTAJE</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ESTATUS</th>
                <th class="text-secondary opacity-7"></th>
              </thead>
              <tbody >

              </tbody>
            </table>
          <br><br>
          <div id="ttt" ><meta charset="utf-8"></div>
        </div> -->
      </div>
    </div>
  </div>
</div>

@endsection

@section('page-scripts')
<script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script>
  var tabla;
  var vRol;
  var iduser;
  // var evalu;
  var evalu = []; 
  var arrayCentro = [];
  

  function filterSugerenciaRepre(){
    let sugerenciarepresentacion_id_Busqueda = $("#estatus_id option:selected").text();
    $("#tbListado tr").filter(function() {
      $(this).toggle($(this)[0].cells[6].innerText.toLowerCase().indexOf(sugerenciarepresentacion_id_Busqueda.toLowerCase()) > -1)
    });
  }
  
  function load(){
    var tipo='GET';
    var tipo2='POST';
    var estatus_id= $('#estatus_id').val();
    var estatus_eval_id= $('#estatus_eval_id').val();
    var municipio_select= $('#municipio_select').val();
    var grado_select= $('#grado_select').val();
    var region_select= $('#region_select').val();
    var nivel_select= $('#nivel_select').val();
    $.ajax({
      url: '{{route("show")}}',
      data:{'estatus_id' : estatus_id,
        'estatus_eval_id' : estatus_eval_id,
        'municipio_select' : municipio_select,
        'grado_select' : grado_select,
        'region_select' : region_select,
        'nivel_select' : nivel_select},
      type: tipo,
      dataType: 'json', // added data type
      success: function(data) {
          vRol=data.vRol;
          fntabla(data);
          //evalu=data[1];
      }
    });
  }



  function fntabla(data){
    //  console.log(data[0]);
    //  console.log(data[1][0].user_id);
    // console.log("------- data[1]");
    // console.log(data[1]);
    // console.log("------- data[1]");
    evalu=data[1];
    // console.log("------- data[1]");
    // console.log(evalu[0]);
    // console.log("------- data[1]");
     hiddenIdUser=$('#hiddenIdUser').val();
     if(vRol=='J'){
      hideColumn=5;
     }else{
      hideColumn='';
     }
     
    if(tabla){
      $('#tablaPrueba2').DataTable().clear().destroy();
    }
    tabla=$('#tablaPrueba2').DataTable({
          data:data[0],
          columns: [
            { data: 'folio' },
            { data: null, render:function(data){
                return '<h6 class="mb-0 text-sm">'+data.curp+'</h6><p class="text-xs text-secondary mb-0">'+data.nombre_alumno+' '+data.ap_paterno+' '+data.ap_materno+'</p>  ';
              }
            },
            { data: null, render:function(data){
                return '<h6 class="mb-0 text-sm">'+data.nombre_municipio+'</h6><p class="text-xs text-secondary mb-0">'+data.Region+'</p>  ';
              }
            },
            { data: null, render:function(data){
                return '<h6 class="mb-0 text-sm">'+data.cct+'</h6><p class="text-xs text-secondary mb-0">'+data.nombre_cct+'</p>  ';
              }
            },
            { data: 'nombre_personaje' },
            { data: 'total_puntaje' },
            { data: null, render:function(data){
                if (data.estatus_id==1){
                  return '<span>Registrado</span>';
                }else if (data.estatus_id==2){
                  if (vRol=="J"){ //juradooooo si es jurado hace esto
                    if (data.estatus_eval_id==3){
                      return '<span>Por Evaluar</span>';
                    }else if (data.estatus_eval_id==1){
                      if (data.countJuez==1){
                           return '<span>Evaluado</span>';
                         }else{
                           return '<span>Por Evaluar</span>';
                         }

                    }else if (data.estatus_eval_id==2){
                      return '<span>Evaluado</span>';
                    }
                  }else{// //si es admin
                    if(data.estatus_eval_id==3){
                      return '<span>Seleccionado</span>';
                    }else{
                        if( data.countEval > 0 && data.countEval < 5){
                          return '<span>En Evaluación</span>';
                        }else if( data.countEval == 5 ){
                          return '<span>Evaluado</span>';
                        }
                    }
                  }
                }else if (data.estatus_id==3){
                  return '<span>No seleccionado</span>';
                }
              }
            },
            { data: null, render:function(data){
              var estatuss='';
              estatuss+= '<div class="dropdown btn-group dropstart">'+
                        '<button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="opciones" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-ellipsis-v text-xs"></i></button>'+
                        '<ul class="dropdown-menu" aria-labelledby="opciones1">'+
                        '<li>'+
                        '<a onclick="fnMostrarInfo('+data.id_registro_concurso+',1)" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fas fa-eye"></i> Visualizar</a>'+
                        '</li>';
                            if(vRol=='A'){
                              if( !(data.estatus_id==2 || data.estatus_id==3)){
                                estatuss+=        '<li>'+
                                '<a onclick="fnMostrarInfo('+data.id_registro_concurso+',2)"  class="dropdown-item"          data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-download"></i> Revisar Dibujo </a>'+ '</li>';
                              }
                            }
                            if(vRol=='J'){  
                              if(data.estatus_eval_id!=2){
                                if (data.countJuez!=1){
                       estatuss+=         '<li>'+
                                '<a onclick="fnEvaluar('+data.id_registro_concurso+')" class="dropdown-item"><i class="fas fa-edit"></i> Evaluar Dibujo</a>'+
                                 '</li>';
                                }
                              }
                            }
                              estatuss+=       '<li>'+
                            '<a  onclick="fnPrueba('+data.id_registro_concurso+')"class="dropdown-item" ><i class="fas fa-eye"></i> Evaluación de Dibujo</a>'+
                                '</li>'+
                            '</ul>'+
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
                        "targets": [ hideColumn ],
                        "visible": false,
                        "searchable": false
                    },
        ]
      });
  }

  $(document).ready(function () {
    load()

    $("#btnFiltrar").show();
    $("#pnFiltros").hide();
    $("#ttt").hide();
     $("#divPrueba").hide();
    $("#divPrueba").css("display", "none");
    $("#btnRevisar").prop('disabled', true);
    $('#estatus_selec_id option[value="0"]').attr("selected", true);
    $("#msjObli").hide();
    $("#mostrarDibujo").hide();
    $("#revisarDibujo").hide();
    $("#visualizarNoSeleccionado").hide();

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


    $("#btnFiltros").click(function(){
      $("#pnFiltros").toggle("slow");
      $('#estatus_selec_id option[value="0"]').attr("selected", true);
      $('#observaciones').val('');
      $("#cancelRevisionModal").modal("hide");
      $("#exampleModal").modal("hide");
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
//               $('#ttt').html(tablita);
//             //  console.log(tablita);
//             window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#ttt').html())); 
//             // var Result = 'data:application/vnd.ms-excel,';
//             // var DatosEncode = encodeURIComponent($('#ttt').html());

//             // window.open(Result + DatosEncode);
// // e.preventDefault();
//             // e.preventDefault();

//             // exportTableToExcel('excelDibujos')

//             // window.open('data:application/vnd.ms-excel;base64,' + jQuery.base64.encodeURIComponent(jQuery('#ttt').html()));
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
                $('#ttt').html(tablita);
              //  console.log(tablita);
              var Result = 'data:application/vnd.ms-excel,';
              var DatosEncode = encodeURIComponent($('#ttt').html());
              window.open(Result + DatosEncode);
              },
          error:function( data ) {
          },
      });

    });

  });

//   function exportTableToExcel( filename = ''){
//     var downloadLink;
//     var dataType = 'application/vnd.ms-excel; charset=UTF-8';
//     var tableSelect = document.getElementById('ttt');
//     var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
//     // Specify file name
//     filename = filename?filename+'.xls':'excel_data.xls';
    
//     // Create download link element
//     downloadLink = document.createElement("a");
    
//     document.body.appendChild(downloadLink);
    
//     if(navigator.msSaveOrOpenBlob){
//         var blob = new Blob(['ufeff', tableHTML], {
//             type: dataType
//         });
//         navigator.msSaveOrOpenBlob( blob, filename);
//     }else{
//         // Create a link to the file
//         downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
//         // Setting the file name
//         downloadLink.download = filename;
        
//         //triggering the function
//         downloadLink.click();
//     }
// }
 </script>

@endsection
