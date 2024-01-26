<?php

namespace App\Http\Controllers;

class DocumentosController extends Controller
{
    public function index($id)
    {

        return(view('proyectos.documentos', ['id' => $id]));
    }
}
