<?php

namespace App\Http\Controllers;

use App\Models\CatEtapas;

class EtapasController extends Controller
{
    public function index()
    {
        return(view('etapas.index', ['etapas' => (new CatEtapas())::all()]));
    }
}
