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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [TeamController::class,'dashboard'])->name('dashboard');
    Route::get('/team/{teams}/players',[PlayerController::class,'list'])->name('teamPlayers');

    Route::middleware(['role:admin'])->group(function (){
        Route::get('/create/team',[TeamController::class,'create'])->name('createTeam');
        Route::post('/create/team',[TeamController::class,'store']);
        Route::get('team/{teams}',[TeamController::class,'edit'])->name('editTeam');
        Route::post('team/{teams}',[TeamController::class,'update']);
        Route::get('delete/team/{teams}',[TeamController::class,'destroy'])->name('deleteTeam');


        Route::get('create/players/{teams}',[PlayerController::class,'create'])->name('createPlayer');
        Route::post('create/players',[PlayerController::class,'store']);
        Route::get('player/{players}',[PlayerController::class,'edit'])->name('editPlayer');
        Route::post('player/{players}',[PlayerController::class,'update']);
        Route::get('delete/player/{players}',[PlayerController::class,'destroy'])->name('deletePlayer');
    });


});




require __DIR__.'/auth.php';
