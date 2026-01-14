<?php

namespace App\Services;


class ShippingService
{
    private $services;

    public function __construct() {
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

    public function getServiceDescription($shipping)
    {
        return $this->services[$shipping];
    }
}
