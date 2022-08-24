<?php

namespace Source\App;

use Source\Models\Product;

class ProductController
{

    public function getAllProducts()
    {

        $listProducts = array();
        $product = new Product();
        $list = $product->find()->fetch(true);

        foreach ($list as $prod) {
            array_push($listProducts, $prod->data());
        }

        echo json_encode(['listProducts' => $listProducts]);
    }

    public function getById($data)
    {
        $product = new Product();
        $product->findById($data['nr_sku']);
        echo json_encode(['product' => $product->data()]);
    }

    public function saveProduct($data)
    {
        $product = new Product();

        if ($data['nr_sku']) {
            $product = (new Product())->findById($data['nr_sku']);
        }

        $product->nr_sku = $data['nr_sku'];
        $product->nm_product = $data['nm_product'];
        $product->vl_product = $data['vl_product'];
        $product->qt_product = $data['qt_product'];
        $product->id_category = $data['id_category'];
        $product->ds_description = $data['ds_description'];

        $product->save();
    }
}
