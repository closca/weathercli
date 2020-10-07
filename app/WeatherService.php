<?php


namespace App;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class WeatherService - http service using Guzzle  - we use this class to communicate with the weather data provider
 *
 * @package App
 * @author  Costel
 * @license NA
 */
class WeatherService
{
    /**
     * The API host
     * @var string
     */
    private $host = 'https://api.openweathermap.org';
    /**
     * The API key
     * @var string
     */
    private $key = 'c0f764ce5e4c25576b8d6325fc223810';
    /**
     * @var Client
     */
    private $client;

    /**
     * WeatherService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->host
        ]);
    }

    /**
     * This method will make the http get call and will retrieve the data in associative array if possible.
     *
     * @param $city
     * @return \Exception|GuzzleException|mixed
     */
    public function getWeather($city)
    {
        try {
            $response = $this->client->get(sprintf('/data/2.5/weather?q=%s&appid=%s&units=metric', $city, $this->key));
                return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            return $e;
        }
    }
}
