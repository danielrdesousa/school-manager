<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\SchoolController;
use App\Http\Controllers\API\ClassroomController;

/*

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('students', StudentController::class)->middleware('auth:api');

Route::post('/students/{student}/classrooms', [StudentController::class, 'createClassrooms'])->middleware('auth:api');
Route::delete('/students/{student}/classrooms', [StudentController::class, 'destroyClassrooms'])->middleware('auth:api');
Route::put('/students/{student}/classrooms', [StudentController::class, 'updateClassrooms'])->middleware('auth:api');

Route::apiResource('schools', SchoolController::class)->middleware('auth:api');
Route::apiResource('classrooms', ClassroomController::class)->middleware('auth:api');
