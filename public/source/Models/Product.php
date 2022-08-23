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
        parent::__construct("products", ["nr_sku", "nm_product", "vl_product", "qt_product", "id_category"], "id_category");
    }

}