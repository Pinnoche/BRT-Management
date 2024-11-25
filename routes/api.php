<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrtController;
use App\Http\Controllers\AuthController;


Route::group(
    [
        'middleware' => 'api',
    ],
    function ($router) {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::get('profile', [AuthController::class, 'profile'])->middleware('auth:api');
        Route::post('logout', [AuthController::class, 'destroy'])->middleware('auth:api');

    }
);


Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'brts'], function () {
    Route::get('/', [BrtController::class, 'index']);
    Route::post('/', [BrtController::class, 'store']);
    Route::get('/{brt}', [BrtController::class, 'show']);
    Route::patch('/{brt}', [BrtController::class, 'update']);
    Route::delete('/{brt}', [BrtController::class, 'destroy']);
});
