<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Models\Sparepart;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('cars', CarController::class);

Route::apiResource('spareparts', SparepartController::class);

Route::apiResource('transactions', TransactionController::class);

Route::apiResource('transaction-details', TransactionDetailController::class);
