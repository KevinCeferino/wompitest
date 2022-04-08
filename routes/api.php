<?php

use App\Http\Controllers\api\v1\PaymentController;
use App\Http\Controllers\api\v1\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('v1/payment', PaymentController::class);
Route::apiResource('v1/transaction', TransactionController::class);

