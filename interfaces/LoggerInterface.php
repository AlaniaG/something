<?php
interface LoggerInterface
{
    public function logMessage ($textError);
    public function lastMessages (int $count);
}