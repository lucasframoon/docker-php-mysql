<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set("display_errors", 1);
error_reporting(E_ALL);

use Source\Models\Product;
use Source\Models\ProductCategory;
use Source\Models\Upload;

try {
    $idProduct = filter_var(filter_input(INPUT_POST, "id_product"), FILTER_SANITIZE_NUMBER_INT);
    $qtProduct = filter_var(filter_input(INPUT_POST, "qt_product"), FILTER_SANITIZE_NUMBER_INT);
    $idCategory = filter_var(filter_input(INPUT_POST, "id_category"));
    $nrSku = filter_var(filter_input(INPUT_POST, "nr_sku"));
    $nmProduct = filter_var(filter_input(INPUT_POST, "nm_product"));
    $vlProduct = filter_var(filter_input(INPUT_POST, "vl_product"));
    $dsDescription = filter_var(filter_input(INPUT_POST, "ds_description"));

    if (isset($_FILES["product_image"])) {

        $fileToUpload = new Upload($_FILES["product_image"]);
        $fileToUpload->generateNewName();
        $uploaded = $fileToUpload->upload(__DIR__ . "/../../uploads", false);;

        if ($uploaded["result"]) {
            $dsFilePath = "/source/uploads" . $uploaded["basename"];
        } else {


            echo json_encode([
                "success" => false,
                "error" => "invalid_param",
                "message" => "Invalid image type",
                "teste" => $fileToUpload
            ]);
            exit;
        }
    }

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
            "success" => false,
            "error" => "invalid_param",
            "message" => "Invalid SKU"
        ]);
        exit;
    } else {
        $product->nr_sku = $nrSku;
    }

    if ($nmProduct == "") {
        echo json_encode([
            "success" => false,
            "error" => "invalid_param",
            "message" => "Invalid name"
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

    if (isset($dsFilePath)) {
        $product->ds_file_path = $dsFilePath;
    }

    $responseProduct = $product->save();

    if ($responseProduct) {

        if ($isUpdate) {
            $productCategory = new ProductCategory();
            $listProductCategoryToDestroy = $productCategory->find("id_product = :id_product", ":id_product=" . $product->id_product)->fetch(true);
            foreach ($listProductCategoryToDestroy as $prodCat) {
                $prodCat->destroy();
            }
        }


        if ($idCategory != "") {
            $idsCategory = explode(",", $idCategory);
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
        "success" => true,
        "idProduct" => $product->id_product,
        "responseProduct" => $responseProduct,
        "allCategoriesResponse" => $allCategoriesResponse
    ]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(["success" => false, "error" => $th->getMessage()]);
    exit;
}
