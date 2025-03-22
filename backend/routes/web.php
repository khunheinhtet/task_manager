<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', [TaskController::class, 'index'])->name('home');
Route::post('/store', [TaskController::class, 'store']);
Route::post('/update/{id}', [TaskController::class, 'update']);
Route::get('/delete/{id}', [TaskController::class, 'delete']);
Route::get('/new', [TaskController::class, 'new']);
Route::get('/edit/{id}', [TaskController::class, 'edit']);
