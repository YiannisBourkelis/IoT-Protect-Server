<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeviceController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user/devices', [DeviceController::class, 'index'])->middleware('auth:sanctum');
Route::post('user/device/create', [DeviceController::class, 'createme'])->middleware('auth:sanctum');
Route::post('/user/device/measurement', [DeviceController::class, 'add_measurement'])->middleware('auth:sanctum');
Route::get('device/{team_id}/measurements', [DeviceController::class, 'read_measurements'])->middleware('auth:sanctum');
Route::get('device/{team_id}/measurements/latest', [DeviceController::class, 'read_last_measurement'])->middleware('auth:sanctum');

Route::get('avg_battery_voltage', [DeviceController::class, 'avg_battery_voltage']);