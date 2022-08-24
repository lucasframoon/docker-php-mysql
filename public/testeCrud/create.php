<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\Product;
// use Source\Models\Category;

// $category = new Category();
// $category->nm_category = "Nova Categoria " . rand(0, 9999);
// $category->save()

$product->nr_sku = $data['nr_sku'];
$product->nm_product = $data['nm_product'];
$product->vl_product = $data['vl_product'];
$product->qt_product = $data['qt_product'];
$product->ds_description = $data['ds_description'];
$product->save();