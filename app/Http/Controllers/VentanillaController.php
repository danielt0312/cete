<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VentanillaController extends Controller
{

    public function index(){
         return view('ventanilla.index');
    }

    public function create(){
        return view('ventanilla.create');
    }

    public function store(){
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function show(){
        // return view('ordenes.index');
    }
}
