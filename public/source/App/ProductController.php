<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

namespace Source\App;
use Source\Models\Product;

class ProductController
{
    
    public function getAllProducts()
    {

        Controller::views('dashboard');
        $listProducts = array();
        $product = new Product();
        $list = $product->find()->fetch(true);

        foreach ($list as $prod) {
            array_push($listProducts, $prod->data());
        }

        echo json_encode(['listProducts' => $listProducts]);
    }

    public function save($data)
    {
        echo "<h1> Erro </h1>";

        echo json_encode(['saveProduct' => $data]);
    }
   

    public function error($data)
    {
        die("<h1> Erro </h1>");
    }

}
