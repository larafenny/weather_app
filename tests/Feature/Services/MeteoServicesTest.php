<?php

namespace Tests\Feature\Services;
use App\Services\WeatherServices;
use Tests\TestCase;

class MeteoServicesTest extends TestCase
{
    protected $weatherService;

    public function setUp():void
    {
        parent::setUp();
        $this->weatherService = new WeatherServices();
    }
    public function testGetInstantWeather()
    {
        $lat = '45.4064';
        $lon = '11.8778';

        $result = $this->weatherService->getInstantWeather($lat, $lon);

        $this->assertNotEmpty($result);

    }
}
