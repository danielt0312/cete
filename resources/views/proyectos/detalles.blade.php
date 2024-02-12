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
                        <h5 class="card-title text-primary font-weight-bolder">Nombre de proyecto</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-bold">{{$proyecto['nombre']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Descripción</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['descripcion']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Dominio</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['url_dominio']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">URL de Proyecto</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['url_proyecto']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">URL de Código Fuente</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['url_codigo_fuente']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Responsable de proyecto</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['responsable']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Área</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['area']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Tipo de información contenida</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['informacion_contenida']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Disponibilidad requerida</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['disponibilidad']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Periodos críticos</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text font-weight-normal">{{$proyecto['periodo_critico']}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <h5 class="card-title text-primary font-weight-bolder">Observaciones</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="card-title text @if($proyecto['observaciones'] == '') font-italic font-weight-light @else text font-weight-normal @endif ">{{$proyecto['observaciones'] != '' ? $proyecto['observaciones']: 'No hay datos registrados para este elemento.'}}</h5>
                    </div>
                </div>

                <div class="card-action">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="card-title text-primary font-weight-bolder">Procesos soportados</h5>
                        </div>
                    </div>
                    @foreach($etapas->toArray() as $etapa)
                        <div class="row row-cols-2">
                            <div class="col">
                                <h6 class="card-title font-weight-bold">{{$etapa['nombre']}}</h6>
                            </div>
                            <div class="col">
                                <h6 class="card-title font-weight-bold">Lista de desarrolladores</h6>
                            </div>
                        </div>

                        @php($nodata = true)
                        @foreach($procesos as $proceso)
                            @foreach($proceso as $valor)
                                @if(array_key_exists($etapa['id'], $procesos))
                                    @if($valor['id_cat_etapa'] == $etapa['id'])
                                        @php($nodata = false)
                                        <div class="row row-cols-2">
                                            <div class="col">
                                                <label class="card-title text font-weight-normal">{{$valor['nombre']}}</label>
                                            </div>
                                            <div class="col">
                                                <label class="card-title text font-weight-normal">{{$valor['desarrolladores']}}</label>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                @endif
                            @endforeach
                        @endforeach

                        @if($nodata)
                            <div class="row">
                                <div class="col text-center">
                                    <label class="card-title text font-italic font-weight-light">No hay datos registrados para este elemento.</label>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card-action">
                    @if(isset($documentaciones['disponible']))
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-primary font-weight-bolder">Documentación disponible</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="card-title text">Nombre</label>
                            </div>
                            <div class="col-6">
                                <label class="card-title text">Fecha de subida</label>
                            </div>
                        </div>
                        <ul class="row row-cols-2">
                            @foreach($documentaciones['disponible'] as $documentacion)
                                <div class="col">
                                    <a href="{{asset("storage/{$documentacion['directorio']}")}}" target="_blank"> {{$documentacion['nombre']}}</a>
                                </div>
                                <div class="col">
                                    <label class="col font-weight-normal">{{$documentacion['fecha_subida']}}</label>
                                </div>
                            @endforeach
                        </ul>
                    @endif

                    @if(isset($documentaciones['no_disponible']))
                        <div class="col">
                            <h5 class="card-title text-primary font-weight-bolder">Documentación faltante</h5>
                        </div>
                        <ul class="row row-cols-1">
                            @foreach($documentaciones['no_disponible'] as $documentacion)
                                <div class="col">
                                    <a> {{$documentacion['nombre']}}</a>
                                </div>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
