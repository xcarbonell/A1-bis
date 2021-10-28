<?php

//establecer errores
//ini_set('display_errors', 'On');
session_start();
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
require 'config.php';
require 'src/router.php';

$controller = getRoute();

//calls controller
require APP . '/src/controllers/' . $controller . '.php';
