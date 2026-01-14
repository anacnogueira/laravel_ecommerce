<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }


    /**
     * Get all Orders
     * @return array
     */
    public function getAllOrders()
    {
        return $this->entity->all();
    }

    /**
     * Get all Orders by Contact ID
     * @return array
     */
    public function getAllOrdersByContactId($contactId)
    {
        return $this->entity->where('contact_id', $contactId)->get();
    }


    /**
     * Select Order by ID
     * @param int $id
     * @return object
     */
    public function getOrderById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Get total sales amount
     * @return float
     */
    public function getTotalSalesAmount()
    {
        return $this->entity->sum('value');
    }

    /**
     * Delete a order
     * @param object $order
     */
    public function destroyOrder(Order $order)
    {
        return $order->delete();
    }
}
