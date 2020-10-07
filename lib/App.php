<?php

namespace WeatherCLI;
/**
 * The application main class. This class will help running the commands, instantiate printers.
 *
 * @author  Costel
 * @license NA
 */
class App
{
    /**
     *  Printer class instance
     *
     * @var Printer
     */
    private $printer;

    /**
     * CommandRegistry class instance
     * @var CommandRegistry
     */
    public $command_registry;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->printer = new Printer();
        $this->command_registry = new CommandRegistry();
    }

    /**
     * retrieve printer instance
     *
     * @return Printer
     */
    public function getPrinter()
    {
        return $this->printer;
    }

    /**
     * Register controller into the app
     *
     * @param $name
     * @param CommandController $controller
     */
    public function registerController($name, CommandController $controller)
    {
        $this->command_registry->registerController($name, $controller);
    }

    /**
     * You can register commands into the app with a callback
     *
     * @param $name
     * @param $callable
     */
    public function registerCommand($name, $callable)
    {
        $this->command_registry->registerCommand($name, $callable);
    }

    /**
     * This method will run a command. It's checking first if there is a command into the arguments, and has the
     * capability to run a default command.
     * There is exception catch which will print the exception message
     *
     * @param array $argv
     * @param string $default_command
     */
    public function runCommand(array $argv = [], $default_command = 'weather')
    {
        $command_name = $default_command;

        if (isset($argv[1])) {
            $command_name = $argv[1];
        }

        try {
            call_user_func($this->command_registry->getCallable($command_name), $argv);
        } catch (\Exception $e) {
            $this->getPrinter()->display("ERROR: " . $e->getMessage());
        }
    }
}
