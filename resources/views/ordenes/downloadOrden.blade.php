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

        table {
          border-collapse:collapse; 
          border: none; 
          width: 100%;
        }
        
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

        table .firmas{
          /* padding-top: 100em; */
          padding: 40px 1px 0px 1px;
          font-size: 13px;
        }

        .firmas2 th {
          background-color: #c2c2c2;
          color: black;
        }

        .centrarTitulo{
          font-size: 12px; 
          text-align: center;
          vertical-align: middle;
        }

        .colorLink{
          color: #ab0033;
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
        <img src="{{ asset('images/logo/logoTam2022.png') }}" alt="" style="width: 210px; height: 45px; margin-top: 10px;">
        <!-- <img src="{{ asset('images/logo/cete.png') }}" alt="" style="width: 210px; height: 45px; margin-top: 10px;"> -->
      </div>
      <div style="margin-left: 10%; height: 50px; text-align: right; font-size: 12px;"> 
        <p><b>CENTRO ESTATAL DE TECNOLOGÍA EDUCATIVA</b><br>
            SUBDIRECCIÓN DE OPERACIÓN DE PROYECTOS <br>
            ORDEN DE SERVICIO {{ $ordenServiciosObject->folio }}
        </p>
      </div>
      <div class="centrarTitulo" style="width:100%;"> 
        <p><b>FORMATO DE ÓRDEN DE SERVICIO</b></p> 
      </div>
    <!-- <hr style="height:1 px; border-width:0; color:rgb(0, 0, 0); background-color:rgb(0, 0, 0)"> -->
</header>
<div class="showcase">
<body>
    <div>
      <!-- <div style=" width:100%; text-aling:center; font-size: 12px;"> 
        <p><b>ÓRDEN DE SERVICIO</b></p> 
      </div> -->
        <table>
          <tr>
            <th>DATOS DEL CT</th>
            <th>DATOS DEL REPORTE</th>
          </tr>
          <tr>
            <td>
              <table class="sinbordetable">
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Nombre del CT:</span> <span>{{ $ordenServiciosObject->nombrect }}</span></td>
                  <td class="sinbordetable"> CCT: {{ $ordenServiciosObject->clave_ct }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td class="sinbordetable">Nombre del Director: {{ $ordenServiciosObject->director }}</td>
                  <td class="sinbordetable">Municipio: {{ $ordenServiciosObject->municipio }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td class="sinbordetable">Dirección: {{ $ordenServiciosObject->domicilio }}</td>
                  <td class="sinbordetable">Teléfono: {{ $ordenServiciosObject->telefono }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td colspan="2" class="sinbordetable">Coordinación: {{ $ordenServiciosObject->coordinacion }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td class="sinbordetable">Turno: {{ $ordenServiciosObject->turno }}</td>
                  <td class="sinbordetable">Nivel educativo: {{ $ordenServiciosObject->nivel }}</td>
                </tr>
              </table>
            </td>
            <td>
              <table  class="sinbordetable">
                <tr class="sinbordetable">
                  <td class="sinbordetable">Tipo de Orden: {{ $ordenServiciosObject->desc_tipo_orden }}</td>
                  <td class="sinbordetable">Fecha de Orden: {{ $ordenServiciosObject->fecha_captacion }}</td>
                  <td class="sinbordetable">Número de Orden: {{ $ordenServiciosObject->folio }}</td> 
                </tr>
                <tr class="sinbordetable">
                  <td colspan="3" class="sinbordetable">Dependencia que atiende el servicio: {{ $ordenServiciosObject->area_atiende }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td colspan="2" class="sinbordetable">Nombre del Solicitante: {{ $ordenServiciosObject->solicitante }}</td>
                  <td class="sinbordetable">Teléfono: {{ $ordenServiciosObject->telef_solicitante }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td colspan="3" class="sinbordetable">Correo electrónico: {{ $ordenServiciosObject->correo_solic }}</td>
                </tr>
                <tr class="sinbordetable">
                  <td colspan="3" class="sinbordetable">Descripción del reporte: {{ $ordenServiciosObject->descrip_reporte }}</td>
                </tr>
              </table>
            </td>
          </tr>
        </table>  
        <table> <!--//////////////////////////////////////////////////////////////////////-->
          <tr>
            <th>TÉCNICOS DE SOPORTE ASIGNADOS</th>
          </tr>
          <tr>
            <td>
              <table class="sinbordetable">
                <tr class="sinbordetable">
                  <td class="sinbordetable"><span>Técnico Encargado:</span> 
                  <span >{{ $ordenServiciosObject->tecnico_encargado }}</span> 
                </td>
                  <td class="sinbordetable">Fecha - hora inicio: {{ $ordenServiciosObject->fecha_inicio_programada }}</td>
                </tr>
                <tr class="sinbordetable">
                <td class="sinbordetable"> Técnico(s) Auxiliares: <span >{{ $ordenServiciosObject->tecnico_auxiliar }}</span> </td>
                  <td class="sinbordetable">Fecha - hora término: {{ $ordenServiciosObject->fecha_fin_programada }}</td>
                </tr>
                
              </table>
            </td>
          </tr>
        </table>

        <table> <!--//////////////////////////////////////////////////////////////////////-->
          @if ($ordenServiciosObject->jequipos!=null && $ordenServiciosObject->jequipos !='')
          <tr>
            <th>EQUIPOS</th>
          </tr>
              <?php
                $conta=0;
              ?>
            @foreach(json_decode($ordenServiciosObject->jequipos) as $val )
              <?php
                $conta=$conta+1;
              ?>
              <tr>
                <td>
                  <table>
                    <tr>
                      <td class="sinbordetable" style="width:2%;"><span> <?php echo $conta; ?></span></td>
                      <td class="sinbordetable" style="width:32%;">
                        <table style="width:100%;">
                          <tr class="sinbordetable">
                            <td class="sinbordetable"><span>Equipo:</span><span>{{$val->tipo_equipo}}</span></td>
                            <td class="sinbordetable"><span>Etiqueta:</span><span>@if($val->etiqueta!=''){{$val->etiqueta}}@else S/D @endif</span></td>
                          </tr>
                          <tr class="sinbordetable">
                            <td class="sinbordetable"><span>Núm de Serie:</span><span> S/D </span></td>
                            <td class="sinbordetable"><span>Marca:</span><span> S/D </span></td>
                          </tr>
                          <tr class="sinbordetable">
                            <td class="sinbordetable"><span>Ubicación:</span><span>@if($val->ubicacion!=''){{$val->ubicacion}}@else S/D @endif</span></td>
                            <td class="sinbordetable"><span>Modelo:</span><span> S/D </span></td>
                          </tr>
                        </table> 
                      </td>
                      <td class="sinbordetable" style="width:32%;">
                        <span>Servicios:</span>
                        <?php
                          $vServ='';
                          $vAux=''; 
                        ?>
                        @foreach($val->tareas as $val2)
                          <?php
                            if( $vAux != $val2->servicio ){
                              $vAux=$val2->servicio;
                              if($vServ==''){ 
                                $vServ = $vAux;
                              }else{
                                $vServ = $vServ.', '.$vAux;
                              }
                            }
                          ?>
                        @endforeach
                        <span><?php echo $vServ; ?> </span> 
                        <br>
                        <span>Tareas:</span>
                        @foreach($val->tareas as $val3)
                          <span>{{$val3->tarea}}, </span> 
                        @endforeach
                      </td>
                      <td class="sinbordetable" style="width:33%;">
                        <span>Descripción del Problema:</span> 
                          <span>{{$val->desc_problema}}</span> 
                        <br>
                        <span>Diagnóstico / Solución:</span>
                        <span> 
                          @if($val->diagnostico!='') 
                            {{$val->diagnostico}} /
                          @else 
                            S/D 
                          @endif
                        </span> 
                        <span> 
                          @if($val->solucion!='') 
                            {{$val->solucion}}
                          @else 
                            S/D 
                          @endif
                        </span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            @endforeach
          @endif
          <tr>
            <td>
              <table style="text-align:center;">
                <tr class="firmas2">
                  <th>SOLICITANTE:</th>
                  <th>TÉCNICO(s) AUXLILIARES</th>
                  <th>TÉCNICO ENCARGADO</th>
                </tr>
                <tfoot>
                  <tr>
                    <td class="firmas text-center " style="width: 33.3%; text-transform: uppercase; border-top:1px solid black;"><br><span>{{ $ordenServiciosObject->solicitante }}</span></td>
                    <td class="firmas text-center " style="width: 33.3%; text-transform: uppercase;"><br><span>{{ $ordenServiciosObject->tecnico_auxiliar }}</span></td>
                    <td class="firmas text-center " style="width: 33.3%; text-transform: uppercase; border-top:1px solid black;"><br><span>{{ $ordenServiciosObject->tecnico_encargado }}</span></td>
                  </tr>
                </tfoot>
              </table>
            </td>
          </tr>
        </table>
    </div>
    <br>
      
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
                      <img style="width: 90px; height: 90px;" src="{{ asset('images/logo/QR.png') }}" alt="">
                    </td>
                    <td class="tableFoot text-right" style="width: 23%; text-align: right; font-size: 12px; margin-top: 4px;">
                      <span class="invoice-title"><small>Calzada Gral. Luis Caballero S/N Antigua Escuela</small><br></span>
                      <span class="invoice-title"><small>Normal de Tamatán Tel. (834) 153-8000, 153-8001</small><br><br></span>
                      <span class="invoice-title colorLink"><small>https://tamaulipas.gob.mx/ventanillaunica</small></span> 
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