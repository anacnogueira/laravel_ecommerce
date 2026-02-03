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
    public function getAllOrdersByContactId($contactId, $queryParams = null)
    {
        $orders = $this->entity->where('contact_id', $contactId);
        //Filters
        if ($queryParams['filter']) {
            switch ($queryParams['filter']) {
                case "ultimos":
                    $orders = $orders->latest()->take(5);
                    $queryParams['paginate'] = null;
                    break;
            }
        }

        if (isset($queryParams["conditions"])) {
            foreach ($queryParams["conditions"] as $condition) {
                if ($condition["operator"]!= "between") {
                    $orders = $orders->where($condition["column"], $condition["operator"], $condition["value"]);
                } else {
                    $orders = $orders->whereBetween($condition["column"], $condition["value"]);
                }

            }
        }

        if ($queryParams['sort'] && $queryParams['direction']) {
            $orders = $orders->orderBy($queryParams['sort'], $queryParams['direction']);
        }
        $orders = !empty($queryParams['paginate']) ? $orders->paginate($queryParams['paginate']) : $orders->get();

        return $orders;
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
     * Select Order by ID and contactId
     * @param int $id
     * @return object
     */
    public function getOrderByIdAndContactId($id, $contactId)
    {
         return $this->entity
            ->where('id', $id)
            ->where('contact_id', $contactId)
            ->first();
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
     * Update data of order
     * @param object $order
     * @param array $data
     * @return object
     */
    public function updateOrder(Order $order, array $data)
    {
        return $order->update($data);
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
