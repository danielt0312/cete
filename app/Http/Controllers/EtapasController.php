<?php

namespace App\Http\Controllers;

use App\Models\CatEtapa;

class EtapasController extends Controller
{
    public function index()
    {
        return(view('etapas.index', ['etapas' => (new CatEtapa())::all()]));
    }
}
