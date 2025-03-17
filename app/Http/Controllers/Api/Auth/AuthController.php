<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('Api Token')->accessToken;
            return Response::json([
                'success' => true,
                'message' => 'Logged In Successfully',
                'token' => $token
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Invalid Credentials',
        ]);
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return Response::json([
            'success' => true,
            'message' => 'Logged Out Successfully!',
        ]);
    }
}
