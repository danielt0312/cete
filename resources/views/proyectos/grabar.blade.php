    @extends('layouts.contentIncludes')

    @section('content')
        <div class="container-fluid py-4 mt-3">
            <div class="row mt-4">
                <div class="d-flex justify-content-between ">
                    <h1 class="mb-2 colorTitle">Grabar proyecto</h1>
                </div>
            </div>
            <div class="mt-7"/>
            <form class="row" id="formProyecto" action="{{ route('grabar_proyecto') }}" method="POST">
                @csrf
                <div class="row row-cols-2">
                    <div class="col">
                        <label for="nombre" class="col-form-label">Nombre del proyecto</label>
                        <div>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{$data['nombre']}}" placeholder="InfoGestor" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="periodos" class="col-form-label">Periodos críticos</label>
                        <div>
                            <input type="text" class="form-control" name="datefilter" id="periodos" value="" placeholder="07/01/2023 - 03/02/2023" />
                        </div>
                    </div>
                </div>
                <div class="row col-sm-12 mt-2">
                    <label for="descripcion" class="col-form-label">Descripción</label>
                    <div>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{$data['descripcion']}}</textarea>
                    </div>
                </div>
                <div class="row row-cols-2 mt-2">
                    <div class="col">
                        <label for="responsable" class="col-form-label">Responsable del proyecto</label>
                        <div>
                            <input type="text" class="form-control" name="responsable" id="responsable" value="{{$data['nombre']}}" placeholder="Lic. José Luis" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="area" class="col-form-label">Área:</label>
                        <div>
                            <input type="text" class="form-control" name="area" id="area" placeholder="Recursos Humanos" value="{{$data['area']}}" required>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-3 mt-2">
                    <div class="col">
                        <label for="dominio" class="col-form-label">Dominio</label>
                        <div>
                            <input type="text" class="form-control" id="dominio" name="dominio" placeholder="www.tamaulipas.gob.mx" value="{{$data['url_dominio']}}" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="url_proyecto" class="col-form-label">URL de Proyecto</label>
                        <div>
                            <input type="text" class="form-control" name="url_proyecto" id="url_proyecto" placeholder="www.tamaulipas.gob.mx/project" value="{{$data == null ? '' : $data['url_dominio']}}" required>
                        </div>
                    </div>
                    <div class="col">
                        <label for="url_codigo_fuente" class="col-form-label">URL de Código Fuente</label>
                        <div>
                            <input type="text" class="form-control"  name="url_codigo_fuente" id="url_codigo_fuente" placeholder="github.com/user/repository.git" value="{{$data == null ? '' : $data['url_dominio']}}" required>
                        </div>
                    </div>
                </div>
                <div class="row col-sm-12 mt-2">
                    <label for="informacion" class="col-form-label">Tipo de información contenida</label>
                    <div>
                        <input type="text" class="form-control" name="informacion" id="informacion" value="{{$data['informacion_contenida']}}" required>
                    </div>
                </div>
                <div class="row col-sm-12 mt-2">
                    <label for="disponibilidad" class="col-form-label">Disponibilidad requerida</label>
                    <div class="">
                        <input type="text" class="form-control" name="disponibilidad" id="disponibilidad" value="{{$data['disponibilidad']}}" required>
                    </div>
                </div>
                <div class="row col-sm-12 mt-2">
                    <label for="procesosSoportados" class="col-form-label">Procesos soportados</label>
                    <div id="listaProcesos" class="">
                        @foreach($etapas as $etapa)
                            <div class="card @if($etapa['id'] != 1) mt-3 @endif card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="col-form-label col-form-label-sm">{{$etapa['nombre']}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="col-form-label col-form-label-sm">Lista de desarrolladores</label>
                                    </div>
                                </div>

                                <div id="{{$etapa['id']}}-newInput"></div>

                                <div class="row">
                                    <div class="col-11 text-center mt-2">
                                        <button id="{{$etapa['id']}}-rowAdder" type="button" class="btn btn-dark btn-xs">
                                            <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Agregar proceso
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row mt-2 col-sm-12">
                    <label for="documentacion" class="col-form-label">Documentación</label>
                    <div class="">
                        <ul>
                            @if($data['id'] != '')
                                @foreach($documentacion as $documento)
                                    <li><a href="#" class="link-primary">{{$documento}}</a></li>
                                @endforeach
                            @else
                               <label class="col-form-label col-form-label-sm">Sin documentación</label>
                            @endif
                        </ul>
                    </div>
                    <div class="row">
                        <div class="agregar">
                            <div id="documento-newinput"></div>
                            <button id="documento-rowAdder" type="button" class="btn btn-dark btn-xs">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;Agregar nueva documentación
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row col-sm-12">
                    <label for="observaciones" class="col-form-label">Observaciones</label>
                    <div class="">
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{$data['observaciones']}}</textarea>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="text-center">
                        <button class="btn btn-primary" id="btnEnviar" type="submit">@if($data['id'] != '') Actualizar @else Guardar @endif</button>
                    </div>
                </div>
            </form>
        </div>
    @endsection

    @section('page-scripts')
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js" integrity="sha512-lUZZrGg8oiRBygP81yUZ4XkAbmeJn7u7HW5nq7npQ+ZXTRvj3ErL6y1XXDq6fujbiJlu6gHsgNUZLKE6eSDm8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css" integrity="sha512-YWDtZYKUekuPMIzojX205b/D7yCj/ZM82P4hkqc9ZctHtQjvq3ei11EvAmqxQoyrIFBd9Uhfn/X6nJ1Nnp+F7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script type="text/javascript">
            var desarrolladores = @json($desarrolladores);

            $(document).ready(function () {
                var guardar_id_procesos = {};

                function agregarProcedimiento(elementos) {
                    elementos.forEach(function (elemento) {
                        guardar_id_procesos[elemento.id] = [];
                        var contador = 0;
                        var identificadorBase = `${elemento.id}`;

                        $(`#${identificadorBase}-rowAdder`).click(function () {
                            var identificador = `${identificadorBase}-${++contador}`;

                            var addNewRow =
                                `<div class="row align-items-center" id="${identificador}-row">` +
                                '<div class="col-5">' +
                                `<div>` +
                                '<div class="input-group">' +
                                '<div class="col-sm-12">' +
                                `<input type="text" id="${identificador}-input-proceso" class="form-control form-control-sm" required>` +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-1" style="padding-left: 25px; padding-top: 15px;">' +
                                '<div class="col-sm-1">' +
                                `<button class="btn btn-danger btn-xs form-control-sm" id="${identificador}-deleteRow" type="button">` +
                                '<i class="fas fa-trash"></i>' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '<div class="col-6">' +
                                `<div id="${identificador}-des-row">` +
                                '<div class="input-group">' +
                                '<div class="col-sm-12">' +
                                `<input type="text" id="${identificador}-input-desarrollador" class="form-control form-control-sm" required>` +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';

                            $(`#${identificadorBase}-newInput`).append(addNewRow);

                            var inputDesarrollador = $(`#${identificador}-input-desarrollador`);
                            inputDesarrollador.tokenfield({
                                autocomplete: {
                                    source: desarrolladores,
                                    delay: 100
                                },
                                showAutocompleteOnFocus: true
                            });

                            $("body").on("click", `#${identificador}-deleteRow`, function () {
                                $(this).parents(`#${identificador}-row`).remove();
                                var ids = identificador.split("-");
                                guardar_id_procesos[elemento.id].splice(guardar_id_procesos[elemento.id].indexOf(parseInt(ids[1])), 1);
                            });

                            guardar_id_procesos[elemento.id].push(contador);
                        });
                    });
                }

                agregarProcedimiento(@json($etapas));

                $('#btnEnviar').on('click', function () {
                    for(var clave in guardar_id_procesos){
                        guardar_id_procesos[clave].forEach(function (elemento) {
                            var procesoInputSelector = `${clave}-${elemento}-input-proceso`;
                            var desarrolladorInputSelector = `${clave}-${elemento}-input-desarrollador`;

                            var procesoValue = document.getElementById(procesoInputSelector).value;
                            var desarrolladorValue = document.getElementById(desarrolladorInputSelector).value;

                            $('<input>').attr({
                                type: 'hidden',
                                name: `procesos[${clave}][${elemento}][proceso]`,
                                value: procesoValue
                            }).appendTo('#formProyecto');

                            $('<input>').attr({
                                type: 'hidden',
                                name: `procesos[${clave}][${elemento}][desarrollador]`,
                                value: desarrolladorValue
                            }).appendTo('#formProyecto');
                        });
                    }
                });
            });
        </script>

        <script type="text/javascript">
            $("#documento-rowAdder").click(function () {
                documento_newRowAdd =
                    '<div id="documento-row" style="margin-left: 20px">'+
                        '<div class="input-group">'+
                            '<div class="col-sm-11">'+
                                '<input type="text" class="form-control" required>'+
                            '</div>'+
                            '<button class="btn btn-danger" id="documento-DeleteRow" type="button" style="margin-left: -5px">'+
                                '<i class="fas fa-trash"></i>'+
                            '</button>'+
                        '</div>'+
                    '</div>';

                $('#documento-newinput').append(documento_newRowAdd);
            });
            $("body").on("click", "#documento-DeleteRow", function () {
                $(this).parents("#documento-row").remove();
            })
        </script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <script type="text/javascript">
            $(function() {
                $('input[name="datefilter"]').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel:    'Limpiar',
                        applyLabel:     'Guardar',
                        daysOfWeek:     ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                        monthNames:     ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    }
                });

                $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                });

                $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });
        </script>
    @endsection
