<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend4 extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        // dd($details);
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Aprobación de solicitud - Sistema C.A.S. - C.E.T.E.')->view('mailsend4');
    }
}
