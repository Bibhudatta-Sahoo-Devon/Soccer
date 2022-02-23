<?php


namespace App\Interfaces;


use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Players;

interface  PlayerRepositoryInterface
{
    public function getPlayer(int  $id):players;
    public function getTeamPlayers(int  $id):array;
    public function storePlayer(StorePlayerRequest  $request):players;
    public function updatePlayer(UpdatePlayerRequest $request, $id):players;
    public function deletePlayer(int  $id):void;

}
