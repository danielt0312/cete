@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Ciclo de vida {{($nombre_proyecto == null ? ': Etapas' : ': '.$nombre_proyecto)}}</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <div class="g-2 d-grid d-md-flex">
            <a class="btn btn-secundario " href="{{ route('index_proyectos') }}"><i class="fas fa-arrow-alt-circle-left">&nbsp;</i>  Regresar</a>
        </div>
        <div class="container-fluid row">
            <div class="col-md-12">
                <table id="etapas" class="table dataTable shadow" style="width:100%">
                    <thead>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        var data = @json($documentacion);
        $(document).ready(function () {

            $('#etapas').DataTable({
                columnDefs : [
                    {orderable : false, targets: [2]}
                ],
                order: [3, 'desc'],
                language: {
                    sProcessing:     "Procesando...",
                    sLengthMenu:     "Mostrar _MENU_ registros",
                    sZeroRecords:    "No se encontraron resultados",
                    sEmptyTable:     "Ningún dato disponible en esta tabla",
                    sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty:      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix:    "",
                    sSearch:         "Buscar en todos los registros:",
                    sUrl:            "",
                    sInfoThousands:  ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst:    "Primero",
                        sLast:     "Último",
                        sNext:     "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending:  ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                },
                data: data,
                columns: [
                    {data: 'id', title: '#'},
                    {data: 'nombre', title: 'Etapa'},
                    {data: 'opcion', title: 'Acciones'},
                    {data: 'fecha_subida', title: 'Fecha de subida'},
                ],
            });
        });
    </script>
@endsection
