<?php
spl_autoload_register(function ($class) {
        include 'entities/' . $class . '.php';
});
