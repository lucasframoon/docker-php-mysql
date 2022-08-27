<?php
require __DIR__ . "/../../../vendor/autoload.php";

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

use Source\Models\Product;

try {

    $listProductsAndCategories = array();
    $productCategories = array();

    $listProducts = (new Product())->find()->fetch(true);

    foreach ($listProducts as $prod) {

        //Get list of category of this product
        $listOfCategoriesForThisProduct = $prod->categoriesByProduct();
        $categoriesNames = array();

        foreach ($listOfCategoriesForThisProduct as $category) {
            array_push($categoriesNames, $category->nm_category);
        }

        array_push($listProductsAndCategories, [$prod->data(), $categoriesNames]);
    }



    echo json_encode(['success' => true, 'listProductsAndCategories' => $listProductsAndCategories]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
