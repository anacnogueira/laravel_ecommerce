<?php

namespace App\Repositories;

use App\Repositories\Contracts\StateRepositoryInterface;
use App\Models\State;

class StateRepository implements StateRepositoryInterface
{
    protected $entity;

    public function __construct(State $state)
    {
        $this->entity = $state;
    }

    /**
     * Get all States
     * @return array
     */
    public function getAllStates()
    {
        return $this->entity->all();
    }    

    /**
     * Select State by ID
     * @param int $id
     * @return object
     */
    public function getStateById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new State
     * @param array $data
     * @return object
     */
    public function createState(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of State
     * @param object $state
     * @param array $data
     * @return object
     */
    public function updateState(State $state, array $data)
    {
        return $state->update($data);
    }

    /**
     * Delete a State
     * @param object $state
     */
    public function destroyState(State $state) 
    {
        return $state->delete();
    }
}