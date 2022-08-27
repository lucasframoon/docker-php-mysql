<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Product;

try {
    $listProducts = array();
    $list = (new Product())->find()->fetch(true);

    foreach ($list as $prod) {
        array_push($listProducts, $prod->data());
    }

    
    echo json_encode(['success' => true, 'listProducts' => $listProducts]);
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
