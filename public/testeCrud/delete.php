<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\Category;

$category = (new Category())->findById(4);

if($category){
    $category->destroy();
}