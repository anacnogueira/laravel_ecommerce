<?php

namespace App\Repositories\Contracts;

use App\Models\ProductNotification;

interface ProductNotificationRepositoryInterface
{
    public function createNotification(array $data);
}
