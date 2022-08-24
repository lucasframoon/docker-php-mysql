<?php

namespace Source\App;
use Source\Models\Product;

class Web
{

    // function getAllProducts()
    // {
    //     $listProducts = array();
    //     $product = new Product();
    //     $list = $product->find()->fetch(true);

    //     foreach ($list as $prod) {
    //         array_push($listProducts, $prod->data());
    //     }

    //     echo json_encode(['listProducts' => $listProducts]);
    // }

    // public function product($data)
    // {
    //     die('teste');
    // }

    // public function category($data)
    // {
    //     echo "<h1>Category </h1>";
    //     var_dump($data);
    //     exit;
    // }

    public function error($data)
    {
        echo "<h1> Erro ". $data['errcode'] ."</h1>";
    }
}
