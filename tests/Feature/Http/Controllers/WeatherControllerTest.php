<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\WeatherController;
use App\Interfaces\WeatherInterface;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Request;
use Mockery;
use Tests\TestCase;

class WeatherControllerTest extends TestCase
{
    protected $weatherController;
    protected $weatherService;

    public function setUp():void
    {
        parent::setUp();
        $this->weatherService = new WeatherService();
        $this->weatherController = new WeatherController($this->weatherService);
    }


    public function testGetWeather() {
        $request = Request::create('/get-weather', 'POST', ['city' => 'padova']);

        $result = $this->weatherController->getWeather($request);

        $this->assertEquals('home', $result->getName());
        $this->assertEquals($result['weather']['name'], 'Padova');
    }
}
