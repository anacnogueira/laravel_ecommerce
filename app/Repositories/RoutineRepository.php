<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoutineRepositoryInterface;
use App\Models\Routine;

class RoutineRepository implements RoutineRepositoryInterface
{
    protected $entity;

    public function __construct(Routine $routine)
    {
        $this->entity = $routine;
    }

    /**
     * Get all Routines
     * @return array
     */
    public function getAllRoutines()
    {
        return $this->entity->all();
    }

    /**
     * Get all Routines
     * @return array
     */
    public function getActiveRoutines()
    {
        return $this->entity->show();
    }

    /**
     * Select Routine by ID
     * @param int $id
     * @return object
     */
    public function getRoutineById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new routine
     * @param array $data
     * @return object
     */
    public function createRoutine(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of routine
     * @param object $routine
     * @param array $data
     * @return object
     */
    public function updateRoutine(Routine $routine, array $data)
    {
        return $routine->update($data);
    }

    /**
     * Delete a routine
     * @param object $routine
     */
    public function destroyRoutine(Routine $routine) 
    {
        return $routine->delete();
    }
}