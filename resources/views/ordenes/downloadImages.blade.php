<html lang="en">
<head>
    <title>Orden de Servicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
       @page {
        margin: 0cm 0cm;
      }

      body { 
        font-family: sans-serif;
        margin-top: 2.8cm;
        margin-left: 1cm;
        margin-right: 1cm;
        max-height: 100px;
        margin-bottom: 4cm;
      }

      /* table {
        border-collapse:collapse; 
        border: none; 
        width: 100%;
      }  */

      /* img {image-orientation: initial;} */
      .rotate90 {
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
      }

      /* .sinbordetable{
        border: 0px solid #000;
        text-align: center !important;
        padding: 0;
        height: 16px !important;
        font-size: 12px;
      } */

      .sinbordetable2{
        text-align: center !important;
        width:100%;
        height:100%;
        vertical-align:middle!important;
      }
    </style>
</head>
  
<header>
    
</header>
<div ><!--class="showcase"-->
<body class="container">
    <!-- <div> -->
        <!-- <table> -->
          @foreach($ordenServicios as $images)
          <div class="row sinbordetable2">
            <div class="col-12">
            <!-- <tr>
              <td class="sinbordetable" style="text-align:center;"> -->
                <img class="rotate90" src="{{asset('cierreOrden/'.$images->nombre_archivo)}}" >
              <!-- </td>
            </tr> -->
            </div>
          </div>
          @endforeach
        <!-- </table> -->
        
    <!-- </div> -->
    <!-- <br> -->
      
</body>
</div>
<footer >
    
</footer>

</html>