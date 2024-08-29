<?php

namespace App\Http\Controllers\AuthController;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Requests\RegisterMerchantRequest;

class MerchnatAuthController extends Controller
{
    public function register(RegisterMerchantRequest $request)
    {
        $merchant  = Merchant::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password)
        ]);

        return new ApiSuccessResponse(
            $merchant,
            ["message" => "Merchant created successfully"],
            Response::HTTP_CREATED
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $merchant  = Merchant::where('email', $request->email)->first();

        if(!$merchant || !Hash::check($request->password, $merchant->password)) {
            return new ApiErrorResponse("The provided credential are incorrect", null, Response::HTTP_UNAUTHORIZED);
        }

        $token = $merchant->createToken('merchant-token', ['guard-name' => 'merchant'])->plainTextToken;

        return new ApiSuccessResponse(
            ["token" => $token],
            ['message' => "Merchant logged in successfully"]
        );
    }

    public function logout(Request $request) {

        if ($request->user()->tokenCan('guard-name:merchant')) {
            return $request->user();
        }

        $request->user()->currentAccessToken()->delete;

        return new ApiSuccessResponse(
            null,
            ["message" => "Logged Out Successfully"]
        );
    }
}
