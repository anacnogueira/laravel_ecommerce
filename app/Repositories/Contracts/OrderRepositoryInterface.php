<?php

namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getAllOrdersByContactId($contactId);
    public function getAllOrders();
    public function getOrderById($id);
    public function getTotalSalesAmount();
    public function destroyOrder(Order $order);

}
