<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/get-data', [ApiController::class, 'getFilteredData'])->name('getFilteredData');
Route::get('/filter-data', [ApiController::class, 'filterFromDB'])->name('filterFromDB');

//Route::post('/chat', [ChatBotController::class, 'chat']);
Route::post('/chat', function () {
    return response()->json(['response' => 'How can I help you?']);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('test', function () { return 'test';});
});





