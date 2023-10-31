<?php

namespace App\Http\Controllers;

use App\Interfaces\WeatherInterface;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherInterface $weatherInterface)
    {
        $this->weatherService = $weatherInterface;
    }

    public function index()
    {
        $instantMeteo = '';
        return view('home');
    }

    public function showWeatherForm()
    {
        return view('home');
    }

    public function getWeather(Request $request)
    {
        $city = $request->input('city');
        $coordinates = $this->weatherService->getLatAndLongFromCity($city);
        $weather = $this->weatherService->getInstantWeather($coordinates['latitude'], $coordinates['longitude']);

        return view('home', compact('weather'));
    }
}
