@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Información contenida</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <div class="g-2 d-grid d-md-flex">
            <a class="btn btn-secundario " href="{{ route('index_proyectos') }}"><i class="fas fa-arrow-alt-circle-left">&nbsp;</i>  Regresar</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Nombre de proyecto:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['nombre']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Descripción:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text-secondary">{{$proyecto['descripcion']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Dominio: </h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['url_dominio']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">URL Proyecto:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['url_proyecto']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">URL Codigo Fuente:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['url_codigo_fuente']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Responsable de proyecto:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['responsable']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Área:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['area']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Información contenida:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['informacion_contenida']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Disponibilidad</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['disponibilidad']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Periodos críticos:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['periodo_critico']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary">Observaciones:</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text">{{$proyecto['observaciones']}}</h5>
                    </div>
                </div>
                <div class="card-action">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="card-title text-primary">Procesos soportados:</h5>
                        </div>
                    </div>
                    @foreach($etapas->toArray() as $etapa)
                        <div class="row">
                            <div class="col-6">
                                <h6 class="card-title text-secondary">{{$etapa['nombre']}}</h6>
                            </div>
                            <div class="col-6">
                                <h6 class="card-title text-secondary">Lista de desarrolladores</h6>
                            </div>
                        </div>
                        @foreach($procesos as $proceso)
                            @foreach($proceso as $valor)
                                @if(array_key_exists($etapa['id'], $procesos))
                                    @if($valor['id_cat_etapa'] == $etapa['id'])
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="card-title text">{{$valor['nombre']}}</label>
                                            </div>
                                            <div class="col-6">
                                                <label class="card-title text">{{$valor['desarrolladores']}}</label>
                                            </div>
                                        </div>
                                    @endif
                                {{--@else
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="card-title text">Sin datos disponibles.</label>
                                        </div>
                                        <div class="col-6">
                                            <label class="card-title text">Sin datos disponibles.</label>
                                        </div>
                                    </div>--}}
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
                <div class="card-action">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-primary">{{$documentaciones}}</h5>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
