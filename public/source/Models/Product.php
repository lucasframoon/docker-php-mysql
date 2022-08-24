<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Class Product
 * @package Source\Models
 */
class Product extends DataLayer
{
    /**
     * Product constructor.
     */
    public function __construct()
    {
        parent::__construct("products", ["nm_product", "vl_product", "qt_product", "id_category"], "nr_sku");
    }

    // public static function getAllProducts()
    // {
    //     $product = new Product();
    //     return $product->find()->fetch(true);

    // }

    // public function saveProduct(Product $product)
    // {
    //     return $product->save();
        
    // }

    public function deleteProduct(Product $product)
    {
        return $product->destroy();
    }

    public function categoriesByProduct()
    {
        return (new Category())->find("id_category = :idCategory", ":idCategory=" . ($this->id_category))->fetch(true);
    }
}
