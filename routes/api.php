<?php

use App\Http\Controllers\AuthController\AuthenticationController;
use App\Http\Controllers\AuthController\MerchnatAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('users', UserController::class);

Route::post("/user/test",  [AuthenticationController::class , "register"] );

Route::post("/users/register", [AuthenticationController::class , "register"]);
Route::post("/users/login", [AuthenticationController::class , "login"]);
Route::post("/users/logout", [AuthenticationController::class, 'logout'])->middleware("auth:sanctum");

Route::post("/merchants/register", [MerchnatAuthController::class, "register"]);
Route::post("/merchants/login", [MerchnatAuthController::class, "login"]);
Route::post("/merchants/logout", [MerchnatAuthController::class, "logout"])->middleware("auth:merchant");

Route::apiResource("/product/categories", CategoryController::class);
Route::apiResource("products", ProductController::class);
Route::apiResource("products.reviews", ReviewController::class)->scoped();
