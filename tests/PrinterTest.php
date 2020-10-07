<?php

use App\Command\WeatherController;
use WeatherCLI\App;
use WeatherCLI\CommandRegistry;
use WeatherCLI\Printer;
use function PHPUnit\Framework\assertTrue;
use function Tests\getApp;

it('asserts Printer is created', function () {
    $printer = new Printer();
    assertTrue($printer instanceof Printer);
});

it('asserts Printer out is printing the string', function () {
    $printer = new Printer();
    $printer->out('test');
})->expectOutputString('test');

it('asserts Printer newline is printing the new line', function () {
    $printer = new Printer();
    $printer->newline();
})->expectOutputRegex('/\n/');

it('asserts Printer display is printing the input', function () {
    $printer = new Printer();
    $printer->display('test');
})->expectOutputRegex('/\ntest\n\n/');

it('asserts Printer display set mode works', function () {
    $printer = new Printer();
    $printer->setMode(Printer::MODE_NO_NEW_LINE);
    expect($printer->getMode())->toBe(Printer::MODE_NO_NEW_LINE);
    $printer->setMode(Printer::MODE_CLEAN);
    expect($printer->getMode())->toBe(Printer::MODE_CLEAN);
});
