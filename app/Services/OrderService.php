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
    public function getAllOrdersByContactId($contactId, $queryParams = null)
    {
        return $this->orderRepository->getAllOrdersByContactId($contactId, $queryParams);
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
     * Get Order by ID and ContactId
     * @param int $id
     * @return object
    */
    public function getOrderByIdAndContactId(int $id, int $contactId)
    {
        return $this->orderRepository->getOrderByIdAndContactId($id, $contactId);
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
     * Update tracking code shipping
     * @return float
    */
    public function updateTrackingCodeOrder(int $id, array $data)
    {
        $order = $this->orderRepository->getOrderById($id);

        if (!$order) {
            return response()->json(['message' => 'Order Not Found'], 404);
        }

        $this->orderRepository->updateOrder($order, $data);
        return response()->json(['message' => 'Module Updated'], 200);
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

        $order->orderItems()->delete();
        $order->orderLogs()->delete();

        $this->orderRepository->destroyOrder($order);

        return response()->json(['message' => 'Order Deleted'], 200);
    }
}
