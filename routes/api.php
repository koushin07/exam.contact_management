<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
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
    return response()->json("success",200);
});

/* AUTHENTICATION */
Route::group(['prefix'=>'auth'], function(){
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/logout/{id}', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/register', [AuthenticationController::class, 'register'])->middleware('auth:sanctum');
});

Route::apiResource('user', UserController::class)->middleware('auth:sanctum');
Route::get('/error', function(){
return response()->json(['message' =>'unauthenticated'], 401);
})->name('error');



