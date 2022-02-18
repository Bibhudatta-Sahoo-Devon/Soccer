<?php


namespace App\Interfaces;


use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Players;

interface  PlayerRepositoryInterface
{
    public function store(StorePlayerRequest  $request):players;
    public function update(UpdatePlayerRequest $request, $id):players;

}
