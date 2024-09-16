<?php

namespace App\Repositories\Contracts;

use App\Models\Module;

interface ModuleRepositoryInterface
{
    public function getAllModules();
    public function getModuleById($id);
    public function createModule(array $data);
    public function updateModule(Module $module, array $data);
    public function destroyModule(Module $module);
}