<?php

namespace Source\Models;

use Source\Models\Product;
use PHPUnit\Framework\TestCase;
// use CoffeeCode\DataLayer\DataLayer;

class ProductTest extends TestCase
{

    public function testProductInstance()
    {
        $product = new Product();
        $this->assertInstanceOf(Product::class, $product);
    }
    
    // public function testProductNotBeAInstanteOf()
    // {
    //     $product = new Product();
    //     $this->expectException(Product::class, $product);
    // }

    public function testProductGetAllProducts()
    {
        $product = (new Product())->getProductById(1);

        $this->assertInstanceOf(Product::class, $product);
    }
}
