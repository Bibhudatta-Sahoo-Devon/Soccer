<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'mimes:png,jpg', 'max:2048'],
        ]);

        if ($request->file('logo')->isValid()) {
            $logName = $request->get('name').strtotime(now()).'.'.$request->file('logo')->getMimeType();
            $request->file('logo')->storeAs('public',$logName);
            $team = new Teams();
            $team->name = $request->get('name');
            $team->logo = $logName;
            $team->save();

            return \response(['massage' => 'success'], Response::HTTP_CREATED);
        };
        return \response(['message' => 'Invalid data'], Response::HTTP_UNAUTHORIZED);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teams)
    {
        if (!empty($teams)) {
            return response(['message' => 'Success', 'data' => $teams], Response::HTTP_OK);
        } else
            return \response(['message' => 'No data found'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teams $teams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teams)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable','mimes:png,jpg', 'max:2048'],
        ]);
        if (isset($request['logo']) && $request->file('logo')->isValid()) {
            $logName = $request->get('name').strtotime(now()).$request->file('logo')->getMimeType();
            $logo = $request->file('logo')->storeAs('public',$logName);
            $teams->logo = $logName;
        };
        $teams->name = $request['name'];
        $teams->save();
        return \response(['massage' => 'success'], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Teams $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teams)
    {
        $teams->player()->delete();
        $teams->delete();
        return \response(['massage' => 'success'], Response::HTTP_CREATED);
    }
}
