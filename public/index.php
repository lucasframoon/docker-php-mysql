<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

//Controllers
$router->namespace("Source\App");

// ProductController:dashboard
$router->group(null);
$router->get("/", "ProductController:getAllProducts");

// $router->post("/", "Web:product");
// $router->delete("/", "Web:dashboard");

// //Web:product
$router->group('product');
$router->get("/", "ProductController:getAllProducts");
// $router->post("/", "ProductController:product");
// $router->delete("/", "ProductController:product");


// //Web:category
$router->group('category');
$router->get("/", "Web:category");
$router->post("/", "Web:category");
$router->delete("/", "Web:category");

//ERROR 
$router->group("error");
$router->get("/{errcode}", "Web:error");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ooops/{$router->error()}");
}
