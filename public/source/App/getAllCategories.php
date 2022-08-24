<?php
require __DIR__ . "/../../vendor/autoload.php";

use Source\Models\Category;

$listCategories = array();
$category = new Category();
$list = $category->find()->fetch(true);

foreach ($list as $cat) {
    array_push($listCategories, $cat->data());
}

echo json_encode(['listCategories' => $listCategories]);
