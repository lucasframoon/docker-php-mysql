<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer
{

    public function __construct()
    {
        parent::__construct("products", ["nr_sku", "nm_product", "vl_product", "qt_product"], "id_product");
    }

    //Get list off all products
    public function getAllProducts()
    {
        return $this->find()->fetch(true);
    }

    //Get product by id product
    public function getProductById($idProduct)
    {
        return $this->find("id_product = :id_product", ":id_product=" . $idProduct)->fetch();
    }

    //Get all products related to this category
    public function producyByCategory($idCategory)
    {
        return $this->find(
            "id_product IN (SELECT id_product 
                            FROM product_category
                            WHERE id_category= :idCategory)",
            ":idCategory=" .  $idCategory
        )->fetch(true);
    }

    //LCSTODO: delete product and file
}
