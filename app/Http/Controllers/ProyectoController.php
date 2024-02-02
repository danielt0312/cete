<?php

namespace App\Http\Controllers;

use App\Models\CatEtapa;
use App\Models\Documentacion;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    public function index()
    {
        $sistemas = array();
        $sistemas['data'] = Proyecto::all();

        foreach ($sistemas['data'] as $indice => $sistema){
            $sistemas['data'][$indice] = array(
                'id' => $sistema->id,
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
                            <li><a class="dropdown-item" href="/proyectos/grabar/'.$sistema->id.'">Editar</a></li>
                            <li><a class="dropdown-item" href="/proyectos/documentos/'.$sistema->id.'">Agregar Documentos</a></li>
                            <li><a class="dropdown-item" href="/proyectos/ciclo-vida/'.$sistema->id.'">Ver etapas</a></li>
                        </ul>
                    </div>
                ',
            );
        }
        return(view('proyectos.index', ['proyectos' => $sistemas]));
    }

    public function show($id = 0)
    {
        $data = $this->obtenerSistema($id);
        $etapas = CatEtapa::all();
        $documentacion = $this->documentacionDisponible($id);

        return(view('proyectos.grabar', [
            'data' => $data,
            'etapas' => $etapas,
            'documentacion' => $documentacion,
        ]));
    }

    public function store()
    {
        $this->grabar(request());
    }

    public function grabar(Request $request)
    {
        dump($request);
    }

    public function documentacionDisponible($id)
    {
        $documentacion = Documentacion::find($id);
        if($documentacion == null)
            $documentacion = array(
                'nombre' => '',
                'directorio' => '',
            );
        return $documentacion;
    }

    public function obtenerSistema($id)
    {
        $data = Proyecto::find($id);
        if($data == null)
            $data = array(
                'id' => '',
                'nombre' => '',
                'descripcion' => '',
                'url_dominio' => '',
                'url_proyecto' => '',
                'url_codigo_fuente' => '',
                'responsable' => '',
                'area' => '',
                'informacion_contenida' => '',
                'disponibilidad' => '',
                'periodo_inicio' => '',
                'periodo_final' => '',
                'observaciones' => '',
            );
        return $data;
    }
}
