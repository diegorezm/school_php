<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\StudentController;
use Illuminate\Support\Facades\Route;

// /api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    Route::apiResource('courses', CourseController::class)->middleware('auth:sanctum');
    Route::apiResource('students', StudentController::class)->middleware('auth:sanctum');
    Route::group(['prefix' => 'auth'], function() {
        Route::post("/login", [AuthController::class, "login"]);
        Route::post("/register", [AuthController::class, "register"])->middleware('auth:sanctum');
        Route::get("/whoami", [AuthController::class, "whoami"])->middleware('auth:sanctum');
        Route::get("/verify", [AuthController::class, "verify"])->middleware('auth:sanctum');
  });
});
