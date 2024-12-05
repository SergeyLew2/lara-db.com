<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\StockController;

Route::get('/sales/set_data', [SaleController::class, 'set_data']);
Route::get('/sales/delete_data', [SaleController::class, 'delete_data']);

Route::get('/orders/set_data', [OrderController::class, 'set_data']);
Route::get('/orders/delete_data', [OrderController::class, 'delete_data']);

Route::get('/incomes/set_data', [IncomeController::class, 'set_data']);
Route::get('/incomes/delete_data', [IncomeController::class, 'delete_data']);

Route::get('/stocks/set_data', [StockController::class, 'set_data']);
Route::get('/stocks/delete_data', [StockController::class, 'delete_data']);