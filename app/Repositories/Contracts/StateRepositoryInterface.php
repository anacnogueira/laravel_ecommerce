<?php

namespace App\Repositories\Contracts;

use App\Models\State;

interface StateRepositoryInterface
{
    public function getAllStates();
    public function getStateById($id);
    public function createState(array $data);
    public function updateState(State $state, array $data);
    public function destroyState(State $state);
}