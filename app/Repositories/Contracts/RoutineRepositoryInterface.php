<?php

namespace App\Repositories\Contracts;

use App\Models\Routine;

interface RoutineRepositoryInterface
{
    public function getAllRoutines();
    public function getRoutineById($id);
    public function createRoutine(array $data);
    public function updateRoutine(Routine $routine, array $data);
    public function destroyRoutine(Routine $routine);
}