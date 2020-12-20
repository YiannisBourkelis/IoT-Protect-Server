<?php

namespace App\Models;

use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use App\Models\SmokeDetectorMeasurement;
use App\Models\EnvMonStationMeasurement;

class Team extends JetstreamTeam
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function device()
    {
        return $this->hasOne('App\Models\Device');
    }

    public function latestEnvStationMeasurement()
    {
        return $this->hasOne(EnvMonStationMeasurement::class)->orderby('id','desc')->take(1);
    }

    public function oldestEnvStationMeasurement()
    {
        return $this->hasOne(EnvMonStationMeasurement::class)->orderby('id','asc')->take(1);
    }

    public function latestSmokeDetectorMeasurement()
    {
        return $this->hasOne(SmokeDetectorMeasurement::class)->orderby('id','desc')->take(1);
    }

    public function oldestSmokeDetectorMeasurement()
    {
        return $this->hasOne(SmokeDetectorMeasurement::class)->orderby('id','asc')->take(1);
    }

    public function measurements()
    {
        if ($this->type == 2){
        return $this->hasMany(EnvMonStationMeasurement::class);
        } else {
            return $this->hasMany(SmokeDetectorMeasurement::class);
        }
    }
}
