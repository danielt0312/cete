@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Principal</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <div class="g-2 d-grid d-md-flex justify-content-around">
                <h3>Lista de Proyectos</h3>
                <a class="btn btn-secundario" href="/proyectos/grabar/0"><i class="fas fa-plus-square">&nbsp;</i>  Agregar</a>
        </div>
        <div class="container-fluid row">
            <div class="col-md-12">
                <table id="proyectos" class="table table-bordered shadow" style="width:100%">
                    <thead class="gem-tabla">
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function () {
            var data = @json($proyectos['data']);

            $('#proyectos').DataTable({
                'columnDefs' : [
                    {orderable : false, targets: [1,3,4,5,6,7,8,9,10,11,12,13]}
                ],
                scrollX: true,
                order: [0, 'asc'],
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
                    {data: 'id', title: 'ID'},
                    {data: 'opciones', title: 'Opciones'},
                    {data: 'nombre', title: 'Nombre'},
                    {data: 'descripcion', title: 'Descripición', className: 'descripcion'},
                    {data: 'responsable', title: 'Responsable'},
                    {data: 'url', title: 'URL / Dominio'},
                    {data: 'ubicacion', title: 'Ubicación'},
                    {data: 'procesos', title: 'Procesos'},
                    {data: 'informacion', title: 'Información'},
                    {data: 'disponibilidad', title: 'Disponibilidad'},
                    {data: 'periodos', title: 'Periodos'},
                    {data: 'codigo_fuente', title: 'Código fuente'},
                    {data: 'documentacion', title: 'Documentación disponible'},
                    {data: 'observaciones', title: 'Observaciones', className: 'observaciones'},
                ],
            });
        });
    </script>
@endsection
