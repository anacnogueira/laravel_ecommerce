<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductNotificationRepositoryInterface;
use App\Models\ProductNotification;

class ProductNotificationRepository implements ProductNotificationRepositoryInterface
{
    protected $entity;

    public function __construct(ProductNotification $productNotification)
    {
        $this->entity = $productNotification;
    }

    /**
     * Create a new Product Notification
     * @param array $data
     * @return object
     */
    public function createNotification(array $data)
    {
        return $this->entity->create($data);
    }
}
