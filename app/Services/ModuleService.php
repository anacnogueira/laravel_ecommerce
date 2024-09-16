<?php

namespace App\Services;

use App\Repositories\Contracts\ModuleRepositoryInterface;

class ModuleService
{
    protected $moduleRepository;

    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Select all modules
     * @return array
    */
    public function getAllModules()
    {
        return $this->moduleRepository->getAllModules();
    }

     /**
     * Create a new module
     * @param array $data
     * @return object 
    */
    public function makeModule(array $data)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $module = $this->moduleRepository->createModule($data);        

        return $module;
    }

    /**
     * Get Module by  ID
     * @param int $id
     * @return object
    */
    public function getModuleById(int $id)
    {
        return $this->moduleRepository->getModuleById($id);
    }

    /**
     * Update a module
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateModule(int $id, array $data)
    {
        $module = $this->moduleRepository->getModuleById($id);

        if (!$module) {
            return response()->json(['message' => 'Module Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';
       
        $this->moduleRepository->updateModule($module, $data);
        return response()->json(['message' => 'Module Updated'], 200);
    }

    /**
     * Delete a module
     * @param int $id
     * @return json response
    */
    public function destroyModule(int $id)
    {
        $module = $this->moduleRepository->getModuleById($id);

        if (!$module) {
            return response()->json(['message' => 'Module Not Found'], 404);
        }

        $this->moduleRepository->destroyModule($module);

        return response()->json(['message' => 'Module Deleted'], 200);
    }
}