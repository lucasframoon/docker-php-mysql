<?php
require __DIR__ . "/../../../vendor/autoload.php";

use Source\Models\Product;
use Source\Models\Category;

try {

    $listProductsAndCategories = array();
    $productCategories = array();

    $listAllProducts = (new Product())->getAllProducts();

    foreach ($listAllProducts as $prod) {

        //Get list of category of this product
        $listOfCategoriesForThisProduct = (new Category())->getCategoriesByProduct($prod->id_product);
        $categoriesNames = array();

        foreach ($listOfCategoriesForThisProduct as $category) {
            $categoriesNames[] = $category->nm_category;
        }

        array_push($listProductsAndCategories, [$prod->data(), $categoriesNames]);
    }

    echo json_encode(['success' => true, 'listProductsAndCategories' => $listProductsAndCategories]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
