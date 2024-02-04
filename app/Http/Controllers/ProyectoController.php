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
use Illuminate\Support\Facades\Storage;

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
                'documentacion' => 'No disponible',
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
        $desarrolladores = $this->nombresDesarrolladores();

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

    public function cicloVida($id = 0)
    {
        $etapas = Etapa::get()->where('id_proyecto', '=', $id)->toArray();
        foreach ($etapas as $indice => $value){
            $etapas[$indice]['nombres'] = CatEtapa::get()->where('id', '=', $value['id_cat_etapa'])->toArray()[$indice]['nombre'];
            $etapas[$indice]['opcion'] = '<a href="#" class="btn btn-primary">Ver Documento</a>';
        }

        return view('proyectos.ciclo-vida', ['datos' => $etapas]);
    }

    public function agregarDoc($id = 0)
    {
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
            $directorio = $archivo->store($this->crearDirectorios($documentacion['id_proyecto']));
            $documentacion->directorio = $directorio;

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
        $fecha_inicio = DateTime::createFromFormat('d/m/Y', trim($fechas[0]));
        $fecha_final = DateTime::createFromFormat('d/m/Y', trim($fechas[1]));

        $nuevo_proyecto = new Proyecto();
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
        if(($cat_etapas = CatEtapa::get() ) != null)
            foreach ($cat_etapas as $cat_etapa){
                $nueva_documentacion = new Documentacion();
                $nueva_documentacion->id_proyecto = $nuevo_proyecto->id;
                $nueva_documentacion->nombre = $cat_etapa['nombre'];
                $nueva_documentacion->save();

                $nueva_etapa = new Etapa();
                $nueva_etapa->id_proyecto = $nuevo_proyecto->id;
                $nueva_etapa->id_cat_etapa = $cat_etapa['id'];
                $nueva_etapa->id_doc = $nueva_documentacion->id;
                $nueva_etapa->save();

                if(($etapas = $request->input('etapas')) != null)
                    foreach ($etapas as $procesos)
                        foreach ($procesos as $proceso) {
                            $nuevo_proceso = new Proceso();
                            $nuevo_proceso->id_etapa = $nueva_etapa->id;
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

            }

        return redirect()->route('index_proyectos')->with('sucess');
    }

    public function nombresDesarrolladores()
    {
        $desarrolladores = array();
        foreach (CatDesarrollador::all() as $indice => $desarrollador){
            $desarrolladores[$indice] = $desarrollador['nombre'].' '.$desarrollador['apellido_paterno'].' '.$desarrollador['apellido_materno'];
        }

        return $desarrolladores;
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

    public function crearDirectorios($id = 0)
    {
        $directorio_documents = "documents";

        if (!Storage::exists($directorio_documents))
            Storage::makeDirectory($directorio_documents);

        $directorio_proyecto = $directorio_documents."/".$id;

        if (!Storage::exists($directorio_proyecto))
            Storage::makeDirectory($directorio_proyecto);

        return $directorio_proyecto;
    }
}
