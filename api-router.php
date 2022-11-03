<?php
require_once 'libs/Router.php';
require_once './app/controller/CocaController.php';

$router = new Router();

$router->addRoute('cocas', 'GET', 'CocaController', 'showAll');
$router->addRoute('coca', 'POST', 'CocaController', 'addProduct');
$router->addRoute('coca/:ID', 'GET', 'CocaController', 'showProduct');
$router->addRoute('coca/:ID', 'DELETE', 'CocaController', 'delete');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

