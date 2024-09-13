<?php

namespace App\Services;

use App\Repositories\Contracts\OrderStatusRepositoryInterface;

class OrderStatusService
{
    protected $orderstatusRepository;

    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Select all orderstatusds
     * @return array
    */
    public function getAllOrderStatuses()
    {
        return $this->orderStatusRepository->getAllOrderStatuses();
    }

     /**
     * Create a new orderstatusd
     * @param array $data
     * @return object 
    */
    public function makeOrderStatus(array $data)
    {
        $orderStatus = $this->orderStatusRepository->createOrderStatus($data);        

        return $orderStatus;
    }

    /**
     * Get OrderStatusd by  ID
     * @param int $id
     * @return object
    */
    public function getOrderStatusById(int $id)
    {
        return $this->orderStatusRepository->getOrderStatusById($id);
    }

    /**
     * Update a orderstatusd
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateOrderStatus(int $id, array $data)
    {
   
        $orderStatus = $this->orderStatusRepository->getOrderStatusById($id);

        if (!$orderstatus) {
            return response()->json(['message' => 'Order Status Not Found'], 404);
        }

        $this->orderStatusRepository->updateOrderStatus($orderStatus, $data);
        return response()->json(['message' => 'Payment Method Updated'], 200);
    }

    /**
     * Delete a orderstatusd
     * @param int $id
     * @return json response
    */
    public function destroyOrderStatus(int $id)
    {
        $orderStatus = $this->orderStatusRepository->getOrderStatusById($id);

        if (!$orderStatus) {
            return response()->json(['message' => 'Order Status Not Found'], 404);
        }

        $this->orderStatusRepository->destroyOrderStatus($orderStatus);

        return response()->json(['message' => 'Order Status Deleted'], 200);
    }
}