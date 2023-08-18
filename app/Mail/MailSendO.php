<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSendO extends Mailable
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
    {   //dd($this->details['asunto']);
        return $this->subject( $this->details['asunto'] )->view('ordenes.correo');
    }
}