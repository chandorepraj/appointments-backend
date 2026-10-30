<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Auth;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
   Route::post('/logout',[AuthController::class, 'logout']);
   Route::get('/user', function (Request $request) {
    return $request->user();
});
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);
});
