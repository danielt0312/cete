<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SolicitudesController extends Controller
{

    function __construct()
    {
        Cache::flush();
        setPermissionsTeamId(3);
    }

    public function index2(){

        return view('solicitudes.index');
    }

}
