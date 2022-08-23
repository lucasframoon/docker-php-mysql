<?php

namespace Source\App;

use Source\Models\Product;

class ProductController
{

    function getAllProducts()
    {
        $listProducts = array();
        $product = new Product();
        $list = $product->find()->fetch(true);

        foreach ($list as $prod) {
            array_push($listProducts, $prod->data());
        }

        echo json_encode(['listProducts' => $listProducts]);
    }

    function saveProduct($data)
    {
        die('saveProduct');
    }
   

    function error($data)
    {
        die("<h1> Erro </h1>");
    }

}
