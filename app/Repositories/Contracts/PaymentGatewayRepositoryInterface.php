<?php

namespace App\Repositories\Contracts;

use App\Models\PaymentGateway;

interface PaymentGatewayRepositoryInterface
{
    public function getAllPaymentGateways();
    public function getPaymentGatewayById($id);
    public function createPaymentGateway(array $data);
    public function updatePaymentGateway(PaymentGateway $paymentGateway, array $data);
    public function destroyPaymentGateway(PaymentGateway $paymentGateway);
}