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
     * Get all Order Status
     * @return array
     */
    public function getAllOrderStatuses()
    {
        return $this->entity->all();
    }

    /**
     * Select Order Status by ID
     * @param int $id
     * @return object
     */
    public function getOrderStatusById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new Order Status
     * @param array $data
     * @return object
     */
    public function createOrderStatus(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of Order Status
     * @param object $orderStatus
     * @param array $data
     * @return object
     */
    public function updateOrderStatus(OrderStatus $orderStatus, array $data)
    {
        return $orderStatus->update($data);
    }

    /**
     * Delete a Order Status
     * @param object $orderstatus
     */
    public function destroyOrderStatus(OrderStatus $orderStatus)
    {
        return $orderStatus->delete();
    }
}
