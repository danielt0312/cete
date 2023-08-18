@extends('layouts.layout_educacion')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<style>
    .colorBtnPrincipal{ 
        background-color: #ab0033!important;
        color:#FFFFFF !important;
    }
    .colorBtnPrincipal:hover{ 
        background-color: #bc955c!important;
        color:#FFFFFF !important;
    }
    .showcase {
          /* width: 70%;
          height: 50%; */
          background-image: url("{{ asset('images/img/ventanilla/LOGOPFONDOENTRANSP.png') }}");
          background-position: right;
          background-repeat: no-repeat;
          background-size: cover;
          /* opacity: 0.2; */
        }
    
</style>
<div style="height: 10%;"></div>
<div class="card mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 100%;">
  <div class="row g-0">
    <div class="col-md-4">
    <div style="height: 20%;"></div>
        <center>
        <img src="{{ asset('images/img/ventanilla/VENTUNICALOGO.png') }}" class="img-fluid rounded-start" style="width: 50%;">

        </center>
        <br>
        <center>
        <img src="{{ asset('images/img/ventanilla/CETELOGO.png') }}" class="img-fluid rounded-start" style="width: 30%;">

        </center>
    </div>
    <div class="col-md-8">
      <div class="card-body" style="border-left: 1px solid #8080803d;" >
        <!-- <h5 class="card-title">Card title</h5> -->
        <p></p>
        <br>
        <center>
        <p class="card-text">Si requieres de una Solicitud de Servicio de Soporte Técnico.</p>
        <p class="card-text">Mantenimiento o Telecomunicaciones, regístrala a continuación.</p>
        <br>
        <p class="card-text">Si ya cuentas con una solicitud, puedes consultar el estatus de seguimiento.</p>
        <br>
        <button type="button" id="btn_registrar" class="btn colorBtnPrincipal">Registrar Solicitud</button>
        <br><br><br>
        <button type="button" id="btn_consultar" class="btn colorBtnPrincipal">Consultar Solicitud</button>
        <!-- <div class="showcase"></div> -->
        <!-- <img src="{{ asset('images/img/ventanilla/LOGOPFONDOENTRANSP.png') }}" class="img-fluid rounded-start" style="width: 50%;"> -->
        </center>
        <br><br>
      </div>
    </div>
  </div>
  <div style="height: 10%;"></div>
</div>
<!-- <div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="container " style="text-align: center;">
                    <p>CENTRO ESTATAL DE TECNOLOGIA EDUCATIVA</p>
                    <p>SECRETARIA DE EDUCACION TAMAULIPAS</p>
                    <br>
                    <p>VENTANILLA UNICA PARA RECEPCION DE SOLICITUDES DE SOPORTE TECNICO Y MANTENIMIENTO</p>
                    <br>
                    <button type="button" id="btn_registrar" class="btn btn-secondary">REGISTRO DE SOLICITUD</button>
                    <button type="button" id="btn_consultar" class="btn btn-secondary">CONSULTA ESTATUS DE SOLICITUD</button>
                </div>
        </div>
    </div>

</div> -->
<div style="height: 10%;"></div>
@endsection

@section('page-scripts')

<script>
    $('#btn_registrar').click(function(){
        // console.log('entro')
        window.location.href = "indexMail";
    });

    $('#btn_consultar').click(function(){
        // console.log('entro')
        window.location.href = "consulta";
    });

    // var timer2 = "5:01";
    // var interval = setInterval(function() {     


    // var timer = timer2.split(':');
    // //by parsing integer, I avoid all extra string processing
    // var minutes = parseInt(timer[0], 10);
    // var seconds = parseInt(timer[1], 10);
    // --seconds;
    // minutes = (seconds < 0) ? --minutes : minutes;
    // if (minutes < 0) clearInterval(interval);
    // seconds = (seconds < 0) ? 59 : seconds;
    // seconds = (seconds < 10) ? '0' + seconds : seconds;
    // //minutes = (minutes < 10) ?  minutes : minutes;
    // $('.countdown').html(minutes + ':' + seconds);
    // timer2 = minutes + ':' + seconds;
    // }, 1000);

    // var seconds = 3; //número de segundos a contar
    // function secondPassed() {

    //     var minutes = Math.round((seconds - 30)/60); //calcula el número de minutos
    //     var remainingSeconds = seconds % 60; //calcula los segundos
    //     //si los segundos usan sólo un dígito, añadimos un cero a la izq
    //     if (remainingSeconds < 10) { 
    //         remainingSeconds = "0" + remainingSeconds; 
    //     } 
    //     document.getElementById('countdown').innerHTML = minutes + ":" +     remainingSeconds; 
    //     if (seconds == 0) { 
    //         clearInterval(countdownTimer); 
    //         alert('Se acabó el tiempo'); 
    //         document.getElementById('countdown').innerHTML = "Se acabo el tiempo"; 
    //     } else { 
    //         seconds--; 
    //     } 
    // } 

    // var countdownTimer = setInterval(secondPassed, 1000);

    
</script>
@endsection