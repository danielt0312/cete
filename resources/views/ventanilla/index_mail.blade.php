@extends('layouts.layout_educacion')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<div class="container-fluid py-4 mt-3">
    <!-- <div class="row mt-4">
    </div> -->
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <!-- <div class="container"> -->
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
                            <!-- <button type="button" id="btn_enviar" class="btn btn-secondary">ENVIAR</button> -->
                            <!-- <button type="button" hidden id="btn_enviar2" class="btn btn-secondary">INGRESAR</button> -->
                        </div>
                        <div class="col-3" ></div>
                    </div>
                    <br>
                    <h4><label id="countdown"></label></h4>

                 
                    

                    <br>
                    
                    <!-- <button type="button" id="btn_consultar" class="btn btn-secondary">CONSULTA ESTATUS DE SOLICITUD</button> -->
                </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- <div class="countdown"></div> -->

</div>
<div style="height: 10%;"></div>
@endsection

@section('page-scripts')

<script>

    $(function() {
        var html='';
        var html2='';
        var token = '';
        var correo_verifica = '';

        html+='<div class="row">';
            html+='<div class="col-3" ></div>';
            html+='<div class="col-6" >';
                html+='<input type="text" class="form-control" id="vCorreoVerifica">';
            html+='</div>';
            html+='<div class="col-3" ></div>';
        html+='</div>';
        

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
                url: '/ventanilla/sendEmail/',
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
                title: 'El TOKEN que esta ingresando es Incorrecto..',
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
                position: 'bottom-right',
                icon: 'warning',
                title: 'Favor de Ingresar un Correo Electronico Correcto.',
                showConfirmButton: false,
                customClass: 'msj_aviso',
                timer: 2000
            })
        }
        else{
            $.ajax({
                url: '/ventanilla/index_formulario_solicitud/',
                type: 'GET',
                data: {'vCorreoVerifica' : vCorreoVerifica}
            }).always(function(r) {  
                window.location.href = "formulario_index";
            });
            

        }
    });

    
</script>
@endsection