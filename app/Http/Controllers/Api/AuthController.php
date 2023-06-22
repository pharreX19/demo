<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Actions\User\UserLoginAction;
use App\Actions\User\UserCreateAction;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = (new UserCreateAction())->execute($request->all());
            return response()->json($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'errors' => $e->errors()]
            );
        }
    }

    public function login(Request $request)
    {
        try {
            $token = (new UserLoginAction())->execute($request->all());
            return response()->json([
                'message' => 'User logged in successfully',
                'token' => $token
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage(), 'errors' => $e->errors()]
            );
        }
    }
}
