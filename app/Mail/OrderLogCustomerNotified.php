<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\OrderLog;

class OrderLogCustomerNotified extends Mailable
{
    use Queueable, SerializesModels;

     public $orderLog;

    /**
     * Create a new message instance.
     */
    public function __construct(OrderLog $orderLog)
    {
        $this->orderLog = $orderLog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $orderLog = $this->orderLog;
        $orderId = $orderLog->order_id;
        $orderStatusName = $orderLog->status->name;
        $text = null;

        if ($orderLog->client_comment === 'S') {
            $text = $orderLog->comment;
        }

        return $this->subject("[".env("APP_NAME")."] seu pedido {$orderId} está com status {$orderStatusName}")
            ->view('mails.order-logs.status-changed', compact("text","orderId", 'orderStatusName'));
    }
}
