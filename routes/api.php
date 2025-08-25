<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/auth', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

Route::apiResource('user', UserController::class)->middleware('auth:sanctum');

Route::apiResource('carrinho', CarrinhoController::class)->middleware('auth:sanctum');
