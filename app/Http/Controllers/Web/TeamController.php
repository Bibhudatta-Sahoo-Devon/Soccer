<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\TeamsController;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    protected $teams;

    public function __construct(TeamsController $teams)
    {
        $this->teams = $teams;
    }

    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        $teams = $this->teams->getAllTeams();
        $data = [];
        if ($teams->getStatusCode() == 200) {
            $data = json_decode($teams->getContent(), true);
            $data = $data['data'];
        }
        return view('dashboard', ['data' => $data, 'admin' => Auth::user()->role == 'A'])->with(['message' => 'Team updated successfully']);
    }

    /**
     * @return Application|Factory|View
     */
    public function createTeam()
    {
        return view('team');
    }


    /**
     * @param StoreTeamRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function storeCreateTeam(StoreTeamRequest $request)
    {
        $response = $this->teams->createTeam($request);
        if ($response->getStatusCode() == 201)
            return redirect('dashboard')->with(['message' => 'Team created successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }


    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function editTeam(int $id)
    {
        $team = $this->teams->getTeam($id);
        $data = [];
        if ($team->getStatusCode() == 200) {
            $data = json_decode($team->getContent(), true);
        }
        return view('team', ['data'=>$data]);
    }


    /**
     * @param UpdateTeamRequest $request
     * @param  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function updateTeam(UpdateTeamRequest $request, $id)
    {
        $response = $this->teams->updateTeam($request, $id);
        if ($response->getStatusCode() == 202)
            return redirect('dashboard')->with(['message' => 'Team updated successfully']);

        return redirect()->back()->withInput($request->all())->withErrors($response);
    }


    /**
     * @param  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function deleteTeam($id)
    {
        $response = $this->teams->deleteTeam($id);
        if ($response->getStatusCode() == 204)
            return redirect('dashboard')->with(['message' => 'Team successfully deleted!']);

        return redirect()->back()->withErrors($response);
    }
}
