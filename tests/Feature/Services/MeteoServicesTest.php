<?php

namespace Tests\Feature\Services;
use App\Services\WeatherService;
use Tests\TestCase;

class MeteoServicesTest extends TestCase
{
    protected $weatherService;

    public function setUp():void
    {
        parent::setUp();
        $this->weatherService = new WeatherService();
    }
    public function testGetInstantWeather()
    {
        $lat = '45.4064';
        $lon = '11.8778';

        $result = $this->weatherService->getInstantWeather($lat, $lon);

        $this->assertNotEmpty($result);

    }

    public function testGetLocationWeather()
    {
        $city = 'padova';

        $result = $this->weatherService->getLatAndLongFromCity($city);

        $this->assertNotEmpty($result);
    }

    public function testGetLatAndLongFromCity() {
        $city = 'padova';
        $result = $this->weatherService->getLatAndLongFromCity($city);

        $weather = $this->weatherService->getInstantWeather($result['latitude'], $result['longitude']);

        $this->assertNotEmpty($weather);
    }

    public function testGetLatitudeAndLongitudeFromZipCode() {
        $zipCode = '39042';
        $result = $this->weatherService->getLatitudeAndLongitudeFromZipCode($zipCode);

        $this->assertEquals($result['name'], 'Vahrn - Varna');
    }
}
