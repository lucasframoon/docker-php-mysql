<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Controllers
$router->namespace("Source\App");

//Web:product
// $router->group(null);
// $router->get("/", "Web:product");

//Web:category
$router->group('category');
$router->get("/", "Web:category");

//ERROR 
$router->group("error");
$router->get("/{errcode}", "Web:error");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ooops/{$router->error()}");
}
