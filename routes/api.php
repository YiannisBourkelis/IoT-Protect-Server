<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/signup', 'AuthController@signup');
  
    
    Route::middleware('auth:api')->get('auth/logout', 'AuthController@logout');
    Route::middleware('auth:api')->get('auth/user', 'AuthController@user');
    Route::middleware('auth:api')->get('auth/test', 'AuthController@test');
    Route::middleware('auth:api')->apiResource('auth/iot', 'IoTController');
    Route::middleware('auth:api')->post('auth/iot/data', 'IoTController@data');
