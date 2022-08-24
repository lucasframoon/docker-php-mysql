<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Product;

$listProducts = array();
$product = new Product();
$list = $product->find()->fetch(true);

foreach ($list as $prod) {
    array_push($listProducts, $prod->data());
}

echo json_encode(['listProducts' => $listProducts]);
