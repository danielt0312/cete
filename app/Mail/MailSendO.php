<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSendO extends Mailable
{
    use Queueable, SerializesModels;

    public $details, $ruta;

    public function __construct($details,$ruta)
    {
        $this->details = $details;
        $this->ruta = $ruta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {   
        if($this->ruta != ''){
            return $this->subject( $this->details['asunto'] )->view('ordenes.correo')->attach($this->ruta);
        }else{
            return $this->subject( $this->details['asunto'] )->view('ordenes.correo');
        }
        
    }
}