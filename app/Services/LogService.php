<?php

namespace App\Services;

use App\Repositories\Contracts\LogRepositoryInterface;

class LogService
{
    protected $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * Select all logs
     * @return array
    */
    public function getAllLogs()
    {
        return $this->logRepository->getAllLogs();
    }

    public function get24HoursLogs()
    {
        return $this->logRepository->get24HoursLogs();
    }


    /**
     * Get Log by  ID
     * @param int $id
     * @return object
    */
    public function getLogById(int $id)
    {
        return $this->logRepository->getLogById($id);
    }
   
}