<?php
require_once "../interfaces/EventListenerInterface.php";
require_once "../interfaces/LoggerInterface.php";
class User implements EventListenerInterface
{
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
