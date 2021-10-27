<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Players;
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UIPlayerController extends Controller
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
     * @param Players $players
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdatePlayerRequest $request, Players $players)
    {
        $response = $this->players->update($request, $players);

        if ($response->getStatusCode() == 200)
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
        $response = $this->players->destroy($players);
        if ($response->getStatusCode() == 200)
            return redirect(route('teamPlayers', $teamID))->with(['message' => 'Player deleted successfully']);

        return redirect()->back()->withErrors($response);
    }

}
