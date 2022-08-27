<?php
require __DIR__ . "/../../../vendor/autoload.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Product;
use Source\Models\ProductCategory;
use Source\Models\Log;

try {
    $idProduct = filter_var(filter_input(INPUT_POST, "idProduct"), FILTER_SANITIZE_NUMBER_INT);
    $productCategories = array();

    $product = (new Product())->find("id_product = :id_product", ":id_product=" . $idProduct)->fetch();

    //Get list of category of this product
    $list = (new ProductCategory())->find("id_product = :id_product", ":id_product=" . $idProduct)->fetch(true);
    foreach ($list as $prodCat) {
        array_push($productCategories, $prodCat->id_category);
    }

//Generating request log
$log = new Log();
$log->ds_action = "Get Product";
$log->save();

    echo json_encode([
        'success' => true,
        'product' => $product->data(),
        'productCategories' => $productCategories
    ]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
