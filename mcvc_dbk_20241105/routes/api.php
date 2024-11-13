<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post( '/nuevosuaurio', [AuthController::class,"register"] );
Route::post( '/login', [AuthController::class,"login"] );
Route::post( '/usuario', [AuthController::class,"me"] )->middleware('auth:sanctum');