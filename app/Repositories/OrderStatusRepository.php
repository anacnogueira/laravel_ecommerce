<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrderStatusRepositoryInterface;
use App\Models\OrderStatus;

class OrderStatusRepository implements OrderStatusRepositoryInterface
{
    protected $entity;

    public function __construct(OrderStatus $orderStatus)
    {
        $this->entity = $orderStatus;
    }

    /**
     * Get all Payment Methods
     * @return array
     */
    public function getAllOrderStatuses()
    {
        return $this->entity->all();
    }

    /**
     * Select Payment Method by ID
     * @param int $id
     * @return object
     */
    public function getOrderStatusById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Payment Method
     * @param array $data
     * @return object
     */
    public function createOrderStatus(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Payment Method
     * @param object $payment Method
     * @param array $data
     * @return object
     */
    public function updateOrderStatus(OrderStatus $orderStatus, array $data)
    {
        return $orderStatus->update($data);
    }

    /**
     * Delete a Payment Method
     * @param object $orderstatus
     */
    public function destroyOrderStatus(OrderStatus $orderStatus) 
    {
        return $orderStatus->delete();
    }
}