<?php

namespace App\Service;
use App\Models\Developers;

interface UserService
{
    public function signupUser($request,$path);
    public function updateUser($request,$path);
    public function deleteUser($id);
    public function loginUser($data);
    public function getAllUser();
    public function getUserById($id);
    public function deleteMultipleUser($id);
    public function forgotPassword($data);
}
