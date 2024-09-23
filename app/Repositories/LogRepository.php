<?php

namespace App\Repositories;

use App\Repositories\Contracts\LogRepositoryInterface;
use App\Models\SystemLog;

class LogRepository implements LogRepositoryInterface
{
    protected $entity;

    public function __construct(SystemLog $systemLog)
    {
        $this->entity = $systemLog;
    }

    /**
     * Get all Logs
     * @return array
     */
    public function getAllLogs()
    {
        return $this->entity->all();
    }

    /**
     * Get all Logs
     * @return array
     */
    public function get24HoursLogs()
    {
        return $this->entity->last24Hours()->get();
    }

    /**
     * Select Log by ID
     * @param int $id
     * @return object
     */
    public function getLogById($id)
    {
        return $this->entity->find($id);
    }

    
}