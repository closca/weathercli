<?php


namespace WeatherCLI;


/**
 * Class Printer is designed to help printing the output into the CLI.
 *
 * @package WeatherCLI
 * @author  Costel
 * @license NA
 */
class Printer
{
    /**
     * Constant for mode clean - means that will print with break lines.
     */
    const MODE_CLEAN = 0;
    /**
     * Constant for mode no new line - we need this to make our life easier on unit tests.
     */
    const MODE_NO_NEW_LINE = 1;

    /**
     * Printer mode - default clean
     * @var int
     */
    private $printerMode = self::MODE_CLEAN;

    /**
     * This method will print the $message
     *
     * @param $message
     */
    public function out($message)
    {
        echo $message;
    }

    /**
     *  Print new line - helper method.
     */
    public function newline()
    {
        $this->out("\n");
    }

    /**
     * The main callable method from the Printer class. Based on printerMode property can print with new lines or not.
     * @param $message
     */
    public function display($message)
    {
        if ($this->printerMode == self::MODE_NO_NEW_LINE) {
            $this->out($message);
            return;
        }
        $this->newline();
        $this->out($message);
        $this->newline();
        $this->newline();
    }

    /**
     * setter for printerMode
     *
     * @param int $mode
     */
    public function setMode($mode = self::MODE_CLEAN) {
        $this->printerMode = $mode;
    }

    /**
     * getter for printerMode
     *
     * @return int
     */
    public function getMode() {
        return $this->printerMode;
    }
}
