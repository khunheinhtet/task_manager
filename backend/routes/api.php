<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    // return $request->user();
    return response()->json('success', 200);
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/cache-clear', [AuthController::class, 'cacheClear'])->name('cacheClear');
Route::get('/test', function (Request $request) {
    return response()->json(['msg'=> "success!"], 200);
});
Route::get('/getdata', [TaskController::class, 'getdata'])->name('getdata')->middleware('auth:sanctum');

