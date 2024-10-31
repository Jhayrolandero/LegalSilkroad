<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(["msg"=>'hello']);
});

Route::get('/user',[UserController::class, 'getUsers']);

Route::post('/user',[UserController::class, 'addUser']);