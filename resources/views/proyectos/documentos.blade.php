@extends('layouts.contentIncludes')

@section('content')
    <div class="container-fluid py-4 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between ">
                <h1 class="mb-2 colorTitle">Agregar Documentos</h1>
            </div>
        </div>
        <div class="mt-7"/>
        <form class="row needs-validation">
            <div class="row mt-2">
{{--                <label for="ubicacion" class="col-form-label">Ubicación:</label>--}}
                <div class="input-group">
                    <select class="form-select" id="ubicacion" aria-label="ubicacion" required>
                        <option selected></option>
                        <option value="1">Cd. Victoria</option>
                        <option value="2">Jaumave</option>
                    </select>
                </div>
            </div>
            <div class="row mt-4 text-center">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                </div>
            </div>

            <div class="row mt-4">
                <div>
                    <button class="btn btn-primary col-sm-12" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
