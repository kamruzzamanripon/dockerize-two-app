<?php

use App\Http\Controllers\UnicornController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/unicorns', [UnicornController::class, 'index']);
Route::get('/unicorns/{unicorn}', [UnicornController::class, 'singleInfo']);
Route::put('/unicorns/{unicorn}', [UnicornController::class, 'updateSingleInfo']);
Route::post('/unicorns', [UnicornController::class, 'store']);
Route::delete('/unicorns/{unicorn}', [UnicornController::class, 'delete']);
