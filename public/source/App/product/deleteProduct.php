<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Product;
use Source\Models\Log;

try {
    $idProduct = filter_var(filter_input(INPUT_POST, "idProduct"), FILTER_SANITIZE_NUMBER_INT);

    $product = (new Product())->getProductById($idProduct);
    $result = $product->deleteProductAndFile();

    //Generating request log
    $log = (new Log())->saveAction("Delete Product");

    echo json_encode(['success' => true, 'result' => $result]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
