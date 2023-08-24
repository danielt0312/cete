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
      <div class="card-body" style="border-left: 1px solid #8080803d;">
        <!-- <h5 class="card-title">Card title</h5> -->
        <p></p>
        <center>
        <strong style="font-size:30px; color:#bc955c!important;">Registrar Solicitud</strong>
        </center>
        <br>
        <br>
        <p class="card-text">Para llevar a cabo el registro de solicitudes de servicio,
            deberá ingresar un correo electrónico institucional válido,
            el cual debe encontrarse vigente y en uso en un periodo no mayor a 2 meses.
        </p>
        <center>
        <strong style="font-size:15px; color:#414040!important;">Ingrese su correo electronico institucional</strong>
        <br><br>
        </center>

        <div class="row" id="div_mail"></div>
        <p>Si no cuenta con correo electrónico institucional. Favor de realizar una solicitud de generación de
            cuenta en el sitio: <a target="_blank" href="https://correosset.tamaulipas.gob.mx">https://correosset.tamaulipas.gob.mx</a></p>
        <button type="button" style="text-align:left;" id="btn_enviar4" class="btn btn-secondary pull-left">Regresar</button>
        <button type="button" style="text-align:right;" id="btn_enviar3" class="btn btn-secondary pull-right">Siguiente</button>
      </div>
    </div>
  </div>
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
                <p>INGRESE CORREO ELECTRONICO INSTITUCIONAL</p>

                
                <div class="row" id="div_mail">

                </div>
                <br><br>
                <div class="row">
                    <div class="col-3" ></div>
                    <div class="col-6" >
                        <button type="button" id="btn_enviar3" class="btn btn-secondary">SIGUIENTE</button>
                    </div>
                    <div class="col-3" ></div>
                </div>
                <br>
                <h4><label id="countdown"></label></h4>

                
                

                <br>
                
            </div>
        </div>
    </div>
</div> -->
<div style="height: 10%;"></div>
@endsection

@section('page-scripts')

<script>
$('#encabezado_layout').append('');
    $(function() {
        var html='';
        var html2='';
        var token = '';
        var correo_verifica = '';

        html+='<div class="input-group mb-3">'
            html+='<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>'
            html+='<input type="text" class="form-control" maxlength="150" id="vCorreoVerifica" placeholder="Escriba su correo aqui" aria-label="Username" aria-describedby="basic-addon1">'
        html+='</div>';

        // html+='<center>';

        // html+='<div class="input-group mb-3">'
        // html+='<div class="fa-3x">';
            // html+='<span class="input-group-text" ><i class="fas fa-spin"><i class="fa fa-spinner" aria-hidden="true"></i></i></span>'
            // html+='</div>';
            // html+='</center>';
            // html+='<input type="text" class="form-control" id="vCorreoVerifica" placeholder="Escriba su correo aqui" aria-label="Username" aria-describedby="basic-addon1">'
        
        // html+='</div>';
        
            
            
        
        

        $("#div_mail").append(html);

        
    });

    $('#btn_enviar').click(function(){
        console.log('entro');
        vCorreoVerifica = $('#vCorreoVerifica').val();
        var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/);
        if (caract.test(vCorreoVerifica) == false){
            console.log('entro');
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar un Correo Electronico Correcto.',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
        else{
            $("#btn_enviar").prop('disabled', true);
            $.ajax({
                url: '{{route("sendEmail")}}',
                type: 'GET',
                data: {'vCorreoVerifica' : vCorreoVerifica}
            }).always(function(r) {
                
                console.log(r);
                token = r.TOKEN;
                correo_verifica = vCorreoVerifica;
                $("#div_mail").empty();
                var html='';
                $('#btn_enviar').prop('hidden', true);

                html+='<div class="row justify-content-center">';
                    html+='<div class="col-4" >';
                        html+='<p>Correo Electronico</p>';
                        html+='<input type="text" value="'+vCorreoVerifica+'" disabled class="form-control" disabled id="vCorreoVerifica2">';
                    html+='</div>';
                    html+='<div class="col-3" >';
                        html+='<p>TOKEN</p>';
                        html+='<input type="text" class="form-control" id="vToken">';
                    html+='</div>';
                html+='</div>';
                $("#div_mail").append(html);
                $('#btn_enviar2').prop('hidden', false);
                var seconds = 30; //número de segundos a contar
                function secondPassed() {

                    var minutes = Math.round((seconds - 30)/60); //calcula el número de minutos
                    var remainingSeconds = seconds % 60; //calcula los segundos
                    //si los segundos usan sólo un dígito, añadimos un cero a la izq
                    if (remainingSeconds < 10) { 
                        remainingSeconds = "0" + remainingSeconds; 
                    } 
                    document.getElementById('countdown').innerHTML = minutes + ":" +     remainingSeconds; 
                    if (seconds == 0) { 
                        clearInterval(countdownTimer); 
                        // alert('Se acabó el tiempo'); 
                        // document.getElementById('countdown').innerHTML = "SE ACABO EL TIEMPO..."; 
                        // window.location.href = "indexMail";

                    } else { 
                        seconds--; 
                    } 
                } 

                var countdownTimer = setInterval(secondPassed, 1000);
            });
            
        }
    });

    $('#btn_enviar2').click(function(){
        $("#btn_enviar2").prop('disabled', true);
        console.log($('#vToken').val());
        console.log(token);
        vToken = $('#vToken').val();
        if (token == vToken) {
            // correo_verifica
            window.location.href = "formulario_index";
            // $.ajax({
            //     url: '/ventanilla/formulario_index/',
            //     type: 'GET',
            //     data: {'correo_verifica' : correo_verifica}
            //     }).always(function(r) {

            // });
        }
        else{
            Swal.fire({
                position: 'bottom-right',
                icon: 'warning',
                html:'<p style="font-size:1rem !important;">El correo electrónico que ingresaste es inválido. Favor de verificarlo.'+
                            'En caso de no contar con correo institucional @set.edu.mx ,favor de realizar una solicitud para'+
                            'generación de cuenta en el sitio: </p>'+
                            "<a href='https://correosset.tamaulipas.gob.mx' target='_blank'>https://correosset.tamaulipas.gob.mx</a>",
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
    });
    
    $('#btn_enviar3').click(function(){
        // console.log('sdf');
        vCorreoVerifica = $('#vCorreoVerifica').val();
        var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,3})+$/);
        if (caract.test(vCorreoVerifica) == false){
            // console.log('entro');
            Swal.fire({
                // position: 'bottom-right',
                icon: 'warning',
                html: '<p style="font-size:1rem !important;">Favor de Ingresar un Correo Electronico Correcto.</p>',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
        else{
            $.ajax({
                url: '{{route("index_formulario_solicitud")}}',
                type: 'GET',
                data: {'vCorreoVerifica' : vCorreoVerifica}
            }).always(function(r) {  
                // console.log(r);
                // console.log(r.exito);
                if (r.exito == false) {
                    Swal.fire({
                        // position: 'bottom-right',
                        icon: 'warning',
                        html:'<p style="font-size:1rem !important;">El correo electrónico que ingresaste es inválido. Favor de verificarlo.'+
                            'En caso de no contar con correo institucional @set.edu.mx ,favor de realizar una solicitud para'+
                            'generación de cuenta en el sitio: </p>'+
                            "<a href='https://correosset.tamaulipas.gob.mx' target='_blank'>https://correosset.tamaulipas.gob.mx</a>",
                        showConfirmButton: false,
                        customClass: 'msj_aviso',
                        width: 600,
                        timer: 5000
                    })
                }
                else{
                    window.location.href = "formulario_index";

                }
            });
            

        }
    });

    $('#btn_enviar4').click(function(){
        window.location.href = "indexVentanilla";
    });

    
</script>
@endsection