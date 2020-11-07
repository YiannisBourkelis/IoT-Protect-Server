<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\SmokeDetectorMeasurement;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->ownedTeams()->with('latestSmokeDetectorMeasurement')->where('personal_team', 0)->get();
    }

    public function read_measurements($team_id)
    {
        /*
        *  ελεγχος οτι ο χρήστης που έστειλε το request
        *  είναι μέλος της team
        */
        $team = Team::find($team_id);
        if (! ($team && Auth::user()->belongsToTeam($team))) {
            return response(__METHOD__.", line:".__LINE__, 401);
        }

        return $team->measurements()->simplePaginate(30);
    }

    public function read_last_measurement($team_id)
    {
        /*
        *  ελεγχος οτι ο χρήστης που έστειλε το request
        *  είναι μέλος της team
        */
        $team = Team::find($team_id);
        if (! ($team && Auth::user()->belongsToTeam($team))) {
            return response(__METHOD__.", line:".__LINE__, 401);
        }

        return $team->measurements()->latest('id')->first();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createme(Request $request)
    {
        /*
        *  ελεγχος οτι ο χρήστης που έστειλε το request
        *  είναι μέλος της team
        */
        $new_team = new Team;
        $new_team->user_id = Auth::user()->id;
        $new_team->name = $request->input('place').'\\'.$request->input('location');
        $new_team->personal_team = 0;
        $new_team->place = $request->input('place');
        $new_team->location = $request->input('location');
        $new_team->type = $request->input('type');
        $new_team->model = $request->input('model');
        $new_team->revision = $request->input('revision');
        $new_team->save();

        return $new_team;
    }

    public function add_measurement(Request $request)
    {
        /*
        *  ελεγχος οτι ο χρήστης που έστειλε το request
        *  είναι μέλος της team
        */


        $team = Team::find($request->team_id);

        if (! ($team && Auth::user()->belongsToTeam($team))) {
            return response(__METHOD__.", line:".__LINE__, 401);
        }

        $new_item = new SmokeDetectorMeasurement();
        $new_item->fill($request->all());
        $new_item->team_id = $team->id;
        //TODO: validation
        $new_item->save();

        return $new_item;

        //return $device->team()->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
