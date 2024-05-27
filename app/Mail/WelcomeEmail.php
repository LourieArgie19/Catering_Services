<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
  use Queueable, SerializesModels;

  public $fullname;

  public function __construct($fullname)
  {
    $this->fullname = $fullname;
  }

  public function build()
  {
    return $this->view('catering.WelcomeEmail')->with(['fullname' => $this->fullname]);
  }
}
