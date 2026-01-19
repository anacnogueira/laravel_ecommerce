<?php

namespace App\Services;

use App\Models\Module;
use App\Http\Resources\ModuleResource;

class ModuleMenuService
{
    public static function makeMenuLinks()
    {
       return ModuleResource::collection(Module::tree());
    }
}
