<?php

namespace App\Repositories\Contracts;

use App\Models\PaymentMethod;

interface PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethods();
    public function getPaymentMethodById($id);
    public function createPaymentMethod(array $data);
    public function updatePaymentMethod(PaymentMethod $paymentMethod, array $data);
    public function destroyPaymentMethod(PaymentMethod $paymentMethod);
}