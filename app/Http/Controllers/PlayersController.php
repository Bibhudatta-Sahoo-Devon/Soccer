<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\players;
use App\Models\Teams;
use App\Repositories\PlayerRepository;
use Symfony\Component\HttpFoundation\Response;

class PlayersController extends Controller
{
    protected $repository;

    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Teams $teams): object
    {
        $allPlayers = $teams->player;
        if (!empty($allPlayers)) {
            return response(['message' => 'Success', 'data' => $allPlayers], Response::HTTP_OK);
        }
        return \response(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlayerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerRequest $request): object
    {
        $request->validated();
        $this->repository->store($request);
        return \response(['massage' => 'Player created successfully'], Response::HTTP_CREATED);
    }

    /**
     *
     * @param UpdatePlayerRequest $request
     * @param players $players
     * @return object
     */

    public function update(UpdatePlayerRequest $request, players $players): object
    {
        $request->validated();
        $this->repository->update($request, $players);
        return \response(['massage' => 'Players updated successfully'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\players $players
     * @return \Illuminate\Http\Response
     */
    public function destroy(players $players): object
    {
        $players->delete();
        return \response(['massage' => 'Player deleted successfully'], Response::HTTP_OK);
    }
}
