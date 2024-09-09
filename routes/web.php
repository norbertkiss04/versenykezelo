<?php

use App\Http\Controllers\API\CompetitionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

route::get('/competitions/render', [CompetitionController::class, 'renderCompetitionCards']);
