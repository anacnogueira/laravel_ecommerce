<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderPaymentDone extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $paymentMethod;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, $paymentMethod)
    {
        $this->order = $order;
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("[".env("APP_NAME")."] Novo pedido Nº {$this->order->id} pago com {$this->paymentMethod}")
        ->view('emails.notificationOrderPayment');
    }
}
