<?php


namespace App\Repositories;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Teams;

class TeamRepository implements TeamRepositoryInterface
{
    public function store(StoreTeamRequest $request):void
    {
        $logName = $request->get('name').strtotime(now()).'.'.$request->file('logo')->getMimeType();
        $request->file('logo')->storeAs('public',$logName);
        $team = new Teams();
        $team->name = $request->get('name');
        $team->logo = $logName;
        $team->save();
    }
    public function update(UpdateTeamRequest $request, Teams $teams):void
    {
        if (isset($request['logo']) && $request->file('logo')->isValid()) {
            $logName = $request->get('name').strtotime(now()).$request->file('logo')->getMimeType();
            $request->file('logo')->storeAs('public',$logName);
            $teams->logo = $logName;
        };
        $teams->name = $request['name'];
        $teams->save();
    }

    public function destroy(Teams $teams):void
    {
        $teams->player()->delete();
        $teams->delete();
    }

}
