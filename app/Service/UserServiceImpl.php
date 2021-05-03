<?php

namespace App\Service;
use App\Models\Developers;
use App\Repository\UserRepository;

class UserServiceImpl implements UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        $developers = $this->userRepository->getAllUser();
        return $developers;
    }

    public function getUserById($id)
    {
        $developers = $this->userRepository->getUserById($id);
        return $developers;
    }

    public function signupUser($request, $path)
    {
        $developers = new Developers();
        $developers->profile_pic = $path;
        $developers->first_name = $request['first_name'];
        $developers->last_name = $request['last_name'];
        $developers->email = $request['email'];
        $developers->password = $request['password'];
        $developers->phone_number = $request['phone_number'];
        $developers->address = $request['address'];
        $developers = $this->userRepository->signupUser($developers);

        return $developers;
    }

    public function updateUser($request, $path)
    {
        $developers = new Developers();
        $developers->profile_pic = $path;
        $developers->first_name = $request['first_name'];
        $developers->last_name = $request['last_name'];
        $developers->email = $request['email'];
        $developers->password = $request['password'];
        $developers->phone_number = $request['phone_number'];
        $developers->address = $request['address'];
        $developers = $this->userRepository->updateUser(
            $developers,
            $request['id']
        );

        return $developers;
    }

    public function deleteUser($id)
    {
        $developers = $this->userRepository->deleteUser($id);

        return $developers;
    }

    public function forgotPassword($request)
    {
        $result = '';
        $res = $this->userRepository->forgotPassword($request);
        if ($res == 1) {
            $result = 'Password Changed Successfully';
        } else {
            $result = 'Password Not Changed';
        }
        return $result;
    }

    public function loginUser($developers)
    {
        $username = $developers['email'];
        $password = $developers['password'];
        $developers = $this->userRepository->loginUser($username, $password);
        return $developers;
    }

    public function deleteMultipleUser($id)
    {
        $developers = $this->userRepository->deleteMultipleUser($id);

        return $developers;
    }
}