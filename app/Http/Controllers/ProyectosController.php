<?php

namespace App\Http\Controllers;

use App\Models\CatEtapas;
use App\Models\Sistemas;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public function index()
    {
        $sistemas = array();
        $sistemas['data'] = DB::table('sistemas')->get();

        foreach ($sistemas['data'] as $indice => $sistema){
            $sistemas['data'][$indice] = array(
                'id' => $sistema->id,
                'opciones' =>
                    '<a class="btn btn-primary" href="/proyectos/grabar/'.$sistema->id.'"><i class="fas fa-pencil-alt"></i></a>
                    '.'&nbsp;<a class="btn btn-secundario" href="/proyectos/documentos/'.$sistema->id.'"><i class="fas fa-plus"></i></a>
                    '.'&nbsp;<a class="btn btn-secondary" href="#"><i class="fas fa-eye"></i></a>',
                'nombre' => $sistema->nombre,
                'descripcion' => $sistema->descripcion,
                'responsable' => $sistema->responsable,
                'url' => $sistema->url,
                'ubicacion' => $sistema->ubicacion,
                'procesos' => $sistema->procesos,
                'informacion' => $sistema->informacion,
                'disponibilidad' => $sistema->disponibilidad,
                'periodos' => $sistema->periodos,
                'codigo_fuente' => $sistema->codigo_fuente,
                'documentacion' => $sistema->documentacion,
                'observaciones' => $sistema->observaciones,
            );
        }
        return(view('proyectos.index', ['proyectos' => $sistemas]));
    }

    public function show($id)
    {
        $query = (new Sistemas())->find($id);
        $responsables = [
            'id' => '0',
            'nombre' => 'database'
        ];

        return(view('proyectos.grabar', ['data' => ($query == null ? null : $query->attributesToArray()), 'responsables' => $responsables]));
    }
}
