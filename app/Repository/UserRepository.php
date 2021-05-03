<?php

namespace App\Repository;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Developers;

class UserRepository
{
    protected $developers;

    public function __construct(Developers $developers)
    {
        $this->developers = $developers;
    }

    public function getAllUser()
    {
        $data = DB::table('developers')->get();
        $result = [
            'result' => $data,
        ];
        return $result;
    }

    public function getUserById($id)
    {
        $res = Developers::where('id', '=', $id)->first();
        $result = [
            'result' => $res,
        ];
        return $result;
    }

    public function forgotPassword($data)
    {
        $result = [];
        if (
            Arr::exists($data, 'password') &&
            Arr::exists($data, 'confirm_password')
        ) {
            $password = Hash::make($data['password']);
            $result = Developers::where('email', '=', $data['email'])->update([
                'password' => $password,
                'confirm_password' => $data['confirm_password'],
            ]);
        }
        return $result;
    }

    public function signupUser(Developers $request)
    {
        $request->save();
        return $request->fresh();
    }

    public function updateUser(Developers $data, $id)
    {
        $developers = Developers::find($id);
        $developers->update($data->toArray());
        return $developers;
    }

    public function deleteUser($id)
    {
        $developers = Developers::find($id);
        $developers->delete();
        return $developers;
    }

    public function deleteMultipleUser($id)
    {
        $ids = explode(',', $id);
        Developers::whereIn('id', $ids)->delete();
        return 'Success';
    }

    public function loginUser($email, $password)
    {
        $user = Developers::where('email', '=', $email)->first();
        if (Hash::check($password, $user['password'])) {
            return 'Success';
        }
        return 'invalid';
    }
}
