<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;


//auth
Route::group(['prefix'=> 'auth'], function(){
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
    });
    Route::group(['middleware' => 'guest:api'], function(){
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
});

//blog
Route::group(['prefix'=>'v1', 'middleware' => 'auth:api'], function(){
    Route::apiResource('blog', BlogController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('tag', TagController::class);
});