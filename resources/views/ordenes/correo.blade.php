<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Sistema C.A.S. - C.E.T.E</title>
</head>
<body>  
<img src="https://sistemaset.tamaulipas.gob.mx/cas/public/images/correo/headercas.png" class="img-fluid rounded-start" style="width: 100%;">

<div style="padding-left:3%; padding-right:3%; text-align: justify">
    <h2>{{ $details ['tittle'] }}</h2>
    <hr color="#ab0033!important;">
    <p>
        {{ $details ['body1'] }} <b>{{ $details ['folio'] }}</b> {{ $details ['body2'] }} <b>{{ $details ['estatus'] }}</b> 

        @if ($details ['estatus']!='')
            {{ $details ['body3'] }}
        @endif

        @if ($details ['fecha_hora_asignacion']!='')
            <b>{{ $details ['fecha_hora_asignacion'] }}</b>
        @endif

        @if ($details ['fecha_hora_asignacion']!='')
            {{ $details ['body3'] }}
        @endif
    </p>

    @if ($details ['estatus']=='' && $details ['fecha_hora_asignacion']=='')
    <p>{{ $details ['body3'] }}</p>
    @endif
    
    <p>{{ $details ['body4'] }}</p>
    
    <center><b><p>{{ $details ['firma1'] }}<br><br>{{ $details ['firma2'] }}<br></p></b></center>

    @if ($details ['band_ventanilla']=='1')
        <p>De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
        <!-- <a href="devcete.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a></p> -->
        <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a></p>
    @else
    <p>De igual manera, puede consultar el seguimiento de su orden de servicio a través del sitio:
        <!-- <a href="devcete.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a></p> -->
        <a href="https://sistemaset.tamaulipas.gob.mx/cas/ventanilla/consulta" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a></p>
    @endif
</div>
    <br>

<img src="https://sistemaset.tamaulipas.gob.mx/cas/public/images/correo/foothercas.png" class="img-fluid rounded-start" style="width: 100%;">

</body>
</html>