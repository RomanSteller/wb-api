<?php

use App\Actions\GetIncomesListAction;
use App\Actions\GetOrdersListAction;
use App\Actions\GetStocksListAction;
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


Route::middleware('check.api.key')->group(function () {
    Route::get('sales', GetStocksListAction::class);
    Route::get('orders', GetOrdersListAction::class);
    Route::get('incomes', GetIncomesListAction::class);
    Route::get('stocks', GetStocksListAction::class);
});
