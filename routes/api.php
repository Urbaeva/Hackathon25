<?php

use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



//Route::post('/chat', [ChatBotController::class, 'chat'])->middleware('auth');
Route::post('/chat', [ChatBotController::class, 'chat']);


