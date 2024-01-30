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
                    <input type="text" class="form-control col-sm-12" id="nombre" value="{{$data == null ? '': $data['nombre']}}"
                           @if($data == null) required @else readonly @endif>
                </div>
            </div>
            <div class="row mt-2">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="descripcion" rows="3"
                              @if($data == null) required @else readonly @endif>{{$data == null ? '': $data['descripcion']}}
                    </textarea>
                </div>
            </div>
            <div class="row mt-2">
                <label for="responsable" class="col-form-label">Responsable de Proyecto:</label>
                <div class="input-group">
                    <select class="form-select" id="responsable" aria-label="ResponsableProyecto"
                            @if($data != null) disabled @endif>
                        <option selected>{{$data == null ? 'Escoja...' : $data['responsable']}}</option>
                        <option value="1">Lic. Manuel de la Cruz</option>
                        <option value="2">Lic. Alfonso Rodríguez</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="url" class="col-sm-3 col-form-label">URL / Dominio:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="url" value="{{$data == null ? '': $data['url_dominio']}}"
                           @if($data == null) required @else readonly @endif>
                </div>
            </div>
            <div class="row mt-2">
                <label for="ubicacion" class="col-form-label">Ubicación:</label>
                <div class="input-group">
                    <select class="form-select" id="ubicacion" aria-label="ubicacion"
                            @if($data != null) disabled @endif>
                        <option selected>{{$data == null ? 'Escoja...' : $data['ubicacion']}}</option>
                        <option value="1">Cd. Victoria</option>
                        <option value="2">Jaumave</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <label for="procesosSoportados" class="col-form-label">Procesos soportados:</label>
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
            <div class="row">
                <label for="informacion" class="col-sm-3 col-form-label">Tipo de información contenida:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="informacion" value="{{$data == null ? '': $data['informacion']}}"
                           @if($data == null) required @else readonly @endif>
                </div>
            </div>
            <div class="row mt-2">
                <label for="disponibilidad" class="col-sm-3 col-form-label">Disponibilidad requerida</label>
                <div class="col-sm-12">
                    <div class="col-auto">
                        <label class="visually-hidden" for="autoSizingInputGroup"></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="disponibilidad" value="{{$data == null ? '': $data['disponibilidad']}}"
                                   @if($data == null) required @else readonly @endif>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <label for="periodos" class="col-sm-3 col-form-label">Periodos críticos:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="periodos" value="{{$data == null ? '': $data['periodos']}}"
                           @if($data == null) required @else readonly @endif>
                </div>
            </div>
            <div class="row mt-2">
                <label for="codigo_fuente" class="col-sm-3 col-form-label">Código fuente:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="codigo_fuente" value="{{$data == null ? '': $data['codigo_fuente']}}"
                           @if($data == null) required @else readonly @endif>
                </div>
            </div>
            <div class="row mt-2">
                <label for="documentacion" class="col-sm-3 col-form-label">Documentación disponible:</label>
                <div class="col-sm-12">
                    <ul>
                        <li><a href="https://google.com" class="link-primary">gitlab.com</a></li>
                        <li><a href="https://google.com" class="link-primary">github.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-2">
                <label for="observaciones" class="col-form-label">Observaciones:</label>
                <div class="col-sm-12">
                    <textarea class="form-control" id="observaciones" rows="3"
                              @if($data != null) readonly @endif>{{$data == null ? '': $data['observaciones']}}
                    </textarea>
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
@endsection
