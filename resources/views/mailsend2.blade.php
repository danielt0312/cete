<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Sistema C.A.S. - C.E.T.E</title>
</head>
<body>
<!-- <img src="data:image/png;base64,{{base64_encode( asset('images/img/ventanilla/headercas.png') )}}" alt=""> -->

<img src="https://sistemaset.tamaulipas.gob.mx/cas/public/images/correo/headercas.png" class="img-fluid rounded-start" style="width: 100%;">
<div style="padding-left:3%; padding-right:3%">
    <h2>{{ $details ['tittle'] }}</h2>
    <hr color="#ab0033!important;">
    <p>{{ $details ['body1'] }}</p>
    <p>{{ $details ['body2'] }}<b>{{ $details ['body2.1'] }}</b></p>
    <!-- <br><br> -->
    <p>{{ $details ['body3'] }}</p>
    <br>
    <!-- <br> -->
    <center><b><p>{{ $details ['body4'] }}<br><br>{{ $details ['body5'] }}<br></p></b></center>
</div>
    <br>
    <img src="https://sistemaset.tamaulipas.gob.mx/cas/public/images/correo/foothercas.png" class="img-fluid rounded-start" style="width: 100%;">

    <!-- <img src="{{ asset('images/img/ventanilla/foothercas.png') }}" class="img-fluid rounded-start" style="width: 100%;"> -->
</body>
</html>