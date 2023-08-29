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
        <img src="{{ asset('images/logo/logoTam2022.png') }}" alt="" style="width: 210px; height: 45px; margin-top: 10px;">
      </div>
      <div style="margin-left: 10%; height: 50px; text-align: right; font-size: 12px;"> 
        <p><b>CENTRO ESTATAL DE TECNOLOGÍA EDUCATIVA</b><br>
            SUBDIRECCIÓN DE OPERACIÓN DE PROYECTOS <br>
            ORDEN DE SOLICITUD DE SERVICIOS
        </p>
      </div>
    
    <!-- <hr style="height:1 px; border-width:0; color:rgb(0, 0, 0); background-color:rgb(0, 0, 0)"> -->
</header>
<div class="showcase">
<body>
    <div>
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
            <th>EQUIPOS ATENDIDOS</th>
          </tr>
            @foreach(json_decode($ordenServiciosObject->jequipos) as $val )
              <tr>
                <td>
                  <table>
                    <tr>
                      <!-- <td class="sinbordetable" style="width:2%;"><span>1</span></td> -->
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
                        @foreach($val->tareas as $val2)
                          <span>{{$val2->servicio}}, </span>
                        @endforeach <br>
                        
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
          <!-- <tr>
            <td>
              <table>
                <tr>
                  <td class="sinbordetable" style="width:2%;"><span>1</span></td>
                  <td class="sinbordetable" style="width:32%;">
                    <table style="width:100%;">
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Equipo:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Etiqueta:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Núm de Serie:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Marca:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Ubicación:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Modelo:</span><span>dddddd</span></td>
                      </tr>
                    </table>
                  </td>
                  <td class="sinbordetable" style="width:32%;">
                    <span>Servicios:</span><span>dddddd</span> <br>
                    <span>Tareas:</span><span>dddddd</span>
                  </td>
                  <td class="sinbordetable" style="width:33%;">
                    <span>Descripción del Problema:</span> 
                      <span>Equipo no enciende, no tiene antivirus, no se conecta al inter, requiere actualizar software.</span> 
                    <br>
                    <span>Diagnóstico / Solución:</span><span>dddddd</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table>
                <tr>
                  <td class="sinbordetable" style="width:2%;"><span>1</span></td>
                  <td class="sinbordetable" style="width:32%;">
                    <table style="width:100%;">
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Equipo:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Etiqueta:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Núm de Serie:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Marca:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Ubicación:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Modelo:</span><span>dddddd</span></td>
                      </tr>
                    </table>
                  </td>
                  <td class="sinbordetable" style="width:32%;">
                    <span>Servicios:</span><span>dddddd</span> <br>
                    <span>Tareas:</span><span>dddddd</span>
                  </td>
                  <td class="sinbordetable" style="width:33%;">
                    <span>Descripción del Problema:</span> 
                      <span>Equipo no enciende, no tiene antivirus, no se conecta al inter, requiere actualizar software.</span> 
                    <br>
                    <span>Diagnóstico / Solución:</span><span>dddddd</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table>
                <tr>
                  <td class="sinbordetable" style="width:2%;"><span>1</span></td>
                  <td class="sinbordetable" style="width:32%;">
                    <table style="width:100%;">
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Equipo:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Etiqueta:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Núm de Serie:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Marca:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Ubicación:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Modelo:</span><span>dddddd</span></td>
                      </tr>
                    </table>
                  </td>
                  <td class="sinbordetable" style="width:32%;">
                    <span>Servicios:</span><span>dddddd</span> <br>
                    <span>Tareas:</span><span>dddddd</span>
                  </td>
                  <td class="sinbordetable" style="width:33%;">
                    <span>Descripción del Problema:</span> 
                      <span>Equipo no enciende, no tiene antivirus, no se conecta al inter, requiere actualizar software.</span> 
                    <br>
                    <span>Diagnóstico / Solución:</span><span>dddddd</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table>
                <tr>
                  <td class="sinbordetable" style="width:2%;"><span>1</span></td>
                  <td class="sinbordetable" style="width:32%;">
                    <table style="width:100%;">
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Equipo:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Etiqueta:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Núm de Serie:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Marca:</span><span>dddddd</span></td>
                      </tr>
                      <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Ubicación:</span><span>dddddd</span></td>
                        <td class="sinbordetable"><span>Modelo:</span><span>dddddd</span></td>
                      </tr>
                    </table>
                  </td>
                  <td class="sinbordetable" style="width:32%;">
                    <span>Servicios:</span><span>dddddd</span> <br>
                    <span>Tareas:</span><span>dddddd</span>
                  </td>
                  <td class="sinbordetable" style="width:33%;">
                    <span>Descripción del Problema:</span> 
                      <span>Equipo no enciende, no tiene antivirus, no se conecta al inter, requiere actualizar software.</span> 
                    <br>
                    <span>Diagnóstico / Solución:</span><span>dddddd</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr> -->

          <tr>
            <td>
              <table style="text-align:center;">
                <tr>
                  <th>SOLICITANTE:</th>
                  <th>TÉCNICO(s) AUXLILIARES</th>
                  <th>TÉCNICO ENCARGADO</th>
                </tr>
                <!-- <tr>
                  <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>{{ $ordenServiciosObject->solicitante }}</span></td>
                  <td style="width: 33.3%; text-transform: uppercase;"><span>{{ $ordenServiciosObject->tecnico_auxiliar }}</span></td>
                  <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>{{ $ordenServiciosObject->tecnico_encargado }}</span></td>
                </tr> -->
                <tbody>
                  <tr>
                    <td ></td>
                    <td style="width: 33.3%; text-transform: uppercase;"><span>{{ $ordenServiciosObject->tecnico_auxiliar }}</span></td>
                    <td ></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td class="firmas" style="width: 33.3%; text-transform: uppercase; border-top:1px solid black;"><span>{{ $ordenServiciosObject->solicitante }}</span></td>
                    <td style="width: 33.3%; text-transform: uppercase;"></td>
                    <td class="firmas" style="width: 33.3%; text-transform: uppercase; border-top:1px solid black;"><span>{{ $ordenServiciosObject->tecnico_encargado }}</span></td>
                  </tr>
                </tfoot>
              </table>
            </td>
          </tr>
        </table>
        <!-- <table>
          <tr>
            <th>Folio</th>
            <th style="width: 25%">Centro de trabajo</th>
            <th>Quién reporta</th>
            <th>Teléfono</th>
          </tr>

          <tr>
            <td style="text-transform: uppercase;">{{ $ordenServiciosObject->folio }}</td>
            <td rowspan="3" style="text-transform: uppercase;">{{-- $ordenServiciosObject->nombrect --}}</td>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->nom_quien_reporta --}}</td>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->telefono_quien_reporta --}}</td>
          </tr>

          <tr>
            <th>Núm. orden</th> 
            <th>Solicitante</th>
            <th>Fecha de inicio</th>
          </tr>

          <tr>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->id --}}</td>
            {{-- <td style="border: white solid 1px !important"></td> --}}
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->solicitante --}}</td>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->fecha_inicio --}}</td>
          </tr>

          <tr>
            <th style="width: 40%">Domicilio</th>
            <th>Técnico encargado</th>
            <th>Área que atiende</th>
            <th>Fecha de cierre</th>
          </tr>

          <tr>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->domicilio --}}</td>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->tecnico_encargado --}}</td>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->area --}}</td>
            <td style="text-transform: uppercase;">{{-- $ordenServiciosObject->fecha_finalizacion --}}</td>
          </tr>
          
          <tr>
            <th>Técnicos auxiliares:</th>
            <td colspan="3" style="text-transform: uppercase;">
            
            </td>
          </tr>
        </table>  -->
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
          <!-- <div>
            <table>
                
              <tr>
                <th>SOLICITANTE:</th>
                <th>TÉCNICO(s) AUXLILIARES</th>
                <th>TÉCNICO ENCARGADO</th>
              </tr>

              <tr>
                <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>ATENCIÓN A USUARIOS</span><br><span>FIRMA</span></td>
                <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>{{-- $ordenServiciosObject->tecnico_encargado --}}</span><br><span>FIRMA</span></td>
                <td class="firmas" style="width: 33.3%; text-transform: uppercase;"><span>{{-- $ordenServiciosObject->solicitante --}}</span><br><span>FIRMA</span></td>
              </tr>
            </table>
          </div>                 -->
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
<footer>
    {{-- <hr> --}}
    {{-- class="h-80 w-100 rounded-left"  border: #000 solid 1px; --}}
    <div style="width: 100%; text-align: center; font-size: 12px; height: 40px;">
      <span><small>Por disposiciones de este Centro Estatal de Tecnología Educativa, los equipos que hayan sido traídos para su mantenimiento
        o reparación, deberán ser recogidos en un plazo no mayor a 10 días hábiles. Agradecemos su colaboración.</small></span>
    </div>
    <div style="width: 50%; height: 100px; float: left;">
        <img style="width: 100px; height: 80px; margin-top: 8px;" src="{{ asset('images/logo/ceteNI.png') }}" alt="">
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