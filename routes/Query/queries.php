<?php

use App\Http\Controllers\Api\QueryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'queries' => QueryController::class
    ]);
});

