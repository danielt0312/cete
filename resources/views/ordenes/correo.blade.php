<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Sistema C.A.S. - C.E.T.E</title>
</head>
<body>

<img src="{{ $message->embed((asset('images/correo/headercas.png'))) }}" class="img-fluid rounded-start" style="width: 100%;">
<div style="padding-left:3%; padding-right:3%; text-align: justify">
    <h2>{{ $details ['tittle'] }}</h2>
    <hr color="#ab0033!important;">
    <p>
        {{ $details ['body1'] }} <b>{{ $details ['folio'] }}</b> {{ $details ['body2'] }} <b>{{ $details ['estatus'] }}</b> 
        
        @if ($details ['estatus']!='')
            {{ $details ['body3'] }}
        @endif
    </p>

    @if ($details ['estatus']=='')
    <p>{{ $details ['body3'] }}</p>
    @endif

    <p>{{ $details ['body4'] }}</p>
    
    <center><b><p>{{ $details ['firma1'] }}<br>{{ $details ['firma2'] }}<br></p></b></center>

    @if ($details ['band_ventanilla']=='1')
        <p>De igual manera, puede consultar el seguimiento de su solicitud de servicio a través del sitio:
                <a href="cas.ventanillaunica.tamaulipas.gob.mx" style="color: #ab0033;"><ins>Ventanilla Única CETE</ins></a></p>
    @endif
</div>
    <br>
<img src="{{ $message->embed((asset('images/correo/foothercas.png'))) }}" class="img-fluid rounded-start" style="width: 100%;">

</body>
</html>