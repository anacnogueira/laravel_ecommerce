<?php

namespace App\Repositories;

use App\Repositories\Contracts\ModuleRepositoryInterface;
use App\Models\Module;

class ModuleRepository implements ModuleRepositoryInterface
{
    protected $entity;

    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    /**
     * Get all Modules
     * @return array
     */
    public function getAllModules()
    {
        return $this->entity->all();
    }

    /**
     * Get all Modules
     * @return array
     */
    public function getActiveModules()
    {
        return $this->entity->show();
    }

    /**
     * Select Module by ID
     * @param int $id
     * @return object
     */
    public function getModuleById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new module
     * @param array $data
     * @return object
     */
    public function createModule(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of module
     * @param object $module
     * @param array $data
     * @return object
     */
    public function updateModule(Module $module, array $data)
    {
        return $module->update($data);
    }

    /**
     * Delete a module
     * @param object $module
     */
    public function destroyModule(Module $module) 
    {
        return $module->delete();
    }
}