<?php
namespace App\Services;

use GuzzleHttp\Client;

class WeatherServices
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('weather.base_url'),
        ]);
    }
    public function getInstantWeather($lat, $lon)
    {
        $response = $this->client->request('GET', 'weather', [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => config('weather.api_key'),
                'units' => 'metric',
                'lang' => 'it'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}

//https://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid={API key}
