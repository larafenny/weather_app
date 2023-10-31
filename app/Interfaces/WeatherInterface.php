<?php

namespace App\Interfaces;

interface WeatherInterface
{
    public function getInstantWeather($lat, $lon);
}
