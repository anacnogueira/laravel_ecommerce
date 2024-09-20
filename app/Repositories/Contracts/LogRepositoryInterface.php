<?php

namespace App\Repositories\Contracts;

use App\Models\SystemLog;

interface LogRepositoryInterface
{
    public function getAllLogs();
    public function get24HoursLogs();
    public function getLogById($id);

}