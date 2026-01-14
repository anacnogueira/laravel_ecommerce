<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Select all Orders
     * @return array
    */
    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    /**
     * Select all Orders By Contact ID
     * @return array
    */
    public function getAllOrdersByContactId($contactId)
    {
        return $this->orderRepository->getAllOrdersByContactId($contactId);
    }

     /**
     * Get Order by  ID
     * @param int $id
     * @return object
    */
    public function getOrderById(int $id)
    {
        return $this->orderRepository->getOrderById($id);
    }

    /**
     * Get total sales amount
     * @return float
    */
    public function getTotalSalesAmount()
    {
        return $this->orderRepository->getTotalSalesAmount();
    }

     /**
     * Delete a order
     * @param int $id
     * @return json response
    */
    public function destroyOrder(int $id)
    {
        $order = $this->orderRepository->getOrderById($id);

        if (!$order) {
            return response()->json(['message' => 'Order Not Found'], 404);
        }

        $this->orderRepository->destroyOrder($order);

        return response()->json(['message' => 'Order Deleted'], 200);
    }
}
