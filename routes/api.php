<?php

use App\Http\Controllers\API\CompetitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/newCompetition', [CompetitionController::class, 'newCompetition']);
