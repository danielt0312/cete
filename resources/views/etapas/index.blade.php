@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Catálogo de etapas</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <div class="container-fluid row">
            <div class="col-md-12">
                <table id="proyectos" class="table table-striped shadow">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($etapas as $etapa)
                            <tr>
                                <th scope="row">{{$etapa->id}}</th>
                                <td>{{$etapa->nombre}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
