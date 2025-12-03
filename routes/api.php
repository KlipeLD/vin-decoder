<?php

use App\Http\Controllers\Api\VinDecodeController;
use Illuminate\Support\Facades\Route;

Route::post('vin/decode', VinDecodeController::class);