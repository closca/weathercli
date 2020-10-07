<?php


namespace WeatherCLI;


/**
 * Class CommandRegistry is designed as a repository for controllers and commands. It is helping on scaling up the app
 * in order to be able to add other commands with ease.
 *
 * @package WeatherCLI
 * @author  Costel
 * @license NA
 */
class CommandRegistry
{
    /**
     * Array which will store the commands (string)
     *
     * @var array
     */
    protected $registry = [];

    /**
     * Array which will store the instances of the CommandController's
     *
     * @var array
     */
    public $controllers = [];

    /**
     * This method is allowing to register a controller and map it with a command
     *
     * @param $command_name
     * @param CommandController $controller
     */
    public function registerController($command_name, CommandController $controller)
    {
        $this->controllers = [ $command_name => $controller ];
    }

    /**
     * This method is allowing to register a command with a callable function
     *
     * @param $name
     * @param $callable
     */
    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

    /**
     * Will return the CommandController by command string
     *
     * @param $command
     * @return CommandController|null
     */
    public function getController($command)
    {
        return isset($this->controllers[$command]) ? $this->controllers[$command] : null;
    }

    /**
     * This method will return the command callback
     *
     * @param $command
     * @return callable|null
     */
    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

    /**
     * get the callable method from by command name. Can be the run method from a CommandController instance or the
     * callable callback from registerCommand()
     *
     * @param $command_name
     * @return CommandController|Callable
     * @throws \Exception
     */
    public function getCallable($command_name)
    {
        $controller = $this->getController($command_name);

        if ($controller instanceof CommandController) {
            return [ $controller, 'run' ];
        }

        $command = $this->getCommand($command_name);
        if ($command === null) {
            throw new \Exception("Command \"$command_name\" not found.");
        }

        return $command;
    }
}
