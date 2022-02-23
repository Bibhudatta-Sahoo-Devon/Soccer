<?php


namespace App\Repositories;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Teams;

class TeamRepository implements TeamRepositoryInterface
{
    /**
     * @param int $id
     * @return Teams
     * @throws \Exception
     */
    public function getTeam(int $id): Teams
    {
        try {
            return Teams::where('id', $id)->with('player')->first();

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getAllTeams(): array
    {
        try {
            return Teams::all()->toArray();

        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param StoreTeamRequest $request
     * @return Teams
     * @throws \Exception
     */
    public function storeTeam(StoreTeamRequest $request): Teams
    {
        try {
            $logName = $request->get('name') . strtotime(now()) . '.' . $request->file('logo')->getMimeType();
            $request->file('logo')->storeAs('public', $logName);

            $team = new Teams();
            $team->name = $request->get('name');
            $team->logo = $logName;
            $team->save();

            return $team;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param UpdateTeamRequest $request
     * @param $team
     * @return Teams
     * @throws \Exception
     */
    public function updateTeam(UpdateTeamRequest $request, $team): Teams
    {
        try {
            $teams = new Teams();
            $teams->exists = true;
            $teams->id = $team;

            if (isset($request['logo']) && $request->file('logo')->isValid()) {
                $logName = $request->get('name') . strtotime(now()) . $request->file('logo')->getMimeType();
                $request->file('logo')->storeAs('public', $logName);
                $teams->logo = $logName;
            };

            $teams->name = $request['name'];
            $teams->save();

            return $teams;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param $team
     * @throws \Exception
     */
    public function deleteTeam($team): void
    {
        try {
            $teams = new Teams();
            $teams->exists = true;
            $teams->id = $team;

            $teams->player()->delete();

            $teams->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

}
