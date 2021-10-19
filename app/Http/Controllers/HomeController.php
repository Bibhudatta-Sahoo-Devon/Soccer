<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $teams;
    protected $players;
    public function __construct()
    {
        if (!is_object($this->teams)){
            $this->teams = new TeamsController();
        }
        if (!is_object($this->players)){
            $this->players = new PlayersController();
        }


    }

    public function dashboard(Request $request){
        $teams = $this->teams->index();
        $data = [];
        if ($teams->getStatusCode() == 200){
            $data = json_decode($teams->getContent(),true);
            $data = $data['data'];
        }
        return view('dashboard',['data'=>$data,'admin'=>Auth::user()->role == 'A'])->with(['message'=>'Team updated successfully']);

    }

    public function createTeam(Request $request){
        $method  =  strtoupper($request->method());
        if( $method === 'GET'){
            return view('team');
        }else{
            $response = $this->teams->store($request);
            if ($response->getStatusCode() == 201){
                return redirect('dashboard')->with(['message'=>'Team created successfully']);
            }else
                return redirect()->back()->withInput($request->all())->withErrors($response);
        }
    }

    public function editTeam(Teams $teams){
        $response = $this->teams->edit($teams);
        $data = [];
        if ($response->getStatusCode() == 200){
            $data = json_decode($response->getContent(),true);
            $data = $data['data'];
            return view('team',['data'=>$data]);
        }else
            return redirect()->back()->withErrors($response);
    }

    public function updateTeam(Request $request,Teams $teams){
            $response = $this->teams->update($request,$teams);
            if ($response->getStatusCode() == 201){
                return redirect('dashboard')->with(['message'=>'Team updated successfully']);
            }else
                return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    public function destroyTeam(Teams $teams){
        $response = $this->teams->destroy($teams);
        if ($response->getStatusCode() == 201){
            return redirect('dashboard')->with(['message'=>'Team successfully deleted!']);
        }else
            return redirect()->back()->withErrors($response);
    }

    public function playersList(Teams $teams){
        return view('player-list',['data'=>$teams,'admin'=>Auth::user()->role == 'A']);
    }

    public function createPlayer(Teams $teams){
        return view('player',['data'=>$teams]);
    }

    public function storePlayer(Request $request){
        $response = $this->players->store($request);
        if ($response->getStatusCode() == 201){
            return redirect(route('createPlayer',$request->get('team')))->with(['message'=>'Player created successfully']);
        }else
            return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    public function editPlayer(Players $players){
        $response = $this->players->edit($players);
        if ($response->getStatusCode() == 200){
            $data = json_decode($response->getContent(),true);
            $data = $data['data'];
            return view('player',['data'=>$data]);
        }else
            return redirect()->back()->withErrors($response->getContent());
    }


    public function updatePlayer(Request $request,Players $players){
        $response = $this->players->update($request,$players);
        if ($response->getStatusCode() == 200){
            return redirect(route('teamPlayers',$request->get('team')))->with(['message'=>'Player updated successfully']);
        }else
            return redirect()->back()->withInput($request->all())->withErrors($response);
    }

    public function destroyPlayer(Players $players){
        $teamID = $players->team_id;
        $response = $this->players->destroy($players);
        if ($response->getStatusCode() == 200){
            return redirect(route('teamPlayers',$teamID))->with(['message'=>'Player deleted successfully']);
        }else
            return redirect()->back()->withErrors($response);
    }

}
