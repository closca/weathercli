<?php

use App\Command\WeatherController;
use WeatherCLI\App;
use WeatherCLI\CommandRegistry;
use WeatherCLI\Printer;
use function PHPUnit\Framework\assertTrue;
use function Tests\getApp;

it('asserts WeatherController is created', function () {
    $app = getApp();
    $weatherController = new WeatherController($app);
    assertTrue($weatherController instanceof WeatherController);
});

it('asserts WeatherController run print missing city', function () {
    $app = getApp();
    $weatherController = new WeatherController($app);
    $weatherController->run([]);
})->expectOutputString('You must provide the city.');

it('asserts WeatherController run and gets weather data (words separated by comma)', function () {
    $app = getApp();
    $weatherController = new WeatherController($app);
    $weatherController->run(['weather-cli', 'weather', 'Berlin']);
})->expectOutputRegex('/[^,\s?]/');

it('asserts WeatherController run and prints that data could no be found', function () {
    $app = getApp();
    $weatherController = new WeatherController($app);
    $weatherController->run(['weather-cli', 'weather', 'InexistentCity']);
})->expectOutputString('Weather data provider query has failed... ❌ ');
