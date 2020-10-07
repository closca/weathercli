<?php

use App\Command\WeatherController;
use WeatherCLI\App;
use WeatherCLI\CommandRegistry;
use WeatherCLI\Printer;
use function PHPUnit\Framework\assertTrue;
use function Tests\getApp;

it('asserts App is created', function () {
    $app = getApp();
    assertTrue($app instanceof App);
});

it('asserts App has CommandRegistry', function () {
    $app = getApp();

    $registry = $app->command_registry;

    assertTrue($registry instanceof CommandRegistry);
});

it('asserts App has Printer service', function () {
    $app = getApp();

    $printer = $app->getPrinter();

    assertTrue($printer instanceof Printer);
});

it('asserts App prints error message when no command is specified ', function () {
    $app = getApp();
    $app->runCommand(['weathercli', 'test']);
})->expectOutputString('ERROR: Command "test" not found.');

it('asserts App registerController', function () {
    $app = getApp();
    $app->registerController('weather', new WeatherController($app));
    assertTrue($app->command_registry->getController('weather') instanceof WeatherController);
});

it('asserts App registerCommand', function () {
    $app = getApp();
    $app->registerCommand('weather', function () {});
    assertTrue(is_callable($app->command_registry->getCommand('weather')));
});
