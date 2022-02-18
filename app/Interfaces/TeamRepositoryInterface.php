<?php


namespace App\Interfaces;


use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Teams;

interface TeamRepositoryInterface
{
    public function store(StoreTeamRequest $request):Teams;
    public function update(UpdateTeamRequest $request, $id):Teams;
    public function destroy($id):void;
}
