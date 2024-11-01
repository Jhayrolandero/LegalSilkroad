<?php

use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/', function () {
//     return response()->json(["msg"=>'hello']);
// });


// Route::post('/user',[UserController::class, 'addUser']);

Route::post('/register', [JWTAuthController::class, 'register']);
Route::post('/login', [JWTAuthController::class, 'login']);


Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('/user',[UserController::class, 'getUsers']);
});
