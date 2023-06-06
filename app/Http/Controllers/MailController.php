<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\MailSend;
use Illuminate\Routing\Controller as BaseController;

class MailController extends BaseController
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendEmail(){
        $details = [
            'tittle' => 'Correo de su amigo y Servido Juanca',
            'body' => 'Esto es un ejemplo, Espero que funcione'
        ];

        Mail::to("juan.medina@set.edu.mx")->send(new MailSend($details));
        return "Correo Enviado";
    }
}
