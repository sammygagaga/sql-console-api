<?php


use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'users' => UserController::class,
    ]);
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::post('login', [AuthController::class, 'login']);
Route::post('user', [UserController::class, 'store']);
