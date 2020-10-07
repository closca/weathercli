<?php

namespace Tests;

// ..
use WeatherCLI\App;
use WeatherCLI\Printer;

function getApp() {
    $app = new App();
    $printer = $app->getPrinter();
    $printer->setMode(Printer::MODE_NO_NEW_LINE);
    return $app;
}
