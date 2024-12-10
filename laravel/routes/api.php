<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\USerController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Librarian;
use App\Http\Middleware\WarehouseMan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//bárki által elérhető
Route::post('/register',[RegisteredUserController::class, 'store']);
Route::post('/login',[AuthenticatedSessionController::class, 'store']);
Route::get('book-copies',[BookController::class, "bookWithCopies"]);


Route::patch('update-password/{id}', [USerController::class,"updatePassword"]);

//autentikált utvonal
Route::middleware(['auth:sanctum'])
->group(function () {
    Route::get('/auth-user', [USerController::class, 'show']);
    Route::patch('/auth-user',[USerController::class, 'update']);
    // hány kölcsönzése volt
    Route::get('/aktiv-lendin-count', [LendingController::class,'aktivlendinCount']);
    Route::get('/lending-book-count', [LendingController::class,'lendinBookCount']);
    Route::get('lendin-books-data', [LendingController::class, 'lendinBooksdata']);
    Route::get('lendin-books-data2',[LendingController::class, 'lendinBooksdata2']);
    Route::get('/lendings-count', [LendingController::class,'lendinCount']);
    Route::get('/lendings-copies',[LendingController::class, "lendingsWithCopies"]);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

//admin

Route::middleware(['auth:sanctum',Admin::class])
->group(function () {
    Route::apiResource('/admin/users', USerController::class);
    Route::get('/admin/specificDate',[LendingController::class, "dateSpeci"]);
    Route::get('/admin/specifiCopy',[LendingController::class, "copiSpeci"]);

});

Route::middleware(['auth:sanctum',Librarian::class])
->group(function () {
    Route::get('books-copies', [BookController::class, "booksWithCopies"]);

});

Route::middleware(['auth:sanctum',WarehouseMan::class])
->group(function () {

});