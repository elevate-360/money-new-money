<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class Email extends Mailable
{
    public $data;

    public function __construct($customData)
    {
        $this->data = $customData;
    }

    public function build()
    {
        return $this->subject($this->data["subject"])
            ->view('emails.email');
    }
}
