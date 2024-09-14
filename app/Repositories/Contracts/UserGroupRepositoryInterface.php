<?php

namespace App\Repositories\Contracts;

use App\Models\UserGroup;

interface UserGroupRepositoryInterface
{
    public function getAllUserGroups();
    public function getUserGroupById($id);
    public function createUserGroup(array $data);
    public function updateUserGroup(UserGroup $usergroup, array $data);
    public function destroyUserGroup(UserGroup $usergroup);
}