<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function register(UserStoreRequest $request){
        $user = User::create($request->all());
        return Response::json([
            'success' => true,
            'message' => 'User Created Successfully',
            'user' => $user
        ]);
    }
}
