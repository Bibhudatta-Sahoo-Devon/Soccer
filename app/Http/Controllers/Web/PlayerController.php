<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Api\TeamsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PlayersController;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    protected $players;
    protected $teams;

    public function __construct(PlayersController $players,TeamsController $teams)
    {
        $this->players = $players;
        $this->teams = $teams;
    }

    /**
     * @param int $teamId
     * @return Application|Factory|View
     */
    public function getTeamPlayers(int $teamId)//todo
    {
        $response = $this->teams->getTeam($teamId);
        $team = [];
        if ($response->getStatusCode() == 200)
            $team = json_decode($response->getContent(),true);
        return view('player-list', ['data'=>$team, 'admin' => Auth::user()->role == 'A']);

    }

    /**
     * @param int $teamId
     * @return Application|Factory|View
     */
    public function createPlayer(int $teamId)
    {
        $response = $this->teams->getTeam($teamId);
        $team = [];
        if ($response->getStatusCode() == 200)
            $team = json_decode($response->getContent(),true);
        return view('player', ['data' => $team]);
    }

    /**
     * @param StorePlayerRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeCreatePlayer(StorePlayerRequest $request)
    {
        $response = $this->players->createPlayer($request);

        if ($response->getStatusCode() == 201)
            return redirect(route('createPlayer', $request->get('team')))->with(['message' => 'Player created successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    /**
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function editPlayer(int $id)
    {
        $response = $this->players->getPlayer($id);
        if ($response->getStatusCode() == 200)
            return view('player', ['data' => (array)$response->getData()]);

        return redirect()->back()->withErrors('Player is not present.');
    }

    /**
     * @param UpdatePlayerRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function updatePlayer(UpdatePlayerRequest $request, $id)
    {
        $response = $this->players->updatePlayer($request, $id);

        if ($response->getStatusCode() == 202)
            return redirect(route('teamPlayers', $request->get('team')))->with(['message' => 'Player updated successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    /**
     * @param int $id
     * @return Application|RedirectResponse|Redirector
     */
    public function deletePlayer(int $id)
    {
        $response = $this->players->getPlayer($id);
        if ($response->getStatusCode() == 200){
            $teamID = $response->getData()->team_id;
            $response = $this->players->deletePlayer($id);
            if ($response->getStatusCode() == 204)
                return redirect(route('teamPlayers', $teamID))->with(['message' => 'Player deleted successfully']);
        }
        return redirect()->back()->withErrors('Player is not present.');
    }

}
