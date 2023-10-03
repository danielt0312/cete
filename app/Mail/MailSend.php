<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $pfolio_config;

    public function __construct($details,$pfolio_config)
    {
        // dd($pfolio_config);
        $this->details = $details;
        $this->pfolio_config = $pfolio_config;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registro exitoso de solicitud - Sistema C.A.S. - C.E.T.E.')->view('mailsend')->attach(public_path('pdfSolicitud/').'Solicitud_'.$this->pfolio_config.'.pdf');
        //return $this->subject('Registro exitoso de solicitud - Sistema C.A.S. - C.E.T.E.')->view('mailsend');
    }
}
