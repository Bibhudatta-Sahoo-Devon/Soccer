<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\APIController;
use \App\Http\Controllers\Api\TeamsController;
use \App\Http\Controllers\Api\PlayersController;

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

Route::post('/login',[APIController::class,'login']);
Route::get('/teams',[TeamsController::class,'getAllTeams']);
Route::get('/team/{teams}/players',[PlayersController::class,'getTeamPlayers']);

Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('/logout',[APIController::class,'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['role'])->group(function (){
        Route::get('team/{id}',[TeamsController::class,'getTeam']);
        Route::post('team',[TeamsController::class,'createTeam']);
        Route::put('team/{id}',[TeamsController::class,'updateTeam']);
        Route::delete('team/{id}',[TeamsController::class,'deleteTeam']);

        Route::get('/player/{id}',[PlayersController::class,'getPlayer']);
        Route::post('player',[PlayersController::class,'createPlayer']);
        Route::put('player/{id}',[PlayersController::class,'updatePlayer']);
        Route::delete('player/{id}',[PlayersController::class,'deletePlayer']);
    });
});
