<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChatController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->post('/products', [ProductController::class, 'create']);
Route::middleware('auth:sanctum')->get('/products', [ProductController::class, 'get_all']);
Route::middleware('auth:sanctum')->get('/products/{id}', [ProductController::class, 'get_one']);
Route::middleware('auth:sanctum')->post('/cart', [CartController::class, 'create']);
Route::middleware('auth:sanctum')->get('/cart/{user_id}', [CartController::class, 'get_all']);
Route::middleware('auth:sanctum')->delete('/cart', [CartController::class, 'remove_one']);
Route::middleware('auth:sanctum')->post('/order', [OrderController::class, 'create']);
Route::middleware('auth:sanctum')->post('/chat', [ChatController::class, 'chat']);

