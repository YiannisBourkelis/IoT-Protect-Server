<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IoTDeviceInfo extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'iot_device_info';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
