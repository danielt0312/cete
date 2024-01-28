@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Ciclo de vida</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <div class="container-fluid row">
            <table id="etapas" class="table shadow dataTable" style="width:100%">
                <thead class="">
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function () {
            {{--var data = @json($proyectos['data']);--}}
                var data;

            $('#etapas').DataTable({
                columnDefs : [
                    {orderable : false, targets: [1]}
                ],
                order: [3, 'asc'],
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
                    {data: '', title: '#'},
                    {data: '', title: 'Etapa'},
                    {data: '', title: 'Opción'},
                    {data: '', title: 'Fecha'},
                ],
            });
        });
    </script>
@endsection
