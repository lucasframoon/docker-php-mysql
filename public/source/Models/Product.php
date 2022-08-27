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
        parent::__construct("products", ["nr_sku", "nm_product", "vl_product", "qt_product"], "id_product");
    }

    public static function getAllProducts()
    {
        return (new Product())->find()->fetch(true);
    }

    public function categoriesByProduct()
    {

        return (new Category())->find(
            "id_category IN (SELECT id_category 
                                                        FROM product_category pc
                                                        WHERE id_product = :idProduct)",
            ":idProduct=" .  $this->id_product,
            "nm_category, id_category"
        )->fetch(true);
    }
}
