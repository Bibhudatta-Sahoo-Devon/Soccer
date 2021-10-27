<?php


namespace App\Interfaces;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Teams;

interface TeamRepositoryInterface
{
    public function store(StoreTeamRequest $request);
    public function update(UpdateTeamRequest $request, Teams $teams);
    public function destroy(Teams $teams);
}
