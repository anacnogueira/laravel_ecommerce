<?php

namespace App\Services;

use App\Repositories\Contracts\UserGroupRepositoryInterface;

class UserGroupService
{
    protected $userGroupRepository;

    public function __construct(UserGroupRepositoryInterface $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
    }

    /**
     * Select all usergroups
     * @return array
    */
    public function getAllUserGroups()
    {
        return $this->userGroupRepository->getAllUserGroups();
    }

     /**
     * Create a new usergroup
     * @param array $data
     * @return object 
    */
    public function makeUserGroup(array $data, $file)
    {
        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $userGroup = $this->userGroupRepository->createUserGroup($data);

        return $userGroup;
    }

    /**
     * Get UserGroup by  ID
     * @param int $id
     * @return object
    */
    public function getUserGroupById(int $id)
    {
        return $this->userGroupRepository->getUserGroupById($id);
    }

    /**
     * Update a usergroup
     * @param int $id
     * @param arrray $data
     * @return json response
    */
    public function updateUserGroup(int $id, array $data)
    {
        $userGroup = $this->userGroupRepository->getUserGroupById($id);

        if (!$userGroup) {
            return response()->json(['message' => 'User Group Not Found'], 404);
        }

        $data["status"] = isset($data["status"]) ? 'S' : 'N';

        $this->userGroupRepository->updateUserGroup($usergroup, $data);
        return response()->json(['message' => 'UserG roup Updated'], 200);
    }

    /**
     * Delete a usergroup
     * @param int $id
     * @return json response
    */
    public function destroyUserGroup(int $id)
    {
        $userGroup = $this->userGroupRepository->getUserGroupById($id);

        if (!$userGroup) {
            return response()->json(['message' => 'UserGroup Not Found'], 404);
        }

        $this->userGroupRepository->destroyUserGroup($userGroup);

        return response()->json(['message' => 'UserGroup Deleted'], 200);
    }
}