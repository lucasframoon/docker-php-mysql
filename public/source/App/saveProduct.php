<?php
require __DIR__ . "/../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Product;
use Source\Models\ProductCategory;

$product = new Product();

if ($_POST['id_product'] != "") {

    $productExists = (new Product())->findById($_POST['id']);

    if ($productExists != null) {
        $product = $productExists;
    }
}

if ($_POST['nr_sku'] == "" || !is_numeric($_POST['nr_sku'])) {
    echo json_encode([
        'success' => false,
        'message' => 'SKU inválido'
    ]);
    exit;
} else {

    $product->nr_sku = $_POST['nr_sku'];
}

if ($_POST['nm_product'] == "") {
    echo json_encode([
        'success' => false,
        'message' => 'Nome inválido'
    ]);
    exit;
} else {
    $product->nm_product = $_POST['nm_product'];
}

if ($_POST['vl_product'] != "") {
    $product->vl_product = $_POST['vl_product'];
}

if ($_POST['qt_product'] != "") {
    $product->qt_product = $_POST['qt_product'];
}

if ($_POST['ds_description'] != "") {
    $product->ds_description = $_POST['ds_description'];
}
// var_dump($product);
// exit;
$productId = $product->save();
echo json_encode([
    'success' => true,
    'productId' => $productId
]);
// var_dump($product);
// exit;
if ($_POST['id_category']) {
    $productCategory = new ProductCategory();
    $idsCategory = explode(',', $_POST['id_category']);
    foreach ($idsCategory as $idCategory) {
        $productCategory->id_category = $idCategory;
        $productCategory->id_product = $product->id_product;
        $productCategory->save();
    }
}
