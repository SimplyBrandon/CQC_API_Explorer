<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvidersController;

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

Route::group(['prefix' => 'providers'], function () {
    Route::get('/', [ProvidersController::class, 'index']);
    Route::get('/existing', [ProvidersController::class, 'getExisting']);
    Route::get('/search/{query}', [ProvidersController::class, 'searchProviders']);

    Route::get('/{uuid}', [ProvidersController::class, 'show']);
});
