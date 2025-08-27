<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ItemProdutoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/auth', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

Route::apiResource('user', UserController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/carrinho', [CarrinhoController::class, 'show']);

    Route::post('/carrinho/item', [ItemProdutoController::class, 'store']);
    Route::put('/carrinho/item/{id}', [ItemProdutoController::class, 'update']);
    Route::delete('/carrinho/item/{id}', [ItemProdutoController::class, 'destroy']);
    Route::apiResource('produto', ProdutoController::class);
});

