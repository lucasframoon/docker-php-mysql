<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Category extends DataLayer
{
    public function __construct()
    {
        parent::__construct("categories", ["nm_category"], "id_category", false);
    }

    public function productsByCategory()
    {
        return (new Product())->find("id_category = :idCategory", ":idCategory=" . ($this->id_category))->fetch(true);
    }

    public function saveCategory(Category $category)
    {
        return $category->save();
    }

    public function deleteCategory(Category $category)
    {
        return $category->destroy();
    }
}
