<?php
require __DIR__ . "/../../../vendor/autoload.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

use Source\Models\Category;

try {

    $listCategories = array();
    $category = new Category();
    $list = $category->find()->fetch(true);

    foreach ($list as $cat) {
        array_push($listCategories, $cat->data());
    }

    echo json_encode(['success' => true, 'listCategories' => $listCategories]);
    exit;
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}
