<?php

namespace App\Services;

use App\Repositories\Contracts\StateRepositoryInterface;

class StateService
{
    protected $stateRepository;

    public function __construct(StateRepositoryInterface $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Select all States
     * @return array
    */
    public function getAllStates()
    {
        return $this->stateRepository->getAllStates();
    }

     /**
     * Create a new State
     * @param array $data
     * @return object 
    */
    public function makeState(array $data)
    {
        $state = $this->stateRepository->createState($data);

        return $state;
    }

    /**
     * Get State by  ID
     * @param int $id
     * @return object
    */
    public function getStateById(int $id)
    {
        return $this->stateRepository->getStateById($id);
    }

    /**
     * Update a State
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateState(int $id, array $data)
    {
        $state = $this->stateRepository->getStateById($id);

        if (!$state) {
            return response()->json(['message' => 'state Not Found'], 404);
        }

        $this->stateRepository->updateState($state, $data);
        return response()->json(['message' => 'state Updated'], 200);
    }

    /**
     * Delete a State
     * @param int $id
     * @return json response
    */
    public function destroyState(int $id)
    {
        $state = $this->stateRepository->getStateById($id);

        if (!$state) {
            return response()->json(['message' => 'State Not Found'], 404);
        }

        $this->stateRepository->destroyState($state);

        return response()->json(['message' => 'State Deleted'], 200);
    }
}