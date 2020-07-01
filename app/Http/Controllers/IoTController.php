<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\IoTProtectDeviceInfo;
use App\IoTDeviceInfo;
use Auth;

class IoTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_devices = IoTDeviceInfo::where('user_id', Auth::user()->id)->get();
        return json_encode($user_devices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $iot_device = new IoTDeviceInfo;
        $iot_device->user_id = Auth::user()->id;
        $iot_device->place = "Σπίτι";
        $iot_device->spot = "Κουζίνα";
        $iot_device->model = 1;
        $iot_device->revision = 0;
        $iot_device->save();
        return $iot_device->id;
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

        return $id;
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
        return "update > " . $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = IoTDeviceInfo::destroy($id);
        return "delete > " . $id . " , result:" . $result;
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        return "data > " . $request->getContent();
    }
    
}
