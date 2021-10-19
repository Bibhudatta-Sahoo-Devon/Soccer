<?php

namespace App\Http\Controllers;


use App\Models\players;
use App\Models\Teams;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Teams $teams)
    {
        $allPlayers = $teams->player;
        if (!empty($allPlayers)){
            return response(['message' => 'Success', 'data' => $allPlayers], Response::HTTP_OK);
        }
        return \response(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'mimes:png,jpg', 'max:2048'],
            'team' => ['required', 'numeric'],
        ]);

        if ($request->file('image')->isValid()) {
            $imageName = $request->get('first_name').strtotime(now()).'.'.$request->file('image')->getMimeType();
            $request->file('image')->storeAs('public',$imageName);
            $player = new players();
            $player->first_name = $request->get('first_name');
            $player->last_name = $request->get('last_name');
            $player->image = $imageName;
            $player->team_id = $request->get('team');
            $player->save();
            return \response(['massage' => 'success'], Response::HTTP_CREATED);
        };
        return \response(['message' => 'Invalid data'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\players  $players
     * @return \Illuminate\Http\Response
     */
    public function show(players $players)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\players  $players
     * @return \Illuminate\Http\Response
     */
    public function edit(players $players)
    {
        if (!empty($players)) {
            return response(['message' => 'Success', 'data' => $players], Response::HTTP_OK);
        } else
            return \response(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\players  $players
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, players $players)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'mimes:png,jpg', 'max:2048'],
        ]);
        if (isset($request['image']) && $request->file('image')->isValid()) {
            $imageName = $request->get('first_name').strtotime(now()).'.'.$request->file('image')->getMimeType();
            $request->file('image')->storeAs('public',$imageName);
            $players->image = $imageName;
        };

        $players->first_name = $request->get('first_name');
        $players->last_name = $request->get('last_name');
        $players->save();
        return \response(['massage' => 'success'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\players  $players
     * @return \Illuminate\Http\Response
     */
    public function destroy(players $players)
    {
        $players->delete();
        return \response(['massage' => 'success'], Response::HTTP_OK);
    }
}
