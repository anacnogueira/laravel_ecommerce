<?php

namespace App\Services;

use App\Repositories\Contracts\RoutineRepositoryInterface;

class RoutineService
{
    protected $routineRepository;

    public function __construct(RoutineRepositoryInterface $routineRepository)
    {
        $this->routineRepository = $routineRepository;
    }

    /**
     * Select all routines
     * @return array
    */
    public function getAllRoutines()
    {
        return $this->routineRepository->getAllRoutines();
    }

     /**
     * Create a new routine
     * @param array $data
     * @return object 
    */
    public function makeRoutine(array $data)
    {
        $routine = $this->routineRepository->createRoutine($data);        

        return $routine;
    }

    /**
     * Get Routine by  ID
     * @param int $id
     * @return object
    */
    public function getRoutineById(int $id)
    {
        return $this->routineRepository->getRoutineById($id);
    }

    /**
     * Update a routine
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateRoutine(int $id, array $data)
    {
        $routine = $this->routineRepository->getRoutineById($id);

        if (!$routine) {
            return response()->json(['message' => 'Routine Not Found'], 404);
        }
       
        $this->routineRepository->updateRoutine($routine, $data);
        return response()->json(['message' => 'Routine Updated'], 200);
    }

    /**
     * Delete a routine
     * @param int $id
     * @return json response
    */
    public function destroyRoutine(int $id)
    {
        $routine = $this->routineRepository->getRoutineById($id);

        if (!$routine) {
            return response()->json(['message' => 'Routine Not Found'], 404);
        }

        $this->routineRepository->destroyRoutine($routine);

        return response()->json(['message' => 'Routine Deleted'], 200);
    }
}