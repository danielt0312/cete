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
<div style="padding-left:3%; padding-right:3%">
    <h2>{{ $details ['tittle'] }}</h2>
    <hr color="#ab0033!important;">
    <b><p>{{ $details ['body1'] }}</p></b>
    <p>{{ $details ['body2'] }}</p>
    
    <p>{{-- $details ['body3'] --}}</p>
    <center><b><p>{{ $details ['body4'] }}<br>{{ $details ['body5'] }}<br></p></b></center>
</div>
    <br>
<img src="{{ $message->embed((asset('images/correo/foothercas.png'))) }}" class="img-fluid rounded-start" style="width: 100%;">

</body>
</html>