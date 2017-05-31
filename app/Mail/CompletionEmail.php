<?php

namespace App\Mail;

use App\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompletionEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

 //Done
    public function build()
    {
        return $this->view('mails.completion');
    }
}
