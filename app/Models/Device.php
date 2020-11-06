<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SmokeDetectorMeasurement;

class Device extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'team_id', 'created_at', 'updated_at'];

    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }

    public function measurements()
    {
        return $this->hasMany('App\Models\SmokeDetectorMeasurement', 'device_id');
    }
}
