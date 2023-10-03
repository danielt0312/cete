@extends('layouts.contentIncludes')
@section('title','CAS CETE')
@php setPermissionsTeamId(3); @endphp

<meta name="csrf-token" content="{{-- csrf_token() --}}" />

<style>
   
</style>

@section('content')
<div class="container-fluid py-4 mt-3">
    <div class="row mt-4">
        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Detalle Equipo Atendido </h1>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <!-- <div class="d-flex align-items-center">
                        <div class="col-12">
                            <ul class="nav nav-pills nav-justified" id="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1" aria-current="page" data-bs-toggle="tab" href="#tabCCT">Datos del Centro de Trabajo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab2" aria-current="page" data-bs-toggle="tab" href="#tabReporte">Datos del reporte</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="tab3" aria-current="page" data-bs-toggle="tab" href="#tabEquipos">Equipos/Servicios</a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>

                <div class="card-body">
                    <form id="formOrden" action="" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-4">
                                    <label>Equipo/Servicio:</label>
                                    <label class="SinNegrita">{{ $equiposCerrados->tipo_equipo }}</label>
                                </div>
                                <div class="col-4">
                                    <label>Estatus:</label>
                                    <label class="SinNegrita">Atendido</label>
                                </div>
                                <div class="col-4">

                                </div>
                            </div>
                            <div class="row">
                            <div class="col-4">
                                    <label>Etiqueta:</label>
                                    <label class="SinNegrita">
                                        @if($equiposCerrados->etiqueta!='')
                                            {{ $equiposCerrados->etiqueta }}
                                        @else 
                                            S/D 
                                        @endif
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label>Detalle:</label>
                                    <label class="SinNegrita">
                                        S/D 
                                    </label>
                                </div>
                                <div class="col-4">
                                    <label>Ubicación:</label>
                                    <label class="SinNegrita">
                                        @if($equiposCerrados->ubicacion!='')
                                            {{ $equiposCerrados->ubicacion }}
                                        @else 
                                            S/D 
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Descripción del problema:</label>
                                    <label class="SinNegrita">{{ $equiposCerrados->desc_problema }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label>Listado de Áreas de Servicio/Tareas:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table>
                                        <thead>
                                            <th><label class="SinNegrita">Área de Servicio</label></th>
                                            <th><label class="SinNegrita">Tarea</label></th>
                                        </thead>
                                        <tbody>
                                            @foreach(json_decode($equiposCerrados->jtareas) as $val ) 
                                            <tr>
                                                <td>
                                                    <label class="SinNegrita">{{ $val->servicio }}</label>
                                                </td>
                                                <td>
                                                    <label class="SinNegrita">{{ $val->tarea }}</label>
                                                </td>
                                            </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12" id="datosGenCentro">
                                    <label>Diagnóstico:</label>
                                    <label>{{ $equiposCerrados->diagnostico }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" id="datosGenCentro">
                                    <label>Solución:</label>
                                    <label>{{ $equiposCerrados->solucion}} </label>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-scripts')

<script src="{{-- asset('js/jquery-3.5.1.js') --}}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer> </script> 

  <!--multicheck JC-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--multicheck JC-->
<script>

    $(document).ready(function () {
        
    });

</script>
@endsection
