<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class ProductCategory extends DataLayer
{
    public function __construct()
    {
        parent::__construct("productCategories", ["id_category", "id_product"], "", false);
    }

    public function productsByProductCategory()
    {
        return (new Product())->find("id_category = :idProductCategory", ":idProductCategory=" . ($this->id_category))->fetch(true);
    }

    public function saveProductCategory(ProductCategory $category)
    {
        return $category->save();
    }

    public function deleteProductCategory(ProductCategory $category)
    {
        return $category->destroy();
    }
}
