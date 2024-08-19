<?php

namespace App\Http\Controllers\AuthController;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;


class AuthenticationController extends Controller
{
    public function register(RegisterUserRequest $request){

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password)
        ]);

        return new ApiSuccessResponse(
            $user,
            ['message' => 'User was created successfully'],
            Response::HTTP_CREATED
        );
    }

    public function login(UserLoginRequest $request){

        $user = new User();

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return new ApiErrorResponse("Invalid Credentials", null, Response::HTTP_UNAUTHORIZED);
        }

        if(!Hash::check($request->passwrd, $user->password)) {
            return new ApiErrorResponse("Invalid Credentials", null, Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return new ApiSuccessResponse(
            ["token" => $token],
            ['message' => "logged in successfully"]
        );

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return new ApiSuccessResponse(
            null,
            ['message' => "Logged Out Successfully"]
        );
    }
}
