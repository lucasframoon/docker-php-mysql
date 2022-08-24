<?php

require __DIR__ . "/vendor/autoload.php";

header("location: views/dashboard.php"); 


// use CoffeeCode\Router\Router;

// $router = new Router(URL_BASE);

// //Controllers
// $router->namespace("Source\App");

// // ProductController:dashboard
// $router->group(null);
// $router->get("/", "ProductController:getAllProducts");

// // //Web:product
// $router->group('product');
// $router->post("/save", "ProductController:save");
// // $router->post("/", "ProductController:product");
// // $router->delete("/", "ProductController:product");


// // //Web:category
// // $router->group('category');
// // $router->get("/", "CategoryController:getAllCategories");
// // $router->post("/save", "CategoryController:save");
// // $router->delete("/", "CategoryController:category");

// //Web:error
// $router->group("error");
// $router->get("/{errcode}", "Web:error");


// $router->dispatch();

// /*
//  * Redirect all errors
//  */
// if ($router->error()) {
//     $router->redirect("/error/{$router->error()}");
// }
