<?php

namespace App\Mail;

use App\Models\Mails;
use Illuminate\Mail\Mailable;

class LoginSuccess extends Mailable
{
    public $data;
    public $fromEmail = "no-reply@elevate360.in";
    public $fromName = "Support Team | Elevate360";

    public function __construct($customData)
    {
        $this->data = $customData;
    }

    public function build()
    {
        $insertData = array(
            "mailToEmail" => $this->data["to"],
            "mailToName" => $this->data["name"],
            "mailSubject" => "Login Attempted - Money App",
            "mailContent" => $this->data["message"]
        );
        Mails::insert($insertData);
        return $this->from($this->fromEmail, $this->fromName)->subject('Login Attempted - Money App')
            ->view('emails.login');
    }
}
