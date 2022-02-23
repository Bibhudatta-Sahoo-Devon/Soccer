<?php


namespace App\Repositories;


use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Interfaces\PlayerRepositoryInterface;
use App\Models\Players;

class PlayerRepository implements PlayerRepositoryInterface
{

    /**
     * @param int $id
     * @return Players
     * @throws \Exception
     */
    public function getPlayer(int $id): Players
    {
        try {
            return Players::where('id', $id)->first();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param int $teamId
     * @return array
     * @throws \Exception
     */
    public function getTeamPlayers(int $teamId): array
    {
        try {
            return Players::where('team_id', $teamId)->get()->toArray();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param StorePlayerRequest $request
     * @return Players
     * @throws \Exception
     */
    public function storePlayer(StorePlayerRequest $request): Players
    {
        try {
            $imageName = $request->get('first_name') . strtotime(now()) . '.' . $request->file('image')->getMimeType();
            $request->file('image')->storeAs('public', $imageName);

            $player = new players();
            $player->first_name = $request->get('first_name');
            $player->last_name = $request->get('last_name');
            $player->image = $imageName;
            $player->team_id = $request->get('team');
            $player->save();

            return $player;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param UpdatePlayerRequest $request
     * @param $id
     * @return Players
     * @throws \Exception
     */
    public function updatePlayer(UpdatePlayerRequest $request, $id): Players
    {
        try {
            $players = new Players();
            $players->exists = true;
            $players->id = $id;

            if (isset($request['image']) && $request->file('image')->isValid()) {
                $imageName = $request->get('first_name') . strtotime(now()) . '.' . $request->file('image')->getMimeType();
                $request->file('image')->storeAs('public', $imageName);
                $players->image = $imageName;

            };

            $players->first_name = $request->get('first_name');
            $players->last_name = $request->get('last_name');
            $players->save();

            return $players;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    public function deletePlayer(int $id): void
    {
        try {
            Players::destroy($id);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }


}
