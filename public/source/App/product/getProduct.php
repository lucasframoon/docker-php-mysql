<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Product;
use Source\Models\ProductCategory;
use Source\Models\Log;

try {
    $idProduct = filter_var(filter_input(INPUT_POST, "idProduct"), FILTER_SANITIZE_NUMBER_INT);
    $productCategories = array();

    $product = (new Product())->getProductById($idProduct);

    //Get list of category of this product
    $list = (new ProductCategory())->getProductCategoryByIdProduct($idProduct);
    foreach ($list as $prodCat) {
        array_push($productCategories, $prodCat->id_category);
    }

    //Generating request log
    $log = (new Log())->saveAction("Get Product");

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
