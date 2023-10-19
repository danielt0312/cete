<html lang="en">
<head>
    <title>Materiales</title>
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
            bottom: 1.5cm; 
            left: .5cm; 
            right: .5cm;
            height: 3.2cm;
            margin-left: .5cm;
            margin-right: .5cm;
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
        .container {
        display: table;
        width: 100%;
        height: 100%;
        }

        .content {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        }
    </style>
</head>
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
                <span><b>DICTÁMEN DE REQUISICIÓN DE MATERIALES/REFACCIONES</b></span>
                </td>
                </tr>
                <tr class="sinbordetable">
                <td class="sinbordetable3">
                <span><b>PARA ÓRDENES DE SERVICIO</b></span>
                </td>
                </tr>
            </table>
            <br>
            <table class="sinbordetable">
            <tr class="sinbordetable">
                
                @if($detalle_material2[0]->primer_folio != null)
                <td class="sinbordetable"><span>Folio Solicitud: <b>{{ $detalle_material2[0]->primer_folio }}</span> 
                <td class="sinbordetable3"><span>Estatus: <b>{{ $detalle_material2[0]->estatus }}</b></span>
                <td class="sinbordetable4"><span>Folio Orden: <b>{{ $detalle_material2[0]->folio }}</b></span>
                @else
                <td class="sinbordetable"><span>Folio Orden: <b>{{ $detalle_material2[0]->folio }}</span> 
                <td class="sinbordetable4"><span>Estatus: <b>{{ $detalle_material2[0]->estatus }}</b></span>
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
                        <td class="sinbordetable"><span>Nombre del C.T: <b>{{ $detalle_material2[0]->nombrect }}</b></span> 
                        <td class="sinbordetable"><span>Clave del C.T: <b>{{ $detalle_material2[0]->clavecct }}</b></span> 
                        <td class="sinbordetable"><span>Municipio: <b>{{ $detalle_material2[0]->municipio }}</b></span>
                        <span></span> 
                        </td>
                        </tr>
                        <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Nombre del Director: <b>{{ $detalle_material2[0]->director }}</b></span> 
                        <td class="sinbordetable"><span>Fecha de la Solicitud: <b>{{ $detalle_material2[0]->fecha_captacion }}</b></span> 
                        <td class="sinbordetable"><span>Estatus Solicitud: <b>{{ $detalle_material2[0]->estatus }}</b></span>
                        </tr>
                        <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Dirección: <b>{{ $detalle_material2[0]->domicilio }}</b></span> 
                        <td class="sinbordetable"><span>Turno: <b>{{ $detalle_material2[0]->desc_turno }}</b></span> 
                        <td class="sinbordetable"><span>Nivel Educativo: <b>{{ $detalle_material2[0]->nivel }}</b></span>
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
                        <td class="sinbordetable"><span>Nombre: <b>{{ $detalle_material2[0]->solicitante }}</b></span> 
                        <td class="sinbordetable"><span>Descripción del Reporte: <b>{{ $detalle_material2[0]->descrip_reporte }}</b></span></td>
                        </tr>
                        <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Teléfono: <b>{{ $detalle_material2[0]->telef_solicitante }}</b></span>                   
                        </tr>
                        <tr class="sinbordetable">
                        <td class="sinbordetable"><span>Correo Electrónico: <b>{{ $detalle_material2[0]->correo_solic }}</b></span>
                        
                        </tr>
                        
                    </table>
                    </td>
                </tr>
                </table>
                <table> <!--//////////////////////////////////////////////////////////////////////-->
                @if(isset($detalle_material))
                <tr>
                    <th>ACTIVIDADES REALIZADAS</th>
                    <tr class="sinbordetable">
                    @foreach($detalle_material as $detalle_material1)
                    <td style="width: 100%;">{{$detalle_material1->actividad_realizada}}</td>
                    @endforeach
                    </tr>

                </tr>
                @endif
                </table>
                <table> <!--//////////////////////////////////////////////////////////////////////-->
                @if(isset($detalle_material))
                <tr>
                    <th>NOTAS TÉCNICAS</th>
                    <tr class="sinbordetable">
                    <td style="width: 100%;">
                    @foreach($detalle_material as $detalle_material1)
                    {{$detalle_material1->nota_tecnica}}
                    @endforeach
                    </td>
                    </tr>
                </tr>
                @endif
                </table>
                <br>
                @foreach($detalle_material3 as $detalle_material33)
                    
                            <table> <!--//////////////////////////////////////////////////////////////////////-->
                                <tr>
                                    <th style="background-color: gray !important; text-transform: uppercase;">{{$detalle_material33->tarea}}, ÁREA DE SERVICIO: {{$detalle_material33->servicio}}</th>
                                </tr>
                                <tr>
                                    <td>
                                    <table class="sinbordetable">
                                    <th style="background-color: gray !important; width: 10%; text-align: center !important;">CANT.</th>
                                                <th style="background-color: gray !important; width: 30%;">PRODUCTO</th>
                                                <th style="background-color: gray !important; width: 30%;">DESCRIPCIÓN</th>
                                                <th style="background-color: gray !important; width: 100%;">ESPECIFICACIÓN</th>
                                                <th style="background-color: gray !important; width: 10%; text-align: center !important;">MEDIDA</th>
                                    @foreach($detalle_material2 as $detalle_material22)
                        
                                        @if($detalle_material33->id_servicio_tarea == $detalle_material22->id_servicio_tarea)
                                            
                                                
                                                    <tr class="sinbordetable">
                                                        <td style="width: 10%; text-align: center !important;">{{$detalle_material22->cantidad}}</td>
                                                        <td style="width: 30%;">{{$detalle_material22->nombre}}</td>
                                                        <td style="width: 30%;">{{$detalle_material22->descripcion}}</td>
                                                        <td style="width: 100%;">{{$detalle_material22->especificacion}}</td>
                                                        <td style="width: 10%; text-align: center !important;">{{$detalle_material22->medida}}</td>
                                                    </tr>
                                            
                                        @endif
                                    @endforeach
                                    </table>
                                    </td>
                                </tr>
                            </table>
                            <br>
                        
                @endforeach
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


<div class="left" style=" height: 100px; clear: both;
            position: fixed; 
            bottom: 1.5cm; 
            left: .5cm; 
            right: .5cm;
            height: 3.2cm;
            margin-left: .5cm;
            margin-right: .5cm;" >
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
                      <img style="width: 90px; height: 90px;" src="{{ asset('images/QR_ventanilla.png') }}" alt="">
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

</html>