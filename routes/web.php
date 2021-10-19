<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('dashboard');
    Route::get('players/{teams}',[HomeController::class,'playersList'])->name('teamPlayers');

    Route::middleware(['role:admin'])->group(function (){
        Route::get('/create/team',[HomeController::class,'createTeam'])->name('createTeam');
        Route::post('/create/team',[HomeController::class,'createTeam']);
        Route::get('team/{teams}',[HomeController::class,'editTeam'])->name('editTeam');
        Route::post('team/{teams}',[HomeController::class,'updateTeam']);
        Route::get('delete/team/{teams}',[HomeController::class,'destroyTeam'])->name('deleteTeam');


        Route::get('create/players/{teams}',[HomeController::class,'createPlayer'])->name('createPlayer');
        Route::post('create/players',[HomeController::class,'storePlayer']);
        Route::get('player/{players}',[HomeController::class,'editPlayer'])->name('editPlayer');
        Route::post('player/{players}',[HomeController::class,'updatePlayer']);
        Route::get('delete/player/{players}',[HomeController::class,'destroyPlayer'])->name('deletePlayer');
    });


});




require __DIR__.'/auth.php';
