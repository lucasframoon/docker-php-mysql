<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Product;

try {
    $listProducts = array();

    $listAllProducts = (new Product())->getAllProducts();

    foreach ($listAllProducts as $prod) {
        $listProducts[] = $prod->data();
    }

    echo json_encode(['success' => true, 'listProducts' => $listProducts]);
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
