<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Web\TeamController;
use \App\Http\Controllers\Web\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Web" middleware group. Now create something great!
|
*/




Route::middleware(['auth'])->group(function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/dashboard', [TeamController::class,'dashboard'])->name('dashboard');
    Route::get('/team/{teams}/players',[PlayerController::class,'getTeamPlayers'])->name('teamPlayers');

    Route::middleware(['role:admin'])->group(function (){
        Route::get('/create/team',[TeamController::class,'createTeam'])->name('createTeam');
        Route::post('/create/team',[TeamController::class,'storeCreateTeam']);
        Route::get('team/{teams}',[TeamController::class,'editTeam'])->name('editTeam');
        Route::post('team/{teams}',[TeamController::class,'updateTeam']);
        Route::get('delete/team/{teams}',[TeamController::class,'deleteTeam'])->name('deleteTeam');


        Route::get('create/players/{teams}',[PlayerController::class,'createPlayer'])->name('createPlayer');
        Route::post('create/players',[PlayerController::class,'storeCreatePlayer']);
        Route::get('player/{players}',[PlayerController::class,'editPlayer'])->name('editPlayer');
        Route::post('player/{players}',[PlayerController::class,'updatePlayer']);
        Route::get('delete/player/{players}',[PlayerController::class,'deletePlayer'])->name('deletePlayer');
    });


});




require __DIR__.'/auth.php';
