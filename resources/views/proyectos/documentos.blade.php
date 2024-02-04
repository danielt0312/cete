@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Agregar Documentos</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <form class="row needs-validation" id="form" enctype="multipart/form-data" method="POST" action="{{ route('subir-archivo')}}">
            @csrf
            <div class="row mt-2">
                <label for="idDocumento" class="col-form-label">Seleccione un documento</label>
                <div class="input-group">
                    <select class="form-select" id="idDocumento" name="idDocumento" aria-label="idDocumento" required>
                        @foreach($documentacion as $documento)
                            <option value="{{$documento['id']}}">{{$documento['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-4 text-center">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="archivo" id="archivo"  accept="application/pdf" required>
                </div>
            </div>
            <div class="row mt-4">
                <div>
                    <button class="btn btn-primary col-sm-12" id="btnGuardar" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
