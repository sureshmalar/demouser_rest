<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Developers;
use App\Service\UserService;
use App\Requests\DevelopersRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /* signup User */

    public function signup(DevelopersRequest $request)
    {
        try {
            $result = ['status' => 200];
            $file = $request['profile_pic'];
            $path = $file->storeAs(
                'storage/uploads',
                $file->getClientOriginalName()
            );
            $result['data'] = $this->userService->signupUser($request, $path);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result);
    }

    /**
     * list of user
     */
    public function getAllUser()
    {
        try {
            $result = ['status' => 200];
            $user = $this->userService->getAllUser();
            $result['data'] = $user;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }

    public function getUserById(Request $request)
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->userService->getUserById($request['id']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }

    /**
     * Update user based on id
     *
     */

    public function update(DevelopersRequest $request)
    {
        try {
            $result = ['status' => 200];
            $file = $request['profile_pic'];
            $path = $file->storeAs(
                'storage/uploads',
                $file->getClientOriginalName()
            );
            $result['data'] = $this->userService->updateUser($request, $path);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }

    /**
     * Delete single user based on id
     *
     */
    public function delete($id)
    {
        try {
            $result = ['status' => 200];
            $user = $this->userService->deleteUser($id);
            $result['data'] = $user;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }

    /**
     * login user based on email and password
     *
     */
    public function login(Request $request)
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->userService->loginUser($request);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }

    /**
     * delete multiple user record
     */
    public function deleteMultiple(Request $request)
    {
        try {
            $result = ['status' => 200];

            $user = $this->userService->deleteMultipleUser($request['ids']);
            $result['data'] = $user;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }

    public function forgotPassword(Request $request)
    {
        try {
            $result = ['status' => 200];
            $result['data'] = $this->userService->forgotPassword(
                $request->all()
            );
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }
        return response()->json($result);
    }
}
