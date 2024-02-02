@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Grabar etapa</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <form action="{{ route('grabar_etapa', ['id' => $data['id']]) }}" class="row mt-2" method="POST">
            @csrf
            <div class="row">
                <label for="nombre" class="col-sm-3 col-form-label">Nombre de la etapa:</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control col-sm-12" name="nombre" id="nombre" value="{{ $data['nombre'] }}" required>
                </div>
            </div>
            <div class="row mt-2">
                <label for="descripcion" class="col-form-label">Descripción:</label>
                <div class="col-sm-12">
                        <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required>{{ $data['descripcion'] }}</textarea>
                </div>
            </div>

            <div class="row mt-4">
                <div class="text-center">
                    <button class="btn btn-primary" type="submit">{{ $data['id'] == 0 ? 'Guardar' : 'Actualizar' }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
