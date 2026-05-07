<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Services\ShippingService;
use App\Models\Order;
use App\Providers\AppServiceProvider;

class OrderDone extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $services;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->services = [
           'pac' =>  'Correios PAC',
           'sedex' => 'Correios Sedex',
           'loja' => 'Retirada na loja|Pque Santo Antonio|',
           'motoboy' => 'Motoboy',
           'jadlog' => 'Jadlog',
           'Sequoia SFX' => 'Sequoia SFX',
           'Total Express' => 'Total Express',
        ];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $orderId = $order->id;

        $shipping = $this->services[$this->order->type_shipping];

        if($this->order->type_shipping == 'loja') {
            $this->order->address->address = env('SELLER_ADDRESS');
            $this->order->address->number = env('SELLER_NUMBER');
            $this->order->address->complement = '';
            $this->order->address->neighborhood = env('SELLER_NEIGHBORHOOD');
            $this->order->address->cep = env('SELLER_CEP');
            $this->order->address->city->name = env('SELLER_CITY');
            $this->order->address->state->uf = env('SELLER_UF');
            $this->order->address->country->name = env('SELLER_COUNTRY');
            $this->order->address->phone = env('SELLER_PHONE');
        }

        return $this->subject("[".env("APP_NAME")."] Confirmação de pedido {$orderId}")
            ->view('mails.orders.done', compact("order",'shipping'));
    }
}
