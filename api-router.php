<?php
require_once 'libs/Router.php';
require_once './app/controller/CocaController.php';

$router = new Router();

$router->addRoute('cocas', 'GET', 'CocaController', 'showAll');
$router->addRoute('cocas', 'POST', 'CocaController', 'addProduct');
$router->addRoute('cocas/:ID', 'GET', 'CocaController', 'showProduct');
$router->addRoute('cocas/:ID', 'DELETE', 'CocaController', 'delete');



$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);

