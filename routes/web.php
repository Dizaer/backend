<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/todo', [TodoController::class, 'index']);

Route::get('/todo/{id}', [TodoController::class, 'show']);

Route::post('/todo', [TodoController::class, 'store']);

Route::put('/todo/{id}', [TodoController::class, 'update']);

Route::delete('/todo/{id}', [TodoController::class, 'destroy']);

Route::resource('role',RoleController::class, ['except' => ['create', 'edit']]);

