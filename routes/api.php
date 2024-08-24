<?php

use App\Http\Controllers\AuthController\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
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
Route::post("/users/logout", [AuthenticationController::class, 'logout']);

Route::apiResource("/product/categories", CategoryController::class);
Route::apiResource("products", ProductController::class);
