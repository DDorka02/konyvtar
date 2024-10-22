<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\USerController;
use App\Http\Middleware\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//bárki által elérhető
Route::post('/register',[RegisteredUserController::class, 'store']);
Route::post('/login',[AuthenticatedSessionController::class, 'store']);
Route::apiResource('users', USerController::class);
Route::patch('update-password/{id}'), [USerController::class,"updatePassword"];

//autentikált utvonal
Route::middleware(['auth:sanctum'])
->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

//admin

Route::middleware(['auth:sanctum',Admin::class])
->group(function () {
    Route::get('/admin/users', [USerController::class, 'index']);
});


