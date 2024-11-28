<?php

//session_start();
include_once("helper/ManejoSesiones.php");
include_once("configuration/Configuration.php");
//require __DIR__ . '../vendor/autoload.php;

$configuration = new Configuration();
$router = $configuration->getRouter();

$controllerName = isset($_GET['page']) ? $_GET['page'] : 'inicio';
$methodName = isset($_GET['action']) ? $_GET['action'] : 'inicio';

$data = isset($_POST) ? $_POST : null;


$router->route($controllerName, $methodName, $data); // Aquí estaban mal definidas las variables