<?php

namespace App\Repositories;

use App\Repositories\Contracts\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    protected $entity;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->entity = $paymentMethod;
    }

    /**
     * Get all Payment Methods
     * @return array
     */
    public function getAllPaymentMethods()
    {
        return $this->entity->all();
    }

    /**
     * Select Payment Method by ID
     * @param int $id
     * @return object
     */
    public function getPaymentMethodById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Payment Method
     * @param array $data
     * @return object
     */
    public function createPaymentMethod(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Payment Method
     * @param object $payment Method
     * @param array $data
     * @return object
     */
    public function updatePaymentMethod(PaymentMethod $paymentMethod, array $data)
    {
        return $paymentMethod->update($data);
    }

    /**
     * Delete a Payment Method
     * @param object $paymentmethod
     */
    public function destroyPaymentMethod(PaymentMethod $paymentMethod) 
    {
        return $paymentMethod->delete();
    }
}