<?php

namespace App\Repositories;

use App\Repositories\Contracts\OrderLogRepositoryInterface;
use App\Models\OrderLog;

class OrderLogRepository implements OrderLogRepositoryInterface
{
    protected $entity;

    public function __construct(OrderLog $orderLog)
    {
        $this->entity = $orderLog;
    }

    /**
     * Create a new Order Log
     * @param array $data
     * @return object
     */
    public function createOrderLog(array $data)
    {
        return $this->entity->create($data);
    }
}
