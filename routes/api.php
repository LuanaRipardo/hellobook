<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ReaderController;


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

Route::post('login', [AuthController::class, 'login']);
//Route::apiResource('books', 'BookController');
Route::post('/books', [BookController::class, 'store']);
Route::get('books', [BookController::class, 'index']);
Route::delete('books/{book_id}', [BookController::class, 'deleteBook']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::post('/readers', [ReaderController::class, 'store']);
Route::put('/readers/{id}', [ReaderController::class, 'update']);
Route::get('/readers', [ReaderController::class, 'index']);
Route::delete('readers/{reader_id}', [ReaderController::class, 'deleteReader']);

//Route::get('/books', [BookController::class, 'index']);


Route::post('/reader/{reader_id}/add-book', [BookController::class, 'addToReader']);
Route::delete('/readers/{reader_id}/books/{book_id}', [ReaderController::class, 'removeBookFromReader']);

Route::get('/test-email', [EmailController::class, 'testEmail']);






Route::middleware('jwt:api')->group(function () {
    Route::delete('/readers/{readerId}/books/{bookId}', [ReaderController::class, 'removeBookFromReader']);
    Route::delete('/readers/{id}/books', [BookController::class, 'removeBookFromReader']);
});




