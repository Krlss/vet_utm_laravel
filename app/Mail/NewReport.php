<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewReport extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;

    public function __construct($detail)
    {
        $this->detail = $detail;
    } 

    public function build()
    {
       return $this->subject('Hay un nuevo reporte')->view('emails.newReport');
    }
}
