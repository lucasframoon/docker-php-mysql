<?php

require __DIR__ . "/../vendor/autoload.php";

use Source\Models\Category;

$category = new Category();
$category->nm_category = "Nova Categoria " . rand(0, 9999);
$category->save();