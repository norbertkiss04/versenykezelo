<?php

use App\Http\Controllers\API\CompetitionController;
use App\Http\Controllers\API\RoundController;
use App\Http\Controllers\API\UserController;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/newCompetition', [CompetitionController::class, 'newCompetition']);

Route::post('/newRound', [RoundController::class, 'newRound']);

Route::get('/getCompetitions', function () {
    return Competition::all();
});

Route::get('/getCompetitors/{roundId}', function ($roundId) {
    $competitors = DB::table('competitors')
        ->join('app_users', 'competitors.user_id', '=', 'app_users.id')
        ->where('competitors.round_id', $roundId)
        ->select('app_users.username')
        ->get();

    return response()->json($competitors);
});

Route::post('/login', [UserController::class, 'login']);
