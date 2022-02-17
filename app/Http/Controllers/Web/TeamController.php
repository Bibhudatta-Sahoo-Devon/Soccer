<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\TeamsController;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    protected $teams;

    public function __construct(TeamsController $teams)
    {
        $this->teams = $teams;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function dashboard()
    {
        $teams = $this->teams->index();
        $data = [];
        if ($teams->getStatusCode() == 200) {
            $data = json_decode($teams->getContent(), true);
            $data = $data['data'];
        }
        return view('dashboard', ['data' => $data, 'admin' => Auth::user()->role == 'A'])->with(['message' => 'Team updated successfully']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('team');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreTeamRequest $request)
    {
        $response = $this->teams->store($request);
        if ($response->getStatusCode() == 201)
            return redirect('dashboard')->with(['message' => 'Team created successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }


    /**
     * @param Teams $teams
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Teams $teams)
    {
        return view('team', ['data' => $teams]);
    }


    /**
     * @param UpdateTeamRequest $request
     * @param Teams $teams
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateTeamRequest $request, Teams $teams)
    {
        $response = $this->teams->update($request, $teams);
        if ($response->getStatusCode() == 202)
            return redirect('dashboard')->with(['message' => 'Team updated successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }


    /**
     * @param Teams $teams
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Teams $teams)
    {
        $response = $this->teams->destroy($teams);
        if ($response->getStatusCode() == 204)
            return redirect('dashboard')->with(['message' => 'Team successfully deleted!']);

        return redirect()->back()->withErrors($response);
    }
}
