<?php


namespace WeatherCLI;

/**
 * Class CommandController is a abstract class, which we use as model for the controllers
 *
 * @package WeatherCLI
 * @author  Costel
 * @license NA
 */
abstract class CommandController
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @param $argv
     * @return mixed
     */
    abstract public function run($argv);

    /**
     * CommandController constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Retrieves the app instance
     *
     * @return App
     */
    protected function getApp()
    {
        return $this->app;
    }
}
