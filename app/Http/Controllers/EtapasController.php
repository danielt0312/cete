<?php

namespace App\Http\Controllers;

use App\Models\CatEtapa;

class EtapasController extends Controller
{
    public function index()
    {
        $etapas = array();
        foreach (CatEtapa::all() as $index => $value) {
            $attributes = $value->getAttributes();
            $attributes['editar'] = '
                <a class="btn btn-primary btn-editar" href="#">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            ';

            $etapas[$index] = $attributes;
        }

        return(view('etapas.index', ['etapas' => $etapas]));
    }
}
