<html lang="en">
<head>
    <title>Solicitud</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
       /* -------------------------- */
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
          /* border: #000 solid 1px; */
          /* min-height: calc(100vh - 100px - 100px); */
          /* background-image: url("{{ asset('images/logo/logoTam2022.png') }}");
          background-repeat: no-repeat;
          background-size: cover;
          background-color: transparent;
          opacity: 0.6; */
        }

        .waterMark{
          background-image: url("{{ asset('images/logo/logoTam2022.png') }}");
          opacity: 0.2;
        }

        .showcase {
          /* width: 70%;
          height: 50%; */
          background-image: url("{{ asset('images/logo/logoTam2022.png') }}");
          /* height: 400px;
          width: 500px; */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          opacity: 0.2;
        }
        
        header {
            position: fixed;
            top: .3cm;
            left: .5cm;
            right: .5cm;
            height: 2cm;
            margin-left: .5cm;
            margin-right: .5cm; 
            /* border: #000 solid 1px; */
        }
        
        footer {
            clear: both;
            position: fixed; 
            bottom: .3cm; 
            left: .5cm; 
            right: .5cm;
            height: 3.2cm;
            /* width: 100%; */
            margin-left: .5cm;
            margin-right: .5cm;
            /* border: #000 solid 1px; */
        } 

        /* width: 100%; */
        /* height: 2.2cm; */
        /* ------------------------- */

        table {border-collapse:collapse; border: none; width: 100%;}
        
        table .equipo {
            font-size: 13px;
        }

        table .equipo2 {
            font-size: 12px;
        }

        table tr {
            text-align: center;
            color: #000;
        }

        table th {
            border: 1px solid #000;
            text-align: center;
            color: #FFFFFF;
            padding: 0;
            /* background-color: rgb(203,211,219); */
            background-color: #ab0033;
            font-size: 14px;
        }

        table td {
            border: 1px solid #000;
            text-align: left !important;
            padding: 0;
            /* Alto de las celdas */
            height: 16px !important;
            font-size: 12px;
            /* text-transform: capitalize; */
        }

        .sinbordetable{
            border: 0px solid #000;
            text-align: left !important;
            padding: 0;
            /* Alto de las celdas */
            height: 16px !important;
            font-size: 12px;
            /* text-transform: capitalize; */
        }
        .sinbordetable2{
            border: 0px solid #000;
            text-align: right !important;
            padding: 0;
            /* Alto de las celdas */
            height: 16px !important;
            font-size: 12px;
            /* text-transform: capitalize; */
        }
        .sinbordetable3{
            border: 0px solid #000;
            text-align: center !important;
            padding: 0;
            /* Alto de las celdas */
            height: 16px !important;
            font-size: 12px;
            /* text-transform: capitalize; */
        }
        .sinbordetable4{
            border: 0px solid #000;
            text-align: right !important;
            padding: 0;
            /* Alto de las celdas */
            height: 16px !important;
            font-size: 12px;
            /* text-transform: capitalize; */
        }

        table .firmas{
            /* padding-top: 100em; */
            padding: 40px 1px 0px 1px;
            font-size: 13px;
        }
        .tableFoot {
          border-collapse:collapse; 
          border: none; 
        }
    </style>
</head>
  {{-- http://localhost/cas/images/logo/logoTam2022.png {{ asset('images/logo/logoTam2022.png') }}--}}
<header>
      <div style="width: 30%; height: 50px; float: left;">
      <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/logo/logo_cete_3.png'))) }}" alt="" style="width: 300px; height: 45px; margin-top: 10px;">
      </div>
      <div style="margin-left: 10%; height: 50px; text-align: right; font-size: 12px;"> 
        <p><b>CENTRO ESTATAL DE TECNOLOGÍA EDUCATIVA</b><br>
            SUBDIRECCIÓN DE OPERACIÓN DE PROYECTOS <br>
        </p>
      </div>
    
    <!-- <hr style="height:1 px; border-width:0; color:rgb(0, 0, 0); background-color:rgb(0, 0, 0)"> -->
</header>
<div class="showcase">
<body>
    <div> 
      <table class="sinbordetable">
        <tr class="sinbordetable">
          <td class="sinbordetable3">
          <span><b>SOLICITUD DE SERVICIOS - VENTANILLA ÚNICA</b></span>
          </td>
        </tr>
      </table>
    <table class="sinbordetable">
      <tr class="sinbordetable">
        <td class="sinbordetable"><span>Folio Solicitud: <b>{{ $fn_solicitud->folio }}</span> 
        @if($fn_inf_orden != null)
        <td class="sinbordetable3"><span>Estatus: <b>{{ $fn_inf_orden->estatus }}</b></span>
        @else
        <td class="sinbordetable2"><span>Estatus: <b>{{ $fn_solicitud->estatus }}</b></span>
        @endif
        @if($fn_inf_orden != null)
        <td class="sinbordetable4"><span>Folio Orden: <b>{{ $fn_inf_orden->folio }}</b></span>
        @endif
      </tr>
      
    </table>
        <table> <!--//////////////////////////////////////////////////////////////////////-->
          <tr>
            <th>DATOS DEL CENTRO DE TRABAJO</th>
          </tr>
          <tr>
            <td>
              <table class="sinbordetable">
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Nombre del C.T: <b>{{ $fn_solicitud->nombrect }}</b></span> 
                  <td class="sinbordetable"><span>Clave del C.T: <b>{{ $fn_solicitud->clave_ct }}</b></span> 
                  <td class="sinbordetable"><span>Municipio: <b>{{ $fn_solicitud->municipio }}</b></span>
                  <span></span> 
                </td>
                </tr>
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Nombre del Director: <b>{{ $fn_solicitud->director }}</b></span> 
                  <td class="sinbordetable"><span>Fecha de la Solicitud: <b>{{ $fn_solicitud->fecha_captacion }}</b></span> 
                  <td class="sinbordetable"><span>Estatus Solicitud: <b>{{ $fn_solicitud->estatus }}</b></span>
                </tr>
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Dirección: <b>{{ $fn_solicitud->domicilio }}</b></span> 
                  <td class="sinbordetable"><span>Turno: <b>{{ $fn_solicitud->desc_turno }}</b></span> 
                  <td class="sinbordetable"><span>Nivel Educativo: <b>{{ $fn_solicitud->subnivel }}</b></span>
                </tr>
                
              </table>
            </td>
          </tr>
        </table>
        <table> <!--//////////////////////////////////////////////////////////////////////-->
          <tr>
            <th>DATOS DEL SOLICITANTE</th>
          </tr>
          <tr>
            <td>
              <table class="sinbordetable">
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Nombre: <b>{{ $fn_solicitud->solicitante }}</b></span> 
                  <td class="sinbordetable"><span>Descripción del Reporte: <b>{{ $fn_solicitud->descrip_reporte }}</b></span></td>
                </tr>
                <tr class="sinbordetable">
                <td class="sinbordetable"><span>Teléfono: <b>{{ $fn_solicitud->telef_solicitante }}</b></span>                   
                </tr>
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Correo Electrónico: <b>{{ $fn_solicitud->correo_solic }}</b></span>
                  
                </tr>
                
              </table>
            </td>
          </tr>
        </table>
    </div>
    <br>
        {{-- <h4 style="text-align: center; background-color: rgb(175, 175, 175); border: 1px solid;">Equipos</h4>   --}}
        <!-- <div>
          <table>
              <tr >
                <th colspan="5">Equipos</th>
              </tr>
              <tr>
                <th>Equipo</th>
                <th>Núm. serie</th>
                <th>Núm. inventario</th>
                <th>tipo de equipo</th>
                <th>Tarea</th>
                {{-- <th>Estatus</th> --}}
                {{-- <th>Técnico encargado</th> --}}
              </tr>
            
          </table>
        </div>
        <br> -->
        <div>
          
          {{-- style="padding: 30px 1px 0px 1px;" --}}

          {{-- <br>
          <div class="invoice-product-details table-responsive mx-md-25 table-secondary" style="text-align: center; color: #000; background-color: rgb(203,211,219);">
            <span><b>ENCUESTA DE CALIDAD</b></span>
          </div>
          <div style="width: 100%;">
                <div>
                  <table>
                    <tr>
                      <th style="background-color: white !important; border: none !important;"></th>
                      <th style="background-color: white !important; border: none !important;">BUENO</th>
                      <th style="background-color: white !important; border: none !important;">REGULAR</th>
                      <th style="background-color: white !important; border: none !important;">MALO</th>
                    </tr>
                    <tr>
                      <td style="font-size: 12px !important; border: none !important; text-align: left">¿CÓMO CALIFICA LA ATENCIÓN RECIBIDA POR LOS TÉCNICOS?</td>
                      <td style="height: 15px !important;"></td>
                      <td style="height: 15px !important;"></td>
                      <td style="height: 15px !important;"></td>
                    </tr>
                    <tr>
                      <td style="font-size: 12px !important; border: none !important; text-align: left">¿CÓMO CALIFICA LA CALIDAD DEL SERVICIO PRESTADO?</td>
                      <td style="height: 15px !important;"></td>
                      <td style="height: 15px !important;"></td>
                      <td style="height: 15px !important;"></td>
                    </tr>
                    <tr>
                      <td style="font-size: 12px !important; border: none !important; text-align: left">¿CÓMO CALIFICA EL TIEMPO DE RESPUESTA EN EL SERVICIO?</td>
                      <td style="height: 15px !important;"></td>
                      <td style="height: 15px !important;"></td>
                      <td style="height: 15px !important;"></td>
                    </tr>
                  </table>
                </div>
          </div>
            <br>
            <div class="invoice-product-details table-responsive mx-md-25" style="text-align: center; color: #000;">
              <span><b> ¿TIENE ALGUNA SUGERENCIA PARA LA MEJORA DEL SERVICIO?</b></span>
            </div>
            <div class="invoice-product-details table-responsive mx-md-25" style="border: 1px solid rgb(0, 0, 0); height: 60px;">
            </div>
            <div class="invoice-product-details table-responsive mx-md-25" style="text-align: center; font-size: 15px;">
              <span><small>Por disposiciones de este Centro Estatal de Tecnología Educativa, los equipos que hayan sido traídos para su mantenimiento
                o reparación, deberán ser recogidos en un plazo no mayor a 10 días hábiles. Agradecemos su colaboración.</small></span>
            </div> --}}
        </div>
</body>
</div>
<footer > <!--style="display:flex; "-->
    {{-- <hr> --}}
    {{-- class="h-80 w-100 rounded-left"  border: #000 solid 1px; --}}
    <!-- <div style="width: 100%; text-align: center; font-size: 12px; height: 40px;">
      <span><small>Por disposiciones de este Centro Estatal de Tecnología Educativa, los equipos que hayan sido traídos para su mantenimiento
        o reparación, deberán ser recogidos en un plazo no mayor a 10 días hábiles. Agradecemos su colaboración.</small></span>
    </div> -->
    <!-- <div style="width: 62%; height: 100px; float: left; " > -->
    <div class="left" style="width: 100%; height: 100px; " >
         <!-- <img style="width: 100px; height: 80px; margin-top: 8px;" src="{{ asset('images/logo/ceteNI.png') }}" alt="">  -->
         <table>
          <thead>
            <th><small>Acta responsiva</small></th> 
          </thead>
          <tbody>
            <tr>
              <td style="width: 64%;">
                <span><small>Por medio de la presente, dejo constancia que NO HAGO RESPONSABLE al Centro Estatal de Tenología Educativa:</small></span><br>
                <span><small>- Si los técnicos al revisar el equipo informático eliminan archivos valiosos para el usuario, se recomienda realizar un respaldo antes de proporcionar el equipo.</small></span><br>
                <span><small>- Si los técnicos revisan el equipo informático, éste pueda presentar posteriormente un daño en los dispositivos de hardware.</small></span><br>
                <span><small>- Por el mal funcionamiento que pudieran presentar los accesorios del equipo informático a revisar, como cargadores y periféricos.</small></span>
              </td>
              <td style="width: 33%;" class="text-righ tableFoot">
              <table class="tableFoot">
                  <tr>
                    <td class="tableFoot text-right" style="width: 10%;">
                    <img style="width: 90px; height: 90px;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/images/QR_ventanilla.png'))) }}" alt="">
                    </td>
                    <td class="tableFoot text-right" style="width: 23%; text-align: right; font-size: 12px; margin-top: 4px;">
                      <span class="invoice-title"><small>Calzada Gral. Luis Caballero S/N, Antiguo Edificio Escuela Normal Rural de Tamatán,</small><br></span>
                      <span class="invoice-title"><small>Col. Tamatán, C.P. 87060. Cd. Victoria Tamaulipas.</small><br></span>
                      <span class="invoice-title"><small>Tel. 834 306 0027, 834 315 9031. <br> Opción 1. Mesa de ayuda.</small><br></span>
                      <span class="invoice-title"><small>centroestatal.tecnologiaeducativa@set.edu.mx</small><br></span>
                      <!-- <span class="invoice-title colorLink"><small>https://tamaulipas.gob.mx/ventanillaunica</small></span>  -->
                    </td>
                  </tr>
              </table>
              </td>
            </tr>
          </tbody>
         </table>
    </div>
</footer>

</html>