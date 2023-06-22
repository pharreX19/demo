<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserLoginAction
{

    public function execute($data = [])
    {

        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw ValidationException::withMessages(
                [
                    'Email & Password does not match with our record.'
                ]
            );
        }

        $user = User::where('email', $data['email'])->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        return $token;
    }
}
