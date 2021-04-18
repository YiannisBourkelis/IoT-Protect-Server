<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\EnvMonStationMeasurement;
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
        return Auth::user()->ownedTeams()
                        ->with(['latestSmokeDetectorMeasurement', 
                                'oldestSmokeDetectorMeasurement', 
                                'latestEnvStationMeasurement',
                                'oldestEnvStationMeasurement',
                                ])
                        ->where('personal_team', 0)
                        ->simplePaginate(30);
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

        //return $team->measurements()->orderByDesc('id')->simplePaginate(20);
        return $team->measurements()->orderByDesc('id')->simplePaginate(512);
        
        //return $team->measurements()->orderByDesc('id')->simplePaginate(512, ['*'], 'page', 2);
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

        /*
        if (! ($team && Auth::user()->belongsToTeam($team))) {
            return response(__METHOD__.", line:".__LINE__, 401);
        }
        */
        

        if ($team && $team->type === 1){
            $new_item = new SmokeDetectorMeasurement();
            $new_item->fill($request->all());
            $new_item->team_id = $team->id;

            //TODO: validation
            $new_item->save();
    
            return $new_item;
        }

        //if ($team->type === 2){
            $new_item = new EnvMonStationMeasurement();
            $new_item->fill($request->all());
            $new_item->team_id = $team->id;

            //TODO: validation
            $new_item->save();

            //check if firmware upgrade is required
            $latest_version = '1.1';

            $upgrade_available = version_compare($request->firmware_version, $latest_version, '<');

            $new_item->firmware_version = $request->firmware_version;
            $new_item->upgrade_available = $upgrade_available;
            if ($upgrade_available){
                $new_item->firmware_upgrade_url = "http://www.dentist.gr/Downloads/EnvironmentalMonitoringStation.ino.esp32_v1_1_0.bin";
            }
            //$new_item->reboot = 'true';

            return $new_item;
        //}



        //return $device->team()->get();
    }

    public function avg_battery_voltage()
    {
        $avg = DB::table('measurements_smoke_detector')
             ->selectRaw('AVG(measurements_smoke_detector.battery_voltage) avg_battery_voltage, MAX(created_at) created_at')
             ->where('created_at', '>=', '2021-04-19 21:00:00')
             ->groupByRaw('YEAR(measurements_smoke_detector.created_at),
                           MONTH(measurements_smoke_detector.created_at),
                           DAY(measurements_smoke_detector.created_at),
                           HOUR(measurements_smoke_detector.created_at)
                ')
             ->orderByRaw('id asc')
             ->get();

        return response(json_encode($avg))
                ->header('Content-Type', 'application/json');
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
