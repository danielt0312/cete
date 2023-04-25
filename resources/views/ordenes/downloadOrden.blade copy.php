<html lang="en">
<head>
    <title>Orden de Servicio</title>
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
            color: #000;
            padding: 0;
            background-color: rgb(203,211,219);
            font-size: 14px;
        }

        table td {
            border: 1px solid #000;
            text-align: center !important;
            padding: 0;
            /* Alto de las celdas */
            height: 16px !important;
            font-size: 12px;
            text-transform: capitalize;
        }

        table .firmas{
            /* padding-top: 100em; */
            padding: 40px 1px 0px 1px;
            font-size: 13px;
        }
    </style>
</head>
  {{-- http://localhost/cas/images/logo/logoTam2022.png {{ asset('images/logo/logoTam2022.png') }}--}}
<header>
      <div style="width: 30%; height: 50px; float: left;">
        <img src="<?php echo $pic ?>" alt="" style="width: 210px; height: 45px; margin-top: 10px;">
      </div>
      <div style="margin-left: 10%; height: 50px; text-align: right; font-size: 12px;"> 
        <p><b>CENTRO ESTATAL DE TECNOLOGÍA EDUCATIVA</b><br>
            SUBDIRECCIÓN DE OPERACIÓN DE PROYECTOS <br>
            REPORTE DE SERVICIOS
        </p>
      </div>
    
    <hr style="height:1 px; border-width:0; color:rgb(0, 0, 0); background-color:rgb(0, 0, 0)">
</header>
<body>
    <div>
        <table>
          <tr>
            <th>Folio</th>
            <th style="width: 25%">Centro de trabajo</th>
            <th>Quién reporta</th>
            <th>Teléfono</th>
          </tr>

          <tr>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->folio }}</td>
            <td rowspan="3" style="text-transform: uppercase;">{{ $ordenServiciosObject->nombrect }}</td>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->nom_quien_reporta }}</td>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->telefono_quien_reporta }}</td>
          </tr>

          <tr>
            <th>Núm. orden</th> 
            <th>Solicitante</th>
            <th>Fecha de inicio</th>
          </tr>

          <tr>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->id }}</td>
            {{-- <td style="border: white solid 1px !important"></td> --}}
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->solicitante }}</td>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->fecha_inicio }}</td>
          </tr>

          <tr>
            <th style="width: 40%">Domicilio</th>
            <th>Técnico encargado</th>
            <th>Área que atiende</th>
            <th>Fecha de cierre</th>
          </tr>

          <tr>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->domicilio }}</td>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->tecnico_encargado }}</td>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->area }}</td>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->fecha_finalizacion }}</td>
          </tr>
          
          <tr>
            <th>Técnicos auxiliares:</th>
            <td colspan="3" style="text-transform: uppercase;">
            @foreach ($tecnicos_aux as $tecnico_aux)
              {{ $tecnico_aux->nombre_tec }}
            @endforeach
            </td>
          </tr>
        </table> 
    </div>
    <br>
        {{-- <h4 style="text-align: center; background-color: rgb(175, 175, 175); border: 1px solid;">Equipos</h4>   --}}
        <div>
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
            @foreach($equipos as $equipo)
              <tr>
                <td>{{ $equipo->nombre_equipo }}</td>
                <td>{{ $equipo->numero_serie }}</td>
                <td>{{ $equipo->numero_inventario }}</td>
                <td>{{ $equipo->tipo_equipo }}</td>
                @php
                      if(property_exists($equipo, "nombreTarea")){
                        echo '<td>'. $equipo->nombreTarea .'</td>';
                      }else{
                        echo '<td></td>';
                      }
                  @endphp
                {{-- <td>{{ $equipo->nombreTarea }}</td> --}}
                {{-- <td><span class="badge badge-circle-info">{{ $equipo->estatus_tarea }}</span></td> --}}
                {{-- <td>{{ $equipo->tecnico_encargado_equipo }}</td> --}}
              </tr>
            @endforeach
          </table>
        </div>
        <br>
        <div>
          <div>
            <table>
                
              <tr>
                <th>ADMINISTRADOR</th>
                <th>TÉCNICO</th>
                <th>SOLICITANTE</th>
              </tr>

              <tr>
                <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>ATENCIÓN A USUARIOS</span><br><span>FIRMA</span></td>
                <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>{{ $ordenServiciosObject->tecnico_encargado }}</span><br><span>FIRMA</span></td>
                <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>{{ $ordenServiciosObject->solicitante }}</span><br><span>FIRMA</span></td>
              </tr>
            </table>
          </div>                
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
<footer>
    {{-- <hr> --}}
    {{-- class="h-80 w-100 rounded-left"  border: #000 solid 1px; --}}
    <div style="width: 100%; text-align: center; font-size: 12px; height: 40px;">
      <span><small>Por disposiciones de este Centro Estatal de Tecnología Educativa, los equipos que hayan sido traídos para su mantenimiento
        o reparación, deberán ser recogidos en un plazo no mayor a 10 días hábiles. Agradecemos su colaboración.</small></span>
    </div>
    <div style="width: 50%; height: 100px; float: left;">
        <img style="width: 100px; height: 80px; margin-top: 8px;" src="<?php echo $pic_footer ?>" alt="">
    </div>
    <div div style="margin-left: 50%; height: 100px; text-align: right; font-size: 12px; margin-top: 4px;">
        <span class="invoice-title"><small><b>Centro Estatal de Tecnología Educativa</b></small><br></span>  
        <span class="invoice-title"><small>Calzada Gral. Luis Caballero S/N Antigua Escuela N</small><br></span>
        <span class="invoice-title"><small>Tel. (834)1538000, 153 8001</small><br></span>
        <span class="invoice-title"><small>Cd. Victoria. Tamaulipas</small><br></span>
        {{-- <span class="invoice-title"><small>http://cete.tamaulipas.gob.mx</small></span> --}}
    </div>      
</footer>

</html>