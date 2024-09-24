<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
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


//book -s

Route::get('/books', [BookController::class, 'index']);

Route::get('/book/{id}', [BookController::class, 'show']);

Route::post('/book', [BookController::class, 'store']);



Route::put('/book{id}', [BookController::class, 'update']);

Route::delete('/book{id}', [BookController::class, 'destroy']);


//copies

Route::get('/copies', [CopyController::class, 'index']);

Route::get('/copy/{id}', [CopyController::class, 'show']);

Route::post('/copy', [CopyController::class, 'store']);



Route::put('/copy{id}', [CopyController::class, 'update']);

Route::delete('/copy{id}', [CopyController::class, 'destroy']);