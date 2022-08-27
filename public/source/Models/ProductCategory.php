<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class ProductCategory extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product_category", ["id_category", "id_product"], "id", false);
    }

    public function getAllProductCategory()
    {
        return $this->find()->fetch(true);
    }

    //Get list of categories related to this product
    public function getProductCategoryByIdProduct($idProduct)
    {
        return $this->find("id_product = :id_product", ":id_product=" . $idProduct)->fetch();
    }

    //Get list of products in this category
    public function getProductCategoryByIdCategory($idCategory)
    {
        return $this->find("id_category = :id_category", ":id_category=" . $idCategory)->fetch();
    }
 
}
