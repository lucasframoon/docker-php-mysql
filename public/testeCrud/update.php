<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\Category;

$category = (new Category())->findById(3);
$category->nm_category = "Update Categoria " . rand(0, 9999);
$category->save();