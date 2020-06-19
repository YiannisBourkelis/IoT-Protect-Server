<?php

namespace App\Classes;

class IoTProtectDeviceInfo {

    public string $Name = 'Name';
    public string $Location = 'Home';
    public float  $Temperature;
    public int    $Photoresitor;
    public int    $WaterResistor;

    public function __construct()
    {
        $this->Temperature = 0;
        $this->Photoresitor = 130;
        $this->WaterResistor = 0;
    }

    public function parse()
    {
    }

}

?>