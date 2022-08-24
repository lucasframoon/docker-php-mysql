<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class ProductCategory extends DataLayer
{
    public function __construct()
    {
        parent::__construct("product_category", ["id_category", "id_product"], "id", false);
    }

    // public function productsByCategory()
    // {
    //     return (new Product())->find("id_category = :id_category", ":id_category=" . ($this->id_category))->fetch(true);
    // }

    // public function saveProductCategory(ProductCategory $category)
    // {
    //     return $category->save();
    // }

    // public function deleteProductCategory(ProductCategory $category)
    // {
    //     return $category->destroy();
    // }
}
