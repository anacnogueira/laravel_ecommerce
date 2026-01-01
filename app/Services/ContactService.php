<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSent;

class ContactService
{

    /**
     * Send Contact Form to email
     * @param array $data
     * @return void
    */
    public function sendEmail(array $data)
    {

       Mail::to("anacnogueira@gmail.com")
        ->send(new ContactSent($data));
    }
}
