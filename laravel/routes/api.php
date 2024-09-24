<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', [UserController::class, 'index']);

Route::get('/user/{id}', [UserController::class, 'show']);

Route::post('/user', [UserController::class, 'store']);



Route::put('/user{id}', [UserController::class, 'update']);

Route::delete('/user{id}', [UserController::class, 'destroy']);