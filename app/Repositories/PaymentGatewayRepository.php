<?php

namespace App\Repositories;

use App\Repositories\Contracts\PaymentGatewayRepositoryInterface;
use App\Models\PaymentGateway;

class PaymentGatewayRepository implements PaymentGatewayRepositoryInterface
{
    protected $entity;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->entity = $paymentGateway;
    }

    /**
     * Get all PaymentGateways
     * @return array
     */
    public function getAllPaymentGateways()
    {
        return $this->entity->all();
    }

    /**
     * Get all PaymentGateways
     * @return array
     */
    public function getActivePaymentGateways()
    {
        return $this->entity->show();
    }

    /**
     * Select PaymentGateway by ID
     * @param int $id
     * @return object
     */
    public function getPaymentGatewayById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new paymentgateway
     * @param array $data
     * @return object
     */
    public function createPaymentGateway(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of paymentgateway
     * @param object $paymentGateway
     * @param array $data
     * @return object
     */
    public function updatePaymentGateway(PaymentGateway $paymentGateway, array $data)
    {
        return $paymentGateway->update($data);
    }

    /**
     * Delete a paymentgateway
     * @param object $paymentGateway
     */
    public function destroyPaymentGateway(PaymentGateway $paymentGateway) 
    {
        return $paymentGateway->delete();
    }
}