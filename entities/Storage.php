<?php
require_once "../interfaces/EventListenerInterface.php";
require_once "../interfaces/LoggerInterface.php";
class Storage implements LoggerInterface, EventListenerInterface
{
    public $log='C:\xampp\htdocs\prog\in.txt';
    public function logMessage ($textError)
    {
        file_put_contents($this->log, $textError, FILE_APPEND);
    }
    public function lastMessages (int $count)
    {
        $error = explode("\n", file_get_contents($this->log));
        for ($i = 0; $i < $count; $i++ ) {
            echo ($error[$i]) ;
        }
    }
    protected $events = [];

    public function attachEvent($nameFunction, $callback)
    {
        if(method_exists($this,$nameFunction)) {

            $this->events[$nameFunction] = $callback;
            return true;

        }
        return false;
    }
    public function detouchEvent($nameFunction)
    {
        unset($this->events[$nameFunction]);
    }
}