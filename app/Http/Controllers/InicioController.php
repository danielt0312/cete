<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function index (){ 
        return view('inicio');
        // return view('inicio');
    }

}
