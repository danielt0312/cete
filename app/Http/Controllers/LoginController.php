<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index (){ 
        
    }

    public function login (Request $request){
        // dd($request);

        return view('inicio');
    }

    public function logout(){

    }

    public function show(){
    }
}
