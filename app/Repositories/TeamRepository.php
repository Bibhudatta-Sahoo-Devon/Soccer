<?php


namespace App\Repositories;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Teams;

class TeamRepository implements TeamRepositoryInterface
{
    public function store(StoreTeamRequest $request):Teams
    {
        $logName = $request->get('name').strtotime(now()).'.'.$request->file('logo')->getMimeType();
        $request->file('logo')->storeAs('public',$logName);
        $team = new Teams();
        $team->name = $request->get('name');
        $team->logo = $logName;
        $team->save();
        return $team;
    }
    public function update(UpdateTeamRequest $request, $team):Teams
    {

        $teams = new Teams();
        $teams->exists = true;
        $teams->id = $team;
        if (isset($request['logo']) && $request->file('logo')->isValid()) {
            $logName = $request->get('name').strtotime(now()).$request->file('logo')->getMimeType();
            $request->file('logo')->storeAs('public',$logName);
            $teams->logo = $logName;
        };
        $teams->name = $request['name'];
        $teams->save();
        return $teams;
    }

    public function destroy($team):void
    {
        $teams = new Teams();
        $teams->exists = true;
        $teams->id = $team;
        $teams->player()->delete();
        $teams->delete();
    }

}
