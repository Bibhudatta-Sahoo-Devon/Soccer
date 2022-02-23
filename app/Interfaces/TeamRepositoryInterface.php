<?php


namespace App\Interfaces;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Teams;

interface TeamRepositoryInterface
{
    public function getTeam(int $id):Teams;
    public function getAllTeams():array;
    public function storeTeam(StoreTeamRequest $request):Teams;
    public function updateTeam(UpdateTeamRequest $request, $id):Teams;
    public function deleteTeam($id):void;
}
