<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Product;
use Source\Models\Log;

try {
    $idProduct = filter_var(filter_input(INPUT_POST, "idProduct"), FILTER_SANITIZE_NUMBER_INT);

    $product = (new Product())->find("id_product = :id_product", ":id_product=" . $idProduct)->fetch();
    $result = $product->destroy();

    //Generating request log
    $log = new Log();
    $log->ds_action = "Delete Product";
    $log->save();

    echo json_encode(['success' => true, 'result' => $result]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
