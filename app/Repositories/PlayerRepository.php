<?php


namespace App\Repositories;


use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Interfaces\PlayerRepositoryInterface;
use App\Models\Players;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function store(StorePlayerRequest  $request):Players
    {
        $imageName = $request->get('first_name').strtotime(now()).'.'.$request->file('image')->getMimeType();
        $request->file('image')->storeAs('public',$imageName);
        $player = new players();
        $player->first_name = $request->get('first_name');
        $player->last_name = $request->get('last_name');
        $player->image = $imageName;
        $player->team_id = $request->get('team');
        $player->save();
        return $player;
    }
    public function update(UpdatePlayerRequest $request, $id):Players
    {
        $players = new Players();
        $players->exists = true;
        $players->id = $id;
        if (isset($request['image']) && $request->file('image')->isValid()) {
            $imageName = $request->get('first_name').strtotime(now()).'.'.$request->file('image')->getMimeType();
            $request->file('image')->storeAs('public',$imageName);
            $players->image = $imageName;

        };

        $players->first_name = $request->get('first_name');
        $players->last_name = $request->get('last_name');
        $players->save();
        return $players;
    }


}
