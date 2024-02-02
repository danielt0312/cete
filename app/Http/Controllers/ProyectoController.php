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
        $desarrolladores = $this->desarrolladores();

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
        $documentos = Etapa::get()->where('id_proyecto', '=', $id)->where('updated_at', "=",null)->toArray();
        foreach ($documentos as $indice => $value){
            $documentos[$indice]['nombre'] = CatEtapa::get()->where('id', '=', $value['id_cat_etapa'])->toArray()[$indice]['nombre'];
        }

        return view('proyectos.documentos', ['documentos' => $documentos]);
    }

    public function subirArchivo(Request $request)
    {
        return redirect()->route('index_proyectos')->with('sucess');

        return dump($request);
        // Validar el formulario si es necesario
        $request->validate([
            'documento' => 'required',
            'guardarArchivo' => 'required|mimes:pdf|max:2048', // Ajusta las reglas según tus necesidades
        ]);

        // Obtener el documento seleccionado
        $documento = $request->input('documento');

        // Obtener el archivo cargado
        $archivo = $request->file('guardarArchivo');

        // Definir la carpeta de destino
        $carpetaDestino = 'ruta/a/tu/carpeta';

        // Mover el archivo a la carpeta de destino con un nombre único
        $nombreArchivo = uniqid() . '_' . $archivo->getClientOriginalName();
        $archivo->move($carpetaDestino, $nombreArchivo);

        // Aquí puedes realizar otras acciones según tus necesidades, como almacenar la información en la base de datos, etc.

        // Redireccionar o devolver una respuesta, por ejemplo:
        return redirect()->back()->with('success', 'Documento subido exitosamente');
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

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->input('nombre');
        $proyecto->descripcion = $request->input('descripcion');
        $proyecto->url_dominio = $request->input('dominio');
        $proyecto->url_proyecto = $request->input('url_proyecto');
        $proyecto->url_codigo_fuente = $request->input('url_codigo_fuente');
        $proyecto->responsable = $request->input('responsable');
        $proyecto->area = $request->input('area');
        $proyecto->informacion_contenida = $request->input('informacion');
        $proyecto->disponibilidad = $request->input('disponibilidad');
        $proyecto->periodo_inicio = $fecha_inicio;
        $proyecto->periodo_final = $fecha_final;
        $proyecto->observaciones = $request->input('observaciones');
        $proyecto->save();

        $rutaDirectorioPadre = "C:\\laragon\\www\\PlantillaCasCete\\storage\\app\\documents";

        if (!is_dir($rutaDirectorioPadre)) {
            mkdir($rutaDirectorioPadre, 0777, true);
        }

        $ruta = $rutaDirectorioPadre . "\\" . $proyecto->id;

        if (!is_dir($ruta)) {
            mkdir($ruta);
        }

        if(($documentos = $request->input('documentos')) != null)
            foreach ($documentos as $nombre) {
                $documentacion = new Documentacion();
                $documentacion->id_proyecto = $proyecto->id;
                $documentacion->nombre = $nombre;
                $documentacion->save();
            }

        if(($etapas = $request->input('etapas')) != null)
            foreach ($etapas as $id_cat_etapa => $procesos) {
                $nueva_etapa = new Etapa();
                $nueva_etapa->id_proyecto = $proyecto->id;
                $nueva_etapa->id_cat_etapa = $id_cat_etapa;
                $nueva_etapa->save();

                foreach ($procesos as $proceso) {
                    $nuevo_proceso = new Proceso();
                    $nuevo_proceso->id_etapa = $nueva_etapa->id;
                    $nuevo_proceso->nombre = $proceso['nombre'];
                    $nuevo_proceso->save();

                    $nombres_desarrolladores = explode(', ', $proceso['desarrollador']);
                    foreach ($nombres_desarrolladores as $nombre) {
                        $id_desarrollador = CatDesarrollador::whereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) = ?", [$nombre])->pluck('id');
                        $nuevo_desarrollador = new Desarrollador();
                        $nuevo_desarrollador->id_cat_desarrollador = $id_desarrollador[0];
                        $nuevo_desarrollador->id_proceso = $nuevo_proceso->id;
                        $nuevo_desarrollador->save();
                    }
                }
            }

        return redirect()->route('index_proyectos')->with('sucess');
    }

    public function desarrolladores()
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
}
