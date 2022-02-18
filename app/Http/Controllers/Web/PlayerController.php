<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PlayersController;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Players;
use App\Models\Teams;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    protected $players;

    public function __construct(PlayersController $players)
    {
        $this->players = $players;
    }

    /**
     * @param Teams $teams
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function list(Teams $teams)
    {
        return view('player-list', ['data' => $teams, 'admin' => Auth::user()->role == 'A']);
    }

    /**
     * @param Teams $teams
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Teams $teams)
    {
        return view('player', ['data' => $teams]);
    }

    /**
     * @param StorePlayerRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePlayerRequest $request)
    {
        $response = $this->players->store($request);

        if ($response->getStatusCode() == 201)
            return redirect(route('createPlayer', $request->get('team')))->with(['message' => 'Player created successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    /**
     * @param Players $players
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Players $players)
    {
        return view('player', ['data' => $players]);
    }

    /**
     * @param UpdatePlayerRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdatePlayerRequest $request, $id)
    {
        $response = $this->players->update($request, $id);

        if ($response->getStatusCode() == 202)
            return redirect(route('teamPlayers', $request->get('team')))->with(['message' => 'Player updated successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    /**
     * @param Players $players
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Players $players)
    {
        $teamID = $players->team_id;
        $response = $this->players->destroy($players->id);
        if ($response->getStatusCode() == 204)
            return redirect(route('teamPlayers', $teamID))->with(['message' => 'Player deleted successfully']);

        return redirect()->back()->withErrors($response);
    }

}
