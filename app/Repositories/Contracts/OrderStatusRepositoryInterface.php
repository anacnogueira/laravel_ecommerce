<?php

namespace App\Repositories\Contracts;

use App\Models\OrderStatus;

interface OrderStatusRepositoryInterface
{
    public function getAllOrderStatuses();
    public function getOrderStatusById($id);
    public function createOrderStatus(array $data);
    public function updateOrderStatus(OrderStatus $orderStatus, array $data);
    public function destroyOrderStatus(OrderStatus $orderStatus);
}