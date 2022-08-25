<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Product;
use Source\Models\ProductCategory;

try {
    $idProduct = filter_var(filter_input(INPUT_POST, "id_product"), FILTER_SANITIZE_NUMBER_INT);
    $qtProduct = filter_var(filter_input(INPUT_POST, "qt_product"), FILTER_SANITIZE_NUMBER_INT);
    $idCategory = filter_var(filter_input(INPUT_POST, "id_category"));
    $nrSku = filter_var(filter_input(INPUT_POST, "nr_sku"));
    $nmProduct = filter_var(filter_input(INPUT_POST, "nm_product"));
    $vlProduct = filter_var(filter_input(INPUT_POST, "vl_product"));
    $dsDescription = filter_var(filter_input(INPUT_POST, "ds_description"));

    $product = new Product();
    $responseProduct = false;
    $isUpdate = false;
    $allCategoriesResponse = array();

    if ($idProduct != "") {

        $product = (new Product())->findById($idProduct);
        $isUpdate = true;
    }


    if ($nrSku == "" || !is_numeric($nrSku)) {
        echo json_encode([
            'success' => false,
            'message' => 'SKU inválido'
        ]);
        exit;
    } else {
        $product->nr_sku = $nrSku;
    }

    if ($nmProduct == "") {
        echo json_encode([
            'success' => false,
            'message' => 'Nome inválido'
        ]);
        exit;
    } else {
        $product->nm_product = $nmProduct;
    }

    if ($vlProduct != "") {
        $product->vl_product = $vlProduct;
    }

    if ($qtProduct != "") {
        $product->qt_product = $qtProduct;
    }

    if ($dsDescription != "") {
        $product->ds_description = $dsDescription;
    }

    $responseProduct = $product->save();
    // print_r([$responseProduct, '---', $product->id_product]);
    // exit;

    if ($responseProduct) {


        //LCSTODO arrumar para quando editar apagar as antigas antes de inserir as novas
        if ($isUpdate) {
            $productCategory = new ProductCategory();
            $listProductCategoryToDestroy = $productCategory->find("id_product = :id_product", ":id_product=" . $product->id_product)->fetch(true);
            foreach ($listProductCategoryToDestroy as $prodCat) {
                $prodCat->destroy();
            }
        }


        if ($idCategory != "") {
            $idsCategory = explode(',', $idCategory);
            foreach ($idsCategory as $idCategory) {
                $productCategory = new ProductCategory();
                $productCategory->id_category = $idCategory;
                $productCategory->id_product = $product->id_product;
                $res = $productCategory->save();

                array_push($allCategoriesResponse, $idCategory . "= " . $res);
            }
        }
    }

    echo json_encode([
        'success' => true,
        'idProduct' => $product->id_product,
        'responseProduct' => $responseProduct,
        'allCategoriesResponse' => $allCategoriesResponse
    ]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
