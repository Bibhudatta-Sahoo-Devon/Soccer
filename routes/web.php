<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\UITeamController;
use \App\Http\Controllers\UIPlayerController;

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
    Route::get('/dashboard', [UITeamController::class,'dashboard'])->name('dashboard');
    Route::get('players/{teams}',[UIPlayerController::class,'list'])->name('teamPlayers');

    Route::middleware(['role:admin'])->group(function (){
        Route::get('/create/team',[UITeamController::class,'create'])->name('createTeam');
        Route::post('/create/team',[UITeamController::class,'store']);
        Route::get('team/{teams}',[UITeamController::class,'edit'])->name('editTeam');
        Route::post('team/{teams}',[UITeamController::class,'update']);
        Route::get('delete/team/{teams}',[UITeamController::class,'destroy'])->name('deleteTeam');


        Route::get('create/players/{teams}',[UIPlayerController::class,'create'])->name('createPlayer');
        Route::post('create/players',[UIPlayerController::class,'store']);
        Route::get('player/{players}',[UIPlayerController::class,'edit'])->name('editPlayer');
        Route::post('player/{players}',[UIPlayerController::class,'update']);
        Route::get('delete/player/{players}',[UIPlayerController::class,'destroy'])->name('deletePlayer');
    });


});




require __DIR__.'/auth.php';
