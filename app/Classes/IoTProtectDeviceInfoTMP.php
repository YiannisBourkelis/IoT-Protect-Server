<?php

namespace App\Classes;

class IoTProtectDeviceInfoTMP {

    public int    $ID;
    public int    $UserID;
    public string $Place = 'Home';
    public string $Location = 'Kitchen';
    public int    $Model;
    public int    $Revision;
    public float  $Temperature;
    public int    $Photoresitor;

    public function __construct()
    {
        $this->Temperature = 22;
        $this->Photoresitor = 130;
    }

    public function parse()
    {
    }

}

?>