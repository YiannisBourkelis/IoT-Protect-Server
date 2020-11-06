<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\Device;
use App\Models\SmokeDetectorMeasurement;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        return Auth::user()->ownedTeams()->with('device')->get();
        //return Auth::user()->ownedTeams()->get();
        //return Auth::user()->AllTeams();
        //return 'ok';
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

        //$device = $team->device()->first();
        //return $device->measurements()->get();

        return $team->device()->first()->measurements()->simplePaginate(15);

        //$measurements = SmokeDetectorMeasurement::find("device_id", $device->id);

        //return $measurements;

        //return $team->with('device.measurements')->get();

        //$device = $team->device()->with('measurements')->get();
        //return $device;
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

        //$device = $team->device()->first();
        //return $device->measurements()->get();

        return $team->device()->first()->measurements()->latest('id')->first();

        //$measurements = SmokeDetectorMeasurement::find("device_id", $device->id);

        //return $measurements;

        //return $team->with('device.measurements')->get();

        //$device = $team->device()->with('measurements')->get();
        //return $device;
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
        $team = Team::find($request->team_id);
        if (! ($team && Auth::user()->belongsToTeam($team))) {
            return response(__METHOD__.", line:".__LINE__, 401);
        }

        
        $new_item = new Device();
        $new_item->fill($request->all());
        $new_item->team_id = $team->id;
        //TODO: validation
        $new_item->save();

        return $new_item;
    }

    public function add_measurement(Request $request)
    {
        /*
        *  ελεγχος οτι ο χρήστης που έστειλε το request
        *  είναι μέλος της team
        */

        //return 'ok';
        $device = Device::find($request->device_id);
        $team = Team::find($device->team_id);

        if (! ($team && Auth::user()->belongsToTeam($team))) {
            return response(__METHOD__.", line:".__LINE__, 401);
        }

        $new_item = new SmokeDetectorMeasurement();
        $new_item->fill($request->all());
        $new_item->device_id = $device->id;
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
