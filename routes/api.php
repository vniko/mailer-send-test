<?php

use App\Http\Controllers\ApiController;
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


Route::delete('{model}/{id}', [ApiController::class, 'destroy']);
Route::post('{model}/{id}', [ApiController::class, 'update']);
Route::get('{model}/{id}', [ApiController::class, 'show']);
Route::get('{model}', [ApiController::class, 'index']);
Route::post('{model}', [ApiController::class, 'store']);
