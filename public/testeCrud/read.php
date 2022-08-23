<?php

require __DIR__ . "/../vendor/autoload.php";

// use CoffeeCode\DataLayer\Connect;

// $conn = Connect::getInstance();
// $error = Connect::getError();

// if ($error) {
//     echo $error->getMessage();
//     die();
// }

// $query = $conn->query ("SELECT * FROM products" );
// var_dump($query);

use Source\Models\Category;

$category = new Category();
$list = $category->find()->fetch(true);

/**
 * @var $list Category[]
 */
foreach ($list as $cat) {
    var_dump($cat->id_category);
    var_dump($cat->productsByCategory());
}

