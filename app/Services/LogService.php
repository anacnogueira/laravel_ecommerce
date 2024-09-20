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
     * Create a new log
     * @param array $data
     * @return object 
    */
    public function makeLog(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $log = $this->logRepository->createLog($data);

        $fileName = Str::kebab($log->name)."-".date('dmYHis');

        if($file) {
            $storeFileService = new StoreFileService(
                $file,
                "public/images/logs",
                $fileName
            );
            $pathFile = $storeFileService->upload();
            $log->update([
                "image" => $pathFile,
            ]);
        }        

        return $log;
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

    /**
     * Update a log
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateLog(int $id, array $data, $file)
    {
   
        $log = $this->logRepository->getLogById($id);

        if (!$log) {
            return response()->json(['message' => 'Log Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        

        //To Do: Update image

        $this->logRepository->updateLog($log, $data);
        return response()->json(['message' => 'Log Updated'], 200);
    }

    /**
     * Delete a log
     * @param int $id
     * @return json response
    */
    public function destroyLog(int $id)
    {
        $log = $this->logRepository->getLogById($id);

        if (!$log) {
            return response()->json(['message' => 'Log Not Found'], 404);
        }

        $this->logRepository->destroyLog($log);

        return response()->json(['message' => 'Log Deleted'], 200);
    }
}