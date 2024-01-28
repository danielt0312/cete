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
                    '.'&nbsp;<a class="btn btn-secondary" href="/proyectos/ciclo-vida/'.$sistema->id.'"><i class="fas fa-eye"></i></a>',
                'nombre' => $sistema->nombre,
                'descripcion' => $sistema->descripcion,
                'responsable' => $sistema->responsable,
                'url' => '<a href="#">'.$sistema->url.'</a>',
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

    public function crearEtapas() {
        // Datos que deseas escribir en el archivo CSV


        $datos = array(
            array('id', 'nombre', 'descripcion'),
            array(1, 'Sistema A', 'Descripción A'),
            array(2, 'Sistema B', 'Descripción B'),
            // Agrega más filas según sea necesario
        );

// Nombre del archivo CSV
        $nombreArchivo = '.csv';

// Ruta donde se guardará el archivo (asegúrate de tener permisos de escritura)
        $rutaArchivo = '/storage/documents/' . $nombreArchivo;

// Abre el archivo en modo escritura
        if ($archivo = fopen($rutaArchivo, 'w')) {
            // Escribe cada fila en el archivo CSV
            foreach ($datos as $fila) {
                fputcsv($archivo, $fila);
            }

            // Cierra el archivo
            fclose($archivo);

            echo "Archivo CSV creado correctamente en: $rutaArchivo";
        } else {
            echo "Error al abrir el archivo CSV para escritura.";
        }
    }
}
