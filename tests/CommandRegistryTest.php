<?php

use App\Command\WeatherController;
use WeatherCLI\App;
use WeatherCLI\CommandRegistry;
use WeatherCLI\Printer;
use function PHPUnit\Framework\assertTrue;
use function Tests\getApp;

it('asserts CommandRegistry is created', function () {
    $command_registry = new CommandRegistry();
    assertTrue($command_registry instanceof CommandRegistry);
});

it('asserts CommandRegistry getCallable', function () {
    $this->expectException(Exception::class);
    $this->expectExceptionMessage('Command "test" not found.');
    $command_registry = new CommandRegistry();
    $command_registry->getCallable('test');
});

it('asserts CommandRegistry getCallable returns a controller', function () {
    $app = getApp();
    $app->registerController('weather', new WeatherController($app));
    $callable = $app->command_registry->getCallable('weather');
    assertTrue(is_array($callable));
    expect(count($callable))->toBe(2);
    assertTrue($callable[0] instanceof WeatherController);
});

it('asserts CommandRegistry getCallable returns the command name', function () {
    $command_registry = new CommandRegistry();
    $command_registry->registerCommand('test', function() {});
    $callable = $command_registry->getCallable('test');
    assertTrue(is_callable($callable));
});
