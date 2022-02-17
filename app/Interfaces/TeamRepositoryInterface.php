<?php


namespace App\Interfaces;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Teams;

interface TeamRepositoryInterface
{
    public function store(StoreTeamRequest $request):void;
    public function update(UpdateTeamRequest $request, Teams $teams):void;
    public function destroy(Teams $teams):void;
}
