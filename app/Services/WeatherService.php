<?php
namespace App\Services;

use GuzzleHttp\Client;
use App\Interfaces\WeatherInterface;

class WeatherService implements WeatherInterface
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
        try {
            $response = $this->client->request('GET', '/data/2.5/weather', [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => config('weather.api_key'),
                    'units' => 'metric',
                    'lang' => 'it'
                ]
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            throw new Exception('Error retrieving weather from API, error: ' . $e->getMessage());
        }
    }

    public function getLatAndLongFromCity($city)
    {
        try {
            $response = $this->client->request('GET', '/geo/1.0/direct', [
                'query' => [
                    'q' => $city,
                    'appid' => config('weather.api_key'),
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            return [
                'latitude' => $result[0]['lat'],
                'longitude' => $result[0]['lon']
            ];
        } catch (Exception $e) {
            throw new Exception('Error retrieving latitude and longitude from city name, error: ' . $e->getMessage());
        }
    }

    public function getLatitudeAndLongitudeFromZipCode($zipCode)
    {
        try {
            $response = $this->client->request('GET', 'geo/1.0/zip', [
                'query' => [
                    'zip' => "$zipCode,IT",
                    'appid' => config('weather.api_key'),
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            throw new Exception('Error retrieving latitude and longitude from zip code, error: ' . $e->getMessage());
        }
    }
}
