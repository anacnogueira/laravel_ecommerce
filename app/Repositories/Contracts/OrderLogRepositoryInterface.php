<?php

namespace App\Repositories\Contracts;

use App\Models\OrderLog;

interface OrderLogRepositoryInterface
{
    public function createOrderLog(array $data);
}
