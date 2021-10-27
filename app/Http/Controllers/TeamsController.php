<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Interfaces\TeamRepositoryInterface;
use App\Models\Teams;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{

    private $repository;

    public function __construct(TeamRepositoryInterface $repository)
    {
       $this->repository =  $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():object
    {
        $allTeams = Teams::all();
        if (!empty($allTeams)) {
            return response(['message' => 'Success', 'data' => $allTeams], Response::HTTP_OK);
        } else
            return \response(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request):object
    {
        $request->validated();
        $this->repository->store($request);
        return \response(['massage' => 'Created Team successfully'], Response::HTTP_CREATED);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeamRequest $request
     * @param \App\Models\Teams $teams
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Teams $teams):object
    {
        $request->validated();
        $this->repository->update($request,$teams);
        return \response(['massage' => 'Update Team successfully'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Teams $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teams):object
    {
        $this->repository->destroy($teams);
        return \response(['massage' => 'Deleted Team successfully'], Response::HTTP_CREATED);
    }
}
