<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', 'ApiController@apiDetails');
Route::get('/details',  [App\Http\Controllers\ApiController::class, 'apiDetails']);

Route::put('/products/{code}',  [App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{code}', [App\Http\Controllers\ProductController::class, 'trash']);
Route::get('/products/{code}', [App\Http\Controllers\ProductController::class, 'show']);
Route::get('/products',  [App\Http\Controllers\ProductController::class, 'index']);
Route::get('/token',  [App\Http\Controllers\ProductController::class, 'token']);
Route::get('/cron',  [App\Http\Controllers\ProductController::class, 'cron']);

