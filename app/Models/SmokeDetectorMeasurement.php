<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmokeDetectorMeasurement extends Model
{
    use HasFactory;

    protected $table = 'measurements_smoke_detector';

    protected $guarded = ['id', 'team_id', 'created_at', 'updated_at'];

    /*
    public function device()
    {
        return $this->belongsTo('App\Models\Device', 'device_id');
    }
    */
}
