<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $method;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $method)
    {
        $this->email = $email;
        $this->method = $method;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $method = $this->method;
        $email = $this->email;

        return $this->subject("[".env("APP_NAME")."] Cliente cadastrado com sucesso")
        ->view('mails.customers.registered', compact("method", "email"));
    }
}
