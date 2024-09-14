<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserGroupRepositoryInterface;
use App\Models\UserGroup;

class UserGroupRepository implements UserGroupRepositoryInterface
{
    protected $entity;

    public function __construct(UserGroup $userGroup)
    {
        $this->entity = $userGroup;
    }

    /**
     * Get all UserGroups
     * @return array
     */
    public function getAllUserGroups()
    {
        return $this->entity->all();
    }

    /**
     * Select UserGroup by ID
     * @param int $id
     * @return object
     */
    public function getUserGroupById($id)
    {
        return $this->entity->find($id);
    }

    /**
     * Create a new usergroup
     * @param array $data
     * @return object
     */
    public function createUserGroup(array $data)
    {
        return $this->entity->create($data);
    }

     /**
     * Update data of usergroup
     * @param object $usergroup
     * @param array $data
     * @return object
     */
    public function updateUserGroup(UserGroup $userGroup, array $data)
    {
        return $userGroup->update($data);
    }

    /**
     * Delete a usergroup
     * @param object $usergroup
     */
    public function destroyUserGroup(UserGroup $userGroup) 
    {
        return $userGroup->delete();
    }
}