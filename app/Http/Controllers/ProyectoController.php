<?php

namespace App\Http\Controllers;

use App\Models\CatDesarrollador;
use App\Models\CatEtapa;
use App\Models\Desarrollador;
use App\Models\Documentacion;
use App\Models\Etapa;
use App\Models\Proceso;
use App\Models\Proyecto;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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
                'documentacion' => $this->obtenerDocumentacion($sistema->id),
                'observaciones' => $sistema->observaciones,
                'opciones' => '
                    <div class="dropdown">
                        <a class="btn" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="'.route('grabar_proyecto', ['id' => $sistema->id]).'">Editar</a></li>
                            <li><a class="dropdown-item" href="'.route('agregar-documento', ['id' => $sistema->id]).'">Agregar documentos</a></li>
                            <li><a class="dropdown-item" href="'.route('ciclo_vida', ['id' => $sistema->id]).'">Ciclo de Vida</a></li>
                            <li><a class="dropdown-item" href="'.route('detalles', ['id' => $sistema->id]).'">Más detalles</a></li>
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
        $data['id'] = $id;
        $etapas = $this->obtenerEtapas($id);
        $documentacion = $this->obtenerDocumentacion($id);
        $desarrolladores = $this->desarrolladoresDisponibles();

        return(view('proyectos.grabar', [
            'data' => $data,
            'etapas' => $etapas,
            'documentacion' => $documentacion,
            'desarrolladores' => $desarrolladores
        ]));
    }

    public function store()
    {
        return($this->grabar(request()));
    }

    public function detalles($id = 0)
    {
        $this->obtenerTotalDocumentacion($id);

        return view('proyectos.detalles', [
            'proyecto' => $this->obtenerSistema($id)->toArray(),
            'etapas' => $this->obtenerEtapas($id),
            'procesos' => $this->obtenerProcesos($id),
            'documentaciones' => $this->obtenerTotalDocumentacion($id)
        ]);
    }

    public function cicloVida($id = 0)
    {
        if($id == 0)
            return $this->index();

        $documentacion = Documentacion::select(['id_cat_etapa', 'nombre', 'directorio', 'fecha_subida'])
            ->join('etapas', 'etapas.id_doc', '=', 'documentaciones.id')
            ->where('etapas.id_proyecto', '=', $id)
            ->get();

        $documentacion_tmp = array();
        if($documentacion->count() > 0) {
            foreach ($documentacion as $indice => $documento) {
                $documentacion_tmp[$indice]['id'] = $documento['id_cat_etapa'];
                $documentacion_tmp[$indice]['nombre'] = $documento['nombre'];
                $documentacion_tmp[$indice]['fecha_subida'] = ($documento['fecha_subida'] == null ? null : $documento['fecha_subida']->format('m/d/Y H:i:s'));
                $documentacion_tmp[$indice]['opcion'] = '
                    <a href="'.($documento['directorio'] == null ? '#' : asset("storage/{$documento['directorio']}")).'"
                        target="_blank" class="btn '.($documento['directorio'] == null ? 'btn-secundary disabled' : ' btn-primary').'">Ver documento</a>';
            }
        }


        return view('proyectos.ciclo-vida', ['documentacion' => $documentacion_tmp, 'nombre_proyecto' => Proyecto::find($id)->pluck('nombre')[0]]);
    }

    public function agregarDoc($id = 0)
    {
        if($id == 0)
            return $this->index();

        $documentacion = Documentacion::get()->where('id_proyecto', '=', $id)->where('fecha_subida', '=', null)->toArray();

        return view('proyectos.documentos', ['documentacion' => $documentacion]);
    }

    public function subirArchivo(Request $request)
    {
        $request->validate([
            'idDocumento' => 'required',
        ]);

        if(($documentacion = Documentacion::find($request->input('idDocumento'))) != null) {
            $archivo = $request->file('archivo');
            $directorio = $archivo->store("public/documents/".$documentacion['id_proyecto']);

            $directorioRelativo = str_replace('public/', '', $directorio);
            $documentacion->directorio = $directorioRelativo;

            date_default_timezone_set('America/Monterrey');
            $fecha = now();
            $documentacion->fecha_subida = $fecha->format('Y-m-d H:i:s');
            $documentacion->save();
        }

        return redirect()->route('index_proyectos');
    }

    public function grabar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:300',
            'dominio' => 'required|string|max:150',
            'url_proyecto' => 'required|string|max:150',
            'url_codigo_fuente' => 'required|string|max:150',
            'responsable' => 'required|string|max:100',
            'area' => 'required|string|max:100',
            'informacion' => 'required|string|max:200',
            'disponibilidad' => 'required|string|max:200',
            'datefilter' => 'required|string|max:24',
        ]);

        $fechas = explode('-', $request->input('datefilter'));
        $fecha_inicio = DateTime::createFromFormat('m/d/Y', trim($fechas[0]));
        $fecha_final = DateTime::createFromFormat('m/d/Y', trim($fechas[1]));

        $query = Proyecto::find($request['id']);
        $nuevo_proyecto = $query == null ?  new Proyecto() : $query;
        $nuevo_proyecto->nombre = $request->input('nombre');
        $nuevo_proyecto->descripcion = $request->input('descripcion');
        $nuevo_proyecto->url_dominio = $request->input('dominio');
        $nuevo_proyecto->url_proyecto = $request->input('url_proyecto');
        $nuevo_proyecto->url_codigo_fuente = $request->input('url_codigo_fuente');
        $nuevo_proyecto->responsable = $request->input('responsable');
        $nuevo_proyecto->area = $request->input('area');
        $nuevo_proyecto->informacion_contenida = $request->input('informacion');
        $nuevo_proyecto->disponibilidad = $request->input('disponibilidad');
        $nuevo_proyecto->periodo_inicio = $fecha_inicio;
        $nuevo_proyecto->periodo_final = $fecha_final;
        $nuevo_proyecto->observaciones = $request->input('observaciones');
        $nuevo_proyecto->save();

        $this->crearDirectorios($nuevo_proyecto->id);

        // Creación de documentación por entrada
        if(($documentos = $request->input('documentos')) != null)
            foreach ($documentos as $nombre) {
                $nueva_documentacion = new Documentacion();
                $nueva_documentacion->id_proyecto = $nuevo_proyecto->id;
                $nueva_documentacion->nombre = $nombre;
                $nueva_documentacion->save();
            }

        // Creación de documentación por defecto para el ciclo de vida del sistema informático
        if(($cat_etapas = CatEtapa::get() ) != null && $query == null)
            foreach ($cat_etapas as $cat_etapa) {
                $nueva_documentacion = new Documentacion();
                $nueva_documentacion->id_proyecto = $nuevo_proyecto->id;
                $nueva_documentacion->nombre = $cat_etapa['nombre'];
                $nueva_documentacion->save();

                $nueva_etapa = new Etapa();
                $nueva_etapa->id_proyecto = $nuevo_proyecto->id;
                $nueva_etapa->id_cat_etapa = $cat_etapa['id'];
                $nueva_etapa->id_doc = $nueva_documentacion->id;
                $nueva_etapa->save();
            }

        if(($etapas = $request->input('etapas')) != null)
            foreach ($etapas as $indice => $procesos)
                foreach ($procesos as $proceso) {
                    $nuevo_proceso = new Proceso();
                    $id_etapa = Etapa::where('id_proyecto', '=', $nuevo_proyecto->id)->where('id_cat_etapa', '=', $indice)->get()->pluck('id');
                    $nuevo_proceso->id_etapa = $id_etapa[0];
                    $nuevo_proceso->nombre = $proceso['nombre'] == null ? 'Nombre no disponible' : $proceso['nombre'];
                    $nuevo_proceso->save();

                    // Precaución para proceso sin desarrollador(es)
                    if ($proceso['desarrolladores'] != null) {
                        $nombres_desarrolladores = explode(', ', $proceso['desarrolladores']);
                        foreach ($nombres_desarrolladores as $nombres) {
                            $id_desarrollador = CatDesarrollador::whereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) = ?", [$nombres])->pluck('id');
                            $nuevo_desarrollador = new Desarrollador();
                            $nuevo_desarrollador->id_cat_desarrollador = $id_desarrollador[0]; // Suponiendo que el nombre completo del empleado es único
                            $nuevo_desarrollador->id_proceso = $nuevo_proceso->id;
                            $nuevo_desarrollador->save();
                        }
                    }

                }


        return redirect()->route('index_proyectos')->with('sucess');
    }

    public function desarrolladoresDisponibles()
    {
        $desarrolladores = array();
        foreach (CatDesarrollador::all() as $indice => $desarrollador){
            $desarrolladores[$indice] = $desarrollador['nombre'].' '.$desarrollador['apellido_paterno'].' '.$desarrollador['apellido_materno'];
        }

        return $desarrolladores;
    }

    public function obtenerDocumentacion($id = 0)
    {
        $documentacion = Documentacion::select(['documentaciones.nombre', 'documentaciones.directorio'])
            ->leftJoin('etapas', 'documentaciones.id', '=', 'etapas.id_doc')
            ->where('documentaciones.id_proyecto', '=', $id)
            ->whereNull('etapas.id_proyecto')
            ->where('directorio', '!=', null)
            ->get();

        if($documentacion->count() > 0) {
            $documentacion_tmp = '<ul class="list-group">';

            foreach ($documentacion as $documento){
                $documentacion_tmp .= '
                    <li><a class="" href="'.asset("storage/{$documento['directorio']}").'" target="_blank">'.$documento['nombre'] . '</a></li>
                ';
            }

            return $documentacion_tmp . '</ul>';
        } else
            return 'No disponible';
    }

    public function obtenerSistema($id = 0)
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
                'periodo_critico' => '',
                'observaciones' => '',
            );
        else {
            $data['periodo_critico'] = $data['periodo_inicio']->format('m/d/Y'). ' - '. $data['periodo_final']->format('m/d/Y');
        }

        return $data;
    }

    public function obtenerEtapas($id = 0)
    {
        $cat_etapas = CatEtapa::select(['cat_etapas.id', 'cat_etapas.nombre'])
            ->join('etapas', 'etapas.id_cat_etapa', '=', 'cat_etapas.id')
            ->where('etapas.id_proyecto', '=', $id)
            ->get();

        if($cat_etapas->count() == 0)
            $cat_etapas = CatEtapa::get();

        return $cat_etapas;
    }

    public function obtenerProcesos($id = 0)
    {
        $procesos = array();
        $etapas = Etapa::select(['etapas.id_cat_etapa', 'procesos.id', 'procesos.nombre'])
            ->join('procesos', 'procesos.id_etapa', '=', 'etapas.id')
            ->where('etapas.id_proyecto', '=', $id)
            ->get();

        foreach ($etapas->toArray() as $index => $etapa) {
            $procesos[$etapa['id_cat_etapa']][$index] = $etapa;
            $procesos[$etapa['id_cat_etapa']][$index]['desarrolladores'] = $this->obtenerDesarrolladores($etapa['id']);
        }

        return $procesos;
    }

    public function obtenerDesarrolladores($id_proceso)
    {
        $desarrolladores = array();
        foreach (
            Desarrollador::select(Desarrollador::raw('CONCAT(nombre, " ", apellido_paterno, " ", apellido_materno) AS nombre_completo'))
                ->join('cat_desarrolladores', 'cat_desarrolladores.id', '=', 'desarrolladores.id_cat_desarrollador')
                ->where('id_proceso', '=', $id_proceso)
                ->get()
            as $index => $desarrollador) {
            $desarrolladores[$index] = $desarrollador['nombre_completo'];
        }

        return implode(', ', $desarrolladores);
    }

    public function obtenerTotalDocumentacion($id)
    {
        $total_documentacion = array();
        $documentaciones = Documentacion::where('id_proyecto', '=', $id);
        foreach ($documentaciones->get()->sortBy('fecha_subida') as $indice => $documentacion) {
            $tmpDoc = $documentacion->getAttributes();
            if($tmpDoc['fecha_subida'] == null) {
                $total_documentacion['no_disponible'][$indice] = $tmpDoc;
                continue;
            }

            $total_documentacion['disponible'][$indice] = $tmpDoc;
            $fechaSubida = new DateTime($tmpDoc['fecha_subida']);
            $total_documentacion['disponible'][$indice]['fecha_subida'] = $fechaSubida->format('m/d/Y H:i:s');
        }

        return $total_documentacion;
    }


    public function crearDirectorios($id = 0)
    {
        $directorio_documents = storage_path('app\public\documents');

        if (!File::exists($directorio_documents))
            File::makeDirectory($directorio_documents, 0777, true, true);

        $directorio_proyecto = $directorio_documents.'\\'.$id;

        if (!File::exists($directorio_proyecto))
            File::makeDirectory($directorio_proyecto);

        return $directorio_proyecto;
    }
}
