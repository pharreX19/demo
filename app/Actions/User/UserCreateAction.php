<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserCreateAction
{

    public function execute($data = [])
    {

        $validator = User::validate($data);
        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        return $user;
    }
}
