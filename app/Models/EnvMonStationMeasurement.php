<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvMonStationMeasurement extends Model
{
    use HasFactory;

    protected $table = 'measurements_environmental_station';

    protected $fillable = ['temperature', 'pressure', 'humidity', 'carbonMonoxide', 
                           'carbonDioxide', 'nitrogenDioxide', 'hydrogen',
                           'PMS7003_MP_1', 'PMS7003_MP_2_5', 'PMS7003_MP_10', 'uptime'];
}

/*
  json += "\"temperature\":\""      + temperature                   + "\"";
  json += ",\"pressure\":\""        + pressure                      + "\"";
  json += ",\"humidity\":\""        + humidity                      + "\"";
  json += ",\"carbonMonoxide\":\""  + carbonMonoxide                + "\"";
  json += ",\"carbonDioxide\":\""   + carbonDioxide                 + "\"";
  json += ",\"nitrogenDioxide\":\"" + nitrogenDioxide               + "\"";
  json += ",\"hydrogen\":\""        + hydrogen                      + "\"";
  
  if(getPMS7003_MP_10() > -1){ //pms library returns NULL sometimes probably because of a bug in the implementation. We do not send PMS data in case of NULL (-300 in our case)
  json += ",\"PMS7003_MP_1\":\""    + PMS7003_MP_1                  + "\"";
  json += ",\"PMS7003_MP_2_5\":\""  + PMS7003_MP_2_5                + "\"";
  json += ",\"PMS7003_MP_10\":\""   + PMS7003_MP_10  
  */
