


<div class="container mt-5">
<button class="btn btn-secondary" style="font-size:0.80em;" id="btn_añadir_registro">Añadir</button>
<button class="btn btn-secondary" style="font-size:0.80em;" id="btn_agregar_registro">Agregar</button>
<input id="btn_replicar" type="checkbox">&nbsp;&nbsp;<label style="font-size:0.65em;">Replicar Datos en el Siguiente Equipo</label>

</div>

<!-- <script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script> -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha256-E/V4cWE4qvAeO5MOhjtGtqDzPndRO1LBk8lJ/PR7CA4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

<script>
  
  arreglo_agregar = [];
  arreglo_agregar2 = [];
  arreglo_añadir = [];
  contador_global = 0;
  // $(function(){



    
    $('#btn_añadir_registro').click(function(){
      if($('#btn_replicar').is(":checked")==false){
        arreglo_añadir = [];
        prueba = '';
        // arreglo_añadir.push({primera_posicion : contador_global, prueba : prueba});
      }
      else{
        prueba = 'prueba';
        
      }

      // console.log(arreglo_añadir);
      arreglo_añadir.push({primera_posicion : contador_global, prueba : prueba});
      contador_global = contador_global + 1;


      
      // contador_global = contador_global + 1;


    });

    $('#btn_agregar_registro').click(function(){
      arreglo_agregar.push({arreglo_añadir : arreglo_añadir});
      // // contador_global = contador_global + 1;
      // console.log(arreglo_agregar);

      var experimentsData = [];
      // var obj = {};  <-- don't define obj here
      var remoteSheet = response.result.values;

      remoteSheet.filter(function(innerArrayItem) {
          if (i == 0) {
              tablehead = innerArrayItem;
              i++;
          } else {  
              var obj = {} // <-- define it here  
              $.each(tablehead, function(key, value) {
                  obj[value] = innerArrayItem[key];
              });
              experimentsData.push(obj);
          }
      });

      // if (contador_global == 4) {
      //   $.ajax({
      //       url: '/solicitudes/prueba2/',
      //       type: 'GET',
      //       data: {'arreglo_agregar' : arreglo_agregar}
      //      }).always(function(r) {

      //      });
      // }

      

      console.log(arreglo_agregar);
    });
  // });
</script>