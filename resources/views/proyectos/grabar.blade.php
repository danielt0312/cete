@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Grabar proyecto</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <form class="row needs-validation">
            <div class="row">
                <label for="nombre" class="col-sm-3 col-form-label">Nombre del proyecto:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control col-sm-12" name="nombre" id="nombre" value="{{$data['nombre']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{$data['descripcion']}}</textarea>
                </div>
            </div>
            <div class="row mt-2">
                <label for="responsable" class="col-form-label">Responsable del proyecto:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control col-sm-12" name="responsable" id="responsable" value="{{$data['nombre']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="dominio" class="col-sm-3 col-form-label">Dominio:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="dominio" name="dominio" placeholder="www.tamaulipas.gob.mx" value="{{$data['url_dominio']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="url_proyecto" class="col-sm-3 col-form-label">URL de Proyecto:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="url_proyecto" id="url_proyecto" placeholder="www.tamaulipas.gob.mx/project" value="{{$data == null ? '' : $data['url_dominio']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="url_codigo_fuente" class="col-sm-3 col-form-label">URL de código fuente:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control"  name="url_codigo_fuente" id="url_codigo_fuente" placeholder="github.com/user/repository.git" value="{{$data == null ? '' : $data['url_dominio']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="area" class="col-form-label">Área:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="area" id="area" placeholder="Recursos Humanos" value="{{$data['area']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="informacion" class="col-sm-3 col-form-label">Tipo de información contenida:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="informacion" id="informacion" value="{{$data['informacion_contenida']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="procesosSoportados" class="col-form-label">Procesos soportados:</label>
                    <div class="mb-4">
                        @foreach($etapas as $etapa)
                            <div class="row mt-2">
                                <h6>{{$etapa['nombre']}}</h6>

                                <div class="">
                                    <div id="row" style="margin-left: 20px">
                                        <div class="input-group">
                                            <button class="btn btn-danger" id="DeleteRow" type="button">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="newinput"></div>
                                    <button id="rowAdder" type="button" class="btn btn-dark">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
            </div>
            <div class="row mt-2">
                <label for="disponibilidad" class="col-form-label">Disponibilidad requerida:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="disponibilidad" id="disponibilidad" value="{{$data['disponibilidad']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="periodos" class="col-sm-3 col-form-label">Periodos críticos:</label>

            </div>
            <div class="row mt-2">
                <label for="codigo_fuente" class="col-sm-3 col-form-label">Código fuente:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="codigo_fuente" id="codigo_fuente" value="{{$data['url_codigo_fuente']}}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="documentacion" class="col-sm-3 col-form-label">Documentación disponible:</label>
                <div class="col-sm-12">
                    <ul>
                        @if($data['id'] != '')
                            @foreach($documentacion as $documento)
                                <li><a href="#" class="link-primary">{{$documento}}</a></li>
                            @endforeach
                        @else
                            <h6>Sin documentación</h6>
                        @endif
                    </ul>
                </div>
                <div class="row mt-2">
                    <div class="agregar">
                        <div id="documento-row" style="margin-left: 20px">
                            <div class="input-group">
                                <button class="btn btn-danger" id="documento-DeleteRow" type="button">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div id="documento-newinput"></div>
                        <button id="documento-rowAdder" type="button" class="btn btn-dark">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <label for="observaciones" class="col-form-label">Observaciones:</label>
                <div class="col-sm-12">
                    <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{$data['observaciones']}}</textarea>
                </div>
            </div>
            <div class="row mt-4">
                <div>
                    <button class="btn btn-primary col-sm-12" type="submit">{{$data == null ? 'Guardar' : 'Actualizar'}}</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $("#rowAdder").click(function () {
            newRowAdd =
                '<div id="row" style="margin-left: 20px">'+
                    '<div class="input-group">'+
                        '<button class="btn btn-danger" id="DeleteRow" type="button">'+
                            '<i class="fas fa-trash"></i>'+
                        '</button>'+
                        '<div class="col-sm-11">'+
                            '<input type="text" class="form-control" required>'+
                        '</div>'+
                    '</div>'+
                '</div>';

            $('#newinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
    </script>

    <script type="text/javascript">
        $("#documento-rowAdder").click(function () {
            newRowAdd =
                '<div id="row" style="margin-left: 20px">'+
                    '<div class="input-group">'+
                        '<button class="btn btn-danger" id="documento-DeleteRow" type="button">'+
                            '<i class="fas fa-trash"></i>'+
                        '</button>'+
                        '<div class="col-sm-11">'+
                            '<input type="text" class="form-control" required>'+
                        '</div>'+
                    '</div>'+
                '</div>';

            $('#documento-newinput').append(newRowAdd);
        });
        $("body").on("click", "#documento-DeleteRow", function () {
            $(this).parents("#documento-row").remove();
        })
    </script>
@endsection
