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
                <a class="btn btn-primary btn-editar" href="/etapas/grabar/'.$attributes['id'].'">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            ';

            $etapas[$index] = $attributes;
        }

        return(view('etapas.index', ['etapas' => $etapas]));
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
