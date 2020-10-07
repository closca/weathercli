<?php

namespace App\Command;

use App\WeatherService;
use GuzzleHttp\Exception\GuzzleException;
use WeatherCLI\App;
use WeatherCLI\CommandController;


/**
 * Class WeatherController
 * @package App\Command
 * @author  Costel
 * @license NA
 */
class WeatherController extends CommandController
{
    /**
     * Instance of the data service provider
     *
     * @var WeatherService
     */
    protected $weatherService;

    /**
     * WeatherController constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->weatherService = new WeatherService();
    }

    /**
     * the callable method form the controller
     *
     * @param $argv
     * @return mixed|void
     */
    public function run($argv)
    {
        if (!isset($argv[2])) {
            $this->getApp()->getPrinter()->display('You must provide the city.');
            return;
        }

        $city = $argv[2];

        $weatherData = $this->weatherService->getWeather($city);

        if ($weatherData instanceof GuzzleException) {
            $this->getApp()->getPrinter()->display('Weather data provider query has failed... ❌ ');
            return;
        }

        $this->getApp()->getPrinter()->display(
            sprintf('%s, %s degrees celsius', $weatherData['weather'][0]['description'], $weatherData['main']['temp'])
        );
    }
}
