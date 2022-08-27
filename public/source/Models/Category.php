<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Category extends DataLayer
{
    public function __construct()
    {
        parent::__construct("categories", ["nm_category"], "id_category", false);
    }    

    //Get list off all categories
    public function getAllCategories()
    {
        return $this->find()->fetch(true);
    }

    //Get category by id category
    public function getCategoryById($idCategory)
    {
        return $this->find("id_category = :id_category", ":id_category=" . $idCategory)->fetch();
    }

    //Get all categories related to this product
    public function getCategoriesByProduct($idProduct)
    {

        return $this->find(
            "id_category IN (SELECT id_category 
                             FROM product_category pc
                             WHERE id_product = :idProduct)",
            ":idProduct=" .  $idProduct,
            "nm_category, id_category"
        )->fetch(true);
    }
    
}
