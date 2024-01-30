<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    public function index()
    {
        $sistemas = array();
        $sistemas['data'] = (new Proyecto())::all();

        foreach ($sistemas['data'] as $indice => $sistema){
            $sistemas['data'][$indice] = array(
                'id' => $sistema->id,
                /*'opciones' =>
                    '<a class="btn btn-primary" href="/proyectos/grabar/'.$sistema->id.'"><i class="fas fa-pencil-alt"></i></a>
                    '.'&nbsp;<a class="btn btn-secundario" href="/proyectos/documentos/'.$sistema->id.'"><i class="fas fa-plus"></i></a>
                    '.'&nbsp;<a class="btn btn-secondary" href="/proyectos/ciclo-vida/'.$sistema->id.'"><i class="fas fa-eye"></i></a>',*/
                'nombre' => $sistema->nombre,
                'descripcion' => $sistema->descripcion,
                'responsable' => $sistema->responsable,
                'documentacion' => '$sistema->documentacion',
                'observaciones' => $sistema->observaciones,
                'opciones' => '
                    <div class="dropdown">
                        <a class="btn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Editar</a></li>
                            <li><a class="dropdown-item" href="#">Agregar Documentos</a></li>
                            <li><a class="dropdown-item" href="#">Ver etapas</a></li>
                        </ul>
                    </div>
                ',
            );
        }
        return(view('proyectos.index', ['proyectos' => $sistemas]));
    }

    public function show($id)
    {
        $query = (new Proyecto())::find($id);
        $responsables = [
            'id' => '0',
            'nombre' => 'database'
        ];

        return(view('proyectos.grabar', ['data' => ($query == null ? null : $query->attributesToArray()), 'responsables' => $responsables]));
    }


    public function crearEtapas() {

    }
}
