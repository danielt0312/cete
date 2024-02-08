<?php

namespace App\Http\Controllers;

use App\Models\CatEtapa;
use Illuminate\Http\Request;

class EtapasController extends Controller
{
    public function index()
    {
        $etapas = array();
        foreach (CatEtapa::all() as $index => $value) {
            $attributes = $value->getAttributes();
            $attributes['editar'] = '
                <div class="dropdown">
                    <a class="btn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                          <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                        </svg>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="'.route('agregar_etapa', ['id' => $attributes['id']]).'">Editar</a></li>
                        <li><a class="dropdown-item" href="'.route('eliminar_etapa', ['id' => $attributes['id']]).'">Eliminar</a></li>
                    </ul>
                </div>
            ';

            $etapas[$index] = $attributes;
        }

        return(view('etapas.index', ['etapas' => $etapas]));
    }

    public function delete()
    {
        $etapa = CatEtapa::find(request('id'));

        if ($etapa) {
            $etapa->delete();

            return redirect()->route('index_etapas')->with('success');
        } else {
            return redirect()->route('index_etapas')->with('error');
        }
    }

    public function store()
    {
        return($this->grabar(request()));
    }

    public function grabar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:300',
        ]);

        $query = CatEtapa::find($request['id']);
        $etapa = $query == null ? new CatEtapa() : $query;
        $etapa->nombre = $request->input('nombre');
        $etapa->descripcion = $request->input('descripcion');

        $etapa->save();

        return redirect()->route('index_etapas');
    }

    public function show($id = 0)
    {
        $data = $this->buscarEtapa($id);

        return(view('etapas.grabar', [
            'data' => $data
        ]));
    }

    public function buscarEtapa($id)
    {
        $data = CatEtapa::find($id);
        if($data == null)
            $data = array(
                'id' => 0,
                'nombre' => '',
                'descripcion' => '',
            );
        return $data;
    }
}
