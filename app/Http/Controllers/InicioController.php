<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    public function index (){ 
        return view('inicio');
    }

    public function login (){
        return view('login');
    }


    public function ordenes (){
        return view('ordenes');
    }

    public function logout(){

    }

    public function show(){
    }

    public function filtrar(){
    }
}
