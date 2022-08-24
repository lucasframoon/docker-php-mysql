<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/../vendor/autoload.php";
use Source\Models\ProductCategory;

// use CoffeeCode\DataLayer\Connect;

// $conn = Connect::getInstance();
// $error = Connect::getError();

// if ($error) {
//     echo $error->getMessage();
//     die();
// }

// $query = $conn->query ("SELECT * FROM products" );
// var_dump($query);

// use Source\Models\Category;

// $category = new Category();
// $list = $category->find()->fetch(true);

// /**
//  * @var $list Category[]
//  */
// foreach ($list as $cat) {
//     var_dump($cat->id_category);
//     var_dump($cat->productsByCategory());
// }

// $productCategory = (new ProductCategory())->find("id_product = :id_product", ":id_product=" . ($product->id_product))->fetch(true);

$productCategory = new ProductCategory();
// var_dump($productCategory);
// exit;

$list = $productCategory->find("id_product = :id_product", ":id_product=" . 39)->fetch(true);
// $list = $productCategory->find()->fetch(true);
// $list->destroy();
var_dump($list);


